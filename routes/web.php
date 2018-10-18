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
/*Route::get('/home', function () {
   return header('Location: www.google.com');
});*/
/*
v_ => para las vistas
c_ => para cuando
e_ => para v_editar
u_ => para actualizar
*/

################# rutas frontend #################
Route::get('lang/{lang}', function ($lang) {
    session(['lang' => $lang]);
    return \Redirect::back();
})->where([
    'lang' => 'en|es'
]);

Route::middleware(['lang'])->group(function(){
  Route::get('/', 'HomeController@index');
  Route::get('/cursosd', 'HomeController@cursos');
  Route::get('/acercade', 'HomeController@acercade');
  Route::get('/contacto', 'HomeController@contacto');
  Route::get('/registro', 'HomeController@registro');
  Route::post('/registro/guardar', 'HomeController@guardarRegistro');
  Route::get('/login', 'HomeController@login');
  Auth::routes();

  Route::get('/redirect/{provider}/{type?}/{modo?}', 'SocialController@redirect');
  Route::get('/callback/{provider}', 'SocialController@callback');
  Route::get('/callback/{provider}/{rol}', 'SocialController@callback_register');
});


Route::middleware(['auth'])->group(function(){

  Route::get('/principal', 'backend\PrincipalController@index');
  //Route::get('storage/{archivo}','backend\StorageController@index');

  Route::get('foro','backend\modulos\ForoController@index');
  Route::post('foro/data','backend\modulos\ForoController@getData');
  Route::post('foro/publicar','backend\modulos\ForoController@publicacion');
  Route::post('foro/datacoment','backend\modulos\ForoController@getComentarios');
  Route::post('foro/comentar','backend\modulos\ForoController@agregarComentario');

  Route::get('perfil','backend\modulos\PerfilController@index');
  Route::post('perfil/actimg','backend\modulos\PerfilController@actualizarImagen');
  Route::post('perfil/cambiocl','backend\modulos\PerfilController@cambioClave');
  Route::post('perfil/data','backend\modulos\PerfilController@getData');
  Route::post('perfil/act','backend\modulos\PerfilController@actualizar');

  Route::get('cursos','backend\modulos\CursosController@index');
  Route::get('cursos/v_crear', 'backend\modulos\CursosController@view_crear');
  Route::post('cursos/guardar', 'backend\modulos\CursosController@guardar');
  Route::get('cursos/v_editar/{id}', 'backend\modulos\CursosController@view_editar');
  Route::get('cursos/editar/{id}', 'backend\modulos\CursosController@editar');
  Route::post('cursos/actualizar', 'backend\modulos\CursosController@actualizar');
  Route::post('cursos/lista', 'backend\modulos\CursosController@lista');
  Route::get('cursos/abrir/{id}', 'backend\modulos\CursosController@abrir');
  Route::get('cursos/v_config', 'backend\modulos\CursosController@view_config');
  Route::get('cursos/e_config', 'backend\modulos\CursosController@edit_config');
  Route::post('cursos/u_configplan', 'backend\modulos\CursosController@upd_configplan');
  Route::post('cursos/u_configvideo', 'backend\modulos\CursosController@upd_configvideo');
  Route::post('cursos/u_configlogo', 'backend\modulos\CursosController@upd_configlogo');

  Route::get('foroc', 'backend\modulos\ForoCursoController@index');
  Route::post('foroc/data','backend\modulos\ForoCursoController@getData');
  Route::post('foroc/publicar','backend\modulos\ForoCursoController@publicacion');
  Route::post('foroc/datacoment','backend\modulos\ForoCursoController@getComentarios');
  Route::post('foroc/comentar','backend\modulos\ForoCursoController@agregarComentario');

  Route::get('ofertados','backend\modulos\OfertadosController@index');
  Route::post('ofertados/busq','backend\modulos\OfertadosController@listacursos');
  Route::get('ofertados/det/{id}','backend\modulos\OfertadosController@verCurso');
  Route::post('ofertados/suscrip','backend\modulos\OfertadosController@suscripcion');
  Route::get('ofertados/e_curso/{id}','backend\modulos\OfertadosController@edit_curso');

  Route::get('modulos','backend\modulos\ModulosController@index');
  Route::post('modulos/lista', 'backend\modulos\ModulosController@lista');
  Route::get('modulos/crear', 'backend\modulos\ModulosController@crear');
  Route::post('modulos/guardar', 'backend\modulos\ModulosController@guardar');
  Route::post('modulos/progreso', 'backend\modulos\ModulosController@progreso');

  ################# rutas estudiante #################
  Route::group(['prefix' => 'es'], function() {
    Route::get('progres','backend\es\ProgresoController@index');
    Route::get('calend','backend\es\CalendarioController@index');
    Route::get('evaluac','backend\es\EvaluacionesController@index');
    Route::get('result','backend\es\ResultadosController@index');

    Route::get('calendg','backend\es\CalendarioGenController@index');
    Route::get('resultg','backend\es\ResultadosGenController@index');
    Route::get('dicciong','backend\es\DiccionarioGenController@index');
    Route::get('preguntfg','backend\es\PreguntasFrecGenController@index');

  });


});
