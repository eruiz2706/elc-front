<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Log;
use Session;

class ForoCursoController extends Controller
{
  public function index(){
    $rol  =Session::get('rol');
    if($rol=='ad'){
        //return view('backend.modulos.foro.view_ad');
    }else if($rol=='in'){
        return view('backend.modulos.forocurso.view_in');
    }else if($rol=='pr'){
      return view('backend.modulos.forocurso.view_pr');
    }else if($rol=='es'){
      return view('backend.modulos.forocurso.view_es');
    }else{
      echo "no pertenece a ningun rol redireccionar";
    }
  }

  /*trae el listado de las ultimas 30 publicacion*/
  public function getData(Request $request){
    $idcurso =Session::get('o_curso')->id;
    $foros   =DB::select("select
                            f.id,u.nombre as nombreuser,u.imagen as imagenuser,f.descripcion,f.fecha_creacion,f.comentarios
                            from forocurso f
                            left join users u on(f.user_id=u.id)
                            where curso_id = :curso_id
                            order by fecha_creacion desc
                            limit 30",
                          ['curso_id'=>$idcurso]);
    $jsonresponse=[
        'foros'=>$foros
    ];
    return response()->json($jsonresponse,200);
  }

  /*metodo para agregar nueva publicacion*/
  public function publicacion(Request $request){
    $idcurso =Session::get('o_curso')->id;
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
      DB::table('forocurso')->insert([
        'curso_id'=>$idcurso,
        'user_id'=>$id,
        'fecha_creacion'=>date('Y-m-d H:i:s'),
        'descripcion'=>nl2br($request->comentario)
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
                                  descripcion,fecha_creacion,u.imagen,u.nombre
                                  from comentarios_forocurso cf
                                  left join users u on(cf.user_id=u.id)
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
                                    from forocurso
                                    where id = :id"
                       ,['id'=>$request->idforo])[0];

      DB::table('forocurso')->where('id',$request->idforo)->update([
        'comentarios' =>$foro->comentarios+1
      ]);

      DB::table('comentarios_forocurso')->insert([
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
