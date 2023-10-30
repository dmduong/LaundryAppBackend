<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\RolePermission\PermissionController;
use App\Http\Controllers\Api\RolePermission\RoleController;
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
    Route::post('/register', 'create');
    Route::post('/verify', 'verify');
    Route::delete('/{account_id}/verify', 'destroyVerify');
    Route::put('/{account_id}/verify', 'updateVerify');
});

Route::prefix(config('app.version') . '/administrators')->middleware([])->group(function () {
    Route::controller(StoreController::class)->prefix('/stores')->group(function () {
        Route::get('/{store_id}', 'show');
        Route::put('/{store_id}', 'update');
        Route::post('/search', 'index');
        Route::post('/create', 'store');
        Route::delete('/{store_id}', 'destroy');
    });
});

Route::prefix(config('app.version'))->group(function () {
    Route::prefix('employees')->middleware(['employee'])->group(function () {
        Route::controller(EmployeeController::class)->prefix('/me')->group(function () {
            Route::get('/', 'show');
        });

        Route::controller(StoresEmployee::class)->prefix('/')->group(function () {
            Route::post('/search', 'index');
            Route::post('/create', 'store');
        });

        Route::controller(RoleController::class)->prefix('roles')->group(function () {
            Route::post('/search', 'index');
            Route::get('{role_id}', 'show');
            Route::put('{role_id}', 'update');
            Route::delete('{role_id}', 'destroy');
            route::get('{role_id}/has-permission', 'roleHasPermission');
            route::post('{role_id}/assign-permission', 'roleAssignPermission');
        });

        Route::controller(PermissionController::class)->prefix('permissions')->group(function () {
            Route::post('/search', 'index');
            Route::get('{role_id}', 'show');
            Route::put('{role_id}', 'update');
            Route::delete('{role_id}', 'destroy');
        });

        Route::delete('/logout', [AccountController::class, 'logout']);
    });

    Route::prefix('/customers')->middleware([])->group(function () {

    });
});