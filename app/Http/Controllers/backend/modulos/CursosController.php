<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
use Validator;
use Log;

class CursosController extends Controller
{
  /*vista para ver los cursos de la institucion*/
  public function index(){
    $rol  =Session::get('rol');
    if($rol !='in'){
      echo "no pertenece a ningun rol redireccionar";
    }
    return view('backend.modulos.cursos.view_list');
  }

  /*vista para crear un curso*/
  public function crear(){
    $rol  =Session::get('rol');
    if($rol !='in'){
      echo "no pertenece a ningun rol redireccionar";
    }
    return view('backend.modulos.cursos.view_crear');
  }



  /*metodo que inicializa el curso al que voy a ingresar*/
  public function abrir($id){
    $rol  =Session::get('rol');
    $curso  =DB::select("select c.id,c.nombre,u.imagen as imagenprof
                          from cursos c
                          left join users u on(c.user_id=u.id)
                          where c.id= :id"
                     ,['id'=>$id])[0];
    Session::put('o_curso',$curso);
    if($rol =='in'){
      return redirect('modulos');
    }
    return redirect('foroc');
  }

  /*guardar curso*/
  public function guardar(Request $request){
    $id     =Auth::user()->id;

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
      DB::table('cursos')->insert([
        'user_id'=>$id,
        'nombre'=>$request->nombre,
        'fecha_inicio'=>$request->fecha_inicio,
        'duracion'=>$request->duracion,
        'urlvideo'=>$request->urlvideo,
        'visibilidad'=>$request->visibilidad,
        'plan_estudio'=>$request->plan_estudio,
        'fecha_creacion'=>date('Y-m-d H:i:s')
      ]);

      DB::commit();
      return response()->json([
          'message' => 'Registro guardado correctamente!',
          'message2' => 'Click para continuar!'
      ]);
    }
    catch(\Exception $e){
        Log::info('creacion curso : '.$e->getMessage());
        DB::rollback();
        //$e->getMessage();

        return response()->json([
            'error' =>'Hubo una inconsistencias al intentar guardar el registro'
        ], 400);
    }
  }

  /*lista de cursos*/
  public function lista(Request $request){
    $id       =Auth::user()->id;
    $cursos   =DB::select("select
                            id,nombre
                            from cursos
                            where user_id = :user_id
                            order by fecha_inicio desc",
                          ['user_id'=>$id]);
    $jsonresponse=[
        'cursos'=>$cursos
    ];
    return response()->json($jsonresponse,200);
  }
}
