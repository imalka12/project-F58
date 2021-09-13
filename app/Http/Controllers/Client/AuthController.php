<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

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

        // send verification email - trigger client registered event

        // show the verification email sent notice page
        return redirect()->route('client.email-verify');
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
     */
    public function verifyClientEmail()
    {
        # code...
    }

    /**
     * Process client login request
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse $response
     */
    public function processClientLogin(Request $request)
    {
        // get all post data
        $data = $request->post();

        // validate post request
        $request->validate([
            'email_address' => 'required|email|exists:users,email',
            'password' =>'required',
            'remember_me' =>'nullable|boolean',
        ], $data);

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

        return redirect()->route('site.home');
    }

}
