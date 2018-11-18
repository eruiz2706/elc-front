<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Log;
use Session;

class IntegrantesController extends Controller
{
  ############################## VISTAS ##############################
  //lista de modulos de un curso
  function view_lista($idcurso){
    $tab_integ='';
    $user   =Auth::user();
    $rol    =Session::get('rol');
    if($rol==''){
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
     return view('backend.modulos.integrantes.view_list',compact('curso','tab_integ'));
   }


   ############################## METODOS ##############################
   //listado de integrantes de un curso
   public function lista(Request $request){
     $integrantes   =DB::select("select u.nombre,r.name as perfil,u.imagen,u.fecha_ultimo_ingreso,
                                round(extract(epoch from age(u.fecha_ultimo_uso,u.fecha_ultimo_ingreso))/60) as tiempouso
                             from cursos_user cu
                             left join users u on(cu.user_id=u.id)
                             left join role_user ru on(ru.user_id=u.id)
                             left join roles r on(ru.role_id=r.id)
                             where curso_id = :curso_id
                             order by r.name desc",
                           ['curso_id'=>$request->idcurso]);
     $jsonresponse=[
         'integrantes'=>$integrantes
     ];
     return response()->json($jsonresponse,200);
   }




}
