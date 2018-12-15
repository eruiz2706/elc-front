<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use DB;
use Session;
use Validator;
use Log;

class CursosController extends Controller
{
  ############################## VISTAS ##############################
  //vista para vializar listado de cursos
  public function view_list(){
    $rol  =Session::get('rol');
    if($rol !='in'){
      return view('layouts.errors.access_denied');
    }
    return view('backend.modulos.cursos.view_list');
  }

  //vista para datos de configuracion de curso, solo se ve los cursos creados por mi usuario
  public function view_config($id){
    $user =Auth::user();
    $rol  =Session::get('rol');

    if($rol !='in'){
      return view('layouts.errors.access_denied');
    }

    $curso  =DB::select("select c.id,c.nombre,u.imagen as imagenprof
                          from cursos c
                          left join users u on(c.user_id=u.id)
                          where c.id= :id and user_id = :user_id"
                     ,['id'=>$id,'user_id'=>$user->id]);

    if(empty($curso)){
      return view('layouts.errors.not_page');
    }

    $curso    =$curso[0];
    return view('backend.modulos.cursos.view_config',compact('curso'));
  }
  public function view_gestion($id){
    $user =Auth::user();
    $rol  =Session::get('rol');

    if($rol !='pr' && $rol !='es'){
      return view('layouts.errors.access_denied');
    }

    $curso  =DB::select("select c.id,c.nombre
                          from cursos c
                          left join users u on(c.user_id=u.id)
                          where c.id= :id"
                     ,['id'=>$id]);

    if(empty($curso)){
      return view('layouts.errors.not_page');
    }
    $curso    =$curso[0];
    if($rol =='pr')return view('backend.modulos.cursos.view_config_pr',compact('curso'));
    if($rol =='es'){
      $profesor =DB::select("select u.imagen,u.nombre
                             from cursos_user cu
                             left join users u on(u.id=cu.user_id)
                             where cu.slugrol='pr' and cu.curso_id= :curso_id
                             limit 1",
                             ['curso_id'=>$id]);

      return view('backend.modulos.cursos.view_config_es',compact('curso','profesor'));
    }
  }


  ############################## METODOS ##############################
  //retorna los cursos
  public function lista(Request $request){
    $user     =Auth::user();
    $cursos   =DB::select("select
                            id,nombre,fecha_inicio,visibilidad,fecha_creacion,inscripcion,valor,
                            case when fecha_finalizacion='9999-12-31' then 'Indefinido' else fecha_finalizacion::varchar end as fecha_finalizacion,
                            case when fecha_limite='9999-12-31' then 'Indefinido' else fecha_limite::varchar end as fecha_limite
                            from cursos
                            where user_id = :user_id
                            order by fecha_creacion desc",
                          ['user_id'=>$user->id]);

    foreach($cursos as $curso){
      $profesores=DB::select("select us.email
                                from cursos_user cu
                                left join users us on(cu.user_id=us.id)
                                where slugrol='pr' and curso_id= :curso_id",
                              ['curso_id'=>$curso->id]);
      $curso->profesores=$profesores;
    }

    $jsonresponse=[
        'cursos'=>$cursos
    ];
    return response()->json($jsonresponse,200);
  }

  //guardar un nuevo curso
  public function guardar(Request $request){
    $user     =Auth::user();
    $idprof   ='';
    $idprof2  ='';

    $validator =Validator::make($request->all(),[
      'nombre' =>'required|string',
      'fecha_inicio' =>'required',
      //'fecha_finalizacion' =>'required',
      //'fecha_limite' =>'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->messages(),
        ], 400);
    }

    if($request->profesor !=''){
      $profesor =DB::select("select u.id
                    from users u
                    left join role_user ru on(u.id=ru.user_id)
                    left join roles r on(ru.role_id=r.id)
                    where u.email = :email and r.slug='pr'",
                    ['email'=>$request->profesor]);
      if(empty($profesor)){
        return response()->json([
            'errors' => ['profesor'=>['El email no esta asociado a un usuario profesor']]
        ], 400);
      }else{
        $idprof =$profesor[0]->id;
      }
    }

    if($request->profesor2 !=''){
      $profesor2 =DB::select("select u.id
                    from users u
                    left join role_user ru on(u.id=ru.user_id)
                    left join roles r on(ru.role_id=r.id)
                    where u.email = :email and r.slug='pr'",
                    ['email'=>$request->profesor2]);
      if(empty($profesor2)){
        return response()->json([
            'errors' => ['profesor2'=>['El email no esta asociado a un usuario profesor']]
        ], 400);
      }else{
        $idprof2 =$profesor2[0]->id;
      }
    }

    //guardar datos
    DB::beginTransaction();
    try{

      $fecha_finalizacion =($request->fecha_finalizacion=='') ? '9999-12-31' : $request->fecha_finalizacion;
      $fecha_limite       =($request->fecha_limite=='') ? '9999-12-31' : $request->fecha_limite;
      $valor              =($request->valor=='') ? 0 : $request->valor;

      $idcurso=DB::table('cursos')->insertGetId([
        'nombre'=>$request->nombre,
        'fecha_inicio'=>$request->fecha_inicio,
        'fecha_finalizacion'=>$fecha_finalizacion,
        'fecha_limite'=>$fecha_limite,
        'visibilidad'=>$request->visibilidad,
        'inscripcion'=>$request->inscripcion,
        'valor'=>$valor,
        'fecha_creacion'=>date('Y-m-d H:i:s'),
        'user_id'=>$user->id
      ]);

      $fecha  =date('Y-m-d');
      DB::update("update cursos set estado='abierto'
                          where fecha_inicio>'$fecha' and id='$idcurso'");

      DB::update("update cursos set estado='encurso'
                  where '$fecha'>=fecha_inicio and '$fecha'<=fecha_finalizacion  and id='$idcurso'");

      DB::update("update cursos set estado='finalizado'
                  where '$fecha'>=fecha_inicio and '$fecha'>fecha_finalizacion  and id='$idcurso'");

      if($idprof !=''){
        DB::table('cursos_user')->insert([
          'user_id'=>$idprof,
          'curso_id'=>$idcurso,
          'slugrol'=>'pr',
          'fecha_creacion'=>date('Y-m-d H:i:s')
        ]);
      }
      if($idprof2 !=''){
        DB::table('cursos_user')->insert([
          'user_id'=>$idprof2,
          'curso_id'=>$idcurso,
          'slugrol'=>'pr',
          'fecha_creacion'=>date('Y-m-d H:i:s')
        ]);
      }

      DB::commit();
      return response()->json([
          'message' => 'Registro creado correctamente!',
          'message2' => 'Click para continuar!'
      ]);
    }
    catch(\Exception $e){
        Log::info('creacion curso : '.$e->getMessage());
        DB::rollback();
        //$e->getMessage();
        return response()->json([
            'error' =>'Hubo una inconsistencias al intentar crear el registro'.$e->getMessage()
        ], 400);
    }
  }

  //datos de edicion de un curso
  public function editar(Request $request){
    $curso   =DB::select("select
                            id,nombre,fecha_inicio,visibilidad,inscripcion,valor,
                            case when fecha_finalizacion='9999-12-31' then NULL else fecha_finalizacion end as fecha_finalizacion,
                            case when fecha_limite='9999-12-31' then NULL else fecha_limite end as fecha_limite
                            from cursos
                            where id = :id",
                          ['id'=>$request->id])[0];

    $curso_prof=DB::select("select cu.user_id,u.email
                            from cursos_user cu
                            left join users u on(cu.user_id=u.id)
                            where cu.curso_id= :curso_id
                            order by cu.id",
                          ['curso_id'=>$request->id]);
    $profesor='';
    $profesor2='';
    $con=0;
    foreach($curso_prof as $c_prof){
      if($con==0)$profesor=$c_prof->email;
      if($con==1)$profesor2=$c_prof->email;
      $con++;
    }
    $jsonresponse=[
        'curso'=>$curso,
        'profesor'=>$profesor,
        'profesor2'=>$profesor2,
    ];
    return response()->json($jsonresponse,200);
  }

  //actualizar datos curso
  public function actualizar(Request $request){
    $user     =Auth::user();
    $idprof   ='';
    $idprof2  ='';

    $validator =Validator::make($request->all(),[
      'nombre' =>'required|string',
      'fecha_inicio' =>'required',
      //'fecha_finalizacion' =>'required'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->messages(),
        ], 400);
    }

    if($request->profesor !=''){
      $profesor =DB::select("select u.id
                    from users u
                    left join role_user ru on(u.id=ru.user_id)
                    left join roles r on(ru.role_id=r.id)
                    where u.email = :email and r.slug='pr'",
                    ['email'=>$request->profesor]);
      if(empty($profesor)){
        return response()->json([
            'errors' => ['profesor'=>['El email no esta asociado a un usuario profesor']]
        ], 400);
      }else{
        $idprof =$profesor[0]->id;
      }
    }

    if($request->profesor2 !=''){
      $profesor2 =DB::select("select u.id
                    from users u
                    left join role_user ru on(u.id=ru.user_id)
                    left join roles r on(ru.role_id=r.id)
                    where u.email = :email and r.slug='pr'",
                    ['email'=>$request->profesor2]);
      if(empty($profesor2)){
        return response()->json([
            'errors' => ['profesor2'=>['El email no esta asociado a un usuario profesor']]
        ], 400);
      }else{
        $idprof2 =$profesor2[0]->id;
      }
    }

    DB::beginTransaction();
    try{
      $idcurso            =$request->id;
      $fecha_finalizacion =($request->fecha_finalizacion=='') ? '9999-12-31' : $request->fecha_finalizacion;
      $fecha_limite       =($request->fecha_limite=='') ? '9999-12-31' : $request->fecha_limite;
      $valor              =($request->valor=='') ? 0 : $request->valor;

      DB::table('cursos')->where('id',$idcurso)->update([
        'nombre'=>$request->nombre,
        'fecha_inicio'=>$request->fecha_inicio,
        'fecha_finalizacion'=>$fecha_finalizacion,
        'fecha_limite'=>$fecha_limite,
        'valor'=>$valor,
        'visibilidad'=>$request->visibilidad,
        'inscripcion'=>$request->inscripcion,
        'fecha_modific'=>date('Y-m-d H:i:s'),
        'userm_id'=>$user->id
      ]);

      $fecha  =date('Y-m-d');
      DB::update("update cursos set estado='abierto'
                          where fecha_inicio>'$fecha' and id='$idcurso'");

      DB::update("update cursos set estado='encurso'
                  where '$fecha'>=fecha_inicio and '$fecha'<=fecha_finalizacion  and id='$idcurso'");

      DB::update("update cursos set estado='finalizado'
                  where '$fecha'>=fecha_inicio and '$fecha'>fecha_finalizacion  and id='$idcurso'");


      DB::table('cursos_user')->where([
        ['curso_id','=',$idcurso],
        ['slugrol','=','pr']
        ])->delete();

      if($idprof !=''){
        DB::table('cursos_user')->insert([
          'user_id'=>$idprof,
          'curso_id'=>$idcurso,
          'slugrol'=>'pr',
          'fecha_creacion'=>date('Y-m-d H:i:s')
        ]);
      }
      if($idprof2 !=''){
        DB::table('cursos_user')->insert([
          'user_id'=>$idprof2,
          'curso_id'=>$idcurso,
          'slugrol'=>'pr',
          'fecha_creacion'=>date('Y-m-d H:i:s')
        ]);
      }

      DB::commit();
      return response()->json([
          'message' => 'Registro actualizado correctamente!',
          'message2' => 'Click para continuar!'
      ]);
    }
    catch(\Exception $e){
        Log::info('actualizacion curso : '.$e->getMessage());
        DB::rollback();
        //$e->getMessage();

        return response()->json([
            'error' =>'Hubo una inconsistencias al intentar actualizacion el registro'
        ], 400);
    }
  }

  //metodo que redirige a un curso en especifico
  public function abrir($id){
    $rol  =Session::get('rol');

    if($rol=='in'){
        return redirect('cursos/v_editar/'.$id);
    }else if(in_array($rol,['pr','es'])){
      return redirect('foroc/'.$id);
    }else{
      return view('layouts.errors.access_denied');
    }
  }

  public function edit_config(Request $request){
    $user     =Auth::user();
    $curso  =DB::select("select c.id,urlvideo,plan_estudio,imagen
                          from cursos c
                          where c.id= :id and user_id = :user_id"
                     ,['id'=>$request->id,'user_id'=>$user->id])[0];

    $jsonresponse=[
        'curso'=>$curso
    ];
    return response()->json($jsonresponse,200);

  }

  public function upd_configplan(Request $request,$id){
    $user     =Auth::user();
    DB::beginTransaction();
    try{
      DB::table('cursos')->where('id',$id)->update([
        'plan_estudio'=>$request->plan_estudio,
        'fecha_modific'=>date('Y-m-d H:i:s'),
        'userm_id'=>$user->id
      ]);

      DB::commit();
      return response()->json([
          'message' => 'Registro actualizado correctamente!',
          'message2' => 'Click para continuar!'
      ]);
    }
    catch(\Exception $e){
        Log::info('actualizacion curso : '.$e->getMessage());
        DB::rollback();
        //$e->getMessage();

        return response()->json([
            'error' =>'Hubo una inconsistencias al intentar actualizacion el registro'
        ], 400);
    }
  }

  public function upd_configvideo(Request $request,$id){
    $user     =Auth::user();
    DB::beginTransaction();
    try{
      DB::table('cursos')->where('id',$id)->update([
        'urlvideo'=>str_replace("watch?v=","embed/", $request->urlvideo),
        'fecha_modific'=>date('Y-m-d H:i:s'),
        'userm_id'=>$user->id
      ]);

      DB::commit();
      return response()->json([
          'message' => 'Registro actualizado correctamente!',
          'message2' => 'Click para continuar!'
      ]);
    }
    catch(\Exception $e){
        Log::info('actualizacion curso : '.$e->getMessage());
        DB::rollback();
        //$e->getMessage();

        return response()->json([
            'error' =>'Hubo una inconsistencias al intentar actualizacion el registro'
        ], 400);
    }
  }

  public function upd_configlogo(Request $request,$id){
    $user     =Auth::user();
    if($request->file('avatar') != null){
      $file   =$request->file('avatar');
      $nombre =Auth::user()->uniqid.'.'.$file->getClientOriginalExtension();

      $responseImg  =Storage::disk('public_cursos')->put($nombre,  \File::get($file));
      if($responseImg){
          DB::table('cursos')->where('id',$id)->update([
            'imagen' =>'img/cursos/'.$nombre,
            'fecha_modific'=>date('Y-m-d H:i:s'),
            'userm_id'=>$user->id
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

  }
}
