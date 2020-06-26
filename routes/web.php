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

Route::group(['middleware'=>['auth']] , function() {
    Route::group(['middleware'=>['task'] , "prefix"=>"task"] , function() {
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
    Route::group(["prefix"=>"user"] , function() {
        Route::get('' , 'UserController@index')->name('user');
        Route::get('add' , 'UserController@AddUser')->name('user.add');
        Route::post('save' , 'UserController@SaveUser')->name('user.save');
        Route::get('edit' , 'UserController@EditUser')->name('user.edit');
        Route::post('update' , 'UserController@UpdateUser')->name('user.update');
        Route::get('delete' , 'UserController@DeleteUser')->name('user.delete');
        Route::post('admin-password','UserController@AskPassword');
    });
    
});

Route::get('/cmd/clear', function () {
    chdir('./');
    $dir = getcwd();
    print_r($dir);
    $cmd = shell_exec ('php artisan config:cache');
    return $cmd;
});

Route::get('/cmd/migrate', function () {
    chdir('./');
    $dir = getcwd();
    print_r($dir);
    $cmd = shell_exec ('php artisan migrate');
    return $cmd;
});
