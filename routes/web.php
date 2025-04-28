<?php

use App\Http\Controllers\Wizard\WizardController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Redirect;

/**
 * Este archivo de rutas no se emplea para poder así poder cargar las rutas de los
 * módulos, antes de la carga de las rutas del core.
 *
 * Las rutas del core se agregan en el archivo general.php
 */

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return Redirect::to('/Dashboard');
});

// Dashboard
Route::get('/Dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Others Modules
Route::middleware(['auth', 'verified'])->group(function () {

    // Wizard Module
    Route::prefix('/Wizard')->group(function () {

        // Main Controller
        Route::controller(WizardController::class)->group(function () {
            // Module prefix keys
            $pathKey = 'Wizard';
            $routeKey = 'wizard';

            // Views
            Route::get('/', 'index')->name('wizard.index');

            // Actions
            Route::post("/{$pathKey}Store", 'store')->name($routeKey . '.store');
            Route::post("/{$pathKey}Import", 'import')->name($routeKey . '.import');
            Route::patch("/{$pathKey}Update", 'update')->name($routeKey . '.update');
            Route::delete("/{$pathKey}Destroy", 'delete')->name($routeKey . '.delete');
        });
    });
});
