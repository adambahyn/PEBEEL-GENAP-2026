<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Models\car;

Route::get('/', function () {
    return redirect('/customer/login');
});
Route::get('/customer', function () {
    // Ambil beberapa mobil secara acak atau terbaru untuk ditampilkan di beranda
    $cars = Car::latest()->take(8)->get(); 
    
    // Kembalikan view yang baru saja dibuat
    return view('home.index', compact('cars'));
});
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');
