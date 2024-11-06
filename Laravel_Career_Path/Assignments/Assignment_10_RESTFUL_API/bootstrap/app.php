<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $e, Request $request) {

            if ($request->is('api/*')) {
                if ($e instanceof ValidationException) {
                    return response()->json([
                        'message' => 'VAlidation Error',
                        'errors' => $e->errors(),
                    ], Response::HTTP_UNPROCESSABLE_ENTITY);
                } elseif ($e instanceof AuthenticationException) {
                    return response()->json([
                        'message' => 'UNauthenticated.'
                    ], Response::HTTP_UNAUTHORIZED);
                } elseif ($e instanceof NotFoundHttpException) {
                    return response()->json([
                        'message' => 'HTTP NOt Found.'
                    ], Response::HTTP_NOT_FOUND);
                } elseif ($e instanceof QueryException) {
                    return response()->json([
                        'message' => 'Database Error.'
                    ], 500);
                } else {

                    return response()->json([
                        'message' => 'AN Error Has Occured',
                        'error' => $e->getMessage(),
                    ], Response::HTTP_INTERNAL_SERVER_ERROR);
                }
            }
        });
    })->create();
