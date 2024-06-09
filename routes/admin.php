<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->as('admin.')
    // ->middleware(['wed', 'is_admin'])
    ->group(function () {

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
    });
