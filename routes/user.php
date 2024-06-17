<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\User\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;

// Route::get('/users/home', [HomeController::class, 'index'])->name('users.home');
Route::get('/', [HomeController::class, 'index'])->name('users.home');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('users.show');
// Route::get('/categories',[HomeController::class,'index'])->name('users.categories');
Route::get('/get-quantity', [ProductController::class, 'getQuantity'])->name('users.getQuantity');
Route::post('/api/product/quantity', [App\Http\Controllers\User\ProductController::class, 'getProductQuantity'])->name('api.product.quantity');
Route::post('/user/product/getQuantity', [ProductController::class, 'getProductQuantity'])
    ->name('user.product.getQuantity');
