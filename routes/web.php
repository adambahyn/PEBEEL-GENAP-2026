<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GlobalSearchController;

Route::get('/', function () {
    return redirect('/home');
});
Route::get('/home', function () {
    $cars = Product::latest()->take(8)->get(); 
    $carsCount = Product::count();
    
    return view('home.index', compact('cars', 'carsCount'));
});

Route::get('/search', [GlobalSearchController::class, 'search'])->name('search.global');


Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User Routes
Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
Route::get('/user/rental-history', [UserController::class, 'rentalHistory'])->name('user.rental-history');

Route::put('/user/update-profile', [UserController::class, 'updateProfile'])->name('profile.update');
