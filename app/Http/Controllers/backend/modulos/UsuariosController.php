<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use DB;
use Session;
use Validator;
use Log;


class UsuariosController extends Controller
{
  public function index(Request $request){
    $rol  =Session::get('rol');
    if($rol !='ad'){
      return view('layouts.errors.access_denied');
    }
    return view('backend.modulos.usuarios.view_index');
  }
  public function lista(Request $request){
    $users   =DB::select("select
                            id,email,nombre,fecha_ultimo_ingreso,telefono,ciudad,direccion,facebook,
                            linkedin,biografia,created_at,fecha_ultimo_ingreso
                            from users
                            order by created_at desc");

    $jsonresponse=[
        'users'=>$users
    ];
    return response()->json($jsonresponse,200);
  }
}
