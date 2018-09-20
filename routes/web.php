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
Route::resource('st/inicio', 'backend\st\InicioStudyController')->middleware('auth');
Route::resource('st/perfil', 'backend\st\PerfilStudyController')->middleware('auth');
Route::resource('st/sala', 'backend\st\SalaStudyController')->middleware('auth');

Route::resource('te/dash', 'backend\te\InicioTeacherController')->middleware('auth');

Route::resource('in/dash', 'backend\in\InicioInstiController')->middleware('auth');

Route::resource('fa/dash', 'backend\fa\InicioFamilyController')->middleware('auth');
