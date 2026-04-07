<?php

use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\CustomizationController;
use App\Http\Controllers\AI\AIDesignController;

// Public auth
Route::post('/login', LoginController::class)->name('login');
Route::post('/register', RegisterController::class)->name('register');

// Public data
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{slug}', [ProductController::class, 'show'])
    ->where('slug', '[A-Za-z0-9\-]+');

// Stripe webhook (public)
Route::post('/stripe/webhook', [StripeController::class, 'webhook']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', VerificationController::class)->name('me');
    Route::post('/logout', LogoutController::class)->name('logout');

    // Cart
    Route::get('/cart', [CartController::class, 'show']);
    Route::post('/cart/items', [CartController::class, 'add']);
    Route::patch('/cart/items/{item}', [CartController::class, 'update']);
    Route::delete('/cart/items/{item}', [CartController::class, 'destroy']);

    // Checkout
    Route::post('/payment/intent', [StripeController::class, 'createPaymentIntent']);

    // Orders
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{order}', [OrderController::class, 'show']);
    Route::post('/orders', [OrderController::class, 'store']);

    Route::post('/customization/sessions', [CustomizationController::class, 'store']);
    Route::get('/customization/sessions/{customizationSession}', [CustomizationController::class, 'show']);
    Route::patch('/customization/sessions/{customizationSession}', [CustomizationController::class, 'update']);

    Route::post('/ai/designs/generate', AIDesignController::class);
});

Route::middleware(['auth:sanctum', 'admin'])->prefix('admin')->group(function () {
    Route::get('/ping', fn () => response()->json(['ok' => true]));
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus']);
});
