<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentification\AuthController;

Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas con middleware auth:api (JWT)
Route::middleware(['auth:api'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});