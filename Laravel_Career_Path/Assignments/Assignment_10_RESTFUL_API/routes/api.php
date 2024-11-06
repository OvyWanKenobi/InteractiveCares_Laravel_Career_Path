<?php

use App\Http\Controllers\Api\V1\LinkApiController;
use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/my-urls', [LinkApiController::class, 'getUserLinks']);
        Route::post('/url-shortener', [LinkApiController::class, 'shortener']);
    });
});


Route::prefix('v2')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/my-urls', [LinkApiController::class, 'getUserLinks']);
        Route::post('/url-shortener', [LinkApiController::class, 'shortener']);
    });
});
