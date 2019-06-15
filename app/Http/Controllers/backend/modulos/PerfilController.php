<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Validator;
use DB;
use Log;

class PerfilController extends Controller
{
    public function index(){
      $user =Auth::user();
      $rol  =$user->slugrol;
      if($rol != ''){
        if($rol=='es')return view('backend.modulos.perfil.view_index_es');
        return view('backend.modulos.perfil.view_index');
      }else{
        return view('layouts.errors.access_denied');
      }
    }

    public function actualizarImagen(Request $request){

      if($request->file('avatar')==null){
        return response()->json([
            'error' =>'Debe seleccionar una imagen'
        ], 400);
      }

      $file   =$request->file('avatar');
      $nombre =Auth::user()->uniqid.'.'.$file->getClientOriginalExtension();
      $id     =Auth::user()->id;

      $responseImg  =Storage::disk('public_avatar')->put($nombre,  \File::get($file));
      if($responseImg){
          DB::table('users')->where('id',$id)->update([
            'imagen' =>'img/avatar/'.$nombre
          ]);

         $jsonresponse=[
             'message'=>'Se cargo la imagen correctamente',
             'message2' => 'Click para continuar!'
         ];
         return response()->json($jsonresponse,200);
       }else{
         $jsonresponse=[
             'error' =>'Hubo un inconveniente al cargar la imagen'
         ];
         return response()->json($jsonresponse,400);
       }
    }

    public function cambioClave(Request $request){
      $id     =Auth::user()->id;

      $validator =Validator::make($request->all(),[
        'password' =>'required|string|min:6',
        'repassword' =>'required|string'
      ]);

      if ($validator->fails()) {
          return response()->json([
              'errors' => $validator->messages(),
          ], 400);
      }

      if($request->input('password') != $request->input('repassword')){
          return response()->json([
              'errors' => ['password'=>['La contraseña y la confirmacion deben ser iguales']],
          ], 400);
      }

      ############actualizar datos ########
      DB::beginTransaction();
      try{
        DB::table('users')->where('id',$id)->update([
          'password' =>Hash::make($request->input('password'))
        ]);

        DB::commit();
        return response()->json([
            'message' => 'Cambio de contraseña correcto!',
            'message2' => 'Click para continuar!'
        ]);
      }
      catch(\Exception $e){
          Log::info('cambio clave usu : '.$e->getMessage());
          DB::rollback();
          //$e->getMessage();

          return response()->json([
              'error' =>'Hubo una inconsistencias al intentar actualizar la clave'
          ], 400);
      }
    }

    public function getData(Request $request){
      $id  =Auth::user()->id;
      $user   =DB::select("select nombre,email,telefono,ciudad,direccion,facebook,linkedin,biografia,imagen
                            from users
                            where id =:id",['id'=>$id])[0];

      /*$pagos   =DB::select("select valor,fecha_creacion
                              from pagos
                              where user_id =:user_id
                              order by fecha_creacion desc",['user_id'=>$id]);*/

      $jsonresponse=[
          'user'=>$user,
          //'pagos'=>$pagos
      ];
      return response()->json($jsonresponse,200);
    }

    public function actualizar(Request $request){
      $id     =Auth::user()->id;

      DB::beginTransaction();
      try{
        DB::table('users')->where('id',$id)->update([
          'nombre'=>$request->nombre,
          'telefono'=>$request->telefono,
          'ciudad'=>$request->ciudad,
          'direccion'=>$request->direccion,
          'facebook'=>$request->facebook,
          'linkedin'=>$request->linkedin,
          'biografia'=>$request->biografia
        ]);

        DB::commit();
        return response()->json([
            'message' => 'Se actualizo los cambios correctamente!',
            'message2' => 'Click para continuar!'
        ]);
      }
      catch(\Exception $e){
          Log::info('actualizacion usuario : '.$e->getMessage());
          DB::rollback();
          //$e->getMessage();

          return response()->json([
              'error' =>'Hubo una inconsistencias al intentar actualizar la informacion'
          ], 400);
      }
    }

    public function pagos(Request $request){
      $id      =Auth::user()->id;
      $pagos   =DB::select("select reference_code,nombre_curso,valor,fecha_creacion
                            from pagos
                            where user_id =:user_id
                            order by fecha_creacion desc",
                          ['user_id'=>$id]);
      $jsonresponse=[
          'pagos'=>$pagos,
      ];
      return response()->json($jsonresponse,200);
    }

    public function agregarPariente(Request $request){
      $id       =Auth::user()->id;
      $pariente =$request->email_pariente;

      $validator =Validator::make($request->all(),[
        'email_pariente' =>'required|string',
      ]);

      if ($validator->fails()) {
          return response()->json([
              //'errors' => $validator->messages(),
              'error' => 'Email pariente obligatorio',
          ], 400);
      }

      $exisparient   =DB::select("select id
                              from users
                              where email =:email and slugrol='pa'",
                          ['email'=>$pariente]);

      if(empty($exisparient)){
          return response()->json([
            'error' => 'No existe el email para un perfil pariente',
          ], 400);
      }else{
        $pariente_user   =DB::select("select count(*) as count
                                from parientes_user
                                where id_user=:id_user and id_pariente=:id_pariente",
                            ['id_user'=>$id,'id_pariente'=>$exisparient[0]->id]);

        if($pariente_user[0]->count>0){
          return response()->json([
            'error' => 'Ya se encuentra registrado el pariente',
          ], 400);
        }

      }


      DB::beginTransaction();
      try{

        DB::table('parientes_user')->insertGetId([
          'id_user'=>$id,
          'id_pariente'=>$exisparient[0]->id,
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

    public function dataPariente(Request $request){
      $id  =Auth::user()->id;
      $parientes =DB::select("select p.id,p.id_pariente,u.email,u.nombre,u.imagen
                                from parientes_user p
                                left join users u on(p.id_pariente=u.id)
                                where p.id_user =:id_user",['id_user'=>$id]);

      $jsonresponse=[
          'parientes'=>$parientes,
      ];
      return response()->json($jsonresponse,200);
    }

    public function borrarPariente(Request $request){
      DB::beginTransaction();
      try{

        DB::table('parientes_user')->where('id','=',$request->id)->delete();

        DB::commit();
        return response()->json([
            'message' => 'Registro eliminado correctamente!',
            'message2' => 'Click para continuar!'
        ]);
      }
      catch(\Exception $e){
          Log::info('creacion pariente : '.$e->getMessage());
          DB::rollback();
          //$e->getMessage();
          return response()->json([
              'error' =>'Hubo una inconsistencias al intentar realizar la accion'
          ], 400);
      }
    }
}
