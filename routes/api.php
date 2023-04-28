<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\WorkoutController;
use App\Http\Controllers\API\SerieController;
use App\Http\Controllers\API\ExerciseController;

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

Route::middleware('auth:api')->post('/user', function(Request $request) {
    return $request->user();
});

Route::controller(UserController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:api')->group(function () {
    Route::prefix('workouts')->group(function () {
        Route::get('/', [WorkoutController::class, 'showall']);
        Route::post('add', [WorkoutController::class, 'store']);
    });

    Route::prefix('series')->group(function () {
        Route::get('/', [SerieController::class, 'showall']);
        Route::post('add', [SerieController::class, 'store']);
    });

    Route::prefix('exercises')->group(function () {
        Route::get('/', [ExerciseController::class, 'showall']);
        Route::post('add', [ExerciseController::class, 'store']);
    });
});