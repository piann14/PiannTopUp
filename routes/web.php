<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TopUpController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;

// Home
Route::get('/', [HomeController::class , 'index'])->name('home');
Route::get('/search', [HomeController::class , 'search'])->name('search');

// TopUp
Route::get('/topup/{game:slug}', [TopUpController::class , 'show'])->name('topup.show');
Route::post('/topup/check-user', [TopUpController::class , 'checkUser'])->name('topup.check-user');
Route::post('/topup/checkout', [TopUpController::class , 'checkout'])->name('topup.checkout');

// Payment
Route::get('/payment/{orderNumber}', [PaymentController::class , 'show'])->name('payment.show');
Route::post('/payment/callback', [PaymentController::class , 'callback'])->name('payment.callback');
Route::get('/payment/{orderNumber}/pay', [PaymentController::class , 'simulatePay'])->name('payment.simulate');
Route::get('/payment/{orderNumber}/success', [PaymentController::class , 'success'])->name('payment.success');
Route::get('/payment/{orderNumber}/status', [PaymentController::class , 'checkStatus'])->name('payment.status');

// Order Tracking
Route::get('/cek-pesanan', [OrderController::class , 'track'])->name('order.track');
