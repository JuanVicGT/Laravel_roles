<?php

use App\Http\Controllers\Backend;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    /** ========== Profile section  ========== */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /** ========== User section  ========== */
    Route::controller(Backend\UserController::class)->group(function () {
        // Views
        Route::get('/users', 'index')->name('list.user');
        Route::get('/user', 'create')->name('create.user');
        Route::get('/user/{id}', 'edit')->name('edit.user');
        Route::get('/user/show/{id}', 'show')->name('show.user');

        // Actions
        Route::post('/user', 'store')->name('store.user');
        Route::patch('/user', 'update')->name('update.user');
        Route::delete('/user', 'delete')->name('delete.user');
    });

    /** ========== Role section  ========== */
    Route::controller(Backend\RoleController::class)->group(function () {
        // Views
        Route::get('/roles', 'index')->name('list.role');
        Route::get('/role', 'create')->name('create.role');
        Route::get('/role/{id}', 'edit')->name('edit.role');
        Route::get('/role/show/{id}', 'show')->name('show.role');

        // Actions
        Route::post('/role', 'store')->name('store.role');
        Route::patch('/role', 'update')->name('update.role');
        Route::delete('/role', 'delete')->name('delete.role');

        // Custom Actions
        Route::post('/assign/permission', 'assignPermissions')->name('assign.permission');
    });

    /** ========== Permission section  ========== */
    Route::controller(Backend\PermissionController::class)->group(function () {
        // Views
        Route::get('/permissions', 'index')->name('list.permission');
        Route::get('/permission', 'create')->name('create.permission');
        Route::get('/permission/{id}', 'edit')->name('edit.permission');
        Route::get('/permission/show/{id}', 'show')->name('show.permission');

        // Actions
        Route::post('/permission', 'store')->name('store.permission');
        Route::patch('/permission', 'update')->name('update.permission');
        Route::delete('/permission', 'delete')->name('delete.permission');
    });
});

require __DIR__ . '/auth.php';
