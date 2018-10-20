<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use DB;
use Session;
use Validator;
use Log;

class CursosController extends Controller
{
  ############################## VISTAS ##############################
  //vista para vializar listado de cursos
  public function view_list(){
    $rol  =Session::get('rol');
    if($rol !='in'){
      return "no pertenece a ningun rol redireccionar";
    }
    return view('backend.modulos.cursos.view_list');
  }

  //vista para crear un nuevo curso
  public function view_crear(){
    $rol  =Session::get('rol');
    if($rol !='in'){
      return  "no pertenece a ningun rol redireccionar";
    }
    return view('backend.modulos.cursos.view_crear');
  }

  //vista edicion curso
  public function view_editar($id){
      $rol  =Session::get('rol');
      if($rol !='in'){
        return "no pertenece a ningun rol redireccionar";
      }
      return view('backend.modulos.cursos.view_edit',compact('id'));
  }

  //vista para datos de configuracion de curso
  public function view_config($id){
    $user =Auth::user();
    $rol  =Session::get('rol');
    if($rol !='in'){
      return  "no pertenece a ningun rol redireccionar";
    }

    $curso  =DB::select("select c.id,c.nombre,u.imagen as imagenprof
                          from cursos c
                          left join users u on(c.user_id=u.id)
                          where c.id= :id and user_id = :user_id"
                     ,['id'=>$id,'user_id'=>$user->id]);

    if(empty($curso)){
      return "no existe el curso";
    }
    $curso    =$curso[0];
    $tab_conf ='';
    return view('backend.modulos.cursos.view_config',compact('curso','tab_conf'));
  }


  ############################## METODOS ##############################
  //retorna los cursos
  public function lista(Request $request){
    $user     =Auth::user();
    $cursos   =DB::select("select
                            id,nombre
                            from cursos
                            where user_id = :user_id
                            order by fecha_inicio desc",
                          ['user_id'=>$user->id]);
    $jsonresponse=[
        'cursos'=>$cursos
    ];
    return response()->json($jsonresponse,200);
  }

  //guardar un nuevo curso
  public function guardar(Request $request){
    $id     =Auth::user()->id;

    $validator =Validator::make($request->all(),[
      'nombre' =>'required|string',
      'fecha_inicio' =>'required',
      'fecha_finalizacion' =>'required'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->messages(),
        ], 400);
    }

    //guardar datos
    DB::beginTransaction();
    try{
      DB::table('cursos')->insert([
        'user_id'=>$id,
        'nombre'=>$request->nombre,
        'fecha_inicio'=>$request->fecha_inicio,
        'fecha_finalizacion'=>$request->fecha_finalizacion,
        'visibilidad'=>$request->visibilidad,
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

  //datos de edicion de un curso
  public function editar($id){
    $curso   =DB::select("select
                            id,nombre,fecha_inicio,fecha_finalizacion,visibilidad
                            from cursos
                            where id = :id",
                          ['id'=>$id])[0];
    $jsonresponse=[
        'curso'=>$curso
    ];
    return response()->json($jsonresponse,200);
  }

  //actualizar datos curso
  public function actualizar(Request $request){
    $validator =Validator::make($request->all(),[
      'nombre' =>'required|string',
      'fecha_inicio' =>'required',
      'fecha_finalizacion' =>'required'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->messages(),
        ], 400);
    }

    //guardar datos
    DB::beginTransaction();
    try{
      DB::table('cursos')->where('id',$request->id)->update([
        'nombre'=>$request->nombre,
        'fecha_inicio'=>$request->fecha_inicio,
        'fecha_finalizacion'=>$request->fecha_finalizacion,
        'visibilidad'=>$request->visibilidad
      ]);

      DB::commit();
      return response()->json([
          'message' => 'Registro actualizado correctamente!',
          'message2' => 'Click para continuar!'
      ]);
    }
    catch(\Exception $e){
        Log::info('actualizacion curso : '.$e->getMessage());
        DB::rollback();
        //$e->getMessage();

        return response()->json([
            'error' =>'Hubo una inconsistencias al intentar actualizacion el registro'
        ], 400);
    }
  }

  //metodo que redirige a un curso en especifico
  public function abrir($id){
    $rol  =Session::get('rol');

    if($rol =='in'){
      return redirect('cursos/v_config/'.$id);
    }
    return redirect('foroc/'.$id);
  }

  public function edit_config($id){
    $user     =Auth::user();
    $curso  =DB::select("select c.id,urlvideo,plan_estudio,imagen
                          from cursos c
                          where c.id= :id and user_id = :user_id"
                     ,['id'=>$id,'user_id'=>$user->id])[0];

    $jsonresponse=[
        'curso'=>$curso
    ];
    return response()->json($jsonresponse,200);

  }

  public function upd_configplan(Request $request,$id){
    DB::beginTransaction();
    try{
      DB::table('cursos')->where('id',$id)->update([
        'plan_estudio'=>$request->plan_estudio
      ]);

      DB::commit();
      return response()->json([
          'message' => 'Registro actualizado correctamente!',
          'message2' => 'Click para continuar!'
      ]);
    }
    catch(\Exception $e){
        Log::info('actualizacion curso : '.$e->getMessage());
        DB::rollback();
        //$e->getMessage();

        return response()->json([
            'error' =>'Hubo una inconsistencias al intentar actualizacion el registro'
        ], 400);
    }
  }

  public function upd_configvideo(Request $request,$id){
    DB::beginTransaction();
    try{
      DB::table('cursos')->where('id',$id)->update([
        'urlvideo'=>$request->urlvideo
      ]);

      DB::commit();
      return response()->json([
          'message' => 'Registro actualizado correctamente!',
          'message2' => 'Click para continuar!'
      ]);
    }
    catch(\Exception $e){
        Log::info('actualizacion curso : '.$e->getMessage());
        DB::rollback();
        //$e->getMessage();

        return response()->json([
            'error' =>'Hubo una inconsistencias al intentar actualizacion el registro'
        ], 400);
    }
  }

  public function upd_configlogo(Request $request,$id){

    if($request->file('avatar') != null){
      $file   =$request->file('avatar');
      $nombre =Auth::user()->uniqid.'.'.$file->getClientOriginalExtension();

      $responseImg  =Storage::disk('public_cursos')->put($nombre,  \File::get($file));
      if($responseImg){
          DB::table('cursos')->where('id',$id)->update([
            'imagen' =>'img/cursos/'.$nombre
          ]);

         $jsonresponse=[
             'message'=>'Se cargo la imagen correctamente',
             'message2' => 'Click para continuar!'
         ];
         return response()->json($jsonresponse,200);
       }else{
         $jsonresponse=[
             'error' =>'Hubo un inconveniente al cargar la imagen'
         ];
         return response()->json($jsonresponse,400);
       }
    }

  }
}
