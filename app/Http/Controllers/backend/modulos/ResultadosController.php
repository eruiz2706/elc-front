<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Log;
use Session;

class ResultadosController extends Controller
{

  public function getEstudiante(Request $request){
    $tareas   =DB::select("select t.id,t.nombre,
                              t.calificacion,
                              case when tu.calificacion is null then 0 else tu.calificacion end as notaes
                              from tareas t
                              left join tareas_user tu on(t.id=tu.tarea_id and tu.user_id = :user_id)
                              where curso_id = :curso_id
                              order by t.fecha_vencimiento desc",
                          ['curso_id'=>$request->idcurso,'user_id'=>$request->id]);

    $ejercicios   =DB::select("select ej.id,ej.nombre,ej.calificacion as notamaxima,
                              case when eu.calificacion is null then 0 else eu.calificacion end as notaes
                              from ejercicios ej
                              left join ejercicios_user eu on(ej.id=eu.ejercicio_id and eu.user_id = :user_id)
                              where ej.curso_id = :curso_id
                              order by ej.fecha_inicio desc",
                          ['curso_id'=>$request->idcurso,'user_id'=>$request->id]);

    $jsonresponse=[
        'tareas'=>$tareas,
        'examenes'=>$ejercicios
    ];
    return response()->json($jsonresponse,200);
  }

  public function lista(Request $request){
    $user   =Auth::user();
    $integrantes   =DB::select("select u.id,u.nombre,r.name as perfil,u.imagen
                                from cursos_user cu
                                left join users u on(cu.user_id=u.id)
                                left join role_user ru on(ru.user_id=u.id)
                                left join roles r on(ru.role_id=r.id)
                                where curso_id = :curso_id and cu.slugrol='es'
                                order by r.name desc",
                                ['curso_id'=>$request->idcurso]);
    $jsonresponse=[
        'integrantes'=>$integrantes
    ];
    return response()->json($jsonresponse,200);
  }

  public function lista_es(Request $request){
    $user     =Auth::user();
    $tareas   =DB::select("select t.id,t.nombre,
                              t.calificacion,
                              case when tu.calificacion is null then 0 else tu.calificacion end as notaes
                              from tareas t
                              left join tareas_user tu on(t.id=tu.tarea_id and tu.user_id = :user_id)
                              where curso_id = :curso_id
                              order by t.fecha_vencimiento desc",
                          ['curso_id'=>$request->idcurso,'user_id'=>$user->id]);

    $ejercicios   =DB::select("select ej.id,ej.nombre,ej.calificacion as notamaxima,
                              case when eu.calificacion is null then 0 else eu.calificacion end as notaes
                              from ejercicios ej
                              left join ejercicios_user eu on(ej.id=eu.ejercicio_id and eu.user_id = :user_id)
                              where ej.curso_id = :curso_id
                              order by ej.fecha_inicio desc",
                          ['curso_id'=>$request->idcurso,'user_id'=>$user->id]);

    $jsonresponse=[
        'tareas'=>$tareas,
        'examenes'=>$ejercicios
    ];
    return response()->json($jsonresponse,200);
  }
}
