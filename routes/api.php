<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
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

Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:api')->controller(WorkoutController::class)->group(function () {
    Route::post('workouts', 'showall');
    Route::post('add_workout', 'store');
});

Route::middleware('auth:api')->controller(SerieController::class)->group(function () {
    Route::post('series', 'showall');
    Route::post('add_serie', 'store');
});

Route::middleware('auth:api')->controller(ExerciseController::class)->group(function () {
    Route::post('exercises', 'showall');
    Route::post('add_exercise', 'store');
});
