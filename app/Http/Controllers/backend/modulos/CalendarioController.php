<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Log;
use Session;

class CalendarioController extends Controller
{
  ############################## VISTAS ##############################
  //lista de modulos de un curso
  function view_lista($idcurso){
    $tab_calen='';
    $user   =Auth::user();
    $rol    =Session::get('rol');
    if(!in_array($rol,['pr','es'])){
      return view('layouts.errors.access_denied');
    }

    $curso  =DB::select("select c.id,c.nombre,u.imagen as imagenprof
                          from cursos c
                          left join users u on(c.user_id=u.id)
                          where c.id= :idcurso"
                     ,['idcurso'=>$idcurso]);
    if(empty($curso)){
      return view('layouts.errors.not_page');
    }

    $curso  =$curso[0];
    return view('backend.modulos.calendario.view_list',compact('curso','tab_calen'));
  }

  ############################## METODOS ##############################
  //listado de modulos de un curso
  public function lista(Request $request){
    $eventos   =DB::select("select
                              EXTRACT(YEAR FROM fecha_vencimiento) as anio,
                              EXTRACT(MONTH FROM fecha_vencimiento) as mes,
                              EXTRACT(DAY FROM fecha_vencimiento) as dia,
                              fecha_vencimiento as fecha,nombre as titulo,'tarea' as tipo
                              from tareas
                              where curso_id= :curso_id
                              union
                              select
                              EXTRACT(YEAR FROM fecha_inicio) as anio,
                              EXTRACT(MONTH FROM fecha_inicio) as mes,
                              EXTRACT(DAY FROM fecha_inicio) as dia,
                              fecha_inicio as fecha,nombre as titulo,'ejercicio' as tipo
                              from ejercicios
                              where curso_id= :curso_id
                              ",
                          ['curso_id'=>$request->idcurso]);
    $jsonresponse=[
        'eventos'=>$eventos
    ];
    return response()->json($jsonresponse,200);
  }
}
