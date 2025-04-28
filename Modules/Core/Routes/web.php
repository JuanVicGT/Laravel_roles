<?php

use Illuminate\Support\Facades\Route;

use Modules\Core\Http\Controllers as CoreControllers;

// Settings
Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('/Setting')->group(function () {
        // Index para Usuarios, Roles y Permisos
        Route::controller(CoreControllers\SettingController::class)->group(function () {
            // Views
            Route::get('/', 'index')->name('setting.index');

            // Actions
            Route::post("/SettingStore", 'store')->name('setting.store');
        });
    });
});

// Users Module Routes
require_once __DIR__ . '/users/web.php';
