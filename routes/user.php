<?php

use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\UserController;
use App\Http\Services\Payment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\PostController as UserPostController;
use App\Http\Controllers\UserProfileController;

Route::get('/', [HomeController::class, 'index'])->name('index');

//shop
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');

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


// api product
Route::get('/api/product/quantity', [ProductController::class, 'getQuantity'])->name('api.product.quantity');

// cart
Route::get('/cart/list', [CartController::class, 'list'])->name('cart.list');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/update/{id}', [CartController::class, 'update'])->name('cart.update');


Route::post('cart/apply-voucher', [CartController::class, 'applyVoucher'])->name('cart.applyVoucher');
Route::post('/cart/update-multiple', [CartController::class, 'updateMultiple'])->name('cart.update-multiple');
// Đơn hàng
// Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('placeOrder');
// Route::post('/order/save', [OrderController::class, 'save'])->name('order.save');
// Route::get('order/confirmation/{order_id}', [OrderController::class, 'confirmation'])->name('order.confirmation');

// Thanh toán VNPAY

Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place');
Route::get('/order/vnpay-return', [OrderController::class, 'vnpay_return'])->name('order.vnpay_return');
Route::get('/order-confirmation/{order_id}', [OrderController::class, 'confirmation'])->name('order.confirmation');
//comment
Route::post('/product/{id}/comment', [ProductController::class, 'storeForProduct'])->name('product.comment');
Route::delete('/product/comment/{comment}', [ProductController::class, 'deleteComment'])->name('product.comment.delete');
Route::put('/comment/{id}', [ProductController::class, 'updateComment'])->name('comment.update');

// Route to show a single post
Route::get('/post/{id}', [UserPostController::class, 'show'])->name('client.post');


// Route để hiển thị form chỉnh sửa thông tin người dùng
Route::get('/profile/edit/{id}', [UserProfileController::class, 'edit'])->name('client.profile.edit');
// Route để xử lý việc cập nhật thông tin người dùng
Route::put('/profile/update/{id}', [UserProfileController::class, 'update'])->name('client.profile.update');


