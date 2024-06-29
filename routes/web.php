<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('dashboard', function () {
//     return view('dashboard');
// });
Route::get('/tags/search', [ProductController::class, 'search'])->name('tags.search');


// routes/web.php


Route::post('/vnpay-payment', [OrderController::class, 'vnpay_payment'])->name('vnpay_payment');
Route::get('/vnpay-return', [OrderController::class, 'vnpay_return'])->name('vnpay_return');
Route::get('/order-confirmation/{order_id}', [OrderController::class, 'confirmation'])->name('order.confirmation');


