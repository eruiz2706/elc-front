<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Log;
use Session;

class ProgresoController extends Controller
{
  ############################## VISTAS ##############################
  //lista de modulos de un curso
  function view_lista($idcurso){
    $tab_prog='';
    $user   =Auth::user();
    $rol    =Session::get('rol');

    if(!in_array($rol,['es','pr'])){
      return view('layouts.errors.access_denied');
    }

    $curso  =DB::select("select c.id,c.nombre,u.imagen as imagenprof
                          from cursos c
                          left join users u on(c.user_id=u.id)
                          where c.id= :idcurso"
                     ,['idcurso'=>$idcurso]);
    if(empty($curso)){
      return view('layouts.errors.not_page');
    }

    $curso  =$curso[0];
    if($rol=='es')return view('backend.modulos.progreso.view_list',compact('curso','tab_prog'));
    if($rol=='pr')return view('backend.modulos.progreso.view_list_pr',compact('curso','tab_prog'));
  }

  ############################## METODOS ##############################
  //listado de modulos de un curso
  public function lista(Request $request){
    $user     =Auth::user();
    $progreso   =DB::select("select m.id,m.nombre,count(l.id) as cantlec,count(lu.id) as cantlec_leidas
                              from modulos m
                              left join lecciones l on(m.id=l.modulo_id)
                              left join lecciones_user lu on(l.id=lu.leccion_id and lu.user_id= :user_id)
                              where m.curso_id = :curso_id
                              group by m.id,m.nombre
                              order by m.id asc",
                          ['curso_id'=>$request->idcurso,'user_id'=>$user->id]);

    foreach($progreso as $prog){
      $lecciones=DB::select("select
                              l.id,l.nombre,l.descripcion,l.tiempolectura,case when lu.id is not null then true else false end as leido
                              from lecciones l
                              left join lecciones_user lu on(l.id=lu.leccion_id and lu.user_id= :user_id)
                              where l.modulo_id = :modulo_id
                              order by l.id asc"
                         ,['modulo_id'=>$prog->id,'user_id'=>$user->id]);
      $prog->lecciones=$lecciones;
    }

    $jsonresponse=[
        'progreso'=>$progreso
    ];
    return response()->json($jsonresponse,200);
  }

  public function guardar(Request $request){
    $user     =Auth::user();

    //guardar datos
    DB::beginTransaction();
    try{
      $idcurso=DB::table('lecciones_user')->insertGetId([
        'leccion_id'=>$request->id,
        'fecha_creacion'=>date('Y-m-d H:i:s'),
        'user_id'=>$user->id
      ]);

      DB::commit();
      return response()->json([
          'message' => 'Leccion finalizada!',
          'message2' => 'Click para continuar!'
      ]);
    }
    catch(\Exception $e){
        Log::info('creacion curso : '.$e->getMessage());
        DB::rollback();
        //$e->getMessage();
        return response()->json([
            'error' =>'Hubo una inconsistencias al intentar marcar la leccion como finalizada, intente nuevamente'
        ], 400);
    }
  }
}
