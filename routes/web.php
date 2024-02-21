<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Catalogs\RolesController;
use App\Http\Controllers\Catalogs\UsersController;
use Csgt\Utils\Http\Controllers\ProfileController;
use App\Http\Controllers\SalonsController;

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

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::resource('profile', ProfileController::class, ['only' => ['index', 'detail', 'store']]);
});

Route::group(['middleware' => ['auth', 'cancerbero']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index.index');

    Route::prefix('catalogs')->name('catalogs.')->group(function () {
        Route::resource('users', UsersController::class);
        Route::resource('roles', RolesController::class);
    });

    Route::prefix('horarios')->name('horarios.')->group(function () {
        Route::resource('todos', SalonsController::class);
    });
});