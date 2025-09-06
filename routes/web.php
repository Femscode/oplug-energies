<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;



Route::get('/',[FrontendController::class,'index'])->name('home');
Route::get('/shop',[FrontendController::class,'shop'])->name('shop');
Route::get('/product-details',[FrontendController::class,'productDetails'])->name('product-details');
Route::get('/cart',[FrontendController::class,'cart'])->name('cart');
Route::get('/checkout',[FrontendController::class,'checkout'])->name('checkout');
Route::get('/about-us',[FrontendController::class,'about'])->name('about');
Route::get('/contact-us',[FrontendController::class,'contact'])->name('contact');

// User dashboard routes 

// Route::group(['prefix' => 'user', 'middleware' => ['auth', 'role:user']], function() {
Route::group(['prefix' => 'user'], function() {
   
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user-dashboard');
    Route::get('/order', [DashboardController::class, 'order'])->name('user-order');
    Route::get('/change-password', [DashboardController::class, 'changePassword'])->name('change-password');
});
Route::group(['prefix' => 'admin'], function() {
   
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin-dashboard');
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin-order');
    Route::get('/products', [AdminController::class, 'products'])->name('admin-order');
    Route::get('/add-product', [AdminController::class, 'add_product'])->name('admin-add-product');
    Route::get('/change-password', [AdminController::class, 'changePassword'])->name('change-password');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
});