<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('index');
//login
Route::get('/login',[UserController::class, 'login'])->name('login');
Route::post('/login',[UserController::class, 'postLogin']);
//signup
Route::get('/signup',[UserController::class, 'signup'])->name('signup');
Route::post('/signup',[UserController::class, 'postSignup']);
Route::get('/logout',[UserController::class, 'logout'])->name('logout');


Route::get('/product/{id}', [ProductController::class, 'show'])->name('users.show');
// Route::get('/categories',[HomeController::class,'index'])->name('users.categories');
Route::get('/get-quantity', [ProductController::class, 'getQuantity'])->name('users.getQuantity');
Route::post('/api/product/quantity', [App\Http\Controllers\User\ProductController::class, 'getProductQuantity'])->name('api.product.quantity');
Route::post('/user/product/getQuantity', [ProductController::class, 'getProductQuantity'])
    ->name('user.product.getQuantity');
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['user', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
