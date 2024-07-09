<?php

use App\Http\Controllers\App\AuthController;
use App\Http\Controllers\App\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProjectController;
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

Route::prefix('app')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
    });

    Route::middleware('auth')->group(function () {

        Route::prefix('user')->group(function () {
            Route::get('profile', [UserController::class, 'getProfile']);
        });

    });

});

Route::prefix('v1')->group(function () {
    Route::prefix('products')->group(function () {
        Route::post('all', [\App\Http\Controllers\ProductController::class, 'all']);
        Route::prefix('{id}')->group(function () {
            Route::get('/show', [\App\Http\Controllers\ProductController::class, 'get']);
            Route::get('/suggestion', [\App\Http\Controllers\ProductController::class, 'suggestion']);
        });
    });
});


