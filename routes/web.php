<?php

use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\SiteController;
use App\Http\Controllers\ContactFormSubmissionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OptionGroupController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SubCategoryController;
use App\Models\Advertisement;
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

Route::get('/register', function () {
    return redirect()->route('login');
});
