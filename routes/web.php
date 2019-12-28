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

Route::any('task', ['middleware' => 'task', 'uses' => 'TaskController@index']);
Route::any('task/taskCard', ['middleware' => 'task', 'uses' => 'TaskController@taskCard']);
Route::any('task/taskCardAdd', ['middleware' => 'task', 'uses' => 'TaskController@taskCardAdd']);
Route::any('task/taskCardUpdate', ['middleware' => 'task', 'uses' => 'TaskController@taskCardUpdate']);
Route::any('task/fileUpload', ['middleware' => 'task', 'uses' => 'TaskController@fileUpload']);
Route::any('task/taskCardDelete', ['middleware' => 'task', 'uses' => 'TaskController@taskCardDelete']);
Route::any('task/isFinalTask', ['middleware' => 'task', 'uses' => 'TaskController@isFinalTask']);
Route::any('task/setLoginUser', ['middleware' => 'task', 'uses' => 'TaskController@setLoginUser']);
Route::any('task/addBudget', ['middleware' => 'task', 'uses' => 'TaskController@addBudget']);
Route::any('task/addExpense', ['middleware' => 'task', 'uses' => 'TaskController@addExpense']);
Route::any('task/taskList', ['middleware' => 'task', 'uses' => 'TaskController@taskList']);
