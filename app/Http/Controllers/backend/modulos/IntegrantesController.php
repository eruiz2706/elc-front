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

   public function agregar(Request $request){
    $id    =Auth::user()->id;
    $email =$request->email_integrante;
    $idcurso=$request->idcurso;

    $validator =Validator::make($request->all(),[
      'email_integrante' =>'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json([
            //'errors' => $validator->messages(),
            'error' => 'Email obligatorio',
        ], 400);
    }

    $existeEstudiante   =DB::select("select id
                            from users
                            where email =:email and slugrol='es'",
                        ['email'=>$email]);

    if(empty($existeEstudiante)){
        return response()->json([
          'error' => 'No existe el email para un perfil estudiante',
        ], 400);
    }else{
      $curso_user   =DB::select("select count(id) as count
                              from cursos_user
                              where user_id=:user_id and curso_id=:curso_id",
                          ['curso_id'=>$idcurso,'user_id'=>$existeEstudiante[0]->id]);

      if($curso_user[0]->count>0){
        return response()->json([
          'error' => 'El estudiante ya se encuentra registrado al curso',
        ], 400);
      }

    }
    
    DB::beginTransaction();
    try{

      DB::table('cursos_user')->insertGetId([
        'user_id'=>$existeEstudiante[0]->id,
        'curso_id'=>$idcurso,
        'fecha_creacion'=>date('Y-m-d H:i:s')
      ]);

      DB::commit();
      return response()->json([
          'message' => 'Registro creado correctamente!',
          'message2' => 'Click para continuar!'
      ]);
    }
    catch(\Exception $e){
        Log::info('creacion pariente : '.$e->getMessage());
        DB::rollback();
        //$e->getMessage();
        return response()->json([
            'error' =>'Hubo una inconsistencias al intentar crear el registro'
        ], 400);
    }
  }




}
