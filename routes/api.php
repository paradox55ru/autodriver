<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\api\v1\DriverController;
use \App\Http\Controllers\api\v1\AutoController;
use \App\Http\Controllers\api\v1\RelationController;

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

Route::group([
    'prefix' => 'v1'
], function() {
    // Водитель
    Route::get('/driver', [DriverController::class, 'index']);
    Route::get('/driver/{id}', [DriverController::class, 'view']);

    Route::delete('/driver/{id}', [DriverController::class, 'delete']);

    Route::put('/driver/{id}', [DriverController::class, 'update']);

    Route::post('/driver', [DriverController::class, 'create']);


    // Автомобиль
    Route::get('/auto', [AutoController::class, 'index']);
    Route::get('/auto/{id}', [AutoController::class, 'view']);

    Route::post('/auto', [AutoController::class, 'create']);

    Route::delete('/auto/{id}', [AutoController::class, 'delete']);

    Route::put('/auto/{id}', [AutoController::class, 'update']);


    // Cвязь водитель-автомобиль
    Route::get('/relation', [RelationController::class, 'index']);

    Route::post('/relation', [RelationController::class, 'create']);

    Route::put('/relation/updateByAuto/{auto_id}', [RelationController::class, 'updateByAuto']);
    Route::put('/relation/updateByDriver/{driver_id}', [RelationController::class, 'updateByDriver']);

    Route::delete('/relation/deleteByAuto/{auto_id}', [RelationController::class, 'deleteByAuto']);
    Route::delete('/relation/deleteByDriver/{driver_id}', [RelationController::class, 'deleteByDriver']);
});

