<?php

// Client Login / Signup & Logout Routes

use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\ClientController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get(
        'clients/login',
        [AuthController::class, 'showLoginPage']
    )->name('client.login');

    Route::post(
        'clients/login',
        [AuthController::class, 'processClientLogin']
    )->name('client.process-login');

    Route::get(
        'clients/signup',
        [AuthController::class, 'showSignUpPage']
    )->name('client.signup');

    Route::post(
        'clients/signup',
        [AuthController::class, 'processClientSignUp']
    )->name('client.process-signup');

    Route::get(
        'clients/forgot-password',
        [AuthController::class, 'showForgotPasswordPage']
    )->name('password.request');

    Route::post(
        '/forgot-password',
        [AuthController::class, 'sendPasswordResetLinkEmail']
    )->name('password.email');

    Route::get(
        '/reset-password/{token}',
        [AuthController::class, 'passwordReset']
    )->middleware('guest')->name('password.reset');

    Route::post(
        '/reset-password',
        [AuthController::class, 'updateUserPassword']
    )->middleware('guest')->name('password.update');
});

Route::middleware(['auth'])->group(function () {
    Route::post(
        'clients/logout',
        [AuthController::class, 'processClientLogout']
    )->name('client.process-logout');

    // 1. show email notification page
    Route::get(
        '/email/verify',
        [AuthController::class, 'showVerifyEmailNotificationPage']
    )->name('verification.notice');

    // 2. allow to resend the email for email verification - limited to 6 attempts per minute
    Route::post(
        '/email/verification-notification',
        [AuthController::class, 'resendClientEmailVerificationEmail']
    )->middleware(['throttle:6,1'])
        ->name('verification.send');

    // 3. verify the email
    Route::get(
        '/email/verify/{id}/{hash}',
        [AuthController::class, 'verifyClientEmail']
    )->middleware(['signed'])
        ->name('verification.verify');
});

# Email Verification Routes
Route::middleware(['verified'])->group(function () {
    Route::get(
        'client/profile',
        [ClientController::class, 'showProfilePage']
    )->name('client.profile');

    Route::post(
        'client/profile',
        [ClientController::class, 'updateClientProfile']
    )->name('client.profile.update');

    Route::post(
        'user/profile-delete/{user}',
        [ClientController::class, 'processDeleteRequest']
    )->name('user.profile.delete.confirmation');

    Route::get(
        'delete/user/profile/{user}',
        [ClientController::class, 'deleteUserProfile']
    )->name('user.profile.delete');
});
