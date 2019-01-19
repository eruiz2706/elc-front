<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Log;

class CalendarioController extends Controller
{
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
