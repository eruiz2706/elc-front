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
    $progreso   =DB::select("select m.id,m.numero,m.nombre,count(l.id) as cantlec,count(lu.id) as cantlec_leidas
                              from modulos m
                              left join lecciones l on(m.id=l.modulo_id)
                              left join lecciones_user lu on(l.id=lu.leccion_id and lu.user_id= :user_id)
                              where m.curso_id = :curso_id
                              group by m.id,m.nombre,m.numero
                              order by m.numero  asc",
                          ['curso_id'=>$request->idcurso,'user_id'=>$user->id]);

    foreach($progreso as $prog){
      $lecciones=DB::select("select
                              l.id,l.nombre,l.numero,l.descripcion,l.tiempolectura,case when lu.id is not null then true else false end as leido
                              from lecciones l
                              left join lecciones_user lu on(l.id=lu.leccion_id and lu.user_id= :user_id)
                              where l.modulo_id = :modulo_id
                              order by l.numero asc"
                         ,['modulo_id'=>$prog->id,'user_id'=>$user->id]);
      $prog->lecciones=$lecciones;
    }

    $jsonresponse=[
        'progreso'=>$progreso
    ];
    return response()->json($jsonresponse,200);
  }

  public function lista_pr(Request $request){
    $user       =Auth::user();

    $resultUser     =DB::select("select count(id) as cant
                                from cursos_user
                                where curso_id= :curso_id and slugrol='es'",
                        ['curso_id'=>$request->idcurso]);


    $cantUser =0;
    if(!empty($resultUser))$cantUser    =$resultUser[0]->cant;

    $progreso   =DB::select("select m.id,m.numero,m.nombre,count(l.id) as cant_lecc
                              from modulos m
                              left join lecciones l on(m.id=l.modulo_id)
                              where m.curso_id = :curso_id
                              group by m.id,m.numero,m.nombre
                              order by m.numero  asc",
                          ['curso_id'=>$request->idcurso]);

    foreach($progreso as $prog){
      $cantleccuser=0;
      $lecc_user=DB::select("select count(user_id) as cant
                                    from(
                                      select lu.user_id
                                        from lecciones_user lu
                                        left join lecciones l on(l.id=lu.leccion_id)
                                        where l.modulo_id = :modulo_id
                                        group by lu.user_id
                                        having count(lu.id)>= :count_lecc
                                    ) as g",
                                    ['modulo_id'=>$prog->id,'count_lecc'=>$prog->cant_lecc]);
      if(!empty($lecc_user))$cantleccuser=$lecc_user[0]->cant;

      $lecciones=DB::select("select
                              l.id,l.nombre,l.numero,l.descripcion,l.tiempolectura
                              from lecciones l
                              where l.modulo_id = :modulo_id
                              order by l.numero asc"
                         ,['modulo_id'=>$prog->id]);
      $prog->lecciones=$lecciones;
      $prog->cant_leccuser=$cantleccuser;
      $prog->cant_user=$cantUser;
    }

    $jsonresponse=[
        'progreso'=>$progreso,
    ];
    return response()->json($jsonresponse,200);
  }

 /*lista el estado de lecciones de un modulo, de los usuario del curso*/
  public function lista_progreso_modulo(Request $request){
      $user       =Auth::user();

      $lecciones     =DB::select("select count(id) as cant
                                  from lecciones
                                  where modulo_id= :modulo_id ",
                          ['modulo_id'=>$request->idmodulo]);


      $cantlecc =0;
      if(!empty($lecciones))$cantlecc    =$lecciones[0]->cant;

      $progmod   =DB::select("select
                                cu.user_id,u.nombre,u.imagen
                                from cursos_user cu
                                left join users u on(cu.user_id=u.id)
                                where cu.curso_id=:curso_id and slugrol='es'",
                            ['curso_id'=>$request->idcurso]);

      foreach($progmod as $prog){
        $cantleccuser=0;
        $lecc_user=DB::select("select count(lu.user_id) as cant
                                  from lecciones_user lu
                                  left join lecciones l on(l.id=lu.leccion_id)
                                  where l.modulo_id = :modulo_id and lu.user_id = :user_id",
                                 ['modulo_id'=>$request->idmodulo,'user_id'=>$prog->user_id]);
        if(!empty($lecc_user))$cantleccuser=$lecc_user[0]->cant;

        $prog->cantlecc=$cantlecc;
        $prog->cantleccuser=$cantleccuser;
      }

      $jsonresponse=[
          'progmod'=>$progmod
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
