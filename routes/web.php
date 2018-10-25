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
  Route::get('/cursosd/{estado?}', 'HomeController@cursos');
  Route::get('/cursodet/{id}', 'HomeController@cursosdet');
  Route::get('/getcursodet/{id}', 'HomeController@getCursodet');
  Route::get('/acercade', 'HomeController@acercade');
  Route::get('/contacto', 'HomeController@contacto');
  Route::get('/registro', 'HomeController@registro');
  Route::get('/login', 'HomeController@login');
  Route::get('/noaccess', 'HomeController@noaccess');
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

  Route::get('cursos','backend\modulos\CursosController@view_list');
  Route::get('cursos/v_crear', 'backend\modulos\CursosController@view_crear');
  Route::get('cursos/v_editar/{id}', 'backend\modulos\CursosController@view_editar');
  Route::get('cursos/v_config/{id}', 'backend\modulos\CursosController@view_config');
  Route::post('cursos/lista', 'backend\modulos\CursosController@lista');
  Route::post('cursos/guardar', 'backend\modulos\CursosController@guardar');
  Route::get('cursos/editar/{id}', 'backend\modulos\CursosController@editar');
  Route::post('cursos/actualizar', 'backend\modulos\CursosController@actualizar');
  Route::get('cursos/abrir/{id}', 'backend\modulos\CursosController@abrir');
  Route::get('cursos/e_config/{id}', 'backend\modulos\CursosController@edit_config');
  Route::post('cursos/u_configplan/{id}', 'backend\modulos\CursosController@upd_configplan');
  Route::post('cursos/u_configvideo/{id}', 'backend\modulos\CursosController@upd_configvideo');
  Route::post('cursos/u_configlogo/{id}', 'backend\modulos\CursosController@upd_configlogo');

  Route::get('foroc/{idcurso}', 'backend\modulos\ForoCursoController@index');
  Route::post('foroc/data','backend\modulos\ForoCursoController@getData');
  Route::post('foroc/publicar','backend\modulos\ForoCursoController@publicacion');
  Route::post('foroc/datacoment','backend\modulos\ForoCursoController@getComentarios');
  Route::post('foroc/comentar','backend\modulos\ForoCursoController@agregarComentario');

  Route::get('modulos/{idcurso}','backend\modulos\ModulosController@view_lista');
  Route::get('modulos/v_crear/{idcurso}', 'backend\modulos\ModulosController@view_crear');
  Route::get('modulos/v_editar/{idcurso}/{id}', 'backend\modulos\ModulosController@view_editar');
  Route::post('modulos/lista', 'backend\modulos\ModulosController@lista');
  Route::post('modulos/guardar', 'backend\modulos\ModulosController@guardar');
  Route::get('modulos/editar/{id}', 'backend\modulos\ModulosController@editar');
  Route::post('modulos/actualizar', 'backend\modulos\ModulosController@actualizar');
  Route::post('modulos/progreso', 'backend\modulos\ModulosController@progreso');//verificar

  Route::get('lecciones/editar/{id}', 'backend\modulos\LeccionesController@editar');
  Route::get('lecciones/{idcurso}/{idmodulo}','backend\modulos\LeccionesController@view_lista');
  Route::get('lecciones/v_crear/{idcurso}/{idmodulo}', 'backend\modulos\LeccionesController@view_crear');
  Route::get('lecciones/v_editar/{idcurso}/{idmodulo}/{id}', 'backend\modulos\LeccionesController@view_editar');
  Route::post('lecciones/lista', 'backend\modulos\LeccionesController@lista');
  Route::post('lecciones/guardar', 'backend\modulos\LeccionesController@guardar');
  Route::post('lecciones/actualizar', 'backend\modulos\LeccionesController@actualizar');

  Route::get('tareas/{idcurso}','backend\modulos\TareasController@view_lista');
  Route::get('tareas/v_crear/{idcurso}', 'backend\modulos\TareasController@view_crear');
  Route::get('tareas/v_editar/{idcurso}/{id}', 'backend\modulos\TareasController@view_editar');
  Route::post('tareas/lista', 'backend\modulos\TareasController@lista');
  Route::post('tareas/guardar', 'backend\modulos\TareasController@guardar');
  Route::get('tareas/editar/{id}', 'backend\modulos\TareasController@editar');
  Route::post('tareas/actualizar', 'backend\modulos\TareasController@actualizar');

  Route::get('ejercicios/{idcurso}','backend\modulos\EjerciciosController@view_lista');
  Route::get('ejercicios/v_crear/{idcurso}', 'backend\modulos\EjerciciosController@view_crear');
  Route::get('ejercicios/v_editar/{idcurso}/{id}', 'backend\modulos\EjerciciosController@view_editar');
  Route::post('ejercicios/lista', 'backend\modulos\EjerciciosController@lista');
  Route::post('ejercicios/guardar', 'backend\modulos\EjerciciosController@guardar');
  Route::get('ejercicios/editar/{id}', 'backend\modulos\EjerciciosController@editar');
  Route::post('ejercicios/actualizar', 'backend\modulos\EjerciciosController@actualizar');

  Route::get('preguntas/editar/{id}', 'backend\modulos\PreguntasController@editar');
  Route::get('preguntas/{idcurso}/{idejerc}','backend\modulos\PreguntasController@view_lista');
  Route::get('preguntas/v_crear/{idcurso}/{idejerc}', 'backend\modulos\PreguntasController@view_crear');
  Route::get('preguntas/v_editar/{idcurso}/{idejerc}/{id}', 'backend\modulos\PreguntasController@view_editar');
  Route::post('preguntas/lista', 'backend\modulos\PreguntasController@lista');
  Route::post('preguntas/guardar', 'backend\modulos\PreguntasController@guardar');
  Route::post('preguntas/actualizar', 'backend\modulos\PreguntasController@actualizar');

  Route::get('integrantes/{idcurso}','backend\modulos\IntegrantesController@view_lista');
  Route::post('integrantes/lista', 'backend\modulos\IntegrantesController@lista');

  Route::get('ofertados','backend\modulos\OfertadosController@index');
  Route::post('ofertados/busq','backend\modulos\OfertadosController@listacursos');
  Route::get('ofertados/det/{id}','backend\modulos\OfertadosController@verCurso');
  Route::post('ofertados/suscrip','backend\modulos\OfertadosController@suscripcion');
  Route::get('ofertados/e_curso/{id}','backend\modulos\OfertadosController@edit_curso');



});
