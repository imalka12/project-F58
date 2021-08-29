<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiteController;
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

Auth::routes();

Route::get('/', [SiteController::class, 'home'])->name('site.home');
Route::get('about', [SiteController::class, 'about'])->name('site.about');

Route::get('/admin', [HomeController::class, 'root'])->name('root');

//Update User Details
Route::post('/update-profile/{id}', [HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [HomeController::class, 'updatePassword'])->name('updatePassword');

Route::get('{any}', [HomeController::class, 'index'])->name('index');

//Language Translation
Route::get('index/{locale}', [HomeController::class, 'lang']);
