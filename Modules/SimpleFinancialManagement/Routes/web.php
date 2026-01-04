<?php

use Illuminate\Support\Facades\Route;

use Modules\SimpleFinancialManagement\Http\Controllers as ModuleControllers;

Route::middleware(['auth', 'verified'])->group(function () {
    // Wallet Routes
    Route::prefix('/Wallet')->group(function () {

        // Main Controller
        Route::controller(ModuleControllers\WalletController::class)->group(function () {
            // Module prefix keys
            $pathKey = 'Wallet'; // Nombre en el URL/Path
            $routeKey = 'wallet'; // Nombre de la ruta

            // Views
            Route::get('/', 'index')->name($routeKey . '.index');

            // Actions
            Route::post("/{$pathKey}Store", 'store')->name($routeKey . '.store');
            Route::post("/{$pathKey}Import", 'import')->name($routeKey . '.import');
            Route::patch("/{$pathKey}Update", 'update')->name($routeKey . '.update');
            Route::delete("/{$pathKey}Destroy", 'delete')->name($routeKey . '.delete');
        });
    });

    // Tag Routes
    Route::prefix('/Tag')->group(function () {
        // Main Controller
        Route::controller(ModuleControllers\TagController::class)->group(function () {
            // Module prefix keys
            $pathKey = 'Tag'; // Nombre en el URL/Path
            $routeKey = 'tag'; // Nombre de la ruta

            // Views
            Route::get('/', 'index')->name($routeKey . '.index');

            // Actions
            Route::post("/{$pathKey}Store", 'store')->name($routeKey . '.store');
            Route::patch("/{$pathKey}Update", 'update')->name($routeKey . '.update');
            Route::delete("/{$pathKey}Destroy", 'delete')->name($routeKey . '.delete');
        });
    });

    // Card Cycles routes
    Route::prefix('/CardCycle')->group(function () {
        // Main Controller
        Route::controller(ModuleControllers\CardCycleController::class)->group(function () {
            // Module prefix keys
            $pathKey = 'CardCycle'; // Nombre en el URL/Path
            $routeKey = 'card_cycle'; // Nombre de la ruta

            // Views
            Route::get('/', 'index')->name($routeKey . '.index');

            // Actions
            Route::post("/{$pathKey}Store", 'store')->name($routeKey . '.store');
            Route::patch("/{$pathKey}Update", 'update')->name($routeKey . '.update');
            Route::delete("/{$pathKey}Destroy", 'delete')->name($routeKey . '.delete');
        });
    });

    // Credit Cards routes
    Route::prefix('/CreditCard')->group(function () {
        // Main Controller
        Route::controller(ModuleControllers\CreditCardController::class)->group(function () {
            // Module prefix keys
            $pathKey = 'CreditCard'; // Nombre en el URL/Path
            $routeKey = 'credit_card'; // Nombre de la ruta

            // Views
            Route::get('/', 'index')->name($routeKey . '.index');

            // Actions
            Route::post("/{$pathKey}Store", 'store')->name($routeKey . '.store');
            Route::patch("/{$pathKey}Update", 'update')->name($routeKey . '.update');
            Route::delete("/{$pathKey}Destroy", 'delete')->name($routeKey . '.delete');
        });
    });

    // Bucket routes
    Route::prefix('/Bucket')->group(function () {
        // Main Controller
        Route::controller(ModuleControllers\BucketController::class)->group(function () {
            // Module prefix keys
            $pathKey = 'Bucket'; // Nombre en el URL/Path
            $routeKey = 'bucket'; // Nombre de la ruta

            // Views
            Route::get('/', 'index')->name($routeKey . '.index');

            // Actions
            Route::post("/{$pathKey}Store", 'store')->name($routeKey . '.store');
            Route::patch("/{$pathKey}Update", 'update')->name($routeKey . '.update');
            Route::delete("/{$pathKey}Destroy", 'delete')->name($routeKey . '.delete');
        });
    });
});
