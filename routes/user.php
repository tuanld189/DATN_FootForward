<?php

use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\VourcherController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\PostController as UserPostController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\VoucherController;
use App\Models\Vourcher;
use App\Http\Controllers\NotificationController;

Route::get('/', [HomeController::class, 'index'])->name('index');

//shop
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');

Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'postLogin']);
Route::get('signup', [UserController::class, 'signup'])->name('signup');
Route::post('signup', [UserController::class, 'postSignup']);
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
// Route::get('/profile/edit/{id}', [UserProfileController::class, 'edit'])->name('client.profile.edit');
// // Route để xử lý việc cập nhật thông tin người dùng
// Route::put('/profile/update/{id}', [UserProfileController::class, 'update'])->name('client.profile.update');

// Route::get('/orders/{id}', [OrderController::class, 'show']);



// Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

//Profile
Route::get('/profile/edit/{id}', [UserProfileController::class, 'edit'])->name('client.profile.edit');
Route::put('/profile/update/{id}', [UserProfileController::class, 'update'])->name('client.profile.update');
Route::put('/order/{id}/cancel', [UserProfileController::class, 'cancel'])->name('order.cancel');
Route::get('/profile/order/{id}', [UserProfileController::class, 'show'])->name('client.profile.order');
Route::get('/profile/{id}/change-password', [UserProfileController::class, 'showChangePasswordForm'])->name('client.profile.change-password');
Route::post('/profile/{id}/change-password', [UserProfileController::class, 'changePassword'])->name('client.profile.change-password.update');

// Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place');

Route::post('/voucher/redeem', [VourcherController::class, 'redeemVoucher'])->name('voucher.redeem');

//Blog
Route::get('/new', [UserPostController::class, 'new'])->name('client.new');
//Info
Route::get('/info', [HomeController::class, 'info'])->name('client.info');

Route::resource('vourchers', VourcherController::class);

Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
