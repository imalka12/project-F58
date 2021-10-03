<?php

use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\SiteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OptionGroupController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Auth;
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
Route::middleware(['verified'])->group(function () {
    Route::get('client/profile', [ClientController::class, 'showProfilePage'])->name('client.profile');
    Route::post('client/profile', [ClientController::class, 'updateClientProfile'])->name('client.profile.update');
    Route::get('client/create-advertisement', [AdvertisementController::class, 'showPostAdvertisementPage'])->name('client.advertisement.show-create');
    Route::post('client/create-advertisement', [AdvertisementController::class, 'createAdvertisement'])->name('client.advertisement.create');
});

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

# category options
Route::get('/admin/option-groups', [OptionGroupController::class, 'showOptionGroupsPage'])->name('admin.option-groups.add');
Route::post('/admin/option-groups', [OptionGroupController::class, 'createOptionGroup'])->name('admin.option-groups.create');
Route::get('/admin/option-groups/{id}', [OptionGroupController::class, 'showOptionGroupEditPage'])->name('admin.option-groups.edit');
Route::post('/admin/option-group/{id}', [OptionGroupController::class, 'updateOptionGroup'])->name('admin.option-groups.update');
Route::post('/admin/option-groups/{optionGroup}/values', [OptionGroupController::class, 'createOptionGroupValues'])->name('admin.option-group-values.create');

//category
Route::get('/admin/subcategory', [SubCategoryController::class, 'showSubCategoryPage'])->name('admin.subcategory.add');
Route::post('/admin/subcategory', [SubCategoryController::class, 'createSubCategories'])->name('admin.subcategory.create');
Route::get('/admin/subcategory/{id}', [SubCategoryController::class, 'showSubCategoryEditPage'])->name('admin.subcategory.edit');
