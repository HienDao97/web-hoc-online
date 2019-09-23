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

Route::group(['middleware' => ['web'], 'prefix' => 'student'], function() {

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/', 'StudentController@index')->name('student.index')->middleware(['verify.role:show']);
        Route::get('/get', 'StudentController@get')->name('student.get')->middleware(['verify.role:show']);
        Route::get('/export', 'StudentController@export')->name('student.export')->middleware(['verify.role:show']);
        Route::get('edit/{id}', 'StudentController@edit')->name('student.edit')->middleware(['verify.role:edit']);
        Route::get('delete/{id}', 'StudentController@destroy')->name('student.delete')->middleware(['verify.role:destroy']);
        Route::get('/create', 'StudentController@create')->name('student.create')->middleware(['verify.role:create']);
        Route::post('/store', 'StudentController@store')->name('student.store')->middleware(['verify.role:create']);
        Route::post('/update/{id}', 'StudentController@update')->name('student.update')->middleware(['verify.role:edit']);


    });
});
Route::group(['middleware' => ['web'], 'prefix' => 'slide'], function() {

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/', 'SlideController@index')->name('slide.index')->middleware(['verify.role:show']);

        Route::any('edit/{id}', 'SlideController@edit')->name('slide.edit')->middleware(['verify.role:edit']);
        Route::any('/create', 'SlideController@create')->name('slide.create')->middleware(['verify.role:create']);
        Route::get('delete/{id}', 'SlideController@destroy')->name('slide.delete')->middleware(['verify.role:edit']);
    });
});
Route::group(['middleware' => ['web'], 'prefix' => 'comment'], function() {

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/', 'CommentController@index')->name('comment.index')->middleware(['verify.role:show']);

        Route::any('edit/{id}', 'CommentController@edit')->name('comment.edit')->middleware(['verify.role:edit']);
    });
});



