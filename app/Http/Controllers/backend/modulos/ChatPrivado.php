<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Log;
use Session;

class ChatPrivado extends Controller
{
  public function open(Request $request){
    $user =Auth::user();

    $user1    =$user->id;
    $user2    =$request->iduser;
    $idchat   =0;
    $chat     =DB::select("select id
                            from chatprivado
                            where (emisor=:user1 and receptor=:user2) or (emisor=:user2 and receptor=:user1)",
                          ['user1'=>$user1,'user2'=>$user2]);

    if(!empty($chat)){
      $idchat =$chat[0]->id;
    }else{
      $idchat=DB::table('chatprivado')->insertGetId([
           'emisor'=>$user1,
           'receptor'=>$user2,
           'fecha_creacion'=>date('Y-m-d H:i:s')
        ]);
    }

    $chat_mensajes=DB::select("select remitente,u.nombre as nomremitente,u.imagen as imgremitente,mensaje,fecha_creacion
                                from chatprivado_det c
                                left join users u on(u.id=c.remitente)
                                where chat_id=:chat_id
                                order by c.id asc
                                limit 100",
                          ['chat_id'=>$idchat]);

    $jsonresponse=[
        'idchat'=>$idchat,
        'chat_mensajes'=>$chat_mensajes
    ];
    return response()->json($jsonresponse,200);
  }

  public function responder(Request $request){
    $user  =Auth::user();
    $fecha_creacion=date('Y-m-d H:i:s');

    DB::beginTransaction();
    try{
      DB::table('chatprivado_det')->insert([
        'chat_id'=>$request->idchat,
        'remitente'=>$user->id,
        'mensaje'=>nl2br($request->mensaje_chat),
        'fecha_creacion'=>$fecha_creacion,
      ]);

      DB::commit();
      return response()->json([
          'chat_enviado' =>[
            'chat_id'=>$request->idchat,
            'remitente'=>$user->id,
            'nomremitente'=>$user->nombre,
            'imgremitente'=>$user->imagen,
            'mensaje'=>nl2br($request->mensaje_chat),
            'fecha_creacion'=>$fecha_creacion
          ],
      ]);
    }
    catch(\Exception $e){
        Log::info('publicacion chat : '.$e->getMessage());
        DB::rollback();
        //$e->getMessage();

        return response()->json([
            'error' =>'Hubo una inconsistencias al intentar enviar el mensaje'
        ], 400);
    }
  }

}
