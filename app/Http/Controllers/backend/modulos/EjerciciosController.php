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
  ############################## VISTAS ##############################
  //lista de modulos de un curso
  function view_lista($idcurso){
    $tab_ejer='';
    $user   =Auth::user();
    $rol    =Session::get('rol');
    if($rol !='in'){
      return view('layouts.errors.access_denied');
    }
    $curso  =DB::select("select c.id,c.nombre,u.imagen as imagenprof
                          from cursos c
                          left join users u on(c.user_id=u.id)
                          where c.id= :idcurso and user_id = :user_id"
                     ,['idcurso'=>$idcurso,'user_id'=>$user->id]);
    if(empty($curso)){
       return view('layouts.errors.not_page');
    }

    $curso  =$curso[0];
    return view('backend.modulos.ejercicios.view_list',compact('curso','tab_ejer'));

  }

  //vista para crear un nuevo modulo
  public function view_crear($idcurso){
    $tab_ejer='';
    $user   =Auth::user();
    $rol    =Session::get('rol');
    if($rol !='in'){
      return view('layouts.errors.access_denied');
    }
    $curso  =DB::select("select c.id,c.nombre,u.imagen as imagenprof
                          from cursos c
                          left join users u on(c.user_id=u.id)
                          where c.id= :idcurso and user_id = :user_id"
                     ,['idcurso'=>$idcurso,'user_id'=>$user->id]);
     if(empty($curso)){
       return view('layouts.errors.not_page');
     }

    $curso  =$curso[0];
    return view('backend.modulos.ejercicios.view_crear',compact('curso','tab_ejer','idcurso'));
  }

  //vista para editar un modulo
  public function view_editar($idcurso,$id){
    $tab_ejer='';
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
    return view('backend.modulos.ejercicios.view_edit',compact('curso','tab_ejer','idcurso','id'));
  }


  ############################## METODOS ##############################
  //listado de modulos de un curso
  public function lista(Request $request){
    $ejercicios   =DB::select("select id,nombre,descripcion,duracion,calificacion,fecha_inicio,fecha_creacion
                              from ejercicios
                              where curso_id = :curso_id",
                          ['curso_id'=>$request->idcurso]);
    $jsonresponse=[
        'ejercicios'=>$ejercicios
    ];
    return response()->json($jsonresponse,200);
  }

  //guardar un nuevo modulo de un curso
  public function guardar(Request $request){
    $user   =Auth::user();
    $validator =Validator::make($request->all(),[
      'nombre' =>'required|string',
      'fecha_inicio' =>'required',
      'duracion' =>'required|integer|min:10',
      'calificacion' =>'required|integer|min:1',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->messages(),
        ], 400);
    }

    DB::beginTransaction();
    try{
      DB::table('ejercicios')->insert([
        'curso_id'=>$request->idcurso,
        'nombre'=>$request->nombre,
        'descripcion'=>$request->descripcion,
        'duracion'=>$request->duracion,
        'calificacion'=>$request->calificacion,
        'fecha_inicio'=>$request->fecha_inicio,
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
  public function editar($id){
    $ejercicio   =DB::select("select
                            id,nombre,descripcion,duracion,calificacion,fecha_inicio,fecha_creacion
                            from ejercicios
                            where id = :id",
                          ['id'=>$id])[0];
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
      'duracion' =>'required|integer|min:10',
      'calificacion' =>'required|integer|min:1',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->messages(),
        ], 400);
    }

    //guardar datos
    DB::beginTransaction();
    try{
      DB::table('ejercicios')->where('id',$request->id)->update([
        'nombre'=>$request->nombre,
        'descripcion'=>$request->descripcion,
        'duracion'=>$request->duracion,
        'calificacion'=>$request->calificacion,
        'fecha_inicio'=>$request->fecha_inicio,
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
}
