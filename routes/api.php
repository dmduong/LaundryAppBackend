<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\StoreController;
use Illuminate\Http\Request;
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

Route::prefix(config('app.version'))->group(function () {
    Route::prefix('stores')->middleware(['store'])->group(function () {
        Route::controller(StoreController::class)->prefix('/')->group(function () {
            Route::post('/', 'index');
            Route::get('/show', 'show');
            Route::post('/create', 'store');
        });

        Route::controller(EmployeeController::class)->prefix('employees')->group(function () {
            Route::post('/create', 'store');
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