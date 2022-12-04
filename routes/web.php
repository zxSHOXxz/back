<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::view('/', 'dashboard.master')->name('parent');

Route::prefix('cms/admin')->group(function () {
    Route::view('/', 'dashboard.master');

    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);
    // Route::post('permissions_update/{permission}', [StreetsController::class, 'update'])->name('streets_update');

    // Route::get('/index/streets/{id}', [StreetsController::class, 'indexStreets'])->name('indexStreet');
    // Route::get('/create/streets/{id}', [StreetsController::class, 'createStreets'])->name('createStreet');

    // Route::resource('cities', CityController::class);
    // Route::post('cities_update/{id}', [CityController::class, 'update'])->name('cities_update');

    // Route::resource('admins', AdminController::class);
    // Route::post('admins_update/{id}', [AdminController::class, 'update'])->name('admins_update');

    // Route::resource('captains', CaptainController::class);
    // Route::post('captains_update/{id}', [CaptainController::class, 'update'])->name('captains_update');

    // Route::resource('clients', ClientController::class);
    // Route::post('clients_update/{id}', [ClientController::class, 'update'])->name('clients_update');
});
