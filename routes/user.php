<?php
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
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
Route::post('/user/product/getQuantity', [ProductController::class, 'getProductQuantity'])
    ->name('user.product.getQuantity');

    // Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['user', 'auth']], function () {
    //     // \UniSharp\LaravelFilemanager\Lfm::routes();
    // });

Route::get('/api/product/quantity', [ProductController::class, 'getQuantity'])->name('api.product.quantity');
    // Mua bán hàng
Route::get('users/cart/list', [CartController::class, 'list'])->name('users.cart.list');
Route::post('users/cart/add', [CartController::class, 'add'])->name('users.cart.add');


Route::post('users/order/save', [OrderController::class, 'save'])->name('users.order.save');

Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('users.cart.remove');
Route::get('users/cart/checkout', [CartController::class, 'checkout'])->name('users.cart.checkout');

Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('users.cart.update');
Route::post('/users/cart/update-multiple', [CartController::class, 'updateMultiple'])->name('users.cart.update-multiple');


