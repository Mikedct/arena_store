<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // ✅ Custom Middleware Aliases
        $middleware->alias([
            'guest.user' => \App\Http\Middleware\RedirectIfAuthenticated::class,
            'guest.admin' => \App\Http\Middleware\RedirectIfAuthenticatedAdmin::class,
            'auth.user' => \App\Http\Middleware\UserAuth::class,
            'auth.admin' => \App\Http\Middleware\AdminAuth::class,
            'csrf' => \App\Http\Middleware\VerifyCsrfToken::class,
            'trim' => \App\Http\Middleware\TrimString::class,
        ]);


        // ✅ Jika ingin menetapkan middleware global, aktifkan di sini:
        // $middleware->global([
        //     \App\Http\Middleware\ExampleGlobalMiddleware::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // ✅ Untuk custom error handler (optional)
        // $exceptions->renderable(...);
    })
    ->create();
