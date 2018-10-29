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
    return view('backend.modulos.tareas.view_list',compact('curso','tab_tar'));

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

  ############################## METODOS ##############################
  //listado de modulos de un curso
  public function lista(Request $request){
    $tareas   =DB::select("select id,nombre,fecha_vencimiento,calificacion,fecha_creacion
                              from tareas
                              where curso_id = :curso_id
                              order by fecha_creacion desc",
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

      DB::commit();
      return response()->json([
          'message' => 'Registro creado correctamente!',
          'message2' => 'Click para continuar!'
      ]);
    }
    catch(\Exception $e){
        Log::info('creacion tarea : '.$e->getMessage());
        DB::rollback();
        //$e->getMessage();

        return response()->json([
            'error' =>'Hubo una inconsistencias al intentar crear el registro'
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
}
