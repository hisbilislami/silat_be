<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\PrerequisiteController;
use App\Http\Controllers\API\MasterOccupationController;
use App\Http\Controllers\API\ApplicantController;
use App\Http\Controllers\API\MasterServiceController;
use App\Http\Controllers\API\InformationController;
use App\Http\Controllers\API\SuggestionController;
use App\Http\Controllers\API\EventsController;
use App\Http\Controllers\API\TutorialController;
use App\Http\Controllers\API\RegulationController;
use App\Http\Controllers\API\RunningTextController;

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
  
    Route::group(['prefix' => 'prerequisite'], function () {
        Route::get('/get', [PrerequisiteController::class, 'index']);
        Route::post('/insert', [PrerequisiteController::class, 'insert']);
        Route::put('/update', [PrerequisiteController::class, 'update']);
        Route::delete('/delete', [PrerequisiteController::class, 'destroy']);
    });
  
    Route::group(['prefix' => 'occupation'], function () {
        Route::get('/get', [MasterOccupationController::class, 'index']);
        Route::post('/insert', [MasterOccupationController::class, 'insert']);
        Route::put('/update', [MasterOccupationController::class, 'update']);
        Route::delete('/delete', [MasterOccupationController::class, 'destroy']);
    });

    Route::group(['prefix' => 'applicant'], function () {
        Route::get('/get', [ApplicantController::class, 'index']);
        Route::post('/insert', [ApplicantController::class, 'insert']);
        Route::put('/update', [ApplicantController::class, 'update']);
        Route::delete('/delete', [ApplicantController::class, 'destroy']);
    });
  
    Route::group(['prefix' => 'master-service'], function () {
        Route::get('/get', [MasterServiceController::class, 'index']);
        Route::post('/insert', [MasterServiceController::class, 'insert']);
        Route::put('/update', [MasterServiceController::class, 'update']);
        Route::delete('/delete', [MasterServiceController::class, 'destroy']);
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

    Route::group(['prefix' => 'tutorial'], function () {
        Route::get('/get', [TutorialController::class, 'index']);
        Route::post('/insert', [TutorialController::class, 'insert']);
        Route::put('/update', [TutorialController::class, 'update']);
        Route::delete('/delete', [TutorialController::class, 'destroy']);
    });

    Route::group(['prefix' => 'regulation'], function () {
        Route::get('/get', [RegulationController::class, 'index']);
        Route::post('/insert', [RegulationController::class, 'insert']);
        Route::put('/update', [RegulationController::class, 'update']);
        Route::delete('/delete', [RegulationController::class, 'destroy']);
    });

    Route::group(['prefix' => 'running-text'], function () {
        Route::get('/get', [RunningTextController::class, 'index']);
        Route::post('/insert', [RunningTextController::class, 'insert']);
        Route::put('/update', [RunningTextController::class, 'update']);
        Route::delete('/delete', [RunningTextController::class, 'destroy']);
    });

    // API route for logout user
    Route::get('/logout', [AuthController::class, 'logout']);
});
