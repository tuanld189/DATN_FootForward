
<?php


use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;


use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Models\Tag;
use Illuminate\Support\Facades\Route;


//PERMISSIONS
Route::resource('permissions', PermissionController::class);
Route::get('permissions/{permissionId}/delete', [PermissionController::class,'destroy']);

//ROLES
Route::resource('roles',RoleController::class);
Route::get('roles/{roleId}/delete', [RoleController::class,'destroy']);

Route::get('roles/{roleId}/give-permissions',[RoleController::class,'addPermissionToRole']);

Route::put('roles/{roleId}/give-permissions',[RoleController::class,'givePermissionToRole']);

Route::prefix('admin')
    ->as('admin.')
    // ->middleware(['wed', 'is_admin'])
    ->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');


        // Route::prefix('permissions')
        //     ->as('permissions.')
        //     ->group(function () {
        //     Route::get('/', [PermissionController::class, 'index'])->name('index');
        //     Route::get('create', [PermissionController::class, 'create'])->name('create');
        //     Route::post('store', [PermissionController::class, 'store'])->name('store');
        //     Route::get('show/{id}', [PermissionController::class, 'show'])->name('show');
        //     Route::get('{id}/edit', [PermissionController::class, 'edit'])->name('edit');
        //     Route::put('{id}/update', [PermissionController::class, 'update'])->name('update');
        //     Route::get('{id}/destroy', [PermissionController::class, 'destroy'])->name('destroy');
        // });
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
        Route::resource('products', ProductController::class);
        //POST
        Route::prefix('post')
        ->as('posts.')
        ->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('create', [PostController::class, 'create'])->name('create');
        Route::post('store', [PostController::class, 'store'])->name('store');
        Route::get('show/{id}', [PostController::class, 'show'])->name('show');
        Route::get('{id}/edit', [PostController::class, 'edit'])->name('edit');
        Route::put('{id}/update', [PostController::class, 'update'])->name('update');
        Route::get('{id}/destroy', [PostController::class, 'destroy'])->name('destroy');
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
    });
