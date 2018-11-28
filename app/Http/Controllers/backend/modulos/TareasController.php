<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Log;
use Session;

class TareasController extends Controller
{
  ############################## VISTAS ##############################
  //lista de modulos de un curso
  function view_lista($idcurso){
    $tab_tar='';
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
    if($rol=='pr')return view('backend.modulos.tareas.view_list',compact('curso','tab_tar'));
    if($rol=='es')return view('backend.modulos.tareas.view_list_es',compact('curso','tab_tar'));

  }

  //vista para crear un nuevo modulo
  public function view_crear($idcurso){
    $tab_tar='';
    $user   =Auth::user();
    $rol    =Session::get('rol');
    if($rol !='pr'){
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
    return view('backend.modulos.tareas.view_crear',compact('curso','tab_tar','idcurso'));
  }

  //vista para editar un modulo
  public function view_editar($idcurso,$id){
    $tab_tar='';
    $user   =Auth::user();
    $rol    =Session::get('rol');
    if($rol !='pr'){
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
    return view('backend.modulos.tareas.view_edit',compact('curso','tab_tar','idcurso','id'));
  }

  public function view_entrega($idcurso,$id){
    $tab_tar='';
    $user   =Auth::user();
    $rol    =Session::get('rol');
    if($rol !='es'){
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
    return view('backend.modulos.tareas.view_entrega',compact('curso','tab_tar','idcurso','id'));
  }

  function view_listaent($idcurso,$id){
    $tab_tar='';
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
    if($rol=='pr')return view('backend.modulos.tareas.view_listent',compact('id','curso','tab_tar'));

  }

  ############################## METODOS ##############################
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

    $tareas   =DB::select("select t.id,t.nombre,t.fecha_vencimiento,t.calificacion,t.fecha_creacion,t.descripcion,t.entregas as cant_respuest
                            from tareas t
                            where t.curso_id = :curso_id",
                            ['curso_id'=>$request->idcurso]);
    $jsonresponse=[
        'cantUser'=>$cantUser,
        'tareas'=>$tareas
    ];
    return response()->json($jsonresponse,200);
  }

  public function listaent(Request $request){

    $tarea   =DB::select("select
                             t.nombre
                             from tareas t
                             where t.id= :id",
                             ['id'=>$request->id])[0];


   $tareas   =DB::select("select
                            tu.id as ident,u.nombre,tu.respuesta,tu.calificacion as notaes,tu.comentario,tu.estado,t.calificacion,
                            e.nombre as nombestado,e.status,t.descripcion
                            from tareas_user tu
                            left join tareas t on(tu.tarea_id=t.id)
                            left join users u on(tu.user_id=u.id)
                            left join estados e on(e.slug=tu.estado and e.tipo='tareas')
                            where t.id= :id",
                            ['id'=>$request->id]);
    $jsonresponse=[
        'tarea'=>$tarea,
        'tareas'=>$tareas
    ];
    return response()->json($jsonresponse,200);
  }

  public function lista_es(Request $request){
    $tareas   =DB::select("select t.id,t.nombre,t.fecha_vencimiento,t.calificacion,t.fecha_creacion,t.descripcion,
                              tu.calificacion as notaes,tu.respuesta,tu.comentario,
                              case when tu.estado is null then 'Pendiente' else e.nombre end as nombestado,
                              case when e.status is null then 'danger' else e.status end as status
                              from tareas t
                              left join tareas_user tu on(t.id=tu.tarea_id)
                              left join estados e on (e.slug=tu.estado and e.tipo='tareas')
                              where curso_id = :curso_id
                              order by t.fecha_creacion desc",
                          ['curso_id'=>$request->idcurso]);
    $jsonresponse=[
        'tareas'=>$tareas
    ];
    return response()->json($jsonresponse,200);
  }

  //guardar un nuevo modulo de un curso
  public function guardar(Request $request){
    $user   =Auth::user();
    $validator =Validator::make($request->all(),[
      'nombre' =>'required|string',
      'calificacion' =>'required|integer|min:1',
      'fecha_vencimiento' =>'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->messages(),
        ], 400);
    }

    ############guardar datos ########
    DB::beginTransaction();
    try{
      DB::table('tareas')->insert([
        'curso_id'=>$request->idcurso,
        'nombre'=>$request->nombre,
        'descripcion'=>$request->descripcion,
        'calificacion' =>$request->calificacion,
        'fecha_vencimiento' =>$request->fecha_vencimiento,
        'fecha_creacion'=>date('Y-m-d H:i:s'),
        'user_id'=>$user->id
      ]);

      $curso  =DB::select("select c.nombre
                            from cursos c
                            where c.id= :idcurso"
                       ,['idcurso'=>$request->idcurso]);
      $curso  =$curso[0];

      $users_curso   =DB::select("select user_id
                                  from cursos_user
                                  where slugrol='es' and curso_id = :curso_id",
                            ['curso_id'=>$request->idcurso]);

      $notifi_tk=[];
      foreach ($users_curso as $u_curso) {
        DB::table('notificaciones')->insert([
          'descripcion'=>'Nueva tarea curso:<strong> '.$curso->nombre.'</strong> fecha de entrega: <strong>'.$request->fecha_vencimiento.'</strong>',
          'fecha_creacion'=>date('Y-m-d H:i:s'),
          'user_id'=>$u_curso->user_id
        ]);
        $notifi_tk[]=$u_curso->user_id;
      }

      DB::commit();
      return response()->json([
          'message' => 'Registro creado correctamente!',
          'message2' => 'Click para continuar!',
          'notifi_tk'=>$notifi_tk
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

  //datos de edicion de un modulo
  public function editar($id){
    $tarea   =DB::select("select
                            id,nombre,calificacion,fecha_vencimiento,descripcion
                            from tareas
                            where id = :id",
                          ['id'=>$id])[0];
    $jsonresponse=[
        'tarea'=>$tarea
    ];
    return response()->json($jsonresponse,200);
  }

  public function actualizar(Request $request){
    $user   =Auth::user();
    $validator =Validator::make($request->all(),[
      'nombre' =>'required|string',
      'calificacion' =>'required|integer|min:1',
      'fecha_vencimiento' =>'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->messages(),
        ], 400);
    }

    //guardar datos
    DB::beginTransaction();
    try{
      DB::table('tareas')->where('id',$request->id)->update([
        'nombre'=>$request->nombre,
        'descripcion'=>$request->descripcion,
        'calificacion' =>$request->calificacion,
        'fecha_vencimiento' =>$request->fecha_vencimiento,
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
        Log::info('actualizacion tarea : '.$e->getMessage());
        DB::rollback();
        //$e->getMessage();

        return response()->json([
            'error' =>'Hubo una inconsistencias al intentar actualizar el registro'
        ], 400);
    }
  }

  public function editent($id){
    $tarea   =DB::select("select
                            t.id,t.nombre,t.calificacion,t.fecha_vencimiento,t.descripcion,
                            tu.calificacion as notaes,tu.respuesta,tu.comentario,
                            case when tu.id is null then true else false end entrega
                            from tareas t
                            left join tareas_user tu on(t.id=tu.tarea_id)
                            where t.id = :id",
                          ['id'=>$id])[0];
    $jsonresponse=[
        'tarea'=>$tarea
    ];
    return response()->json($jsonresponse,200);
  }

  public function revision(Request $request){
    $tarea   =DB::select("select
                            tu.id,tu.respuesta,tu.comentario,tu.calificacion as notaes,t.calificacion as notasobre,t.descripcion
                            from tareas_user tu
                            left join tareas t on(tu.tarea_id=t.id)
                            where tu.id = :id",
                          ['id'=>$request->id])[0];
    $jsonresponse=[
        'tarea'=>$tarea
    ];
    return response()->json($jsonresponse,200);
  }

  public function updrevision(Request $request){
    $user   =Auth::user();

    ############guardar datos ########
    DB::beginTransaction();
    try{

      DB::table('tareas_user')->where('id',$request->id)->update([
        'comentario'=>$request->comentario,
        'calificacion' =>$request->notaes,
        'estado' =>'calificado'
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


  public function entregar(Request $request){
    $user   =Auth::user();

    ############guardar datos ########
    DB::beginTransaction();
    try{
      DB::table('tareas_user')->insert([
        'tarea_id'=>$request->id,
        'respuesta'=>$request->respuesta,
        'estado'=>'entregado',
        'fecha_creacion'=>date('Y-m-d H:i:s'),
        'user_id'=>$user->id
      ]);

      /*$curso  =DB::select("select c.nombre
                            from cursos c
                            where c.id= :idcurso"
                       ,['idcurso'=>$request->idcurso]);
      $curso  =$curso[0];

      DB::table('notificaciones')->insert([
        'descripcion'=>'Nueva tarea curso:<strong> '.$curso->nombre.'</strong> fecha de entrega: <strong>'.$request->fecha_vencimiento.'</strong>',
        'fecha_creacion'=>date('Y-m-d H:i:s'),
        'user_id'=>$user->id
      ]);*/

      DB::commit();
      return response()->json([
          'message' => 'Tarea enviada correctamente!',
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
}
