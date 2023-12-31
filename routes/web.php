<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecoveryPasswordController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VerifyEmailController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can auth web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::controller(CountryController::class)->group(function () {
	Route::get('/countries', [CountryController::class, 'index'])->name('countries');
	Route::get('/', [CountryController::class, 'create'])->name('home')->middleware('auth');
});

Route::controller(RegisterController::class)->group(function () {
	Route::get('/register', [RegisterController::class, 'create'])->name('register')->middleware('guest');
	Route::post('/register', [RegisterController::class, 'store'])->name('post_register')->middleware('guest');
});

Route::controller(LoginController::class)->group(function () {
	Route::post('/login', [LoginController::class, 'store'])->name('post_login');
	Route::post('/logout', [LoginController::class, 'destroy'])->name('logout')->middleware('auth');
});

Route::controller(VerifyEmailController::class)->group(function () {
	Route::get('/reset-password', [VerifyEmailController::class, 'create'])->name('reset_password');
	Route::post('/reset-password', [VerifyEmailController::class, 'store'])->name('post_reset_password');
});

Route::controller(RecoveryPasswordController::class)->group(function () {
	Route::get('/new-password/{token}', [RecoveryPasswordController::class, 'create'])->name('new_password');
	Route::put('/recovery-password', [RecoveryPasswordController::class, 'update'])->name('recovery_password');
});

//for confirmation pages
Route::view('/confirmation', 'verification.confirmation')->name('confirmation');
Route::view('/confirmation-email', 'verification.confirmation-email')->name('confirmation_email');
Route::view('/account-verified', 'verification.account-confirmation')->name('account_verified');

Route::view('/login', 'auth.login')->name('login')->middleware('guest');
Route::view('/reset-password', 'verification.reset-password')->name('reset_password');
// email template
Route::view('/email-verification', 'emails.confirm-reset-password')->name('email_verification_reset_password');

//for localization
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang'])->name('switch_lang');
Route::post('lang', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang'])->name('lang');
Route::get('/lang/{lang}', [\App\Http\Controllers\LanguageController::class, 'switchLang'])->name('lang.switch');
