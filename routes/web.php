<?php

use App\Http\Controllers\Backend\UserController;
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
    Route::controller(UserController::class)->group(function () {
        // Views
        Route::get('/users', 'index')->name('list.user');
        Route::get('/user/{id}', 'edit')->name('edit.user');

        // Actions
        Route::post('/user', 'store')->name('store.user');
        Route::patch('/user', 'update')->name('update.user');
        Route::delete('/user', 'delete')->name('delete.user');
    });
});

require __DIR__ . '/auth.php';
