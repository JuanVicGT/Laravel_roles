<?php

use Illuminate\Support\Facades\Route;

use Modules\Core\Http\Controllers as CoreControllers;
use Modules\Core\Http\Controllers\UserManagmentController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('/UserManagment')->group(function () {
        // Index para Usuarios, Roles y Permisos
        Route::controller(UserManagmentController::class)->group(function () {
            Route::get('/', 'index')->name('user_managment.index');
        });

        // UserManagmentIndex funciona como el index para Usuarios
        Route::controller(CoreControllers\UserController::class)->group(function () {
            $pathKey = 'User';
            $routeKey = 'user';

            // Views
            Route::get("/{$pathKey}Create", 'create')->name($routeKey . '.create');
            Route::get("/{$pathKey}View/{id}", 'view')->name($routeKey . '.view');
            Route::get("/{$pathKey}Edit/{id}", 'edit')->name($routeKey . '.edit');

            // Actions
            Route::post("/{$pathKey}Store", 'store')->name($routeKey . '.store');
            Route::post("/{$pathKey}Import", 'import')->name($routeKey . '.import');
            Route::patch("/{$pathKey}Update", 'update')->name($routeKey . '.update');
            Route::delete("/{$pathKey}Destroy", 'delete')->name($routeKey . '.delete');
        });
    });

    Route::prefix('/Profile')->group(function () {
        // Index para Usuarios, Roles y Permisos
        Route::controller(UserManagmentController::class)->group(function () {
            Route::get('/', 'index')->name('user_managment.index');
        });

        // ProfileIndex funciona como el index para Usuarios
        Route::controller(CoreControllers\UserController::class)->group(function () {
            $pathKey = 'Profile';
            $routeKey = 'profile';

            // Views
            Route::get("/{$pathKey}Create", 'create')->name($routeKey . '.create');
            Route::get("/{$pathKey}View/{id}", 'view')->name($routeKey . '.view');
            Route::get("/{$pathKey}Edit", 'edit')->name($routeKey . '.edit');

            // Actions
            Route::post("/{$pathKey}Store", 'store')->name($routeKey . '.store');
            Route::post("/{$pathKey}Import", 'import')->name($routeKey . '.import');
            Route::patch("/{$pathKey}Update", 'update')->name($routeKey . '.update');
            Route::delete("/{$pathKey}Destroy", 'delete')->name($routeKey . '.delete');
        });
    });
});
