<?php

use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\BackEnd\SocialController;
use App\Http\Controllers\Backend\VerificationController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FrontEnd\{ HomeController, ProductController, CategoryController, BrandController, CartController };
use App\Http\Controllers\FrontEnd\SubCategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 🔐 Authentication Routes
|--------------------------------------------------------------------------
*/
Auth::routes(['verify' => true]);

// Route::middleware('auth')->prefix('email')->name('verification.')->group(function () {
//     Route::get('/verify', [VerificationController::class, 'show'])->name('notice');
//     Route::post('/verify/resend', [VerificationController::class, 'resend'])->name('resend');
// });

/*
|--------------------------------------------------------------------------
| 🌐 Social Login
|--------------------------------------------------------------------------
*/
Route::prefix('auth')->group(function () {
    Route::get('{provider}/redirect', [SocialController::class, 'redirect']);
    Route::get('{provider}/callback', [SocialController::class, 'callback']);
});

/*
|--------------------------------------------------------------------------
| 🏠 Frontend Routes
|--------------------------------------------------------------------------
*/
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'LatestProducts')->name('home');
    Route::get('/home/category/{id?}', 'showProductsByCategory')->name('home.category');
});

/*
|--------------------------------------------------------------------------
| 📦 Products & Categories & Subcategory
|--------------------------------------------------------------------------
*/
Route::controller(ProductController::class)->prefix('products')->group(function () {
    Route::get('/{id?}', 'index')->name('products');
    Route::get('/details/{id}', 'productdetails')->name('product.details');
});

Route::controller(CategoryController::class)->prefix('categories')->group(function () {
    Route::get('/{id?}', 'index')->name('categories');
});
Route::controller(SubCategoryController::class)->prefix('subcategories')->group(function () {
    Route::get('/{id?}', 'index')->name('subcategories');
    Route::get('/products/{id}', 'showProductsBySubcategory')->name('subcategories.products');
});

Route::controller(BrandController::class)->group(function () {
    Route::get('/brands', 'index')->name('brands');
    Route::get('/products/brand/{id}', 'products')->name('products.brand');
});

/*
|--------------------------------------------------------------------------
| 🛒 Cart Routes
|--------------------------------------------------------------------------
*/
Route::prefix('cart')->name('cart.')->controller(CartController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/add', 'addToCart')->name('add');
    Route::post('/update/{cart}', 'updateCart')->name('update');
    Route::post('/remove/{cart}', 'removeFromCart')->name('remove');
    Route::post('/clear', 'clearCart')->name('clear');
});

/*
|--------------------------------------------------------------------------
| 💳 Checkout & Orders
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'preventAdmin'])->group(function () {

    Route::controller(CheckoutController::class)->group(function () {
        Route::get('/checkout', 'index')->name('checkout.index');
        Route::post('/checkout/place-order', 'placeOrder')->name('checkout.placeOrder');
        Route::get('/my-orders', 'myOrders')->name('orders.index');
    });

});

/*
|--------------------------------------------------------------------------
| 📞 Contact Pages
|--------------------------------------------------------------------------
*/
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');