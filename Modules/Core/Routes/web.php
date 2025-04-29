<?php

use Illuminate\Support\Facades\Route;

use Modules\Core\Http\Controllers as CoreControllers;

// Dashboard
Route::get('/Dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Wizard Routes
    Route::prefix('/Wizard')->group(function () {

        // Main Controller
        Route::controller(CoreControllers\Wizard\WizardController::class)->group(function () {
            // Module prefix keys
            $pathKey = 'Wizard';
            $routeKey = 'wizard';

            // Views
            Route::get('/', 'index')->name('wizard.index');

            // Actions
            Route::post("/{$pathKey}PermissionReset", 'resetPermissions')->name('permission.reset');

            Route::post("/{$pathKey}Store", 'store')->name($routeKey . '.store');
            Route::post("/{$pathKey}Import", 'import')->name($routeKey . '.import');
            Route::patch("/{$pathKey}Update", 'update')->name($routeKey . '.update');
            Route::delete("/{$pathKey}Destroy", 'delete')->name($routeKey . '.delete');
        });
    });

    // Settings Routes
    Route::prefix('/Setting')->group(function () {
        // Index para Usuarios, Roles y Permisos
        Route::controller(CoreControllers\Setting\SettingController::class)->group(function () {
            // Views
            Route::get('/', 'index')->name('setting.index');

            // Actions
            Route::post("/SettingStore", 'store')->name('setting.store');
        });
    });
});

// Users Module Routes
require_once __DIR__ . '/users/web.php';
