<?php

use App\Http\Controllers\Payment\PaymentController;
use Illuminate\Support\Facades\Route;

Route::post('/checkout', [PaymentController::class, 'checkout'])->name('payment.checkout');
Route::post('/payment', [PaymentController::class, 'result'])->name('payment.result');
