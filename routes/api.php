<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentification\AuthController;
use App\Http\Controllers\Display\DisplayController;
use App\Http\Controllers\Language\UserLanguageController;
use App\Http\Middleware\AuthApiMiddleware;
use App\Http\Middleware\SetUserLocale;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Rutas protegidas con middleware auth:api (JWT)
Route::middleware([SetUserLocale::class, AuthApiMiddleware::class])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('displays')->group(function () {
        Route::get('/', [DisplayController::class, 'index']);
        Route::post('/', [DisplayController::class, 'store']);
        Route::get('/{id}', [DisplayController::class, 'show']);
        Route::put('/{id}', [DisplayController::class, 'update']);
        Route::delete('/{id}', [DisplayController::class, 'destroy']);
    });

    Route::get('/user/language', [UserLanguageController::class, 'getLanguage']);
    Route::put('/user/language', [UserLanguageController::class, 'updateLanguage']);
});