<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;

class PrincipalController extends Controller
{

    function indexpa(){
      return view('backend/modulos/manual/view_padres');
    }

    function index(){
      $user =Auth::user();
      if($user->slugrol !=''){
        return redirect('foro');
      }
      return redirect()->to('/noaccess');
    }

    function config(){
      $user =Auth::user();
      $rol  =$user->slugrol;

      $nav_user=[];
      $nav_cursos=[];
      $tit_cursos='';
      $nav_options=[];
      $tit_options='';
      $nav_pariente=[];

      if($rol=='ad'){
        $nav_user[]=['icono'=>'fa fa-inbox','nombre'=>'Ultimas noticias','url'=>'foro'];
        $nav_user[]=['icono'=>'fa fa-book','nombre'=>'Manual de uso','url'=>'principal/manualuso'];

        $tit_options='Administraciòn';
        $nav_options[]=['nombre'=>'Administraciòn','url'=>'administracion'];
        $nav_options[]=['nombre'=>'Chat Soporte','url'=>'https://www.smartsupp.com/app/sign/in','extern'=>'1'];
      }
      if($rol=='in'){
        $nav_user[]=['icono'=>'fa fa-inbox','nombre'=>'Ultimas noticias','url'=>'foro'];
        $nav_user[]=['icono'=>'fa fa-book','nombre'=>'Manual de uso','url'=>'principal/manualuso'];

        $tit_options='Administracion';
        $nav_options[]=['nombre'=>'Lista de cursos','url'=>'cursos'];
      }
      if($rol=='pr'){
        $tit_cursos='Cursos Profesor';
        $nav_cursos  =DB::select("select c.id,c.nombre
                                    from cursos_user cu
                                    left join cursos c on(cu.curso_id=c.id)
                                    where cu.user_id = :user_id
                                    order by cu.fecha_creacion desc"
                                    ,['user_id'=>$user->id]);

        $nav_user[]=['icono'=>'fa fa-inbox','nombre'=>'Ultimas noticias','url'=>'foro'];
        $nav_user[]=['icono'=>'fa fa-book','nombre'=>'Manual de uso','url'=>'principal/manualuso'];
      }
      if($rol=='es'){
        $tit_cursos='Cursos Estudiante';
        $nav_cursos  =DB::select("select c.id,c.nombre
                                    from cursos_user cu
                                    left join cursos c on(cu.curso_id=c.id)
                                    where cu.user_id = :user_id
                                    order by cu.fecha_creacion desc"
                                    ,['user_id'=>$user->id]);
        $nav_user[]=['icono'=>'fa fa-inbox','nombre'=>'Ultimas noticias','url'=>'foro'];
        $nav_user[]=['icono'=>'fa fa-book','nombre'=>'Manual de uso','url'=>'principal/manualuso'];
        $nav_user[]=['icono'=>'fa fa-plus-square-o','nombre'=>'Ofertas  de cursos','url'=>'ofertados'];

        $pagos=DB::select("select sum(valor) as pagos
                                  from pagos
                                  where user_id= :user_id",['user_id'=>$user->id])[0]->pagos;

        if($pagos>0){
            $nav_user[]=['icono'=>'nav-icon fa fa-th','nombre'=>'Herramientas','url'=>'herramientas','optionnew'=>1,'nombreopt'=>'Nuevo'];
        }
      }

      if($rol=='pa'){
        $nav_user[]=['icono'=>'fa fa-inbox','nombre'=>'Ultimas noticias','url'=>'foro'];
        $nav_user[]=['icono'=>'fa fa-book','nombre'=>'Manual de uso','url'=>'principal/manualuso'];

        $nav_pariente  =DB::select("select  p.id_user,u.email,u.nombre,u.imagen
                                  from parientes_user p
                                  left join users u on(p.id_user=u.id)
                                  where p.id_pariente =:id_pariente"
                                    ,['id_pariente'=>$user->id]);

        foreach($nav_pariente as $nav){
            $cursos_es  =DB::select("select c.id,c.nombre
                                      from cursos_user cu
                                      left join cursos c on(cu.curso_id=c.id)
                                      where cu.user_id = :user_id
                                      order by cu.fecha_creacion desc"
                                      ,['user_id'=>$nav->id_user]);
            $nav->cursos=$cursos_es;
        }
      }


      $jsonresponse=[
          'user'=>$user,
          'nav_user'=>$nav_user,
          'nav_cursos'=>[
              'titulo'=>$tit_cursos,
              'content'=>$nav_cursos
            ],
          'nav_options'=>[
            'titulo'=>$tit_options,
            'content'=>$nav_options
          ],
          'nav_parients'=>[
            'content'=>$nav_pariente
          ]
      ];
      return response()->json($jsonresponse,200);
    }

    function conexion(){
      $user   =Auth::user();
      $tiempo_uso=DB::select("select
                              round(extract(epoch from age(fecha_ultimo_uso,fecha_ultimo_ingreso))/60) as tiempo
                            from users
                            where id = :user_id",['user_id'=>$user->id])[0]->tiempo;
      $jsonresponse=[
          'conexion_user'=>[
            'nombre'=>$user->nombre,
            'ultimo_ingreso'=>'Ultimo ingreso: '.$user->fecha_ultimo_ingreso,
            'tiempo_uso'=>'Tiempo de uso: '.$tiempo_uso.' minutos'
          ]
      ];
      return response()->json($jsonresponse,200);
    }

    function manualuso(){
      $user     =Auth::user();

      DB::table('users')->where('id',$user->id)->update([
        'manual'=>false
      ]);
      return redirect('foro');
    }

    function abrirmanual(){
      $user      =Auth::user();
      $rol       =$user->slugrol;
      $usermanual=true;
      if($rol !='ad'){
        $manual  =DB::select("select manual as estado
                              from users
                              where id = :iduser"
                         ,['iduser'=>$user->id]);
        $usermanual=$manual[0]->estado;
      }

      $jsonresponse=[
          'usermanual'=>$usermanual
      ];
      return response()->json($jsonresponse,200);
    }

    function cerrarmanual(Request $request){
      $user     =Auth::user();
      DB::beginTransaction();
      try{
        DB::table('users')->where('id',$user->id)->update([
          'manual'=>$request->chk_manual
        ]);

        DB::commit();
        return response()->json([
            'message' => 'Cierre corecto!',
            'message2' => ''
        ]);
      }
      catch(\Exception $e){
          Log::info('actualizacion manual : '.$e->getMessage());
          DB::rollback();
          //$e->getMessage();

          return response()->json([
              'error' =>'Hubo una inconsistencias al intentar realizar la accion'
          ], 400);
      }
    }
}
