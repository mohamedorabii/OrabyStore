<?php

use App\Http\Controllers\BackEnd\SocialController;
use App\Http\Controllers\Backend\VerificationController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FrontEnd\BrandController;
use App\Http\Controllers\FrontEnd\CartController;
use App\Http\Controllers\FrontEnd\CategoryController;
use App\Http\Controllers\FrontEnd\HomeController;
use App\Http\Controllers\FrontEnd\ProductController;
use App\Http\Controllers\FrontEnd\SubCategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Socialite;


Auth::routes(['verify' => true]);
// Email Verification Routes
Route::middleware(['auth'])->group(function () {
   Route::get('/email/verify',[VerificationController::class,'show'])->name('verification.notice');
   Route::post('/email/verify/resend',[VerificationController::class,'resend'])->name('verification.resend');
});


Route::get('/auth/{provider}/redirect', [SocialController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialController::class, 'callback']);


// Frontend Routes
Route::get('/', [HomeController::class,'LatestProducts'])->name('home');
Route::get('/home/category/{id?}', [HomeController::class,'showProductsByCategory'])->name('home.category');
Route::get('/products/{id?}',[ProductController::class,'index'])->name('products');
Route::get('/brands',[BrandController::class,'index'])->name('brands');
Route::get('/categories/{id?}',[CategoryController::class,'index'])->name('categories');
Route::get('/subcategories',[SubCategoryController::class,'index'])->name('subcategories');
Route::get('/product/{id}',[ProductController::class,'productdetails'])->name('product.details');
Route::view('/contact', 'contact')->name('contact');
Route::prefix('cart')->name('cart.')->group(function(){
    Route::get('/',[CartController::class,'index'])->name('index');
      Route::post('/add',[CartController::class,'addToCart'])->name('add');
      Route::post('/update/{cart}',[CartController::class,'updateCart'])->name('update');
      Route::post('/remove/{cart}',[CartController::class,'removeFromCart'])->name('remove');
      Route::post('/clear',[CartController::class,'clearCart'])->name('clear');
});
Route::get('/checkout', [CheckoutController::class, 'index'])
    ->middleware(['auth','verified'])
    ->name('checkout.index');
Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])
    ->middleware(['auth','verified'])
    ->name('checkout.placeOrder');

Route::get('/my-orders', [CheckoutController::class, 'myOrders'])
    ->middleware(['auth', 'verified'])
    ->name('orders.index');