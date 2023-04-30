<?php

use App\Http\Controllers\Auth\Api\LoginController;
use App\Http\Controllers\Auth\Api\RegisterController;
use App\Http\Controllers\LinkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::post('login', [LoginController::class, 'login']);

    Route::post('logout', [LoginController::class, 'logout'])->middleware('auth');

    Route::post('register', [RegisterController::class, 'register']);
});

Route::apiResource('links', LinkController::class)
    ->only(['index','store', 'show'])
    ->middleware('auth:sanctum');
