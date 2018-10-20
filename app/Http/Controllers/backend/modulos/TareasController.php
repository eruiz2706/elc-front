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
    $curso  =DB::select("select c.id,c.nombre,u.imagen as imagenprof
                          from cursos c
                          left join users u on(c.user_id=u.id)
                          where c.id= :idcurso and user_id = :user_id"
                     ,['idcurso'=>$idcurso,'user_id'=>$user->id]);
    if(!empty($curso)){
      $curso  =$curso[0];
    }

    $rol  =Session::get('rol');
    if($rol=='in'){
        return view('backend.modulos.tareas.view_lista',compact('curso','tab_tar'));
    }else{
      echo "no pertenece a ningun rol redireccionar";
    }
  }

  //vista para crear un nuevo modulo
  public function view_crear($idcurso){
    $tab_tar='';
    $user   =Auth::user();
    $curso  =DB::select("select c.id,c.nombre,u.imagen as imagenprof
                          from cursos c
                          left join users u on(c.user_id=u.id)
                          where c.id= :idcurso and user_id = :user_id"
                     ,['idcurso'=>$idcurso,'user_id'=>$user->id]);
    if(!empty($curso)){
      $curso  =$curso[0];
    }

    $rol  =Session::get('rol');
    if($rol !='in'){
      echo "no pertenece a ningun rol redireccionar";
    }
    return view('backend.modulos.tareas.view_crear',compact('curso','tab_tar','idcurso'));
  }

  //vista para editar un modulo
  public function view_editar($idcurso,$id){
    $tab_tar='';
    $user   =Auth::user();
    $curso  =DB::select("select c.id,c.nombre,u.imagen as imagenprof
                          from cursos c
                          left join users u on(c.user_id=u.id)
                          where c.id= :idcurso and user_id = :user_id"
                     ,['idcurso'=>$idcurso,'user_id'=>$user->id]);
    if(!empty($curso)){
      $curso  =$curso[0];
    }

    $rol  =Session::get('rol');
    if($rol !='in'){
      echo "no pertenece a ningun rol redireccionar";
    }
    return view('backend.modulos.tareas.view_edit',compact('curso','tab_tar','idcurso','id'));
  }

  ############################## METODOS ##############################
  //listado de modulos de un curso
  public function lista(Request $request){
    $tareas   =DB::select("select id,nombre
                              from tareas
                              where curso_id = :curso_id",
                          ['curso_id'=>$request->idcurso]);
    $jsonresponse=[
        'tareas'=>$tareas
    ];
    return response()->json($jsonresponse,200);
  }

  //guardar un nuevo modulo de un curso
  public function guardar(Request $request){
    $validator =Validator::make($request->all(),[
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
      DB::table('tareas')->insert([
        'curso_id'=>$request->idcurso,
        'nombre'=>$request->nombre,
        'descripcion'=>''
      ]);

      DB::commit();
      return response()->json([
          'message' => 'Registro guardado correctamente!',
          'message2' => 'Click para continuar!'
      ]);
    }
    catch(\Exception $e){
        Log::info('creacion tarea : '.$e->getMessage());
        DB::rollback();
        //$e->getMessage();

        return response()->json([
            'error' =>'Hubo una inconsistencias al intentar guardar el registro'
        ], 400);
    }
  }

  //datos de edicion de un modulo
  public function editar($id){
    $tarea   =DB::select("select
                            id,nombre
                            from tareas
                            where id = :id",
                          ['id'=>$id])[0];
    $jsonresponse=[
        'tarea'=>$tarea
    ];
    return response()->json($jsonresponse,200);
  }

  public function actualizar(Request $request){
    $validator =Validator::make($request->all(),[
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
      DB::table('tareas')->where('id',$request->id)->update([
        'nombre'=>$request->nombre
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
            'error' =>'Hubo una inconsistencias al intentar actualizacion el registro'
        ], 400);
    }
  }
}
