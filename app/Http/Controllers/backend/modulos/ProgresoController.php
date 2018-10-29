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
    if($rol !='pr'){
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
    return view('backend.modulos.progreso.view_list',compact('curso','tab_prog'));
  }
}
