<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\ClientRegistered;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /**
     * Shows the login page for website users
     */
    public function showLoginPage()
    {
        return view('pages.web.auth.login');
    }

    /**
     * Show the signup page for website users
     */
    public function showSignupPage()
    {
        return view('pages.web.auth.signup');
    }

    /**
     * Show the forgot password page
     */
    public function showForgotPasswordPage()
    {
        return view('pages.web.auth.forgot-password');
    }

    /**
     * Process the sign up for a website user
     */
    public function processClientSignUp(Request $request)
    {
        // get all post data from the request
        $data = $request->post();

        // create validation
        $validator = Validator::make($data, [
            'firstname' => 'required',
            'lastname' => 'required',
            'email_address' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        // check if validation fails
        if($validator->fails()) {
            // redirect to the sign up page with validation errors and old input values
            return redirect()->route('client.signup')->withErrors($validator)->withInput()->with('error', 'Please check your input values and try again.');
        }

        // get the default role from roles table
        $role = Role::where('is_default_role', true)->first();

        // create general user entry
        $user = User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email_address'],
            'password' => Hash::make($data['password']),
            'status' => 'inactive',
            'role_id' => $role->id
        ]);

        // create profile
        $user->profile()->create();
        
        // log in the user
        Auth::login($user);

        event(new Registered($user));

        return redirect()->route('verification.notice');
    }

    /**
     * Show the email verification sent notification page
     */
    public function showVerifyEmailNotificationPage()
    {
        return view('pages.web.auth.verify-email');
    }     
    
    /**
     * Verify email address
     * @param EmailVerificationRequest $request
     */
    public function verifyClientEmail(EmailVerificationRequest $request) {
        // verify the email address
        $request->fulfill();

        // get current logged in user
        $userId = auth()->user()->id;
        // change user status to active
        $user = User::find($userId);// get user record from users table
        $user->status = 'active';// change to active
        $user->save();// save change

        // return to client profile page after
        return redirect()->route('client.profile')->with('success', 'Thank you for verifying your email address. Your account is now verified and active.');
    }

    /**
     * Resend the email address verification email message
     *
     * @param Request $request
     * @return void
     */
    public function resendClientEmailVerificationEmail(Request $request) {
        // trigger resend email for email verification
        $request->user()->sendEmailVerificationNotification();
    
        // go back to email verification page with link sent message.
        return back()->with('success', 'Verification link sent!');
    }

    /**
     * Process client login request
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse $response
     */
    public function processClientLogin(Request $request)
    {
        // validate post request
        $data = $request->validate([
            'email_address' => 'required|email|exists:users,email',
            'password' =>'required',
            'remember_me' =>'nullable|boolean',
        ]);

        // if validation is passed;
        // get the user for the email address
        $user = User::where('email', $data['email_address'])->first();

        // verify password
        $passwordVerified = Hash::check($data['password'], $user->password);

        // return to login page if password is incorrect
        if(!$passwordVerified) {
            return redirect()->route('client.login')->with('error', 'Failed to login. Please try again.');
        }

        // check if remember me option is checked
        $isRememberMe = $request->post('remember_me') ? true : false;

        // login the user with remember option
        Auth::login($user, $isRememberMe);

        // redirect user to user profile
        return redirect()->route('client.profile');
    }

    /**
     * Process client logout
     *
     * @param Request $request
     * @return void
     */
    public function processClientLogout(Request $request)
    {
        Auth::logout();

        return redirect()->route('site.home')->with('info', 'You are now successfully logged out.');
    }

}
