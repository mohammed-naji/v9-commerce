<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Route::group(['prefix' => LaravelLocalization::setLocale()], function()
// {

Route::prefix(LaravelLocalization::setLocale())->group(function() {

Route::prefix('admin')->name('admin.')->middleware('auth', 'check_admin')->group(function() {

    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::resource('categories', CategoryController::class);

    Route::resource('products', ProductController::class);

    Route::get('orders', [AdminController::class, 'orders'])->name('orders');
    Route::get('orders/{id}', [AdminController::class, 'orders_details'])->name('orders_details')->whereNumber('id');

    Route::get('payments', [AdminController::class, 'payments'])->name('payments');

    Route::get('customers', [AdminController::class, 'customers'])->name('customers');

});

Route::get('/', [FrontController::class, 'index'])->name('site.home');
Route::get('/about', [FrontController::class, 'about'])->name('site.about');
Route::get('/shop', [FrontController::class, 'shop'])->name('site.shop');
Route::get('/contact', [FrontController::class, 'contact'])->name('site.contact');
Route::get('/category/{id}', [FrontController::class, 'category'])->name('site.category');
Route::get('/product/{id}', [FrontController::class, 'product'])->name('site.product');


// Carts Routes
Route::post('add-to-cart', [CartController::class, 'add_to_cart'])->name('site.add_to_cart');




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});
