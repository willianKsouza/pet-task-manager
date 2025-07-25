<?php

use App\Exceptions\GlobalExceptionHandler;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        channels:__DIR__ . '/../routes/channels.php',
        health: '/up',
        then: function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->statefulApi();
    })
    ->withExceptions(function (Exceptions $exceptions): void {
             $exceptions->render(function (Throwable $e, Request $request) {
            
            $className = get_class($e);
            
            $handlers = GlobalExceptionHandler::$handlers;

            if (array_key_exists($className, $handlers)) {
                $method = $handlers[$className];
                $apiHandler = new GlobalExceptionHandler();
                return $apiHandler->$method($e, $request);
            }
            
            return response()->json([
                'error' => [
                    'type' => basename(get_class($e)),
                    'status' => $e->getCode() ?: 500,
                    'message' => $e->getMessage() ?: 'An unexpected error occurred',
                    'timestamp' => now()->toISOString()
                ]
            ], $e->getCode() ?: 500);
        });
    })->create();
