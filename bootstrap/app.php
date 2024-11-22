<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use App\Http\Middleware\JsonMiddleware;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(JsonMiddleware::class);
        $middleware->validateCsrfTokens(except: [
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (\Illuminate\Auth\AuthenticationException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Unauthenticated.'
                ], 401);
            }
        });

        $exceptions->renderable(function (Exception $e, Request $request) {
            if ($e instanceof UnauthorizedHttpException) {
                return response()->json(['status'=>'auth failed'], Response::HTTP_UNAUTHORIZED);
            }
            if ($e instanceof NotFoundHttpException) {
                return response()->json([
                    'success' => false,
                    'message' => 'Үр дүн олдсонгүй',
                ], 400);
            }

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                // 'exception' => get_class($e)
            ], 400);
        });
    })->create();
