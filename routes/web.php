<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CarController;

Route::get('/', function () {
    return redirect('/customer/login');
});

Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/{product_id}', [CarController::class, 'userShow'])->name('cars.user-show');
Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');
Route::get('/cars/{id}', [CarController::class, 'show'])->name('cars.show');
