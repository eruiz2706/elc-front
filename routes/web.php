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

################# rutas frontend #################
Route::get('/', 'HomeController@index');
Route::get('/cursos', 'HomeController@cursos');
Route::get('/acercade', 'HomeController@acercade');
Route::get('/contacto', 'HomeController@contacto');
Route::get('/registro', 'HomeController@registro');
Route::post('/registro/guardar', 'HomeController@guardarRegistro');
Route::get('/login', 'HomeController@login');
Auth::routes();

Route::middleware(['auth'])->group(function(){

  Route::get('/principal', 'backend\PrincipalController@index');
  Route::get('storage/{archivo}','backend\StorageController@index');

  ################# rutas compartidas #################
  Route::get('foro','backend\ForoController@index');
  Route::post('foro/data','backend\ForoController@getData');
  Route::post('foro/publicar','backend\ForoController@publicacion');
  Route::post('foro/datacoment','backend\ForoController@getComentarios');
  Route::post('foro/comentar','backend\ForoController@agregarComentario');
  Route::get('perfil','backend\PerfilController@index');
  Route::post('perfil/actimg','backend\PerfilController@actualizarImagen');
  Route::post('perfil/cambiocl','backend\PerfilController@cambioClave');
  Route::post('perfil/data','backend\PerfilController@getData');
  Route::post('perfil/act','backend\PerfilController@actualizar');

  ################# rutas administrador #################
  Route::group(['prefix' => 'ad'], function() {
    Route::get('inicio', 'backend\ad\InicioController@index');
  });

  ################# rutas institucion #################
  Route::group(['prefix' => 'in'], function() {
    Route::get('inicio', 'backend\in\InicioController@index');;
  });

  ################# rutas profesor #################
  Route::group(['prefix' => 'pr'], function() {
    Route::get('inicio', 'backend\pr\InicioController@index');;
  });

  ################# rutas estudiante #################
  Route::group(['prefix' => 'es'], function() {
    Route::get('foro','backend\es\ForoController@index');
    Route::get('progres','backend\es\ProgresoController@index');
    Route::get('calend','backend\es\CalendarioController@index');
    Route::get('evaluac','backend\es\EvaluacionesController@index');
    Route::get('result','backend\es\ResultadosController@index');

    Route::get('calendg','backend\es\CalendarioGenController@index');
    Route::get('resultg','backend\es\ResultadosGenController@index');
    Route::get('dicciong','backend\es\DiccionarioGenController@index');
    Route::get('preguntfg','backend\es\PreguntasFrecGenController@index');
  });

  ################# rutas familiar #################
  Route::group(['prefix' => 'pa'], function() {
    Route::get('inicio', 'backend\pa\InicioController@index');;
  });

});
