<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\PrerequisiteController;


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
Route::group(['middleware' => ['auth:sanctum']], function ():void {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    Route::group(['prefix' => 'department'], function () {
        Route::get('/get', [DepartmentController::class, 'index']);
        Route::post('/insert', [DepartmentController::class, 'insert']);
        Route::put('/update', [DepartmentController::class, 'update']);
        Route::delete('/delete', [DepartmentController::class, 'destroy']);
    });

    Route::group(['prefix' => 'prerequisite'], function () {
        Route::get('/get', [PrerequisiteController::class, 'index']);
        Route::post('/insert', [PrerequisiteController::class, 'insert']);
        Route::put('/update', [PrerequisiteController::class, 'update']);
        Route::delete('/delete', [PrerequisiteController::class, 'destroy']);
    });

    // API route for logout user
    Route::get('/logout', [AuthController::class, 'logout']);
});
