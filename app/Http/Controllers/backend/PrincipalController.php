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
      Session::put('rol','');
      Session::put('user_tiempo','0');
      $user =Auth::user();

      //se consulta el rol al que esta asociado el usuario
      $rol  =DB::select("select r.slug
                          from roles r
                          left join role_user ru on(r.id=ru.role_id)
                          where user_id = :user_id"
                       ,['user_id'=>$user->id]);
      if(!empty($rol)){
        $rol  =$rol[0];
        Session::put('rol',$rol->slug);

        if($rol->slug !=''){
          return redirect('foro');
        }
      }

      return redirect()->to('/noaccess');
    }

    function config(){
      $user =Auth::user();
      $rol  =Session::get('rol');

      $nav_user=[];
      $nav_cursos=[];
      $tit_cursos='';
      $nav_options=[];
      $tit_options='';
      if($rol=='ad'){
        $nav_user[]=['icono'=>'fa fa-inbox','nombre'=>'Ultimas noticias','url'=>'foro'];
        $nav_user[]=['icono'=>'fa fa-book','nombre'=>'Manual de uso','url'=>'principal/manualuso'];

        $tit_options='Administracion';
        $nav_options[]=['nombre'=>'Lista de usuarios','url'=>'usuarios'];
        //$nav_options[]=['nombre'=>'Informacion de contacto','url'=>'contactos'];
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
      }

      if($rol=='pa'){
        $nav_user[]=['icono'=>'fa fa-inbox','nombre'=>'Ultimas noticias','url'=>'foro'];
        $nav_user[]=['icono'=>'fa fa-book','nombre'=>'Manual de uso','url'=>'principal/manualuso'];
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
          ]
      ];
      return response()->json($jsonresponse,200);
    }

    function conexion(){
      $user   =Auth::user();
      $jsonresponse=[
          'conexion_user'=>[
            'nombre'=>$user->nombre,
            'ultimo_ingreso'=>'Ultimo ingreso: '.$user->fecha_ultimo_ingreso,
            'tiempo_uso'=>'Tiempo de uso: '.Session::get('user_tiempo').' minutos'
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
      $rol      =Session::get('rol');
      $user      =Auth::user();
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
