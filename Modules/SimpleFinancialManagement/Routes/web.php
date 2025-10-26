<?php

use Illuminate\Support\Facades\Route;

use Modules\SimpleFinancialManagement\Http\Controllers as ModuleControllers;

Route::middleware(['auth', 'verified'])->group(function () {
    // Movements Routes
    Route::prefix('/Movement')->group(function () {

        // Main Controller
        Route::controller(ModuleControllers\Movement\MovementController::class)->group(function () {
            // Module prefix keys
            $pathKey = 'Movement'; // Nombre en el URL/Path
            $routeKey = 'movement'; // Nombre de la ruta

            // Views
            Route::get('/', 'index')->name($routeKey . '.index');

            // Actions
            Route::post("/{$pathKey}Store", 'store')->name($routeKey . '.store');
            Route::post("/{$pathKey}Import", 'import')->name($routeKey . '.import');
            Route::patch("/{$pathKey}Update", 'update')->name($routeKey . '.update');
            Route::delete("/{$pathKey}Destroy", 'delete')->name($routeKey . '.delete');
        });
    });
});
