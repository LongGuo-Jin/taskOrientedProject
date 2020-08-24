<?php

use Illuminate\Http\Request;

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

Route::post('login','API\AuthController@Login');
Route::middleware('auth:api')->group(function() {
    Route::get('tasksInfo','API\TaskController@TasksInfo');
    Route::post('task','API\TaskController@Task');
    Route::get('messages','API\TaskController@GetUnreadMessages');
    Route::post('addMessages','API\TaskController@AddMemo');
    Route::post('seenMessage','API\TaskController@SeenMessage');
});
