<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CakeController;
use App\Http\Middleware\EnsureAcceptApplicationJson;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api/v1')
    ->middleware(EnsureAcceptApplicationJson::class)
    ->group(function () {
        Route::prefix('cakes')
            ->name('cakes')
            ->group(function () {
                Route::get('/', [CakeController::class, 'list']);
                Route::get('/{id}', [CakeController::class, 'show']);
                Route::post('/', [CakeController::class, 'store']);
                Route::put('{id}', [CakeController::class, 'update']);
                Route::delete('{id}', [CakeController::class, 'destroy']);
                Route::get('{id}/orders', [CakeController::class, 'orders']);
            });
        
        Route::prefix('orders')
            ->name('orders')
            ->group(function () {
                Route::get('/', [OrderController::class, 'list']);
                Route::get('/{id}', [OrderController::class, 'show']);
                Route::post('/', [OrderController::class, 'store']);
            });
    });
