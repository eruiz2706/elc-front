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
  Route::post('/registro/guardar', 'HomeController@guardarRegistro');
  Route::post('/registro/recover', 'HomeController@recuperarPass');
  Route::get('/login', 'HomeController@login');
  Route::get('/noaccess', 'HomeController@noaccess');
  Route::get('/noregister', 'HomeController@noregister');
  Auth::routes();

  Route::get('/redirect/{provider}/{type?}/{modo?}', 'SocialController@redirect');
  Route::get('/callback/{provider}', 'SocialController@callback');
  Route::get('/callback/{provider}/{rol}', 'SocialController@callback_register');
});


Route::middleware(['auth','navcursos'])->group(function(){

  Route::get('/principalpa', 'backend\PrincipalController@indexpa');

  Route::get('/principal', 'backend\PrincipalController@index');
  Route::post('/principal/config', 'backend\PrincipalController@config');
  Route::post('/principal/conexion', 'backend\PrincipalController@conexion');
  Route::post('/principal/abrirmanual', 'backend\PrincipalController@abrirmanual');
  Route::post('/principal/cerrarmanual', 'backend\PrincipalController@cerrarmanual');
  Route::get('/principal/manualuso', 'backend\PrincipalController@manualuso');

  //Route::get('storage/{archivo}','backend\StorageController@index');

  Route::get('ofertados','backend\modulos\OfertadosController@index');
  Route::post('ofertados/busq','backend\modulos\OfertadosController@listacursos');
  Route::post('ofertados/suscrip','backend\modulos\OfertadosController@suscripcion');
  Route::post('ofertados/vercurso','backend\modulos\OfertadosController@vercurso');
  Route::get('ofertados/respuestapago','backend\modulos\OfertadosController@respuestapago');
  Route::get('ofertados/confirmacionpago','backend\modulos\OfertadosController@confirmacionpago');

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
  Route::post('perfil/pagos','backend\modulos\PerfilController@pagos');

  Route::get('cursos','backend\modulos\CursosController@view_list');
  Route::get('cursos/config/{id}', 'backend\modulos\CursosController@view_config');
  Route::get('cursos/gestion/{id}', 'backend\modulos\CursosController@view_gestion');
  Route::post('cursos/lista', 'backend\modulos\CursosController@lista');
  Route::post('cursos/editar', 'backend\modulos\CursosController@editar');
  Route::post('cursos/guardar', 'backend\modulos\CursosController@guardar');
  Route::post('cursos/actualizar', 'backend\modulos\CursosController@actualizar');
  Route::post('cursos/e_config', 'backend\modulos\CursosController@edit_config');
  Route::post('cursos/u_configplan/{id}', 'backend\modulos\CursosController@upd_configplan');
  Route::post('cursos/u_configvideo/{id}', 'backend\modulos\CursosController@upd_configvideo');
  Route::post('cursos/u_configlogo/{id}', 'backend\modulos\CursosController@upd_configlogo');
  Route::get('cursos/abrir/{id}', 'backend\modulos\CursosController@abrir');

  Route::post('modulos/lista', 'backend\modulos\ModulosController@lista');
  Route::post('modulos/guardar', 'backend\modulos\ModulosController@guardar');
  Route::post('modulos/actualizar', 'backend\modulos\ModulosController@actualizar');
  Route::post('modulos/editar', 'backend\modulos\ModulosController@editar');

  Route::post('lecciones/lista', 'backend\modulos\LeccionesController@lista');
  Route::post('lecciones/editar', 'backend\modulos\LeccionesController@editar');
  Route::post('lecciones/listamod', 'backend\modulos\LeccionesController@listamod');
  Route::post('lecciones/select_mod', 'backend\modulos\LeccionesController@select_mod');
  Route::post('lecciones/guardar', 'backend\modulos\LeccionesController@guardar');
  Route::post('lecciones/actualizar', 'backend\modulos\LeccionesController@actualizar');

  Route::post('integrantes/lista', 'backend\modulos\IntegrantesController@lista');

  Route::post('calendario/lista', 'backend\modulos\CalendarioController@lista');

  Route::post('foroc/data','backend\modulos\ForoCursoController@getData');
  Route::post('foroc/publicar','backend\modulos\ForoCursoController@publicacion');
  Route::post('foroc/datacoment','backend\modulos\ForoCursoController@getComentarios');
  Route::post('foroc/comentar','backend\modulos\ForoCursoController@agregarComentario');

  Route::post('progreso/lista', 'backend\modulos\ProgresoController@lista');
  Route::post('progreso/lista_pr', 'backend\modulos\ProgresoController@lista_pr');
  Route::post('progreso/guardar', 'backend\modulos\ProgresoController@guardar');
  Route::post('progreso/progmod', 'backend\modulos\ProgresoController@lista_progreso_modulo');
  Route::post('progreso/toque', 'backend\modulos\ProgresoController@toque');

  Route::post('tareas/guardar', 'backend\modulos\TareasController@guardar');
  Route::post('tareas/lista', 'backend\modulos\TareasController@lista');
  Route::post('tareas/editar', 'backend\modulos\TareasController@editar');
  Route::post('tareas/actualizar', 'backend\modulos\TareasController@actualizar');
  Route::post('tareas/listaent', 'backend\modulos\TareasController@listaent');
  Route::post('tareas/revision', 'backend\modulos\TareasController@revision');
  Route::post('tareas/updrevision', 'backend\modulos\TareasController@updrevision');
  Route::post('tareas/lista_es', 'backend\modulos\TareasController@lista_es');
  Route::post('tareas/editent', 'backend\modulos\TareasController@editent');
  Route::post('tareas/entregar', 'backend\modulos\TareasController@entregar');

  Route::post('notificaciones/conteo', 'backend\modulos\NotificacionesController@conteo');
  Route::post('notificaciones/lista', 'backend\modulos\NotificacionesController@lista');

  Route::post('ejercicios/lista', 'backend\modulos\EjerciciosController@lista');
  Route::post('ejercicios/guardar', 'backend\modulos\EjerciciosController@guardar');
  Route::post('ejercicios/editar', 'backend\modulos\EjerciciosController@editar');
  Route::post('ejercicios/actualizar', 'backend\modulos\EjerciciosController@actualizar');
  Route::post('ejercicios/lista_es', 'backend\modulos\EjerciciosController@lista_es');
  Route::post('ejercicios/listaent', 'backend\modulos\EjerciciosController@listaent');
  Route::post('ejercicios/iniciar', 'backend\modulos\EjerciciosController@iniciar');
  Route::post('ejercicios/finalizar', 'backend\modulos\EjerciciosController@finalizar');
  Route::post('ejercicios/revision', 'backend\modulos\EjerciciosController@revision');
  Route::post('ejercicios/updrevision', 'backend\modulos\EjerciciosController@updrevision');
  Route::post('ejercicios/resultadoes', 'backend\modulos\EjerciciosController@resultadoes');

  Route::post('preguntas/lista', 'backend\modulos\PreguntasController@lista');
  Route::post('preguntas/guardar', 'backend\modulos\PreguntasController@guardar');
  Route::post('preguntas/actualizar', 'backend\modulos\PreguntasController@actualizar');
  Route::post('preguntas/editar', 'backend\modulos\PreguntasController@editar');

  Route::post('resultados/estudiante', 'backend\modulos\ResultadosController@getEstudiante');
  Route::post('resultados/lista', 'backend\modulos\ResultadosController@lista');
  Route::post('resultados/lista_es', 'backend\modulos\ResultadosController@lista_es');

  Route::get('usuarios','backend\modulos\UsuariosController@index');
  Route::post('usuarios/lista','backend\modulos\UsuariosController@lista');

  Route::post('chatprivado/open','backend\modulos\ChatPrivado@open');
  Route::post('chatprivado/responder','backend\modulos\ChatPrivado@responder');
  Route::post('chatprivado/leido','backend\modulos\ChatPrivado@leido');

  Route::get('herramientas','backend\modulos\HerramientasController@index');

  Route::post('mensajes/conteo', 'backend\modulos\MensagesController@conteo');
  Route::post('mensajes/lista', 'backend\modulos\MensagesController@lista');

});
