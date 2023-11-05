<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Authenticate
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'form_post_request'])->name('login.form_post');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'form_post_request'])->name('register.form_post');

Route::post('/logout', LogoutController::class)->name('logout');

// Reset password
Route::get('/forgot-password', [ResetPasswordController::class, 'indexForgotPassword'])->name('password.request');
Route::post('/forgot-password', [ResetPasswordController::class, 'formForgotPassword'])->name('password.email');

Route::get('/reset-password/{token}',
    [ResetPasswordController::class, 'indexResetPassword'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'formResetPassword'])->name('password.update');

// Email verification
Route::get('/email/verify', [EmailVerificationController::class, 'index'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}',
    [EmailVerificationController::class, 'verifyEmail'])->name('verification.verify');
Route::post('/email/verification-notification',
    [EmailVerificationController::class, 'sendVerificationMail'])->name('verification.send');
