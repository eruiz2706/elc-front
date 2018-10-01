<?php

namespace App\Http\Controllers\backend\general;

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
      return view('backend.general.perfil.index');
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
      $user   =DB::select("select nombre,email,telefono,ciudad,direccion,facebook,linkedin,biografia,
                            fecha_vencimiento
                            from users
                            where id =:id",['id'=>$id])[0];

      $suscripcion=DB::select("select valor from precios")[0];

      $pagos   =DB::select("select valor,fecha_creacion,fecha_vencimiento
                              from pagos
                              where user_id =:user_id
                              order by fecha_creacion desc",['user_id'=>$id]);

      $jsonresponse=[
          'user'=>$user,
          'vrlsuscrip'=>$suscripcion->valor,
          'pagos'=>$pagos
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
}
