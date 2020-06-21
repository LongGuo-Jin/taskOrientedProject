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
    if (Route::has('login')) {
        return redirect('/task/taskCard');
    } else
    return redirect('/login');
});

Auth::routes();

Route::group(['middleware'=>['auth','task'] , "prefix"=>"task" ],function() {

    Route::any('','TaskController@index');
    Route::any('/taskCard', 'TaskController@taskCard');
    Route::any('/taskCardAdd', 'TaskController@taskCardAdd');
    Route::any('/taskCardUpdate', 'TaskController@taskCardUpdate');
    Route::any('/fileUpload', 'TaskController@fileUpload');
    Route::any('/taskCardDelete', 'TaskController@taskCardDelete');
    Route::any('/isFinalTask', 'TaskController@isFinalTask');
    Route::any('/setLoginUser', 'TaskController@setLoginUser');
    Route::any('/addBudget', 'TaskController@addBudget');
    Route::any('/addExpense', 'TaskController@addExpense');
    Route::any('/taskList', 'TaskController@taskList');
    
});
