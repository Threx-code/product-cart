<?php

use App\Helpers\Http\Controllers\V1\CartsController;
use App\Helpers\Http\Controllers\V1\ProductsController;
use App\Helpers\Http\Controllers\V1\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware([])
    ->prefix('/v1/')
    ->group(function () {
        Route::prefix('/products')->group(function(){
            Route::get('/', [ProductsController::class, 'getAllProducts'])->name('all-products');
            Route::get('/{product_id}', [ProductsController::class, 'getSingleProduct'])->name('get-a-product');
            Route::post('/', [ProductsController::class, 'store'])->name('store.products');
            Route::delete('/{product_id}', [ProductsController::class, 'deleteAProduct'])->name('delete-a-product');
        });

        Route::prefix('/users')->group(function (){
            Route::get('/', [UserController::class, 'getAllUsers'])->name('all-users');
            Route::get('/{user_id}', [UserController::class, 'getSingleUser'])->name('get-a-user');
        });

        Route::prefix('/carts')->group(function (){
            Route::get('/', [CartsController::class, 'getAllCarts'])->name('all-carts');
            Route::get('/removed', [CartsController::class, 'getProductsRemovedFromCarts'])->name('get-products-removed-from-cart');
            Route::get('/{user_id}', [CartsController::class, 'getAUserCarts'])->name('get-a-user-cart');
            Route::get('/active/{user_id}', [CartsController::class, 'getAUserActiveCart'])->name('get-a-user-active-cart');
            Route::get('/removed/{user_id}', [CartsController::class, 'getAUserProductsRemovedFromCarts'])->name('get-a-user-product-removed-from-cart');
            Route::post('/', [CartsController::class, 'addToCart'])->name('add-to-cart');
            Route::put('/', [CartsController::class, 'removedFromCarts'])->name('remove-from-cart');
        });
    });
