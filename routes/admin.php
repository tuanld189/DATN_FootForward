<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductSaleController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VourcherController;
use App\Http\Controllers\Admin\OrderController;
use App\Models\Vourcher;
use Illuminate\Support\Facades\Route;




// Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('login', [AuthController::class, 'login']);
// Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')
    ->as('admin.')
    ->middleware(['web', 'auth'])
    ->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');


        //PRODUCT
        // Route::resource('products', ProductController::class);


        //BRAND
        Route::prefix('brands')
            ->as('brands.')
            ->group(function () {
                Route::get('/', [BrandController::class, 'index'])->name('index');
                Route::get('create', [BrandController::class, 'create'])->name('create');
                Route::post('store', [BrandController::class, 'store'])->name('store');
                Route::get('show/{id}', [BrandController::class, 'show'])->name('show');
                Route::get('{id}/edit', [BrandController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [BrandController::class, 'update'])->name('update');
                Route::delete('{id}/destroy', [BrandController::class, 'destroy'])->name('destroy');
            });
        //CATEGORY

        Route::prefix('categories')
            ->as('categories.')
            ->group(function () {

                Route::get('/', [CategoryController::class, 'index'])->name('index');
                Route::get('create', [CategoryController::class, 'create'])->name('create');
                Route::post('store', [CategoryController::class, 'store'])->name('store');
                Route::get('show/{id}', [CategoryController::class, 'show'])->name('show');
                Route::get('{id}/edit', [CategoryController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [CategoryController::class, 'update'])->name('update');
                Route::delete('{id}/destroy', [CategoryController::class, 'destroy'])->name('destroy');
            });

      // product
        Route::resource('products', ProductController::class);
        // Route::delete('products/gallery/delete', [ProductController::class, 'deleteGallery'])->name('products.gallery.delete');
        // Route::get('products/search-products', [ProductController::class, 'searchProducts'])->name('products.search-products');


        Route::post('/import-products', [ProductController::class, 'import'])->name('products.import');
        Route::get('/export-products', [ProductController::class, 'export'])->name('products.export');



        Route::resource('products', ProductController::class);
        Route::delete('products/gallery/delete', [ProductController::class, 'deleteGallery'])->name('products.gallery.delete');



        // PRODUCT-SALE
         Route::prefix('sales')->as('sales.')->group(function () {
            Route::get('/', [ProductSaleController::class, 'index'])->name('index');
            Route::get('create', [ProductSaleController::class, 'create'])->name('create');
            Route::post('store', [ProductSaleController::class, 'store'])->name('store');
            Route::get('{sale}', [ProductSaleController::class, 'show'])->name('show');
            Route::get('{sale}/edit', [ProductSaleController::class, 'edit'])->name('edit');
            Route::put('{sale}', [ProductSaleController::class, 'update'])->name('update');
            Route::delete('{sale}', [ProductSaleController::class, 'destroy'])->name('destroy');
        });


        //POST

        Route::prefix('posts')
            ->as('posts.')
            ->group(function () {
                Route::get('/', [PostController::class, 'index'])->name('index');
                Route::get('create', [PostController::class, 'create'])->name('create');
                Route::post('store', [PostController::class, 'store'])->name('store');
                Route::get('show/{id}', [PostController::class, 'show'])->name('show');
                Route::get('{id}/edit', [PostController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [PostController::class, 'update'])->name('update');
                Route::delete('{id}/destroy', [PostController::class, 'destroy'])->name('destroy');
            });
        // Vourchers

        Route::resource('vourchers', VourcherController::class);

        //ROLE

        // Route::prefix('roles')
        //     ->as('roles.')
        //     ->group(function () {
        //         Route::get('/', [RoleController::class, 'index'])->name('index');
        //         Route::get('create', [RoleController::class, 'create'])->name('create');
        //         Route::post('store', [RoleController::class, 'store'])->name('store');
        //         Route::get('show/{id}', [RoleController::class, 'show'])->name('show');
        //         Route::get('{id}/edit', [RoleController::class, 'edit'])->name('edit');
        //         Route::put('{id}/update', [RoleController::class, 'update'])->name('update');
        //         Route::delete('{id}/destroy', [RoleController::class, 'destroy'])->name('destroy');
        //     });
        //BANNERS
        Route::prefix('banners')
            ->as('banners.')
            ->group(function () {
                Route::get('/', [BannerController::class, 'index'])->name('index');
                Route::get('create', [BannerController::class, 'create'])->name('create');
                Route::post('store', [BannerController::class, 'store'])->name('store');
                Route::get('show/{id}', [BannerController::class, 'show'])->name('show');
                Route::get('{id}/edit', [BannerController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [BannerController::class, 'update'])->name('update');
                Route::delete('{id}/destroy', [BannerController::class, 'destroy'])->name('destroy');
            });

        //PERMISSION
        Route::prefix('permissions')
            ->as('permissions.')
            ->group(function () {
                Route::get('/', [PermissionController::class, 'index'])->name('index');
                Route::get('create', [PermissionController::class, 'create'])->name('create');
                Route::post('store', [PermissionController::class, 'store'])->name('store');
                Route::get('show/{id}', [PermissionController::class, 'show'])->name('show');
                Route::get('{id}/edit', [PermissionController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [PermissionController::class, 'update'])->name('update');
                Route::delete('{id}/destroy', [PermissionController::class, 'destroy'])->name('destroy');
            });
        //ROLES
        Route::prefix('roles')
            ->as('roles.')
            ->group(function () {

                Route::get('/', [PermissionController::class, 'index'])->name('index');
                Route::get('create', [PermissionController::class, 'create'])->name('create');
                Route::post('store', [PermissionController::class, 'store'])->name('store');
                Route::get('show/{id}', [PermissionController::class, 'show'])->name('show');
                Route::get('{id}/edit', [PermissionController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [PermissionController::class, 'update'])->name('update');
                Route::get('{id}/destroy', [PermissionController::class, 'destroy'])->name('destroy');
            });

        //USERS

        // Route::prefix('users')
        //     ->as('users.')
        //     ->group(function () {
        //         Route::get('/', [UserController::class, 'index'])->name('index');
        //         Route::get('create', [UserController::class, 'create'])->name('create');
        //         Route::post('store', [UserController::class, 'store'])->name('store');
        //         Route::get('show/{id}', [UserController::class, 'show'])->name('show');
        //         Route::get('{id}/edit', [UserController::class, 'edit'])->name('edit');
        //         Route::put('{id}/update', [UserController::class, 'update'])->name('update');
        //         Route::delete('{id}/destroy', [UserController::class, 'destroy'])->name('destroy');

        //         // Thêm route cho phương thức search
        //         Route::get('search', [UserController::class, 'search'])->name('search');
        //     });
        Route::prefix('users')
            ->as('users.')
            ->group(function () {
                Route::get('/', [UserController::class, 'index'])->name('index');
                Route::get('create', [UserController::class, 'create'])->name('create');
                Route::post('store', [UserController::class, 'store'])->name('store');
                Route::get('show/{id}', [UserController::class, 'show'])->name('show');
                Route::get('{id}/edit', [UserController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [UserController::class, 'update'])->name('update');
                Route::delete('{id}/destroy', [UserController::class, 'destroy'])->name('destroy');
            });

        // Route cho phương thức search
        Route::get('users/search', [UserController::class, 'index'])->name('admin.users.search');

        // COMMENT
        Route::prefix('comments')
        ->as('comments.')
        ->group(function () {
            Route::get('/', [CommentController::class, 'index'])->name('index');
            Route::get('create', [CommentController::class, 'create'])->name('create');
            Route::post('store', [CommentController::class, 'store'])->name('store');
            Route::get('show/{id}', [CommentController::class, 'show'])->name('show');
            Route::get('{id}/edit', [CommentController::class, 'edit'])->name('edit');
            Route::put('{id}/update', [CommentController::class, 'update'])->name('update');
            Route::delete('{id}/destroy', [CommentController::class, 'destroy'])->name('destroy');
        });



        // ORDER
        Route::prefix('orders')
            ->as('orders.')
            ->group(function () {
                Route::get('/', [AdminOrderController::class, 'index'])->name('index');
                Route::get('create', [AdminOrderController::class, 'create'])->name('create');
                Route::post('store', [AdminOrderController::class, 'store'])->name('store');
                Route::get('show/{id}', [AdminOrderController::class, 'show'])->name('show');
                Route::get('{id}/edit', [AdminOrderController::class, 'edit'])->name('edit');
                Route::put('{id}/update', [AdminOrderController::class, 'update'])->name('update');
                Route::delete('{id}/destroy', [AdminOrderController::class, 'destroy'])->name('destroy');
                Route::get('status', [AdminOrderController::class, 'status'])->name('status');
                Route::get('status', [AdminOrderController::class, 'status'])->name('status');
                Route::post('update-multiple', [AdminOrderController::class, 'updateMultiple'])->name('update_multiple');

            });


        Route::get('export-orders', [OrderController::class, 'export'])->name('orders.export');


        // PRODUCT CLUSTER
        Route::prefix('product-clusters')
        ->as('product-clusters.')
        ->group(function () {
            Route::get('/', [ProductClusterController::class, 'index'])->name('index');
            Route::get('create', [ProductClusterController::class, 'create'])->name('create');
            Route::post('store', [ProductClusterController::class, 'store'])->name('store');
            Route::get('show/{id}', [ProductClusterController::class, 'show'])->name('show');
            Route::get('{id}/edit', [ProductClusterController::class, 'edit'])->name('edit');
            Route::put('{id}/update', [ProductClusterController::class, 'update'])->name('update');
            Route::delete('{id}/destroy', [ProductClusterController::class, 'destroy'])->name('destroy');
        });
    });






























