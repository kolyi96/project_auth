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
})->middleware('referral')->name('index');

//Auth::routes()


Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'web'], function () {

    Auth::routes();
});

Route::group(['prefix'=>'admin','middleware'=>['web','auth']],function(){
    
    Route::get('/',['uses'=>'Admin\IndexController@index','as'=>'index_admin']);
   /* Route::get('/users',['uses'=>'Admin\UsersController@index','as'=>'users']);
    Route::get('/users/create',['uses'=>'Admin\UsersController@create','as'=>'user_create']);
    Route::get('/users/edit/{users?}',['uses'=>'Admin\UsersController@edit','as'=>'user_edit'],function ($value) {
        dump($value);
        exit();
        return \App\User::find($value);
    });
    
    Route::post('/users/store',['uses'=>'Admin\UsersController@store','as'=>'user_create_p']);
    Route::post('/users/update/{users}',['uses'=>'Admin\UsersController@update','as'=>'user_edit_p'],function ($value) {
        dump($value); exit();
        return \App\User::find($value);
    });
    Route::get('/users/destroy/{users}',['uses'=>'Admin\UsersController@store','as'=>'destroy_u'],function ($value) {
        return \App\User::find($value);
    });*/
    
    Route::get('/users/getRoles/{id?}',['uses'=>'Admin\UsersController@getRolesForPage']);
    Route::get('/users/getTableUsers',['uses'=>'Admin\UsersController@getTableUsers']);
    Route::resource('users', 'Admin\UsersController');
    
    
    Route::get('/permissions',['uses'=>'Admin\PermissionsController@index','as'=>'permissions']);
    Route::post('/permissions',['uses'=>'Admin\PermissionsController@store']);
    
});


Route::get('auth/{provider}', 'Auth\RegisterController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');


