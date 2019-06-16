<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use DB;
use Validator;
use Log;


class UsuariosController extends Controller
{

  public function lista(Request $request){

    $filters=[];
    $where = '';
    if($request->idrol !=''){
      $filters['rol_id'] = $request->idrol;
      $where .= " and r.slug = :rol_id";
    }

    $users   =DB::select("select
                            u.id,u.email,u.nombre,u.fecha_ultimo_ingreso,u.telefono,u.ciudad,u.direccion,u.facebook,
                            u.linkedin,u.biografia,u.created_at,u.fecha_ultimo_ingreso,r.name as nombrerol
                            from users u
                            left join roles r on(u.slugrol=r.slug) 
                            where 1=1 $where
                            order by created_at desc",$filters);

    $jsonresponse=[
        'users'=>$users,
        'rol' =>  $request->idrol
    ];
    return response()->json($jsonresponse,200);
  }
}
