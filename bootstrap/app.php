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
    ->withMiddleware(function (Middleware $middleware) {
        // ១. ចុះឈ្មោះប្រព័ន្ធប្ដូរភាសា (ខ្មែរ / អង់គ្លេស)
        $middleware->web(append: [
            \App\Http\Middleware\SetLocaleMiddleware::class,
        ]);

        // ២. ចុះឈ្មោះប្រព័ន្ធឆែកសិទ្ធិ (Role Middleware)
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();