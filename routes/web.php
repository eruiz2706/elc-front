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

Route::middleware(['auth'])->group(function(){

  Route::get('/', 'HomeController@index');

  Route::group(['prefix' => 'st'], function() {
    Route::resource('home', 'backend\st\HomeStudyController');
    Route::post('home/search', 'backend\st\HomeStudyController@search');
    Route::get('home/detcourse/{id}', 'backend\st\HomeStudyController@detcourse');

    Route::resource('profile', 'backend\st\ProfileStudyController');
    Route::post('profile/info', 'backend\st\ProfileStudyController@info');

    Route::resource('room', 'backend\st\RoomStudyController');
  });

  Route::group(['prefix' => 'te'], function() {
    Route::resource('home', 'backend\te\HomeTeacherController');
  });

  Route::group(['prefix' => 'in'], function() {
    Route::resource('home', 'backend\in\HomeInstiController');
  });

  Route::group(['prefix' => 'fa'], function() {
    Route::resource('home', 'backend\fa\HomeFamilyController');
  });

});
