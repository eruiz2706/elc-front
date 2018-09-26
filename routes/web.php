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
#registro de usuario

Route::get('/', 'HomeController@index');
Route::get('/cursos', 'HomeController@cursos');
Route::get('/acercade', 'HomeController@acercade');
Route::get('/contacto', 'HomeController@contacto');
Route::get('/nuevoregistro', 'HomeController@nuevoregistro');
Route::get('/login', 'HomeController@login');


Route::get('/registro/{rol}', 'backend\RegistroController@index');
Route::resource('/registro', 'backend\RegistroController');

Auth::routes();
Route::middleware(['auth'])->group(function(){

  Route::get('/principal', 'backend\PrincipalController@index');

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

  Route::get('storage/{archivo}','backend\StorageController@index');


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
