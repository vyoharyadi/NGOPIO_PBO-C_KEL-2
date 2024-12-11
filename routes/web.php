<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/cart', [OrderController::class, 'showCart'])->name('cart');
    Route::post('/cart/confirm', [OrderController::class, 'confirmOrder'])->name('cart.confirm');
    Route::get('/checkout', [OrderController::class, 'showCheckout'])->name('checkout');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::middleware(['role:admin'])->group(function () {
    Route::view('/admin/menu', 'admin.menu');
});

Route::post('/signup', [AuthController::class, 'register'])->name('signup');

Route::view('/about', 'about');
Route::view('/', 'landingpage');
Route::view('/login', 'login');
Route::view('/signup', 'signup');


Route::prefix('cashier')->group(function () {
    Route::get('/menu', [CartController::class, 'showCashierMenu'])->name('cashier.menu');
    Route::get('/order', [OrderController::class, 'showOrders'])->name('cashier.orders');
});

Route::prefix('user')->group(function () {
    Route::view('/cart', 'user.cart');
    Route::view('/checkout', 'user.checkout');
    Route::view('/profile', 'user.profile');
});

Route::prefix('admin')->group(function () {
    Route::get('/menu', [ProductController::class, 'index'])->name('menu.index');
    Route::post('/menu', [ProductController::class, 'store'])->name('menu.store');
    Route::put('/menu/{id}', [ProductController::class, 'update'])->name('menu.update');
});

Route::get('/admin/menu', [ProductController::class, 'menu'])->name('menu.index');
Route::get('/user/home', [ProductController::class, 'index'])->name('product.index');
Route::get('/user/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/user/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::patch('/user/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/user/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::resource('users', UserController::class);
Route::get('/admin/account', [UserController::class, 'index'])->name('users.index');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

Route::post('/cashier/cart/confirm', [CartController::class, 'checkout'])->name('cart.confirm');
Route::post('/cashier/cart/add', [CartController::class, 'addToCartFromCashier'])->name('cashier.cart.add');
Route::patch('/cart/update/{id}', [CartController::class, 'updateCartFromCashier'])->name('cashier.cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCartFromCashier'])->name('cashier.cart.remove');
Route::post('/cart/checkout', [CartController::class, 'checkoutFromCashier'])->name('cashier.cart.checkout');
Route::get('/cashier/search', [CartController::class, 'search'])->name('cashier.search');
Route::post('/cashier/order/{id}/complete', [OrderController::class, 'markAsComplete']);



