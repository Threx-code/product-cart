<?php

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
        Route::get('/products', [ProductsController::class, 'getAllProducts'])->name('all-products');
        Route::get('/products/{product_id}', [ProductsController::class, 'getSingleProduct'])->name('get-a-product');
        Route::post('/products', [ProductsController::class, 'store'])->name('store.products');
        Route::delete('/products/{product_id}', [ProductsController::class, 'deleteAProduct'])->name('delete-a-product');

        Route::get('/users', [UserController::class, 'getAllUsers'])->name('all-users');
        Route::get('/users/{user_id}', [UserController::class, 'getSingleUser'])->name('get-a-user');

//
//        Route::middleware(['tasks.file.processor'])->group(function () {
//            Route::post('/tasks', [TaskController::class, 'store']);
//            Route::put('/tasks/{id}', [TaskController::class, 'update']);
//        });
//        Route::delete('tasks/{id}', [TaskController::class, 'delete']);

    });
