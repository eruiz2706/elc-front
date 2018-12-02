<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Log;
use Session;

class ForoController extends Controller
{

    /*muestra la vista del foro*/
    function index(){
      $rol  =Session::get('rol');
      if($rol==''){
        return view('layouts.errors.access_denied');
      }

      return view('backend.modulos.foro.view_list');
    }

    /*trae el listado de los ultimos 20 foros publicados*/
    public function getData(Request $request){
      $foros   =DB::select("select
                              f.id,u.nombre as nombreuser,u.imagen as imagenuser,f.descripcion,f.fecha_creacion,f.comentarios,r.slug as role
                              from foros f
                              left join users u on(f.user_id=u.id)
                              left join role_user ru on(u.id=ru.user_id)
                              left join roles r on(ru.role_id=r.id)
                              order by fecha_creacion desc
                              limit 20
                              ");
      $jsonresponse=[
          'foros'=>$foros
      ];
      return response()->json($jsonresponse,200);
    }

    /*metodo para agregar nueva publicacion*/
    public function publicacion(Request $request){
      $id     =Auth::user()->id;

      $validator =Validator::make($request->all(),[
        'comentario' =>'required|string'
      ]);

      if ($validator->fails()) {
          return response()->json([
              'errors' => $validator->messages(),
          ], 400);
      }

      ############guardar datos ########
      DB::beginTransaction();
      try{
        DB::table('foros')->insert([
          'user_id'=>$id,
          'fecha_creacion'=>date('Y-m-d H:i:s'),
          'descripcion'=>$request->comentario
          //'descripcion'=>nl2br($request->comentario)
        ]);

        DB::commit();
        return response()->json([
            'message' => 'Publicacion correcta!',
            'message2' => 'Click para continuar!'
        ]);
      }
      catch(\Exception $e){
          Log::info('publicacion foro : '.$e->getMessage());
          DB::rollback();
          //$e->getMessage();

          return response()->json([
              'error' =>'Hubo una inconsistencias al intentar cargar la publicacion'
          ], 400);
      }
    }

    /*metodo para traer los comentarios de un foro*/
    public function getComentarios(Request $request){
      $comentarios   =DB::select("select
                                    descripcion,fecha_creacion,u.imagen,u.nombre,r.slug as role
                                    from comentarios_foro cf
                                    left join users u on(cf.user_id=u.id)
                                    left join role_user ru on(u.id=ru.user_id)
                                    left join roles r on(ru.role_id=r.id)
                                    where foro_id= :foro_id
                                    order by cf.fecha_creacion desc
                              ",['foro_id'=>$request->idforo]);
      $jsonresponse=[
          'comentarios'=>$comentarios
      ];
      return response()->json($jsonresponse,200);
    }

    /*agregar comentarios a un foro*/
    public function agregarComentario(Request $request){
      $validator =Validator::make($request->all(),[
        'comentario' =>'required|string'
      ]);

      if ($validator->fails()) {
          return response()->json([
              'errors' => $validator->messages(),
          ], 400);
      }

      $id     =Auth::user()->id;
      DB::beginTransaction();
      try{
        $foro =DB::select("select comentarios
                                      from foros
                                      where id = :id"
                         ,['id'=>$request->idforo])[0];

        DB::table('foros')->where('id',$request->idforo)->update([
          'comentarios' =>$foro->comentarios+1
        ]);

        DB::table('comentarios_foro')->insert([
          'foro_id'=>$request->idforo,
          'user_id'=>$id,
          'fecha_creacion'=>date('Y-m-d H:i:s'),
          'descripcion'=>nl2br($request->comentario)
        ]);

        DB::commit();
        return response()->json([
            'message' => 'Publicacion correcta!',
            'message2' => 'Click para continuar!',
            'contcoment'=>$foro->comentarios+1
        ]);
      }
      catch(\Exception $e){
          Log::info('publicacion foro : '.$e->getMessage());
          DB::rollback();
          //$e->getMessage();

          return response()->json([
              'error' =>'Hubo una inconsistencias al intentar guardar el comentario'.$numcomentarios
          ], 400);
      }
    }
}
