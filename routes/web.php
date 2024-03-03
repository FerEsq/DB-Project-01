<?php

use App\Http\Controllers\AggregationController;
use App\Http\Controllers\ManagersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\Catalogs\RolesController;
use App\Http\Controllers\Catalogs\UsersController;
use App\Http\Controllers\HorariosController;
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
    Route::get('/locale/{locale}', [LocaleController::class, 'index']);

});

Route::group(['middleware' => ['auth', 'cancerbero']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index.index');

    Route::prefix('catalogs')->name('catalogs.')->group(function () {
        Route::resource('users', UsersController::class);
        Route::resource('roles', RolesController::class);
    });

    Route::prefix('horarios')->name('horarios.')->group(function () {
        Route::resource('todos', HorariosController::class,['only'=>['index','store','destroy','edit']]);
        Route::resource('salones', SalonsController::class,['only'=>['index','store','destroy','edit']]);
        Route::resource('managers', ManagersController::class,['only'=>['index','store','destroy','edit']]);
    });

    Route::prefix('agregaciones')->name('agregaciones.')->group(function () {
        Route::resource('todas', AggregationController::class,['only'=>['index','store','destroy','edit']]);
    });
});
