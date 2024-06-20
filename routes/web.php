<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AuthController;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('dashboard', function () {
//     return view('dashboard');
// });
Route::get('/tags/search', [ProductController::class, 'search'])->name('tags.search');
Route::delete('admin/products/gallery/delete', [ProductController::class, 'deleteGallery'])->name('admin.products.gallery.delete');

Route::get('admin/products/search-products', [ProductController::class, 'searchProducts'])->name('admin.products.search-products');

// routes/web.php

