<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Log;
use Session;

class ModulosController extends Controller
{
  ############################## METODOS ##############################
  //listado de modulos de un curso
  public function lista(Request $request){
    $modulos   =DB::select("select m.id,m.nombre,m.fecha_creacion,m.numero,count(l.id) as numlec
                              from modulos m
                              left join lecciones l on(m.id=l.modulo_id)
                              where curso_id = :curso_id
                              group by m.id,m.nombre,m.fecha_creacion
                              order by m.numero asc",
                          ['curso_id'=>$request->idcurso]);
    $jsonresponse=[
        'modulos'=>$modulos
    ];
    return response()->json($jsonresponse,200);
  }

  //guardar un nuevo modulo de un curso
  public function guardar(Request $request){
    $user   =Auth::user();
    $validator =Validator::make($request->all(),[
      'numero' =>'required',
      'nombre' =>'required|string'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->messages(),
        ], 400);
    }

    ############guardar datos ########
    DB::beginTransaction();
    try{
      DB::table('modulos')->insert([
        'curso_id'=>$request->idcurso,
        'nombre'=>$request->nombre,
        'numero'=>$request->numero,
        'fecha_creacion'=>date('Y-m-d H:i:s'),
        'user_id'=>$user->id
      ]);

      DB::commit();
      return response()->json([
          'message' => 'Registro creado correctamente!',
          'message2' => 'Click para continuar!'
      ]);
    }
    catch(\Exception $e){
        Log::info('creacion modulo : '.$e->getMessage());
        DB::rollback();
        //$e->getMessage();

        return response()->json([
            'error' =>'Hubo una inconsistencias al intentar crear el registro'.$request->idcurso
        ], 400);
    }
  }

  //datos de edicion de un modulo
  public function editar(Request $request){
    $modulo   =DB::select("select
                            id,nombre,numero
                            from modulos
                            where id = :id",
                          ['id'=>$request->id])[0];
    $jsonresponse=[
        'modulo'=>$modulo
    ];
    return response()->json($jsonresponse,200);
  }

  public function actualizar(Request $request){
    $user   =Auth::user();
    $validator =Validator::make($request->all(),[
      'numero' =>'required',
      'nombre' =>'required|string'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->messages(),
        ], 400);
    }

    //guardar datos
    DB::beginTransaction();
    try{
      DB::table('modulos')->where('id',$request->id)->update([
        'nombre'=>$request->nombre,
        'numero'=>$request->numero,
        'fecha_modific'=>date('Y-m-d H:i:s'),
        'userm_id'=>$user->id
      ]);

      DB::commit();
      return response()->json([
          'message' => 'Registro actualizado correctamente!',
          'message2' => 'Click para continuar!'
      ]);
    }
    catch(\Exception $e){
        Log::info('actualizacion modulo : '.$e->getMessage());
        DB::rollback();
        //$e->getMessage();

        return response()->json([
            'error' =>'Hubo una inconsistencias al intentar actualizacion el registro'
        ], 400);
    }
  }
}
