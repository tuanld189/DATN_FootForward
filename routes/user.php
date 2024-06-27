<?php
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\UserController;
use App\Http\Services\Payment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('index');

// login
Route::get('/login',[UserController::class, 'login'])->name('login');
Route::post('/login',[UserController::class, 'postLogin']);

// signup
Route::get('/signup',[UserController::class, 'signup'])->name('signup');
Route::post('/signup',[UserController::class, 'postSignup']);
Route::get('/logout',[UserController::class, 'logout'])->name('logout');

// product
Route::get('/product/{id}', [ProductController::class, 'show'])->name('client.show');
Route::get('/get-quantity', [ProductController::class, 'getQuantity'])->name('getQuantity');
Route::post('/user/product/getQuantity', [ProductController::class, 'getProductQuantity'])->name('product.getQuantity');

// filemanager
// Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['user', 'auth']], function () {
//     \UniSharp\LaravelFilemanager\Lfm::routes();
// });

// api product
Route::get('/api/product/quantity', [ProductController::class, 'getQuantity'])->name('api.product.quantity');

// cart
Route::get('/cart/list', [CartController::class, 'list'])->name('cart.list');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/update-multiple', [CartController::class, 'updateMultiple'])->name('cart.update-multiple');

// order
Route::post('/order/save', [OrderController::class, 'save'])->name('order.save');
Route::get('order/confirmation/{order_id}', [OrderController::class, 'confirmation'])->name('order.confirmation');

// vnpay payment
    Route::post('/vnpay_payment', [OrderController::class, 'vnpay_payment'])->name('vnpay_payment');
    Route::post('/check-out',[OrderController::class,'store'])->name('checkout.store');
