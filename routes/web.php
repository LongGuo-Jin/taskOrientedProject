<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('task', ['middleware' => 'task', 'uses' => 'TaskController@index']);
Route::get('task/taskCard', ['middleware' => 'task', 'uses' => 'TaskController@taskCard']);
Route::get('task/taskList', ['middleware' => 'task', 'uses' => 'TaskController@taskList']);