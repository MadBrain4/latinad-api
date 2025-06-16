<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentification\AuthController;
use App\Http\Controllers\Display\DisplayController;

Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas con middleware auth:api (JWT)
Route::middleware(['auth:api'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('displays')->group(function () {
        Route::get('/', [DisplayController::class, 'index']);
        Route::post('/', [DisplayController::class, 'store']);
        Route::get('/{display}', [DisplayController::class, 'show']);
        Route::put('/{display}', [DisplayController::class, 'update']);
        Route::delete('/{display}', [DisplayController::class, 'destroy']);
    });
});