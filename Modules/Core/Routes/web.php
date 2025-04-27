<?php

use Illuminate\Support\Facades\Route;

use Modules\Core\Http\Controllers as CoreControllers;

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/user', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('user.index');

Route::get('/setting', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('setting.index');

// Settings
Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('/Settings')->group(function () {
        // Index para Usuarios, Roles y Permisos
        Route::controller(CoreControllers\SettingController::class)->group(function () {
            Route::get('/', 'index')->name('settings.index');
        });
    });
});

// Users Module Routes
require_once __DIR__ . '/users/web.php';
