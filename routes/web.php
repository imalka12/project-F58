<?php

use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\SiteController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Mail\ClientRegistered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);
Route::get('/register', function(){
    return redirect()->route('login');
});

// Web Site Page Routes
Route::get('/', [SiteController::class, 'home'])->name('site.home');
Route::get('about', [SiteController::class, 'about'])->name('site.about');
Route::get('faq' , [SiteController::class, 'faq'])->name('site.faq');
Route::get('pricing' , [SiteController::class, 'pricing'])->name('site.pricing');
Route::get('contact' , [SiteController::class, 'contact'])->name('site.contact');

// Client Login / Signup & Logout Routes
Route::get('clients/login', [AuthController::class, 'showLoginPage'])->name('client.login');
Route::get('clients/signup', [AuthController::class, 'showSignUpPage'])->name('client.signup');
Route::get('clients/forgot-password', [AuthController::class, 'showForgotPasswordPage'])->name('client.forgot-password');
Route::post('clients/signup', [AuthController::class, 'processClientSignUp'])->name('client.process-signup');
Route::post('clients/login', [AuthController::class, 'processClientLogin'])->name('client.process-login');
Route::post('clients/logout', [AuthController::class, 'processClientLogout'])->name('client.process-logout');

// Client Profile Routes
Route::get('client/profile', [ClientController::class, 'showProfilePage'])->middleware('verified')->name('client.profile');
Route::post('client/profile', [ClientController::class, 'updateClientProfile'])->name('client.profile.update');

# Email Verification Routes
// 1. show email notification page
Route::get('/email/verify', [AuthController::class, 'showVerifyEmailNotificationPage'])->middleware('auth')->name('verification.notice');
// 2. allow to resend the email for email verification - limited to 6 attempts per minute
Route::post('/email/verification-notification', [AuthController::class, 'resendClientEmailVerificationEmail'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
// verify the email
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyClientEmail'])->middleware(['auth', 'signed'])->name('verification.verify');

// Administration Panel Routes
Route::get('/admin', [HomeController::class, 'root'])->name('root');
//Update User Details
Route::post('/update-profile/{id}', [HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [HomeController::class, 'updatePassword'])->name('updatePassword');