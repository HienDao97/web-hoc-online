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
    Route::post('/register-post', 'HomeController@loginPost')->name('home.register.post');
    Route::post('/gop-y/', 'HomeController@gopY')->name('gop.y');
    //goc phu huynh
    Route::get('/goc-phu-huynh', 'CommentController@index')->name('home.goc.phu.huynh');
    //
    Route::get('gioi-thieu', 'IntroduceController@index')->name('home.introduce.index');
    //tai lieu
    Route::get('tai-lieu', 'DocumentController@index')->name('home.document.index');
    Route::get('tai-lieu/lop/{id}', 'DocumentController@detail')->name('home.document.course');
    Route::get('tai-lieu/lop/download/{id}', 'DocumentController@download')->name('home.document.download');

    //khoa-hoc
    Route::get('khoa-hoc', 'ClassroomController@index')->name('home.classroom.index');
    Route::get('khoa-hoc/{id}', 'ClassroomController@detail')->name('home.classroom.detail');
    Route::get('logout', 'StudentController@logout')->name('student.logout');
    Route::group(['middleware' => ['auth'], 'prefix' => 'student'], function () {
        Route::get('/info/{id}', 'StudentController@index')->name('student.index');
        Route::any('/change-password', 'StudentController@changePassword')->name('student.change.password');
        Route::any('/change-avatar/{id}', 'StudentController@changeAvatar')->name('student.change.avatar');
        Route::any('/comment', 'StudentController@comment')->name('student.comment');
        Route::get('/lop-hoc/{id}', 'StudentController@classroom')->name('student.classroom');
        Route::post('/exercise/answer', 'StudentController@answer')->name('student.exercise.answer');
        Route::get('/lop-hoc/{id}/bai-hoc/{id_baihoc}', 'StudentController@classroom')->name('student.classroom.exercise');
    });
});
