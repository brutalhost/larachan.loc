<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update')->where('productId',
    '[0-9]+');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
