<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Log;

class IntegrantesController extends Controller
{
   ############################## METODOS ##############################
   //listado de integrantes de un curso
   public function lista(Request $request){
     $user   =Auth::user();
     $integrantes   =DB::select("select u.id as iduser,u.nombre,r.name as perfil,u.imagen,u.fecha_ultimo_ingreso,
                                round(extract(epoch from age(u.fecha_ultimo_uso,u.fecha_ultimo_ingreso))/60) as tiempouso,
                                0 as mensajeschat
                             from cursos_user cu
                             left join users u on(cu.user_id=u.id)
                             left join role_user ru on(ru.user_id=u.id)
                             left join roles r on(ru.role_id=r.id)
                             where curso_id = :curso_id and cu.user_id <> :user_id
                             order by r.name desc",
                           ['curso_id'=>$request->idcurso,'user_id'=>$user->id]);

     /*foreach($integrantes as $integ){
       $chat     =DB::select("select id,emisor,receptor,pendiente_emisor,pendiente_receptor
                               from chatprivado
                               where (emisor=:user1 and receptor=:user2) or (emisor=:user2 and receptor=:user1)",
                             ['user1'=>$user->id,'user2'=>$integ->iduser]);

       if(!empty($chat)){
         $emisor            =$chat[0]->emisor;
         $receptor          =$chat[0]->receptor;
         $pendiente_emisor  =$chat[0]->pendiente_emisor;
         $pendiente_receptor=$chat[0]->pendiente_receptor;

         if($emisor==$integ->iduser){
            $integ->mensajeschat=$pendiente_emisor;
         }
         if($receptor==$integ->iduser){
            $integ->mensajeschat=$pendiente_receptor;
         }
       }else{
         $integ->mensajeschat=0;
       }


     }*/

     $jsonresponse=[
         'integrantes'=>$integrantes,
         'slugrol'=>$user->slugrol
     ];
     return response()->json($jsonresponse,200);
   }




}
