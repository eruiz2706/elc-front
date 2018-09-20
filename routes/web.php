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

/*Route::get('/', function () {
    return view('welcome');
});*/
Auth::routes();
Route::resource('/registerusu', 'backend\RegisterController');


Route::get('/', 'HomeController@index')->middleware('auth');

Route::resource('st/home', 'backend\st\HomeStudyController')->middleware('auth');
Route::post('st/home/search', 'backend\st\HomeStudyController@search')->middleware('auth');
Route::resource('st/profile', 'backend\st\ProfileStudyController')->middleware('auth');
Route::resource('st/room', 'backend\st\RoomStudyController')->middleware('auth');

Route::resource('te/home', 'backend\te\HomeTeacherController')->middleware('auth');

Route::resource('in/home', 'backend\in\HomeInstiController')->middleware('auth');

Route::resource('fa/home', 'backend\fa\HomeFamilyController')->middleware('auth');
