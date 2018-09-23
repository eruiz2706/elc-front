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
Route::resource('/registro', 'backend\RegistroController');

Route::middleware(['auth'])->group(function(){

  Route::get('/', 'HomeController@index');

  Route::group(['prefix' => 'es'], function() {
    Route::resource('inicio', 'backend\es\InicioEsController');
    Route::post('inicio/busq', 'backend\es\InicioEsController@busqueda');
    Route::get('inicio/detcurso/{id}', 'backend\es\InicioEsController@detallecurso');
    Route::get('inicio/curso/{id}', 'backend\es\InicioEsController@curso');

    Route::resource('perfil', 'backend\es\PerfilEsController');
    Route::post('perfil/info', 'backend\es\PerfilEsController@info');
    Route::post('perfil/pagar', 'backend\es\PerfilEsController@pagar');

    Route::resource('forog', 'backend\es\ForoGeneralController');

    Route::resource('sala', 'backend\es\SalasEsController');
  });

  Route::group(['prefix' => 'in'], function() {
    Route::resource('inicio', 'backend\in\InicioInController');
  });

  Route::group(['prefix' => 'pr'], function() {
    Route::resource('inicio', 'backend\pr\InicioPrController');
  });

  Route::group(['prefix' => 'pa'], function() {
    Route::resource('inicio', 'backend\pa\InicioPaController');
  });

});
