<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Log;
use Session;

class EjerciciosController extends Controller
{
  public function lista(Request $request){

    $cantUser     =DB::select("select count(id) as cant
                                from cursos_user
                                where curso_id= :curso_id and slugrol='es'",
                        ['curso_id'=>$request->idcurso]);
    if(!empty($cantUser)){
      $cantUser    =$cantUser[0]->cant;
    }else{
      $cantUser =0;
    }
    $ejercicios   =DB::select("select e.id,e.nombre,e.descripcion,e.duracion,e.fecha_inicio,
                                case when e.fecha_finalizacion='9999-12-31' then 'Indefinido' else e.fecha_finalizacion::varchar end as fecha_finalizacion,
                                e.fecha_creacion,e.preguntas as cant_preg,
                                e.calificacion as notamaxima,e.entregas
                                from ejercicios e
                                where e.curso_id = :curso_id
                                order by e.fecha_inicio desc",
                              ['curso_id'=>$request->idcurso]);

    $jsonresponse=[
        'ejercicios'=>$ejercicios,
        'cantUser'=>$cantUser
    ];
    return response()->json($jsonresponse,200);
  }

  public function lista_es(Request $request){
    $user   =Auth::user();
    $fecha  =date('Y-m-d');
    $ejercicios   =DB::select("select ej.id,ej.nombre,ej.descripcion,ej.duracion,ej.fecha_inicio,
                              case when ej.fecha_finalizacion='9999-12-31' then 'Indefinido' else ej.fecha_finalizacion::varchar end as fecha_finalizacion,
                              ej.fecha_creacion,ej.calificacion as notamaxima,
                              case when '$fecha'>=ej.fecha_inicio and '$fecha'<=ej.fecha_finalizacion then true else false end as statusini,case when eu.calificacion is null then 0 else eu.calificacion end as calificacion,
                              case when es.nombre is null then 'Pendiente' else es.nombre end as nombestado,
                              case when es.status is null then 'danger' else es.status end as status,
                              case when eu.id is null then false else true end as status_user
                              from ejercicios ej
                              left join ejercicios_user eu on(ej.id=eu.ejercicio_id and eu.user_id = :user_id)
                              left join estados es on(es.slug=eu.estado and es.tipo='ejercicios')
                              where ej.curso_id = :curso_id
                              order by ej.fecha_inicio desc",
                          ['curso_id'=>$request->idcurso,'user_id'=>$user->id]);

    $jsonresponse=[
        'ejercicios'=>$ejercicios
    ];
    return response()->json($jsonresponse,200);
  }

  public function listaent(Request $request){

    $ejercicio   =DB::select("select
                             e.nombre
                             from ejercicios e
                             where e.id= :id",
                             ['id'=>$request->id])[0];


   $ejercicios   =DB::select("select
                            eu.id as ident,u.nombre,eu.calificacion as notaes,
                            ej.calificacion,es.nombre as nombestado,es.status,
                            es.slug as slugstatus
                            from ejercicios_user eu
                            left join ejercicios ej on(eu.ejercicio_id=ej.id)
                            left join users u on(eu.user_id=u.id)
                            left join estados es on(es.slug=eu.estado and es.tipo='ejercicios')
                            where ej.id= :id",
                            ['id'=>$request->id]);
    $jsonresponse=[
        'ejercicio'=>$ejercicio,
        'ejercicios'=>$ejercicios
    ];
    return response()->json($jsonresponse,200);
  }

  public function revision(Request $request){
    $ejercicio   =DB::select("select
                                pe.nombre,pe.descripcion,ru.id,ru.respuesta,ru.puntaje,pe.calificacion as notapreg,
                                0 as calificacion
                              from respuestas_user ru
                              left join preguntas pe on(ru.preguntas_id=pe.id)
                              where ejerciciouser_id= :id and pe.tipo='abierta'",
                          ['id'=>$request->id]);
    $jsonresponse=[
        'ejercicio'=>$ejercicio
    ];
    return response()->json($jsonresponse,200);
  }

  public function updrevision(Request $request){
    $user   =Auth::user();

    ############guardar datos ########
    DB::beginTransaction();
    try{

      foreach($request->revision as $revision){
        DB::table('respuestas_user')->where('id',$revision['id'])->update([
          'puntaje'=>$revision['calificacion']
        ]);
      }

      $calificacion=DB::select("select sum(puntaje) as puntaje
                                  from respuestas_user
                                  where ejerciciouser_id= :ejerciciouser_id",
                            ['ejerciciouser_id'=>$request->idejeruser])[0];

      DB::table('ejercicios_user')->where('id',$request->idejeruser)->update([
        'estado'=>'calificado',
        'calificacion'=>$calificacion->puntaje
      ]);

      DB::commit();
      return response()->json([
          'message' => 'Actualizacion correctamente!',
          'message2' => 'Click para continuar!'
      ]);


    }
    catch(\Exception $e){
        Log::info('creacion tarea : '.$e->getMessage());
        DB::rollback();
        //$e->getMessage();

        return response()->json([
            'error' =>'Hubo una inconsistencias al intentar crear el registro'.$e->getMessage()
        ], 400);
    }
  }

  public function iniciar(Request $request){
    $user   =Auth::user();

   DB::beginTransaction();
     try{

       $ejercicio=DB::select("select duracion
                                from ejercicios
                                where id = :id",
                             ['id'=>$request->id])[0];

       $idejeruser=DB::table('ejercicios_user')->insertGetId([
            'ejercicio_id'=>$request->id,
            'fecha_creacion'=>date('Y-m-d H:i:s'),
            'estado'=>'calificado',
            'user_id'=>$user->id
          ]);

        $preguntas=DB::select("select p.id,p.nombre,p.tipo,p.descripcion,p.textorellenar,0 as idunica
                                from preguntas p
                                where ejercicio_id = :ejercicio_id
                                order by p.id",
                              ['ejercicio_id'=>$request->id]);

        foreach($preguntas as $preg){
          $respuestas=DB::select("select pregunta_id,id,puntaje,seleccion as option,false as seleccion,respuesta,relacionar,'' as relacionar2
                                  from respuestas
                                  where pregunta_id= :pregunta_id"
                             ,['pregunta_id'=>$preg->id]);
          $preg->respuestas=$respuestas;
        }

       DB::commit();
       return response()->json([
           'idejeruser' =>$idejeruser,
           'preguntas' => $preguntas,
           'duracion'=>$ejercicio->duracion
       ]);
     }
     catch(\Exception $e){
         Log::info('iniciar ejercicio : '.$e->getMessage());
         DB::rollback();
         //$e->getMessage();

         return response()->json([
             'error' =>'Hubo una inconsistencias al intentar iniciar la prueba'
         ], 400);
     }

  }

  public function finalizar(Request $request){

    DB::beginTransaction();
    try{

      $estado='calificado';
      foreach($request->examen as $examen){
        foreach($examen['respuestas'] as $resp){
          $puntaje=0;
          /*si tiene una respuesta de tipo abierta, queda pendiente por calificar
          por el profesor*/
          if($examen['tipo']=='abierta'){
            $estado='entregado';

            DB::table('respuestas_user')->insert([
              'ejerciciouser_id'=>$request->idejeruser,
              'preguntas_id'=>$resp['pregunta_id'],
              'respuesta_id'=>$resp['id'],
              'respuesta'=>$resp['respuesta'],
            ]);
          }

          if($examen['tipo']=='unica'){
            $seleccion=($resp['id']==$examen['idunica']) ? true : false;
            if($resp['option']==$seleccion)$puntaje=$resp['puntaje'];


            DB::table('respuestas_user')->insert([
              'ejerciciouser_id'=>$request->idejeruser,
              'preguntas_id'=>$resp['pregunta_id'],
              'respuesta_id'=>$resp['id'],
              'respuesta'=>$resp['respuesta'],
              'seleccion'=>$seleccion,
              'puntaje'=>$puntaje
            ]);
          }

          if($examen['tipo']=='multiple'){
            if($resp['option']==$resp['seleccion'])$puntaje=$resp['puntaje'];

            DB::table('respuestas_user')->insert([
              'ejerciciouser_id'=>$request->idejeruser,
              'preguntas_id'=>$resp['pregunta_id'],
              'respuesta_id'=>$resp['id'],
              'respuesta'=>$resp['respuesta'],
              'seleccion'=>$resp['seleccion'],
              'puntaje'=>$puntaje
            ]);
          }

          if($examen['tipo']=='relacionar'){
            if($resp['relacionar']==$resp['relacionar2'])$puntaje=$resp['puntaje'];

            DB::table('respuestas_user')->insert([
              'ejerciciouser_id'=>$request->idejeruser,
              'preguntas_id'=>$resp['pregunta_id'],
              'respuesta_id'=>$resp['id'],
              'respuesta'=>$resp['respuesta'],
              'relacionar'=>$resp['relacionar2'],
              'puntaje'=>$puntaje
            ]);
          }

          if($examen['tipo']=='rellenar'){
            if($resp['relacionar']==$resp['relacionar2'])$puntaje=$resp['puntaje'];

            DB::table('respuestas_user')->insert([
              'ejerciciouser_id'=>$request->idejeruser,
              'preguntas_id'=>$resp['pregunta_id'],
              'respuesta_id'=>$resp['id'],
              'respuesta'=>$resp['respuesta'],
              'relacionar'=>$resp['relacionar2'],
              'puntaje'=>$puntaje
            ]);
          }
        }
      }

      $calificacion=DB::select("select sum(puntaje) as puntaje
                                  from respuestas_user
                                  where ejerciciouser_id= :ejerciciouser_id",
                            ['ejerciciouser_id'=>$request->idejeruser])[0];

      DB::table('ejercicios_user')->where('id',$request->idejeruser)->update([
        'estado'=>$estado,
        'calificacion'=>$calificacion->puntaje
      ]);

      $msj2="";
      if($estado=='entregado'){
        $msj2 .="Tu nota parcial es: ".$calificacion->puntaje;
        $msj2 .=",con preguntas pendientes por calificar";
      }else{
        $msj2 .="Tu nota es: ".$calificacion->puntaje;
      }

      DB::commit();
      return response()->json([
          'message' => 'Finalizaste la prueba!',
          'message2' =>$msj2
      ]);
    }
    catch(\Exception $e){
        Log::info('creacion ejercicio : '.$e->getMessage());
        DB::rollback();
        //$e->getMessage();

        return response()->json([
            'error' =>'Hubo una inconsistencias al intentar enviar la prueba'.$e->getMessage()
        ], 400);
    }

  }

  //guardar un nuevo modulo de un curso
  public function guardar(Request $request){
    $user   =Auth::user();
    $validator =Validator::make($request->all(),[
      'nombre' =>'required|string',
      'fecha_inicio' =>'required',
      'duracion' =>'required|integer|min:1'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->messages(),
        ], 400);
    }

    DB::beginTransaction();
    try{
      $fecha_finalizacion =($request->fecha_finalizacion=='') ? '9999-12-31' : $request->fecha_finalizacion;

      DB::table('ejercicios')->insert([
        'curso_id'=>$request->idcurso,
        'nombre'=>$request->nombre,
        'descripcion'=>$request->descripcion,
        'duracion'=>$request->duracion,
        'fecha_inicio'=>$request->fecha_inicio,
        'fecha_finalizacion'=>$fecha_finalizacion,
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
        Log::info('creacion ejercicio : '.$e->getMessage());
        DB::rollback();
        //$e->getMessage();

        return response()->json([
            'error' =>'Hubo una inconsistencias al intentar crear el registro'
        ], 400);
    }
  }

  //datos de edicion de un modulo
  public function editar(Request $request){
    $ejercicio   =DB::select("select
                            id,nombre,descripcion,duracion,fecha_inicio,
                            case when fecha_finalizacion='9999-12-31' then NULL else fecha_finalizacion end as fecha_finalizacion,
                            fecha_creacion
                            from ejercicios
                            where id = :id",
                          ['id'=>$request->id])[0];
    $jsonresponse=[
        'ejercicio'=>$ejercicio
    ];
    return response()->json($jsonresponse,200);
  }

  public function actualizar(Request $request){
    $user   =Auth::user();
    $validator =Validator::make($request->all(),[
      'nombre' =>'required|string',
      'fecha_inicio' =>'required',
      'duracion' =>'required|integer|min:1'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->messages(),
        ], 400);
    }

    //guardar datos
    DB::beginTransaction();
    try{

      $fecha_finalizacion =($request->fecha_finalizacion=='') ? '9999-12-31' : $request->fecha_finalizacion;

      DB::table('ejercicios')->where('id',$request->id)->update([
        'nombre'=>$request->nombre,
        'descripcion'=>$request->descripcion,
        'duracion'=>$request->duracion,
        'fecha_inicio'=>$request->fecha_inicio,
        'fecha_finalizacion'=>$fecha_finalizacion,
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
        Log::info('actualizacion ejercicio : '.$e->getMessage());
        DB::rollback();
        //$e->getMessage();

        return response()->json([
            'error' =>'Hubo una inconsistencias al intentar actualizar el registro'
        ], 400);
    }
  }

  public function resultadoes(Request $request){
    $user   =Auth::user();

   DB::beginTransaction();
     try{

       $ejercicio=DB::select("select duracion
                                from ejercicios
                                where id = :id",
                             ['id'=>$request->id])[0];

       $idejeruser=DB::table('ejercicios_user')->insertGetId([
            'ejercicio_id'=>$request->id,
            'fecha_creacion'=>date('Y-m-d H:i:s'),
            'estado'=>'calificado',
            'user_id'=>$user->id
          ]);

        $preguntas=DB::select("select p.id,p.nombre,p.tipo,p.descripcion,p.textorellenar,0 as idunica
                                from preguntas p
                                where ejercicio_id = :ejercicio_id
                                order by p.id",
                              ['ejercicio_id'=>$request->id]);

        foreach($preguntas as $preg){
          $respuestas=DB::select("select pregunta_id,id,puntaje,seleccion as option,false as seleccion,respuesta,relacionar,'' as relacionar2
                                  from respuestas
                                  where pregunta_id= :pregunta_id"
                             ,['pregunta_id'=>$preg->id]);
          $preg->respuestas=$respuestas;
        }

       DB::commit();
       return response()->json([
           'idejeruser' =>$idejeruser,
           'preguntas' => $preguntas,
           'duracion'=>$ejercicio->duracion
       ]);
     }
     catch(\Exception $e){
         Log::info('iniciar ejercicio : '.$e->getMessage());
         DB::rollback();
         //$e->getMessage();

         return response()->json([
             'error' =>'Hubo una inconsistencias al intentar iniciar la prueba'
         ], 400);
     }

  }
}
