<?php

use App\Http\Controllers\Api\V1\GameController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\ReviewController;
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

Route::group(
    [
        'prefix' => 'v1',
        'namespace' => 'App\Http\Controllers\Api\V1',
    ],
    function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [UserController::class, 'store']);
    }
);

Route::group(
    [
        'prefix' => 'v1',
        'namespace' => 'App\Http\Controllers\Api\V1',
        'middleware'=> 'auth:sanctum'
    ],
    function () {
        Route::apiResource('games', GameController::class);
        Route::apiResource('users', UserController::class);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/games/{game}/add_review', [ReviewController::class, 'store']);
        Route::patch('/make_admin/{user}', [UserController::class, 'make_admin']);
        Route::put('/make_admin/{user}', [UserController::class, 'make_admin']);
    }
);
