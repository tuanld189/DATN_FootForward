<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;
use Illuminate\Support\Facades\Log;

// Kiểm tra và log các route để tìm controller gây lỗi
// Route::get('/some-route', function () {
//     Log::info('This route is being accessed');
//     // Your logic here
// });
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

//tags,products
Route::get('/tags/search', [ProductController::class, 'search'])->name('tags.search');
Route::get('/products/search-products', [ProductController::class, 'searchProducts'])->name('admin.products.search-products');

// // // filemanager
// Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
//     Lfm::routes('unisharp.lfm.manager'); // Sử dụng tên route mới đã cấu hình trong lfm.php
// });
