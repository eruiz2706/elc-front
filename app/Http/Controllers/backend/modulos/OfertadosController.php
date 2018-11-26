<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;


class OfertadosController extends Controller
{
    public function index(Request $request){
      $rol  =Session::get('rol');
      if($rol !='es'){
        return view('layouts.errors.access_denied');
      }
      return view('backend.modulos.ofertados.viewlist_es');
    }

    public function verCurso(Request $request,$id){
      $rol  =Session::get('rol');
      if($rol !='es'){
        return view('layouts.errors.access_denied');
      }
      $idcurso=$id;
      return view('backend.modulos.ofertados.viewdet_es',compact('idcurso'));

    }

    public function listacursos(Request $request){
      $id       =Auth::user()->id;
      $cursos   =DB::select("select
                              c.id,c.nombre,c.imagen,e.nombre as nombestado
                              from cursos c
                              left join estados e on(c.estado=e.slug and e.tipo='cursos')
                              where visibilidad=true
                              ");
      $jsonresponse=[
          'cursos'=>$cursos
      ];
      return response()->json($jsonresponse,200);
    }

    public function edit_curso($id){
      $user     =Auth::user();
      $subscrip =false;
      $validasub=DB::select("select curso_id
                            from cursos_user
                            where user_id = :user_id and curso_id = :curso_id",
                            ['user_id'=>$user->id,'curso_id'=>$id]);

      if(!empty($validasub)){
        $validasub=$validasub[0];
        $subscrip =($validasub->curso_id==$id) ? true : false;
      }

      $curso   =DB::select("select
                              c.id,c.nombre,c.imagen,c.plan_estudio,c.urlvideo,c.estado,
                              c.fecha_inicio,c.fecha_finalizacion,u.imagen as img_usercrea
                              from cursos c
                              left join users u on(c.user_id=u.id)
                              where c.visibilidad=true and c.id = :id",['id'=>$id])[0];
      $jsonresponse=[
          'curso'=>$curso,
          'subscrip'=>$subscrip
      ];
      return response()->json($jsonresponse,200);
    }

    public function suscripcion(Request $request){
      $rol  =Session::get('rol');
      $id     =Auth::user()->id;

      if ($request->idcurso=='') {
          return response()->json([
              'error' =>'No existe un id de curso a suscribir',
          ], 400);
      }

      ############guardar datos ########
      DB::beginTransaction();
      try{
        DB::table('cursos_user')->insert([
          'user_id'=>$id,
          'curso_id'=>$request->idcurso,
          'slugrol'=>$rol,
          'fecha_creacion'=>date('Y-m-d H:i:s')
        ]);

        DB::commit();

        $cursos  =DB::select("select
                              c.id,c.nombre
                              from cursos_user cu
                              left join cursos c on(cu.curso_id=c.id)
                              where cu.user_id = :user_id
                              order by cu.fecha_creacion desc"
                         ,['user_id'=>$id]);
        Session::put('navcursos',$cursos);

        return response()->json([
            'message' => 'Tu subscripcion se realizo correctamente!',
            'message2' => 'Click para continuar!'
        ]);
      }
      catch(\Exception $e){
          Log::info('suscripcion curso : '.$e->getMessage());
          DB::rollback();
          //$e->getMessage();

          return response()->json([
              'error' =>'Hubo una inconsistencias al intentar realizar el proceso'
          ], 400);
      }
    }
}
