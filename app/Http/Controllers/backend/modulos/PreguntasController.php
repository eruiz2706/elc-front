<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Log;

class PreguntasController extends Controller
{
  public function lista(Request $request){
    $preguntas   =DB::select("select p.id,p.nombre,p.tipo,p.fecha_creacion,sum(r.puntaje) as puntaje
                              from preguntas p
                              left join respuestas r on(p.id=r.pregunta_id)
                              where ejercicio_id = :ejercicio_id
                              group by p.id,p.nombre,p.tipo,p.fecha_creacion",
                          ['ejercicio_id'=>$request->idejerc]);
    $jsonresponse=[
        'preguntas'=>$preguntas
    ];
    return response()->json($jsonresponse,200);
  }

  //guardar un nuevo modulo de un curso
  public function guardar(Request $request){
    $user   =Auth::user();

    $validator =Validator::make($request->all(),[
      'descripcion' =>'required|string',
      'tipo' =>'required|string'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->messages(),
        ], 400);
    }

    ############guardar datos ########
    DB::beginTransaction();
    try{

      $textoaudio=trim($request->texto_audio);

       $idpregunta=DB::table('preguntas')->insertGetId([
        'ejercicio_id'=>$request->idejerc,
        'nombre'=>'',
        'textoaudio'=>$textoaudio,
        'descripcion'=>$request->descripcion,
        'tipo'=>$request->tipo,
        'textorellenar'=>nl2br($request->texto_rellenar),
        'fecha_creacion'=>date('Y-m-d H:i:s'),
        'user_id'=>$user->id
      ]);

      if($request->tipo=='abierta'){
        $puntaje=($request->resp_abierta['puntaje']=='') ? 0 : $request->resp_abierta['puntaje'];
        DB::table('respuestas')->insert([
          'pregunta_id'=>$idpregunta,
          'puntaje'=>$puntaje,
          'fecha_creacion'=>date('Y-m-d H:i:s'),
          'user_id'=>$user->id
        ]);
      }

      if($request->tipo=='unica'){
        foreach($request->resp_unica as $res){
          $seleccion=false;
          if($res['id']==$request->radio_unica)$seleccion=true;
          $puntaje=($res['puntaje']=='') ? 0 : $res['puntaje'];
          DB::table('respuestas')->insert([
            'pregunta_id'=>$idpregunta,
            'seleccion'=>$seleccion,
            'puntaje'=>$puntaje,
            'respuesta'=>nl2br($res['respuesta']),
            'fecha_creacion'=>date('Y-m-d H:i:s'),
            'user_id'=>$user->id
          ]);
        }
      }

      if($request->tipo=='multiple'){
        foreach($request->resp_multiple as $res){
          $puntaje=($res['puntaje']=='') ? 0 : $res['puntaje'];
          DB::table('respuestas')->insert([
            'pregunta_id'=>$idpregunta,
            'seleccion'=>$res['option'],
            'puntaje'=>$puntaje,
            'respuesta'=>nl2br($res['respuesta']),
            'fecha_creacion'=>date('Y-m-d H:i:s'),
            'user_id'=>$user->id
          ]);
        }
      }

      if($request->tipo=='relacionar'){
        foreach($request->resp_relacionar as $res){
          $puntaje=($res['puntaje']=='') ? 0 : $res['puntaje'];
          DB::table('respuestas')->insert([
            'pregunta_id'=>$idpregunta,
            'puntaje'=>$puntaje,
            'respuesta'=>nl2br($res['respuesta']),
            'relacionar'=>nl2br($res['relacionar']),
            'fecha_creacion'=>date('Y-m-d H:i:s'),
            'user_id'=>$user->id
          ]);
        }
      }

      if($request->tipo=='rellenar'){
        foreach($request->resp_rellenar as $res){
          $puntaje=($res['puntaje']=='') ? 0 : $res['puntaje'];
          DB::table('respuestas')->insert([
            'pregunta_id'=>$idpregunta,
            'puntaje'=>$puntaje,
            'respuesta'=>nl2br($res['respuesta']),
            'relacionar'=>nl2br($res['relacionar']),
            'fecha_creacion'=>date('Y-m-d H:i:s'),
            'user_id'=>$user->id
          ]);
        }
      }

      DB::commit();
      return response()->json([
          'message' => 'Registro guardado correctamente!',
          'message2' => 'Click para continuar!'
      ]);
    }
    catch(\Exception $e){
        Log::info('creacion pregunta : '.$e->getMessage());
        DB::rollback();
        //$e->getMessage();

        return response()->json([
            'error' =>'Hubo una inconsistencias al intentar guardar el registro'.$e->getMessage()
        ], 400);
    }
  }

  //datos de edicion de un modulo
  public function editar(Request $request){
    $pregunta   =DB::select("select
                            id,nombre,descripcion,tipo,textorellenar,textoaudio as texto_audio
                            from preguntas
                            where id = :id",
                          ['id'=>$request->id])[0];

    $respuestas   =DB::select("select
                                id,puntaje,seleccion as option,respuesta,relacionar
                                from respuestas
                            where pregunta_id = :id",
                          ['id'=>$request->id]);

    $puntaje=0;
    $radio_unica=0;
    if($pregunta->tipo=='abierta') {
      if(!empty($respuestas[0]))  $puntaje =$respuestas[0]->puntaje;
    }
    if($pregunta->tipo=='unica') {
        $seleccion   =DB::select("select id
                                  from respuestas
                              where pregunta_id = :id and seleccion=true",
                            ['id'=>$request->id])[0];
        $radio_unica=$seleccion->id;
    }

    $jsonresponse=[
        'pregunta'=>$pregunta,
        'resp_abierta'=>$puntaje,
        'resp_unica'=>$respuestas,
        'radio_unica'=>$radio_unica,
        'resp_multiple'=>$respuestas,
        'resp_relacionar'=>$respuestas,
        'resp_rellenar'=>$respuestas
    ];
    return response()->json($jsonresponse,200);
  }

  public function actualizar(Request $request){
    $user   =Auth::user();
    $validator =Validator::make($request->all(),[
      'descripcion' =>'required|string',
      'tipo' =>'required|string'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->messages(),
        ], 400);
    }

    //guardar datos
    DB::beginTransaction();
    try{
      DB::table('preguntas')->where('id',$request->id)->update([
        'nombre'=>'',
        'descripcion'=>$request->descripcion,
        'tipo'=>$request->tipo,
        'textorellenar'=>nl2br($request->texto_rellenar),
      ]);

      DB::table('respuestas')->where([
          ['pregunta_id','=',$request->id]
        ])->delete();

      if($request->tipo=='abierta'){
          DB::table('respuestas')->insert([
            'pregunta_id'=>$request->id,
            'puntaje'=>$request->resp_abierta['puntaje'],
            'fecha_creacion'=>date('Y-m-d H:i:s'),
            'user_id'=>$user->id
          ]);
        }

      if($request->tipo=='unica'){
        foreach($request->resp_unica as $res){
          $seleccion=false;
          if($res['id']==$request->radio_unica)$seleccion=true;

          DB::table('respuestas')->insert([
            'pregunta_id'=>$request->id,
            'seleccion'=>$seleccion,
            'puntaje'=>$res['puntaje'],
            'respuesta'=>nl2br($res['respuesta']),
            'fecha_creacion'=>date('Y-m-d H:i:s'),
            'user_id'=>$user->id
          ]);
        }
      }

      if($request->tipo=='multiple'){
        foreach($request->resp_multiple as $res){
          DB::table('respuestas')->insert([
            'pregunta_id'=>$request->id,
            'seleccion'=>$res['option'],
            'puntaje'=>$res['puntaje'],
            'respuesta'=>nl2br($res['respuesta']),
            'fecha_creacion'=>date('Y-m-d H:i:s'),
            'user_id'=>$user->id
          ]);
        }
      }

      if($request->tipo=='relacionar'){
        foreach($request->resp_relacionar as $res){
          DB::table('respuestas')->insert([
            'pregunta_id'=>$request->id,
            'puntaje'=>$res['puntaje'],
            'respuesta'=>nl2br($res['respuesta']),
            'relacionar'=>nl2br($res['relacionar']),
            'fecha_creacion'=>date('Y-m-d H:i:s'),
            'user_id'=>$user->id
          ]);
        }
      }

      if($request->tipo=='rellenar'){
        foreach($request->resp_rellenar as $res){
          DB::table('respuestas')->insert([
            'pregunta_id'=>$request->id,
            'puntaje'=>$res['puntaje'],
            'respuesta'=>nl2br($res['respuesta']),
            'relacionar'=>nl2br($res['relacionar']),
            'fecha_creacion'=>date('Y-m-d H:i:s'),
            'user_id'=>$user->id
          ]);
        }
      }

      DB::commit();
      return response()->json([
          'message' => 'Registro actualizado correctamente!',
          'message2' => 'Click para continuar!'
      ]);
    }
    catch(\Exception $e){
        Log::info('actualizacion tarea : '.$e->getMessage());
        DB::rollback();
        //$e->getMessage();

        return response()->json([
            'error' =>'Hubo una inconsistencias al intentar actualizacion el registro'.$e->getMessage()
        ], 400);
    }
  }

  public function borrar(Request $request){
    DB::beginTransaction();
    try{
      DB::table('preguntas')->where('id','=',$request->id)->delete();
      DB::commit();

      return response()->json([
          'message' => 'Registro eliminado correctamente!',
          'message2' => 'Click para continuar!'
      ]);
    }
    catch(\Exception $e){
        Log::info('borrado de preguntas : '.$e->getMessage());
        DB::rollback();
        return response()->json([
            'error' =>'Hubo una inconsistencias al intentar realizar la accion'
        ], 400);
    }
  }

}
