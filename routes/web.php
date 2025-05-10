<?php

use App\Http\Controllers\IngredientController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\MeasureController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\BasicAuthMiddleware;
use App\Http\Controllers\BalanceController;

Route::post('/login', [AuthController::class, 'login']);

// Routes protégées par Basic Auth
Route::middleware([BasicAuthMiddleware::class])->group(function () {
    // Routes des ingrédients
    Route::prefix('ingredients')->group(function () {
        Route::get('/', [IngredientController::class, 'index']);
        Route::post('/', [IngredientController::class, 'create']);
        Route::get('/by-type', [IngredientController::class, 'getIngredientsByType']);
        Route::get('/low-stock', [IngredientController::class, 'getLowStockIngredients']);
        Route::get('/connected', [IngredientController::class, 'getConnectedIngredients']);
        Route::delete('/batch', [IngredientController::class, 'batchDestroy']);
        Route::delete('/{id}', [IngredientController::class, 'destroy']);
        Route::patch('/{id}/quantity', [IngredientController::class, 'updateQuantity']);
    });

    // Route pour récupérer tous les types
    Route::prefix('types')->group(function () {
        Route::post('/', [TypeController::class, 'index']);
    });

    // Route pour récupérer toutes les mesures
    Route::prefix('measures')->group(function () {
        Route::get('/', [MeasureController::class, 'index']);
    });

    Route::prefix('balances')->group(function () {
        Route::get('/', [BalanceController::class, 'index']);
        Route::post('/{balance_id}/associate', [BalanceController::class, 'associateWithIngredient']);
        Route::delete('/', [BalanceController::class, 'destroyByMac']);

        Route::prefix('reserved-machine')->group(function () {
            Route::post('/', [BalanceController::class, 'store']);
            Route::post('/update-quantity', [BalanceController::class, 'updateQuantityByMac']);
        });
    });
});
