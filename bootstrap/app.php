<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// 1. Import your RoleMiddleware class
use App\Http\Middleware\RoleMiddleware; 

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        
        // 2. Register the 'role' alias in the $middleware->alias array
        $middleware->alias([
            'role' => RoleMiddleware::class,
        ]);
        
        // You may also want to register your AuthController as global alias if you are not using the default Laravel auth scaffolding
        // $middleware->alias([
        //     'auth' => \App\Http\Middleware\Authenticate::class,
        //     // ... other middleware
        // ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();