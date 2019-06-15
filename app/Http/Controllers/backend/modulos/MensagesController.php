<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Log;


class MensagesController extends Controller
{
  public function conteo(Request $request){
    $user             =Auth::user();
    $mensajes   =DB::select("select sum(conteo) as conteo
                                    from(
                                      select sum(pendiente_receptor)  as conteo
                                        from chatprivado
                                        where emisor=:user_id
                                      union
                                      select sum(pendiente_emisor) as conteo
                                        from chatprivado
                                        where receptor=:user_id
                                    ) as c",
                          ['user_id'=>$user->id])[0];
    $jsonresponse=[
        'conteo'=>$mensajes->conteo
    ];
    return response()->json($jsonresponse,200);
  }
  public function lista(Request $request){
    $user             =Auth::user();
    $mensajes   =DB::select("select u.nombre,u.imagen,fecha,descrip,pendiente
                                    from(
                                      select receptor as remitente,
                                        fecha_receptor as fecha,
                                        descripcion_receptor as descrip,
                                        pendiente_receptor as pendiente
                                        from chatprivado
                                        where emisor=:user_id
                                      union
                                      select emisor as remitente,
                                        fecha_emisor as fecha,
                                        descripcion_emisor as descrip,
                                        pendiente_emisor as pendiente
                                        from chatprivado
                                        where receptor=:user_id
                                    ) as c
                                    left join users u on(c.remitente=u.id)
                                    order by fecha desc
                                    limit 50",
                          ['user_id'=>$user->id]);

      DB::table('chatprivado')->where('pendiente_receptor',1)->where('emisor',$user->id)->update([
        'pendiente_receptor'=>0,
      ]);
      DB::table('chatprivado')->where('pendiente_emisor',1)->where('receptor',$user->id)->update([
        'pendiente_emisor'=>0,
      ]);

    $jsonresponse=[
        'mensajes'=>$mensajes
    ];
    return response()->json($jsonresponse,200);
  }
}
