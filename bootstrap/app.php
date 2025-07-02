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
            // ✅ Middleware kustom
        $middleware->alias([
            'auth.user' => \App\Http\Middleware\UserAuth::class,
            'auth.admin' => \App\Http\Middleware\AdminAuth::class,


            // ✅ Middleware Laravel penting jika ingin pakai
            'guest'     => \App\Http\Middleware\RedirectIfAuthenticated::class,
            'csrf'      => \App\Http\Middleware\VerifyCsrfToken::class,
            'trim'      => \App\Http\Middleware\TrimString::class,
        ]);

        // Middleware global (opsional, jika ingin semua request pakai ini)
        // $middleware->global([...]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Di sini kamu bisa definisikan error handler custom (jika mau)
        // $exceptions->renderable(...);
    })
    ->create();
