<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\CartController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/verify-otp',  [AuthController::class, 'verifyOtp']);
    Route::post('/resend-otp',  [AuthController::class, 'resendOtp']);
    Route::post('/logout',      [AuthController::class, 'logout']);
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/reset-password',  [AuthController::class, 'resetPassword']);
});

Route::get('/products',      [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);

Route::get('/home',                    [HomeController::class, 'index']);
Route::get('/home/category/{id?}',     [HomeController::class, 'productsByCategory']);

Route::get('/categories',                [CategoryController::class, 'index']);
Route::get('/categories/{id}/products',  [CategoryController::class, 'products']);


Route::get('/brands',              [BrandController::class, 'index']);
Route::get('/brands/{id}/products', [BrandController::class, 'products']);


Route::get('/subcategories',                [SubCategoryController::class, 'index']);
Route::get('/subcategories/{id}/products',  [SubCategoryController::class, 'products']);



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/cart',           [CartController::class, 'index']);
    Route::post('/cart',          [CartController::class, 'store']);
    Route::put('/cart/{cart}',    [CartController::class, 'update']);
    Route::delete('/cart/{cart}', [CartController::class, 'destroy']);
    Route::delete('/cart',        [CartController::class, 'clear']);
});