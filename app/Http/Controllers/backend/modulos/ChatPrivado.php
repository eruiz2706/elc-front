<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Log;

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

      DB::table('chatprivado')->where('id',$idchat)->where('emisor',$user2)->update([
        'pendiente_emisor'=>0,
      ]);
      DB::table('chatprivado')->where('id',$idchat)->where('receptor',$user2)->update([
        'pendiente_receptor'=>0,
      ]);
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

      $nombre_curso=DB::select("select nombre
                                from cursos
                                where id= :curso_id",['curso_id'=>$request->idcurso])[0]->nombre;

      /*actualiza solo el registro que corresponda, si es emisor o receptor el que envia el mensaje*/
      DB::table('chatprivado')->where('id',$request->idchat)->where('emisor',$user->id)->update([
        'pendiente_emisor'=>1,
        'fecha_emisor'=>$fecha_creacion,
        'descripcion_emisor'=>$nombre_curso
      ]);
      DB::table('chatprivado')->where('id',$request->idchat)->where('receptor',$user->id)->update([
        'pendiente_receptor'=>1,
        'fecha_receptor'=>$fecha_creacion,
        'descripcion_receptor'=>$nombre_curso
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
            'error' =>$request->idcurso
        ], 400);
    }
  }

  public function leido(Request $request){
    $user  =Auth::user();


    DB::beginTransaction();
    try{
      $chat     =DB::select("select emisor,receptor
                            from chatprivado
                            where id= :id",
                          ['id'=>$request->idchat]);

      if(!empty($chat)){
        $emisor   =$chat[0]->emisor;
        $receptor =$chat[0]->receptor;
        $userupd  =($user->id==$emisor) ? $receptor : $emisor;

        /*actualiza solo el registro que corresponda, si es emisor o receptor el que envia el mensaje*/
        DB::table('chatprivado')->where('id',$request->idchat)->where('emisor',$userupd)->update([
          'pendiente_emisor'=>0,
        ]);
        DB::table('chatprivado')->where('id',$request->idchat)->where('receptor',$userupd)->update([
          'pendiente_receptor'=>0,
        ]);
      }

      DB::commit();
      return response()->json([
          'leido' =>'OK',
          'id'=>''
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
