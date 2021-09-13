<?php

use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\SiteController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Mail\ClientRegistered;
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

Auth::routes();

// get
Route::get('/', [SiteController::class, 'home'])->name('site.home');
Route::get('about', [SiteController::class, 'about'])->name('site.about');
Route::get('faq' , [SiteController::class, 'faq'])->name('site.faq');
Route::get('pricing' , [SiteController::class, 'pricing'])->name('site.pricing');
Route::get('contact' , [SiteController::class, 'contact'])->name('site.contact');
Route::get('clients/login', [AuthController::class, 'showLoginPage'])->name('client.login');
Route::get('clients/signup', [AuthController::class, 'showSignUpPage'])->name('client.signup');
Route::get('clients/forgot-password', [AuthController::class, 'showForgotPasswordPage'])->name('client.forgot-password');
Route::get('clients/email-verify', [AuthController::class, 'showVerifyEmailNotificationPage'])->name('client.email-verify');
Route::get('clients/verify-email', [AuthController::class, 'verifyClientEmail'])->name('client.verify-email');
Route::get('client/profile', [ClientController::class, 'showProfilePage'])->name('client.profile');

// post
Route::post('clients/signup', [AuthController::class, 'processClientSignUp'])->name('client.process-signup');
Route::post('clients/login', [AuthController::class, 'processClientLogin'])->name('client.process-login');
Route::post('clients/logout', [AuthController::class, 'processClientLogout'])->name('client.process-logout');

// Administration Panel Routes
Route::get('/admin', [HomeController::class, 'root'])->name('root');
//Update User Details
Route::post('/update-profile/{id}', [HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [HomeController::class, 'updatePassword'])->name('updatePassword');
Route::get('/send-test-email', function() {
    Mail::to('isu3ru@gmail.com')
    ->send(new ClientRegistered());
});