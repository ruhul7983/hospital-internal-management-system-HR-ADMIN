<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Providers\ViewServiceProvider; // 💡 Import your new provider

// 1. Import your RoleMiddleware class
use App\Http\Middleware\RoleMiddleware; 

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    
    // 💡 CORRECTED SECTION: Providers registered as an array
    ->withProviders([
        ViewServiceProvider::class, // <-- ADD YOUR PROVIDER HERE
        // Add any other custom providers you might have later
    ])
    
    ->withMiddleware(function (Middleware $middleware): void {
        
        // 2. Register the 'role' alias in the $middleware->alias array
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'superadmin' => \App\Http\Middleware\SuperAdminMiddleware::class,
        ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();