<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Models\Product;

// Halaman Beranda
Route::get('/', function () {
    if (!auth()->check()) {
        return redirect()->route('register');
    }

    // Mengambil produk yang tersedia dari database
    $menus = Product::where('is_available', true)
        ->orderBy('id')
        ->get();

    return view('home', compact('menus'));
})->name('home');

// Login dan Registrasi
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'show'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'store'])
        ->name('register.store');

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');
});

// Fitur yang membutuhkan login
Route::middleware('auth')->group(function () {

    // Detail Produk
    Route::get('/products/{product}', [ProductController::class, 'show'])
        ->name('products.show');

    // Keranjang
    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/cart/{product}/add', [CartController::class, 'add'])
        ->name('cart.add');

    Route::patch('/cart/{id}', [CartController::class, 'update'])
        ->name('cart.update');

    Route::delete('/cart/{id}', [CartController::class, 'remove'])
        ->name('cart.remove');

    // Checkout
    Route::get('/checkout', [OrderController::class, 'checkout'])
        ->name('orders.checkout');

    Route::post('/checkout', [OrderController::class, 'store'])
        ->name('orders.store');

    // Riwayat Pesanan
    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders.index');

    // Detail Pesanan
    Route::get('/orders/{order}', [OrderController::class, 'show'])
        ->name('orders.show');

    // Profil
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.index');

    // Mengubah Profil
    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});