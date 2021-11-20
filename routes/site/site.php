<?php

// Web Site Page Routes

use App\Http\Controllers\Client\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'home'])
->name('site.home');

Route::get('about', [SiteController::class, 'about'])
->name('site.about');

Route::get('faq', [SiteController::class, 'faq'])
->name('site.faq');

Route::get('pricing', [SiteController::class, 'pricing'])
->name('site.pricing');

Route::get('contact-us', [SiteController::class, 'contact'])
->name('site.contact');

Route::post(
    'contact-us',
    [SiteController::class, 'processContactFormSubmission']
)->name('site.contact.submission');
