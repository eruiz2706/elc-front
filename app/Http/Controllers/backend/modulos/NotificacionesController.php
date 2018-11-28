<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Log;
use Session;

class NotificacionesController extends Controller
{
  public function conteo(Request $request){
    $user             =Auth::user();
    $notificaciones   =DB::select("select count(id) as conteo
                            from notificaciones
                            where user_id= :user_id and estado=0",
                          ['user_id'=>$user->id])[0];
    $jsonresponse=[
        'conteo'=>$notificaciones->conteo
    ];
    return response()->json($jsonresponse,200);
  }
}
