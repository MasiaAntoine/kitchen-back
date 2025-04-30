<?php

use App\Http\Controllers\IngredientController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\MeasureController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\BasicAuthMiddleware;

Route::post('/login', [AuthController::class, 'login']);

// Routes protégées par Basic Auth
Route::middleware([BasicAuthMiddleware::class])->group(function () {
    // Routes des ingrédients
    Route::prefix('ingredients')->group(function () {
        Route::get('/', [IngredientController::class, 'index']);
        Route::get('/by-type', [IngredientController::class, 'getIngredientsByType']);
        Route::get('/low-stock', [IngredientController::class, 'getLowStockIngredients']);
        Route::get('/connected', [IngredientController::class, 'getConnectedIngredients']);
        Route::post('/', [IngredientController::class, 'create']);
        Route::delete('/batch', [IngredientController::class, 'batchDestroy']);
        Route::delete('/{id}', [IngredientController::class, 'destroy']);
        Route::patch('/{id}/quantity', [IngredientController::class, 'updateQuantity']);
    });

    // Route pour récupérer tous les types
    Route::get('/types', [TypeController::class, 'index']);

    // Route pour récupérer toutes les mesures
    Route::get('/measures', [MeasureController::class, 'index']);
});
