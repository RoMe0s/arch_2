<?php

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

Route::group(['middleware' => 'api'], function () {
    Route::group(['prefix' => 'command'], function () {
        Route::post('generate-shapes', 'CommandController@generateShapes');
        Route::post('change-color', 'CommandController@changeColor');
        Route::post('{eloquentAction}/undo-action', 'CommandController@undoAction');
        Route::post('undo', 'CommandController@undoByLimit');
    });
});