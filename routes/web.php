<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Public routes
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'Index')->name('home');
    Route::get('/about', 'About')->name('about');
    Route::get('/contact', 'Contact')->name('contact');
    Route::get('/shop', 'Shop')->name('shop');
    Route::get('/category/{id}/{slug}', 'Category')->name('category');
    Route::get('/collection/{id}/{slug}', 'Collection')->name('collection');
    Route::get('/product-details/{id}/{slug}', 'ProductDetails')->name('product');
});

// Cart routes (session-based)
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.cart');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Checkout & Orders (protected)
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.checkout');
    Route::post('/checkout/place-order', [CheckoutController::class, 'store'])->name('checkout.store');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');
});

require __DIR__ . '/auth.php';
