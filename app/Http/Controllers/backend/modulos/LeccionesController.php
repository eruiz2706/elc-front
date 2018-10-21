<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Log;
use Session;


class LeccionesController extends Controller
{
  ############################## VISTAS ##############################
  //lista de modulos de un curso
  function view_lista($idcurso,$idmodulo){
    $tab_mod='';
    $user   =Auth::user();
    $curso  =DB::select("select c.id,c.nombre,u.imagen as imagenprof
                          from cursos c
                          left join users u on(c.user_id=u.id)
                          where c.id= :id"
                     ,['id'=>$idcurso]);

    if(!empty($curso)){
      $curso  =$curso[0];
    }

    $rol  =Session::get('rol');
    if($rol=='in'){
        return view('backend.modulos.lecciones.view_lista',compact('idmodulo','curso','tab_mod'));
    }else{
      echo "no pertenece a ningun rol redireccionar";
    }
  }

  //vista para crear una nueva leccion
  public function view_crear($idcurso,$idmodulo){
    $tab_mod='';
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
    return view('backend.modulos.lecciones.view_crear',compact('idmodulo','curso','tab_mod','idcurso'));
  }

  //vista para editar una leccion
  public function view_editar($idcurso,$idmodulo,$id){

    $tab_mod='';
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
    return view('backend.modulos.lecciones.view_edit',compact('curso','tab_mod','idmodulo','id'));
  }


  ############################## METODOS ##############################
  //listado de modulos de un curso
  public function lista(Request $request){
    $lecciones  =DB::select("select l.id,l.nombre,l.descripcion
                            from lecciones l
                            where modulo_id = :idmodulo"
                     ,['idmodulo'=>$request->idmodulo]);

    $jsonresponse=[
        'lecciones'=>$lecciones
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
      DB::table('lecciones')->insert([
        'modulo_id'=>$request->idmodulo,
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
        Log::info('creacion leccion : '.$e->getMessage());
        DB::rollback();
        //$e->getMessage();

        return response()->json([
            'error' =>'Hubo una inconsistencias al intentar guardar el registro.'.$e->getMessage()
        ], 400);
    }
  }

  //datos de edicion de un modulo
  public function editar($id){
    $leccion   =DB::select("select
                            id,nombre
                            from lecciones
                            where id = :id",
                          ['id'=>$id])[0];
    $jsonresponse=[
        'leccion'=>$leccion
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
      DB::table('lecciones')->where('id',$request->id)->update([
        'nombre'=>$request->nombre
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