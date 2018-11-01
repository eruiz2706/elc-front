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
  ############################## VISTAS ##############################
  //lista de modulos de un curso
  function view_lista($idcurso){

    $tab_mod='';
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
    return view('backend.modulos.modulos.view_list',compact('curso','tab_mod'));
  }

  //vista para crear un nuevo modulo
  public function view_crear($idcurso){
    $tab_mod='';
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
    return view('backend.modulos.modulos.viewcrear',compact('curso','tab_mod','idcurso'));
  }

  //vista para editar un modulo
  public function view_editar($idcurso,$id){
    $tab_mod='';
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
    return view('backend.modulos.modulos.viewedit',compact('curso','tab_mod','idcurso','id'));
  }

  ############################## METODOS ##############################
  //listado de modulos de un curso
  public function lista(Request $request){
    $modulos   =DB::select("select m.id,m.nombre,m.fecha_creacion,count(l.id) as numlec
                              from modulos m
                              left join lecciones l on(m.id=l.modulo_id)
                              where curso_id = :curso_id
                              group by m.id,m.nombre,m.fecha_creacion",
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
  public function editar($id){
    $modulo   =DB::select("select
                            id,nombre
                            from modulos
                            where id = :id",
                          ['id'=>$id])[0];
    $jsonresponse=[
        'modulo'=>$modulo
    ];
    return response()->json($jsonresponse,200);
  }

  public function actualizar(Request $request){
    $user   =Auth::user();
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
      DB::table('modulos')->where('id',$request->id)->update([
        'nombre'=>$request->nombre,
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
