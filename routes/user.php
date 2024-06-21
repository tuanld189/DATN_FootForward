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
Route::get('/get-quantity', [ProductController::class, 'getQuantity'])->name('getQuantity');
Route::post('/user/product/getQuantity', [ProductController::class, 'getProductQuantity'])
    ->name('product.getQuantity');
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['user', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });


Route::get('/api/product/quantity', [ProductController::class, 'getQuantity'])->name('api.product.quantity');
    // Mua bán hàng
Route::get('/cart/list', [CartController::class, 'list'])->name('cart.list');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');


Route::post('/order/save', [OrderController::class, 'save'])->name('order.save');

Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

Route::post('/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/update-multiple', [CartController::class, 'updateMultiple'])->name('cart.update-multiple');

