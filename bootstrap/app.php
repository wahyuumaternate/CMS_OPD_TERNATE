<?php

use App\Http\Middleware\ThemeMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
           // Jalankan LocaleMiddleware paling awal
    //  $middleware->prepend([
    // ]);
    // Middleware lain
    $middleware->append([
       
        \App\Http\Middleware\ThemeMiddleware::class,
    ]);

     $middleware->web([
       
        // \App\Http\Middleware\ThemeMiddleware::class,
        \App\Http\Middleware\LocaleMiddleware::class,
    ]);
         $middleware->alias([
        'is_admin' => \App\Http\Middleware\IsAdmin::class,
          'locale' => \App\Http\Middleware\LocaleMiddleware::class,
    ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
