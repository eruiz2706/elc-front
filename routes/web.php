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
    Route::resource('inicio', 'backend\es\InicioEsController');
    Route::post('inicio/busq', 'backend\es\InicioEsController@busqueda');
    Route::get('inicio/detcurso/{id}', 'backend\es\InicioEsController@detallecurso');
    Route::get('inicio/curso/{id}', 'backend\es\InicioEsController@curso');

    Route::post('perfil/info', 'backend\es\PerfilEsController@info');
    Route::post('perfil/pagar', 'backend\es\PerfilEsController@pagar');
    Route::post('perfil/avatar', 'backend\es\PerfilEsController@cargarAvatar');
    Route::resource('perfil', 'backend\es\PerfilEsController');

    Route::resource('forog', 'backend\es\ForoGeneralController');

    Route::resource('foro', 'backend\es\ForoController');
    Route::resource('prog', 'backend\es\ProgresoController');
    Route::resource('calend', 'backend\es\CalendarioController');
    Route::resource('evalua', 'backend\es\EvaluacionesController');
    Route::resource('result', 'backend\es\ResultadosController');
    Route::resource('tutor', 'backend\es\TutorController');
    //return view('backend.es.resultado.index');
  });

  ################# rutas familiar #################
  Route::group(['prefix' => 'pa'], function() {
    Route::get('inicio', 'backend\pa\InicioController@index');;
  });

});
