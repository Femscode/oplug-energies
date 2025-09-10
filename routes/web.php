<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use Illuminate\Support\Facades\Route;






Route::get('/',[FrontendController::class,'index'])->name('home');
Route::get('/shop',[FrontendController::class,'shop'])->name('shop');
Route::get('/product-details',[FrontendController::class,'productDetails'])->name('product-details');
Route::get('/cart',[FrontendController::class,'cart'])->name('cart');
Route::get('/checkout',[FrontendController::class,'checkout'])->name('checkout');
Route::get('/about-us',[FrontendController::class,'about'])->name('about');
Route::get('/contact-us',[FrontendController::class,'contact'])->name('contact');

// User dashboard routes 
Route::group(['prefix' => 'user', 'middleware' => ['auth', 'role:user']], function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
    
    // User Orders
    Route::get('/orders', [UserOrderController::class, 'index'])->name('user.orders.index');
    Route::get('/orders/{order}', [UserOrderController::class, 'show'])->name('user.orders.show');
    Route::post('/orders/{order}/cancel', [UserOrderController::class, 'cancel'])->name('user.orders.cancel');
    Route::post('/orders/{order}/reorder', [UserOrderController::class, 'reorder'])->name('user.orders.reorder');
    
    // User Profile
    Route::get('/profile', [UserProfileController::class, 'show'])->name('user.profile');
    Route::put('/profile', [UserProfileController::class, 'update'])->name('user.profile.update');
    Route::get('/change-password', [UserProfileController::class, 'showChangePasswordForm'])->name('user.change-password');
    Route::post('/change-password', [UserProfileController::class, 'changePassword'])->name('user.change-password.update');
    Route::delete('/profile', [UserProfileController::class, 'destroy'])->name('user.profile.destroy');
});
// Admin dashboard routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function() {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Admin Product Management
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/add-product', [AdminController::class, 'add_product'])->name('admin.add-product');
    Route::post('/products/store', [AdminController::class, 'storeProduct'])->name('admin.store_product');
    Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::put('/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/products/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.destroy');
    
    // Admin Category Management
    Route::resource('categories', AdminCategoryController::class, [
        'names' => [
            'index' => 'admin.categories.index',
            'create' => 'admin.categories.create',
            'store' => 'admin.categories.store',
            'show' => 'admin.categories.show',
            'edit' => 'admin.categories.edit',
            'update' => 'admin.categories.update',
            'destroy' => 'admin.categories.destroy'
        ]
    ]);
    
    // Admin Order Management
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    
    // Admin Settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::get('/change-password', [AdminController::class, 'changePassword'])->name('admin.change-password');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
