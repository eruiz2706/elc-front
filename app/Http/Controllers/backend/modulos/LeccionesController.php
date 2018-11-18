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
  function view_lista($idcurso){
    $tab_lecc='';
    $user   =Auth::user();
    $rol    =Session::get('rol');
    if($rol !='in'){
      return view('layouts.errors.access_denied');
    }

    $curso  =DB::select("select c.id,c.nombre,u.imagen as imagenprof
                          from cursos c
                          left join users u on(c.user_id=u.id)
                          where c.id= :id"
                     ,['id'=>$idcurso]);
    if(empty($curso)){
      return view('layouts.errors.not_page');
    }

    $curso  =$curso[0];
    return view('backend.modulos.lecciones.view_list',compact('curso','tab_lecc'));

  }

  //vista para crear una nueva leccion
  public function view_crear($idcurso){
    $tab_lecc='';
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
    return view('backend.modulos.lecciones.view_crear',compact('curso','tab_lecc','idcurso'));
  }

  //vista para editar una leccion
  public function view_editar($idcurso,$id){

    $tab_lecc='';
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
    return view('backend.modulos.lecciones.view_edit',compact('curso','tab_lecc','id'));
  }


  ############################## METODOS ##############################
  //listado de modulos de un curso
  public function lista(Request $request){
    $select_mod  =DB::select("select m.id,m.nombre
                              from modulos m
                              where curso_id = :idcurso
                              order by m.numero asc"
                            ,['idcurso'=>$request->idcurso]);

    /*$lecciones  =DB::select("select l.id,l.nombre,l.descripcion,l.fecha_creacion,l.tiempolectura,
                            l.modulo_id,m.nombre as nommod
                            from lecciones l
                            left join modulos m on(l.modulo_id=m.id)
                            where curso_id = :idcurso"
                     ,['idcurso'=>$request->idcurso]);*/

    $jsonresponse=[
        'lecciones'=>[],
        'select_mod'=>$select_mod
    ];
    return response()->json($jsonresponse,200);
  }
  public function select_mod(Request $request){
    $select_mod  =DB::select("select m.id,m.nombre
                              from modulos m
                              where curso_id = :idcurso
                              order by m.numero asc"
                            ,['idcurso'=>$request->idcurso]);

    $jsonresponse=[
        'select_mod'=>$select_mod
    ];
    return response()->json($jsonresponse,200);
  }
  public function listamod(Request $request){

    $lecciones  =DB::select("select l.id,l.nombre,l.descripcion,l.fecha_creacion,l.tiempolectura,
                            l.modulo_id,m.nombre as nommod,l.numero
                            from lecciones l
                            left join modulos m on(l.modulo_id=m.id)
                            where l.modulo_id = :idmodulo
                            order by l.numero asc"
                     ,['idmodulo'=>$request->idmodulo]);

    $jsonresponse=[
        'lecciones'=>$lecciones
    ];
    return response()->json($jsonresponse,200);
  }

  //guardar un nuevo modulo de un curso
  public function guardar(Request $request){
    $user   =Auth::user();
    $validator =Validator::make($request->all(),[
      'numero' =>'required',
      'modulo' =>'required|integer',
      'nombre' =>'required|string'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->messages(),
        ], 400);
    }

    DB::beginTransaction();
    try{
      DB::table('lecciones')->insert([
        'modulo_id'=>$request->modulo,
        'numero'=>$request->numero,
        'nombre'=>$request->nombre,
        'descripcion'=>$request->descripcion,
        'tiempolectura'=>$request->tiempolectura,
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
        Log::info('creacion leccion : '.$e->getMessage());
        DB::rollback();
        //$e->getMessage();

        return response()->json([
            'error' =>'Hubo una inconsistencias al intentar crear el registro.'.$e->getMessage()
        ], 400);
    }
  }

  //datos de edicion de un modulo
  public function editar(Request $request){
    $select_mod  =DB::select("select m.id,m.nombre
                              from modulos m
                              where curso_id = :idcurso"
                            ,['idcurso'=>$request->idcurso]);

    $leccion   =DB::select("select
                            id,nombre,numero,descripcion,tiempolectura,modulo_id as modulo
                            from lecciones
                            where id = :id",
                          ['id'=>$request->id])[0];
    $jsonresponse=[
        'leccion'=>$leccion,
        'select_mod'=>$select_mod
    ];
    return response()->json($jsonresponse,200);

  }

  public function actualizar(Request $request){
    $user   =Auth::user();
    $validator =Validator::make($request->all(),[
      'numero' =>'required',
      'modulo' =>'required|integer',
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
        'modulo_id'=>$request->modulo,
        'numero'=>$request->numero,
        'nombre'=>$request->nombre,
        'descripcion'=>$request->descripcion,
        'tiempolectura'=>$request->tiempolectura,
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
            'error' =>'Hubo una inconsistencias al intentar actualizar el registro'
        ], 400);
    }
  }
}
