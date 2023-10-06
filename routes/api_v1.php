<?php

use \App\Http\Controllers\API\v1\BlogController;
use App\Http\Controllers\API\v1\UserController as V1UserController;
use App\Http\Controllers\API\v2\BlogController as V2BlogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [V1UserController::class, 'register']);
Route::post('/login', [V1UserController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users', [V1UserController::class, 'index']);
    Route::get('/logout', [V1UserController::class, 'logout']);
    Route::apiResource('/blog', BlogController::class);
});
