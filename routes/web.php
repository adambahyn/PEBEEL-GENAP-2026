<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Models\Product;

Route::get('/', function () {
    return redirect('/customer');
});
Route::get('/customer', function () {
    $cars = Product::latest()->take(8)->get(); 
    $carsCount = Product::count();
    
    return view('home.index', compact('cars', 'carsCount'));
});
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');
