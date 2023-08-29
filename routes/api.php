<?php

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

Route::prefix(config('app.version'))->group(function () {
    Route::prefix('stores')->middleware([])->group(function () {
        Route::controller(StoreController::class)->prefix('/')->group(function () {
            Route::get('/', 'index');
            Route::post('/create', 'store');
        });
    });

    Route::prefix('/employees')->middleware([])->group(function () {

    });

    Route::prefix('/accounts')->middleware([])->group(function () {

    });
});