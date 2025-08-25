<?php

use App\Http\Controllers\IngredientController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlaceTypeController;
use App\Http\Controllers\MeasurementUnitController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\BasicAuthMiddleware;
use App\Http\Controllers\ConnectedScaleController;

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

    // Route pour récupérer tous les types de lieux
    Route::prefix('place-types')->group(function () {
        Route::get('/', [PlaceTypeController::class, 'index']);
    });

    // Route pour récupérer toutes les unités de mesure
    Route::prefix('measurement-units')->group(function () {
        Route::get('/', [MeasurementUnitController::class, 'index']);
    });

    Route::prefix('connected-scales')->group(function () {
        Route::get('/', [ConnectedScaleController::class, 'index']);
        Route::post('/{connected_scale_id}/associate', [ConnectedScaleController::class, 'associateWithIngredient']);
        Route::delete('/', [ConnectedScaleController::class, 'destroyByMac']);

        Route::prefix('reserved-machine')->group(function () {
            Route::post('/', [ConnectedScaleController::class, 'store']);
            Route::post('/update-quantity', [ConnectedScaleController::class, 'updateQuantityByMac']);
        });
    });
});
