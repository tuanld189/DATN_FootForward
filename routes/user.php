<?php

use App\Http\Controllers\User\CategoriesController;
use App\Http\Controllers\User\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;

Route::get('/users/home', [HomeController::class, 'index'])->name('users.home');
Route::get('/users/categories', [CategoriesController::class, 'index'])->name('users.categories');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('users.show');
