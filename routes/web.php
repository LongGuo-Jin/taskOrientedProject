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
use Illuminate\Support\Facades\Session;


Route::get('/', function () {
    if (Route::has('login')) {
        return redirect('/dashboard');
    } else
    return redirect('/login');
});

Auth::routes();

Route::group(['middleware'=>['auth' , 'tag']] , function() {

    Route::get('dashboard', 'TaskController@index')->name('dashboard');
    Route::get('calendar', 'TaskController@CalendarView')->name('CalendarView');
    Route::post('shake','TaskController@Shake')->name('Shake');
    Route::post('addWorkTime','TaskController@AddWorkTime');
    Route::post('addAllocationTime','TaskController@AddAllocationTime');
    Route::get('locale/{locale}', 'TaskController@Locale');
    Route::post('update_filter','TaskController@UpdateFilter')->name('filter.update');
    Route::get('rest_filter','TaskController@ResetFilter')->name('filter.reset');

    Route::group(['middleware'=>['task'] , "prefix"=>"task"] , function() {
        Route::any('/taskCard', 'TaskController@taskCard')->name('task.taskCard');
        Route::any('/taskCardAdd', 'TaskController@taskCardAdd');
        Route::any('/taskCardUpdate', 'TaskController@taskCardUpdate');
        Route::post('/taskWorkTimeUpdate', 'TaskController@taskWorkTimeUpdate');
        Route::any('/fileUpload', 'TaskController@fileUpload');
        Route::any('/taskCardDelete', 'TaskController@taskCardDelete');
        Route::any('/isFinalTask', 'TaskController@isFinalTask');
        Route::any('/setLoginUser', 'TaskController@setLoginUser');
        Route::any('/addBudget', 'TaskController@addBudget');
        Route::any('/addExpense', 'TaskController@addExpense');
        Route::any('/taskList', 'TaskController@taskList');
        Route::any('/addPin','TaskController@AddPin')->name('task.addPin');
        Route::any('/removePin','TaskController@RemovePin')->name('task.removePin');
    });
    Route::group(["prefix"=>"user"] , function() {
        Route::get('' , 'UserController@index')->name('user');
        Route::get('add' , 'UserController@AddUser')->name('user.add');
        Route::post('save' , 'UserController@SaveUser')->name('user.save');
        Route::get('edit' , 'UserController@EditUser')->name('user.edit');
        Route::post('update' , 'UserController@UpdateUser')->name('user.update');
        Route::get('setting' , 'TaskController@Settings')->name('user.setting');
        Route::post('SaveSetting' , 'TaskController@SaveSettings')->name('user.saveSetting');
        Route::get('delete' , 'UserController@DeleteUser')->name('user.delete');
        Route::post('admin-password','UserController@AskPassword');
    });

    Route::group(["prefix"=>"tag"] , function() {
        Route::get('','TagController@index')->name('tag');
        Route::get('updatePin', 'TagController@UpdatePin')->name('tag.updatePin');
        Route::post('add','TagController@Add')->name('tag.add');
        Route::post('update','TagController@Update')->name('tag.update');
        Route::get('delete','TagController@Delete')->name('tag.delete');
    });

    Route::get('people','UserController@People')->name('people');
    Route::post('people/update','UserController@UpdatePeople')->name('people.update');
    Route::post('people/add','UserController@AddPerson')->name('people.add');
    Route::get('organization','CompanyController@company')->name('company');
    Route::post('organization/add','CompanyController@Add')->name('company.add');
    Route::post('organization/update','CompanyController@Update')->name('company.update');
    Route::get('organization/delete','CompanyController@Delete')->name('company.delete');


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

Route::get('/cmd/passport', function () {
    chdir('./');
    $dir = getcwd();
    print_r($dir);
    $cmd = shell_exec ('php artisan passport:install');
    return $cmd;
});
