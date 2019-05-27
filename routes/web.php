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
Route::group(['middleware' => ['web']], function() {

    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/login', 'HomeController@login')->name('home.login');
    Route::any('/register', 'HomeController@register')->name('home.register');
    Route::any('/login', 'HomeController@login')->name('home.login');
    Route::any('/forgot-password', 'HomeController@forgotPassword')->name('home.forgotPassword');
//    Route::group(['middleware' => ['check_admin_login', 'auth']], function () {
//        Route::get('/', 'StudentController@index')->name('student.index');
//        Route::get('/get', 'StudentController@get')->name('student.get');
//        Route::get('edit/{id}', 'StudentController@edit')->name('student.edit');
//        Route::get('delete/{id}', 'StudentController@destroy')->name('student.delete');
//        Route::get('/create', 'StudentController@create')->name('student.create');
//        Route::post('/store', 'StudentController@store')->name('student.store');
//        Route::post('/update/{id}', 'StudentController@update')->name('student.update');
//
//
//    });
});
