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

Route::group(['middleware' => ['web','auth','check_admin_login'], 'prefix' => 'user'], function()
{
    Route::get('/', 'UsersController@index')->name('user.index');
    Route::get('/get', 'UsersController@get')->name('user.get');
    Route::get('view/{id}', 'UsersController@view')->name('user.view');

});
