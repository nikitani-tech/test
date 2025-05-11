<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ThankyouController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/product/{product_slug}', [ProductController::class, 'index']);

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/add-to-cart/{product_id}', [CartController::class, 'add_to_cart']);

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'checkout_request']);

Route::get('/thankyou/{order_id}', [ThankyouController::class, 'index']);
