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
    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('report', 'DailyReportController');

    Route::get('question/mypage', 'QuestionController@showMyPage')->name('question.mypage');
    Route::resource('question', 'QuestionController');
    Route::post('question/confirm', 'QuestionController@confirm')->name('question.confirm');

    Route::resource('comment', 'CommentController', ['only' => ['store']]);


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
