<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->as('admin.')
    // ->middleware(['wed', 'is_admin'])
    ->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

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
            Route::get('{id}/destroy', [BrandController::class, 'destroy'])->name('destroy');
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
            Route::get('{id}/destroy', [CategoryController::class, 'destroy'])->name('destroy');
        });
        //PRODUCT
        Route::prefix('products')
            ->as('products.')
            ->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('create', [ProductController::class, 'create'])->name('create');
            Route::post('store', [ProductController::class, 'store'])->name('store');
            Route::get('show/{id}', [ProductController::class, 'show'])->name('show');
            Route::get('{id}/edit', [ProductController::class, 'edit'])->name('edit');
            Route::put('{id}/update', [ProductController::class, 'update'])->name('update');
            Route::get('{id}/destroy', [ProductController::class, 'destroy'])->name('destroy');
        });
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
            Route::get('{id}/destroy', [BannerController::class, 'destroy'])->name('destroy');
        });
        //USERS
        Route::prefix('users')
            ->as('users.')
            ->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('create', [UserController::class, 'create'])->name('create');
            Route::post('store', [UserController::class, 'store'])->name('store');
            Route::get('show/{id}', [UserController::class, 'show'])->name('show');
            Route::get('{id}/edit', [UserController::class, 'edit'])->name('edit');
            Route::put('{id}/update', [UserController::class, 'update'])->name('update');
            Route::get('{id}/destroy', [UserController::class, 'destroy'])->name('destroy');
        });
        Route::get('/provinces', [LocationController::class, 'getProvinces']);
        Route::get('/districts/{province_id}', [LocationController::class, 'getDistricts']);
        Route::get('/wards/{district_id}', [LocationController::class, 'getWards']);
    });
