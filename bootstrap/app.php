<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckRoleNotOne;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'role'  => RoleMiddleware::class,
            'redirectIfAuth' => RedirectIfAuthenticated::class,
            'role_not_one' => CheckRoleNotOne::class,
        ]);

        // $middleware->validateCsrfTokens(except: [
        //     'stripe/*',
        //     'http://example.com/foo/bar',
        //     'http://example.com/foo/*',
        //     '/notification'
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
