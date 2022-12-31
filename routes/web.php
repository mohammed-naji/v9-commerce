<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontController;
use App\Models\User;
use App\Notifications\NewOrder;
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
Route::post('/product-review/{id}', [FrontController::class, 'product_rate'])->name('site.product_rate');


// Carts Routes
Route::post('add-to-cart', [CartController::class, 'add_to_cart'])->name('site.add_to_cart');

Route::get('cart', [CartController::class, 'cart'])->name('site.cart')->middleware('auth');
Route::get('checkout', [CartController::class, 'checkout'])->name('site.checkout')->middleware('auth');
Route::get('result', [CartController::class, 'result'])->name('site.result')->middleware('auth');

Route::put('update-cart', [CartController::class, 'update_cart'])->name('site.update_cart');

Route::get('remove-cart/{id}', [CartController::class, 'remove_cart'])->name('site.remove_cart');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});



// Just For test only
Route::get('send-notify', function() {
    $user = User::find(1);
    $user->notify(new NewOrder);
});

Route::get('all-notify', function() {
    $user = User::find(1);
    return view('notifications', compact('user'));
});

Route::get('read-notify/{id}', function($id) {
    $user = User::find(1);

    $user->notifications->find($id)->markAsRead();

    return view('notifications', compact('user'));
})->name('read_notify');
