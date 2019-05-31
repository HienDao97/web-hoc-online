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

Route::group(['middleware' => ['web'], 'prefix' => 'course'], function() {

    Route::group(['middleware' => ['check_admin_login', 'auth']], function () {
        Route::get('/', 'CourseController@index')->name('course.index');
        Route::get('/get', 'CourseController@get')->name('course.get');
        Route::any('edit/{id}', 'CourseController@edit')->name('course.edit');
        Route::get('delete/{id}', 'CourseController@destroy')->name('course.delete');
        Route::any('/create', 'CourseController@create')->name('course.create');
    });
});
Route::group(['middleware' => ['web'], 'prefix' => 'theory'], function() {

    Route::group(['middleware' => ['check_admin_login', 'auth'], 'prefix' => 'group'], function () {
        Route::get('/', 'TheoryGroupController@index')->name('theory.group.index');
        Route::get('/get', 'TheoryGroupController@get')->name('theory.group.get');
        Route::any('edit/{id}', 'TheoryGroupController@edit')->name('theory.group.edit');
        Route::get('delete/{id}', 'TheoryGroupController@destroy')->name('theory.group.delete');
        Route::any('/create', 'TheoryGroupController@create')->name('theory.group.create');
    });
});
Route::group(['middleware' => ['web'], 'prefix' => 'theory'], function() {

    Route::group(['middleware' => ['check_admin_login', 'auth']], function () {
        Route::get('/', 'TheoryController@index')->name('theory.index');
        Route::get('/get', 'TheoryController@get')->name('theory.get');
        Route::any('edit/{id}', 'TheoryController@edit')->name('theory.edit');
        Route::get('delete/{id}', 'TheoryController@destroy')->name('theory.delete');
        Route::any('/create', 'TheoryController@create')->name('theory.create');
    });
});
Route::group(['middleware' => ['web'], 'prefix' => 'classroom'], function() {

    Route::group(['middleware' => ['check_admin_login', 'auth']], function () {
        Route::get('/', 'ClassroomController@index')->name('classroom.index');
        Route::get('/get', 'ClassroomController@get')->name('classroom.get');
        Route::any('edit/{id}', 'ClassroomController@edit')->name('classroom.edit');
        Route::get('delete/{id}', 'ClassroomController@destroy')->name('classroom.delete');
        Route::any('/create', 'ClassroomController@create')->name('classroom.create');
    });
});
Route::group(['middleware' => ['web'], 'prefix' => 'exercise'], function() {

    Route::group(['middleware' => ['check_admin_login', 'auth']], function () {
        Route::get('/', 'ExerciseController@index')->name('exercise.index');
        Route::get('/get', 'ExerciseController@get')->name('exercise.get');
        Route::get('edit/{id}', 'ExerciseController@edit')->name('exercise.edit');
        Route::get('delete/{id}', 'ExerciseController@destroy')->name('exercise.delete');
        Route::get('/create', 'ExerciseController@create')->name('exercise.create');
        Route::post('/update/{id}', 'ExerciseController@update')->name('exercise.update');
        Route::post('/store', 'ExerciseController@store')->name('exercise.store');
        Route::get('/filter', 'ExerciseController@filter')->name('exercise.filter');
    });
});

