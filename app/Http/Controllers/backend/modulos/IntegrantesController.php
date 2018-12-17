<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Log;
use Session;

class IntegrantesController extends Controller
{
   ############################## METODOS ##############################
   //listado de integrantes de un curso
   public function lista(Request $request){
     $user   =Auth::user();
     $integrantes   =DB::select("select u.nombre,r.name as perfil,u.imagen,u.fecha_ultimo_ingreso,
                                round(extract(epoch from age(u.fecha_ultimo_uso,u.fecha_ultimo_ingreso))/60) as tiempouso
                             from cursos_user cu
                             left join users u on(cu.user_id=u.id)
                             left join role_user ru on(ru.user_id=u.id)
                             left join roles r on(ru.role_id=r.id)
                             where curso_id = :curso_id and cu.user_id <> :user_id
                             order by r.name desc",
                           ['curso_id'=>$request->idcurso,'user_id'=>$user->id]);
     $jsonresponse=[
         'integrantes'=>$integrantes
     ];
     return response()->json($jsonresponse,200);
   }




}
