<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Resources\PostController;
use App\Http\Controllers\Resources\ProductController;
use App\Http\Controllers\Resources\UserController;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

include_once __DIR__.'/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('posts', PostController::class);
Route::resource('users', UserController::class)->except(['create', 'store']);
Route::resource('products', ProductController::class);

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update')->where('productId',
    '[0-9]+');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
