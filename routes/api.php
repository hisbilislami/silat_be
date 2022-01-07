<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\InformationController;
use App\Http\Controllers\API\SuggestionController;
use App\Http\Controllers\API\EventsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function (): void {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });

    Route::group(['prefix' => 'department'], function () {
        Route::get('/get', [DepartmentController::class, 'index']);
        Route::post('/insert', [DepartmentController::class, 'insert']);
        Route::put('/update', [DepartmentController::class, 'update']);
        Route::delete('/delete', [DepartmentController::class, 'destroy']);
    });

    Route::group(['prefix' => 'information'], function () {
        Route::get('/get', [InformationController::class, 'index']);
        Route::post('/insert', [InformationController::class, 'insert']);
        Route::put('/update', [InformationController::class, 'update']);
        Route::delete('/delete', [InformationController::class, 'destroy']);
    });

    Route::group(['prefix' => 'suggestion'], function () {
        Route::get('/get', [SuggestionController::class, 'index']);
        Route::post('/insert', [SuggestionController::class, 'insert']);
        Route::put('/update', [SuggestionController::class, 'update']);
        Route::delete('/delete', [SuggestionController::class, 'destroy']);
    });

    Route::group(['prefix' => 'events'], function () {
        Route::get('/get', [EventsController::class, 'index']);
        Route::post('/insert', [EventsController::class, 'insert']);
        Route::put('/update', [EventsController::class, 'update']);
        Route::delete('/delete', [EventsController::class, 'destroy']);
    });

    // API route for logout user
    Route::get('/logout', [AuthController::class, 'logout']);
});
