<?php

use App\Http\Controllers\API\v2\BlogController;
use App\Http\Controllers\API\v2\UserController as V2UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [V2UserController::class, 'register']);
Route::post('/login', [V2UserController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users', [V2UserController::class, 'index']);
    Route::apiResource('/blog', BlogController::class);
    Route::get('/logout', [V2UserController::class, 'logout']);
});
