<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\Stores\EmployeeController as StoresEmployee;
use App\Http\Controllers\Api\StoreController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AccountController::class)->prefix(config('app.version') . '/')->group(function () {
    Route::post('/login', 'login');
});

Route::prefix(config('app.version') . '/administrators')->middleware([])->group(function () {
    Route::controller(StoreController::class)->prefix('/stores')->group(function () {
        Route::post('/', 'index');
        Route::post('/create', 'store');
        Route::delete('/{store_id}', 'destroy');
    });
});

Route::prefix(config('app.version'))->group(function () {
    Route::prefix('stores')->middleware(['store'])->group(function () {
        Route::controller(StoreController::class)->prefix('/')->group(function () {
            Route::put('/', 'update');
            Route::get('/show', 'show');
        });

        Route::controller(EmployeeController::class)->prefix('employees')->group(function () {
            Route::post('/create', 'store');
        });

        Route::controller(StoresEmployee::class)->prefix('employees')->group(function () {
            Route::post('/', 'index');
        });
    });

    Route::prefix('/employees')->middleware(['employee'])->group(function () {
        Route::controller(EmployeeController::class)->prefix('me')->group(function () {
            Route::get('/', 'show');
        });
    });

    Route::prefix('/customers')->middleware([])->group(function () {

    });
});