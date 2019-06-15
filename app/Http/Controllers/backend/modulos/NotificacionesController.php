<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Log;

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
  public function lista(Request $request){
    $user             =Auth::user();
    $notificaciones   =DB::select("select descripcion,fecha_creacion
                            from notificaciones
                            where user_id= :user_id order by fecha_creacion desc
                            limit 50",
                          ['user_id'=>$user->id]);

    DB::table('notificaciones')->where(['user_id'=>$user->id,'estado'=>'0'])->update([
      'estado'=>'1',
    ]);

    $jsonresponse=[
        'notificaciones'=>$notificaciones
    ];
    return response()->json($jsonresponse,200);
  }
}
