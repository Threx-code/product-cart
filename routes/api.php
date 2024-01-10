<?php

use App\Http\Controllers\V1\ProductController;
use Illuminate\Http\Request;
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
        Route::get('/products', [ProductController::class, 'getAllProducts'])->name('all-products');
        Route::get('/products/{product_id}', [ProductController::class, 'getSingleProduct'])->name('get-a-product');
        Route::post('/products', [ProductController::class, 'store'])->name('store.products');
        Route::delete('/products/{product_id}', [ProductController::class, 'deleteAProduct'])->name('delete-a-product');

//
//        Route::middleware(['tasks.file.processor'])->group(function () {
//            Route::post('/tasks', [TaskController::class, 'store']);
//            Route::put('/tasks/{id}', [TaskController::class, 'update']);
//        });
//        Route::delete('tasks/{id}', [TaskController::class, 'delete']);

    });
