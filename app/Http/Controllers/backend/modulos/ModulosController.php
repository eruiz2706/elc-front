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
  /*muestra la vista*/
  function index(){
    $rol  =Session::get('rol');
    if($rol=='ad'){
        //return view('backend.modulos.modulos.view_ad');
    }else if($rol=='in'){
        return view('backend.modulos.modulos.view_in');
    }else if($rol=='pr'){
      //return view('backend.modulos.foro.view_pr');
    }else if($rol=='es'){
      return view('backend.modulos.modulos.view_es');
    }else{
      echo "no pertenece a ningun rol redireccionar";
    }
  }

  /*vista para crear un modulo*/
  public function crear(){
    $rol  =Session::get('rol');
    if($rol !='in'){
      echo "no pertenece a ningun rol redireccionar";
    }
    return view('backend.modulos.modulos.viewcrear_in');
  }

  public function abrirLeccion(){

  }

  /*guardar curso*/
  public function guardar(Request $request){
    $idcurso =Session::get('o_curso')->id;

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
        'curso_id'=>$idcurso,
        'nombre'=>$request->nombre
      ]);

      DB::commit();
      return response()->json([
          'message' => 'Registro guardado correctamente!',
          'message2' => 'Click para continuar!'
      ]);
    }
    catch(\Exception $e){
        Log::info('creacion modulo : '.$e->getMessage());
        DB::rollback();
        //$e->getMessage();

        return response()->json([
            'error' =>'Hubo una inconsistencias al intentar guardar el registro'
        ], 400);
    }
  }

  /*lista de cursos*/
  public function lista(Request $request){
    $idcurso =Session::get('o_curso')->id;
    $modulos   =DB::select("select nombre
                              from modulos
                              where curso_id = :curso_id",
                          ['curso_id'=>$idcurso]);
    $jsonresponse=[
        'modulos'=>$modulos
    ];
    return response()->json($jsonresponse,200);
  }

  public function progreso(Request $request){
      $idcurso =Session::get('o_curso')->id;
      $modulos   =DB::select("select id,nombre
                                from modulos
                                where curso_id = :curso_id",
                            ['curso_id'=>$idcurso]);
      foreach($modulos as $mod){
        $lecciones=DB::select("select
                              id,nombre,descripcion
                              from lecciones
                              where modulo_id= :modulo_id"
                           ,['modulo_id'=>$mod->id]);
        $mod->lecciones=$lecciones;
      }

      $jsonresponse=[
          'modulos'=>$modulos
      ];
      return response()->json($jsonresponse,200);
  }
}
