<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\SetUserLocale;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php', 
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(SetUserLocale::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->renderable(function (AuthorizationException $e) {
            return response()->json([
                'message' => __('messages.forbidden'),
            ], 403);
        });

        $exceptions->renderable(function (AccessDeniedHttpException $e) {
            return response()->json([
                'message' => __('messages.forbidden'), // o texto directo como 'No tienes permiso...'
            ], 403);
        });
    })->create();
