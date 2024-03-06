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
        Route::get('/ListUser', 'index')->name('list.user');
        Route::get('/CreateUser', 'create')->name('create.user');
        Route::get('/EditUser/{id}', 'edit')->name('edit.user');
        Route::get('/ViewUser/{id}', 'show')->name('show.user');

        // Actions
        Route::post('/user', 'store')->name('store.user');
        Route::patch('/user', 'update')->name('update.user');
        Route::delete('/user', 'delete')->name('delete.user');
    });

    /** ========== Role section  ========== */
    Route::controller(Backend\RoleController::class)->group(function () {
        // Views
        Route::get('/ListRole', 'index')->name('list.role');
        Route::get('/CreateRole', 'create')->name('create.role');
        Route::get('/EditRole/{id}', 'edit')->name('edit.role');
        Route::get('/ViewRole/{id}', 'show')->name('show.role');

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
        Route::get('/ListPermission', 'index')->name('list.permission');
        Route::get('/CreatePermission', 'create')->name('create.permission');
        Route::get('/EditPermission/{id}', 'edit')->name('edit.permission');
        Route::get('/ViewPermission/{id}', 'show')->name('show.permission');

        // Actions
        Route::post('/permission', 'store')->name('store.permission');
        Route::patch('/permission', 'update')->name('update.permission');
        Route::delete('/permission', 'delete')->name('delete.permission');
    });
});

require __DIR__ . '/auth.php';
