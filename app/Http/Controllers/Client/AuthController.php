<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientLoginRequest;
use App\Http\Requests\ClientSignupRequest;
use App\Models\User;
use App\Services\ClientAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    protected $clientAuth;

    public function __construct(ClientAuthService $clientAuth ) {
        $this->clientAuth = $clientAuth;
    }

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
     * Show the email verification sent notification page
     */
    public function showVerifyEmailNotificationPage()
    {
        return view('pages.web.auth.verify-email');
    }     

    /**
     * Process the sign up for a website user
     * 
     * @param ClientSignupRequest $clientSignupRequest
     */
    public function processClientSignUp(ClientSignupRequest $request)
    {
        // signup
        $this->clientAuth->signUp($request);

        // redirect to email address verification notice page
        return redirect()->route('verification.notice');
    }
    
    /**
     * Verify email address
     * @param EmailVerificationRequest $request
     */
    public function verifyClientEmail(EmailVerificationRequest $request) {
        // verify the email address
        $request->fulfill();

        $this->clientAuth->setActive();

        // return to client profile page after
        return redirect()->route('client.profile')
                ->with('success', 'Thank you for verifying your email address. Your account is now verified and active.');
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
     * @param ClientLoginRequest $request
     * @return \Illuminate\Http\RedirectResponse $response
     */
    public function processClientLogin(ClientLoginRequest $request)
    {
        $isLoggedIn = $this->clientAuth->login($request);

        if(!$isLoggedIn) {
            return redirect()->route('client.login')->with('error', 'Failed to login. Please check your username and password and try again.');
        }

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
