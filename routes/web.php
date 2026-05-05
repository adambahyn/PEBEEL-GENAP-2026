<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CarController;
use App\Models\car;
use App\Http\Controllers\AuthController;

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
Route::get('/product/{product_id}', [CarController::class, 'userShow'])->name('cars.user-show');
Route::get('/sync-products-cars', [ProductController::class, 'syncToCars'])->name('product.sync');
Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');
Route::get('/cars/{id}', [CarController::class, 'show'])->name('cars.show');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
