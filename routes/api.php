<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\VehicleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::name('users.')->group(function () {
    Route::get('/users', [UserController::class, 'getUsers'])->name('all');
    Route::get('/users/{id}', [UserController::class, 'getUser'])->name('get');
    Route::post('/users', [UserController::class, 'createUser'])->name('create');
    Route::put('/users/{id}', [UserController::class, 'updateUser'])->name('update');
    Route::delete('/users/{id}', [UserController::class, 'deleteUser'])->name('delete');
});

Route::name('vehicles.')->group(function () {
    Route::get('/vehicles', [VehicleController::class, 'getVehicles'])->name('all');
    Route::get('/vehicles/{id}', [VehicleController::class, 'getVehicle'])->name('get');
    Route::post('/vehicles', [VehicleController::class, 'createVehicle'])->name('create');
    Route::put('/vehicles/{id}', [VehicleController::class, 'updateVehicle'])->name('update');
    Route::delete('/vehicles/{id}', [VehicleController::class, 'deleteVehicle'])->name('delete');
});
