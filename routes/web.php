<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CakeController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api/v1')
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
    });
