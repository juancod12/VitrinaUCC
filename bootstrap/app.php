<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route; // Importante añadir esta línea

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        // --- AQUÍ CARGAMOS EL ARCHIVO EXTRA ---
        then: function () {
            Route::middleware('web')
                ->group(base_path('routes/products.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        // --- AQUÍ REGISTRAMOS EL PERMISO ADMIN ---
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class, 
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();