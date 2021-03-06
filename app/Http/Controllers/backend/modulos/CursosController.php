<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use DB;
use Validator;
use Log;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;


class CursosController extends Controller
{
  ############################## VISTAS ##############################
  //vista para vializar listado de cursos
  public function view_list(){
    $user =Auth::user();
    $rol  =$user->slugrol;
    if($rol !='in'){
      return view('layouts.errors.access_denied');
    }
    return view('backend.modulos.cursos.view_list');
  }

  //vista para datos de configuracion de curso, solo se ve los cursos creados por mi usuario
  public function view_config($id){
    $user =Auth::user();
    $rol  =$user->slugrol;

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
  public function view_gestion($id=0,$id2=0){
    $user =Auth::user();
    $rol  =$user->slugrol;

    if($rol !='pr' && $rol !='es' && $rol !='pa'){
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
    if($rol =='pr'){
        return view('backend.modulos.cursos.view_config_pr',compact('curso'));
    }
    if($rol =='es'){
      $profesor =DB::select("select u.imagen,u.nombre
                             from cursos_user cu
                             left join users u on(u.id=cu.user_id)
                             where cu.slugrol='pr' and cu.curso_id= :curso_id
                             limit 1",
                             ['curso_id'=>$id]);

      return view('backend.modulos.cursos.view_config_es',compact('curso','profesor'));
    }
    if($rol =='pa'){
        return view('backend.modulos.cursos.view_config_pa',compact('curso','id2'));
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
                                where cu.slugrol='pr' and curso_id= :curso_id",
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
                            where cu.curso_id= :curso_id and cu.slugrol='pr'
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
    $user =Auth::user();
    $rol  =$user->slugrol;

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
      $nombre =uniqid('',true).'_'.$id.'.'.$file->getClientOriginalExtension();

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

  public function borrar(Request $request){

    /*$cantidadCursosUser=DB::select("select count(id) as conteo
                                      from cursos_user
                                      where curso_id=:curso_id",
                                    ['curso_id'=>$request->id])[0];
    
    if($cantidadCursosUser->conteo>0){
      return response()->json([
          'error' =>'No se puede eliminar el curso, por que ya tiene estudiantes inscritos'
      ], 400);
    }*/

    DB::beginTransaction();
    try{
      DB::table('cursos')->where('id','=',$request->id)->delete();
      DB::commit();

      return response()->json([
          'message' => 'Curso eliminado correctamente!',
          'message2' => 'Click para continuar!'
      ]);
    }
    catch(\Exception $e){
        Log::info('borrado de cursos : '.$e->getMessage());
        DB::rollback();
        return response()->json([
            'error' =>'Hubo una inconsistencias al intentar realizar la accion'
        ], 400);
    }
  }

  public function replicar(Request $request){
    $user     =Auth::user();
    DB::beginTransaction();
    try{

      $cursoOriginal=DB::select("select nombre,fecha_inicio,fecha_finalizacion,fecha_limite,visibilidad,inscripcion,plan_estudio,estado,valor,urlvideo
                                    from cursos 
                                  where id=:id",
                                ['id'=>$request->id])[0];

      $idcurso=DB::table('cursos')->insertGetId([
        'nombre'=>"(COPIA)".$cursoOriginal->nombre,
        'fecha_inicio'=>$cursoOriginal->fecha_inicio,
        'fecha_finalizacion'=>$cursoOriginal->fecha_finalizacion,
        'fecha_limite'=>$cursoOriginal->fecha_limite,
        'visibilidad'=>$cursoOriginal->visibilidad,
        'inscripcion'=>$cursoOriginal->inscripcion,
        'plan_estudio'=>$cursoOriginal->plan_estudio,
        'estado'=>$cursoOriginal->estado,
        'valor'=>$cursoOriginal->valor,
        'urlvideo'=>$cursoOriginal->urlvideo,
        'fecha_creacion'=>date('Y-m-d H:i:s'),
        'user_id'=>$user->id
      ]);

      $moduloscurso=DB::select("select id,nombre,numero
                                  from modulos
                                  where curso_id=:curso_id",
                                ['curso_id'=>$request->id]);
      foreach($moduloscurso as $modulo){
          $idmodulo=DB::table('modulos')->insertGetId([
            'curso_id'=>$idcurso,
            'nombre'=>$modulo->nombre,
            'numero'=>$modulo->numero,
            'fecha_creacion'=>date('Y-m-d H:i:s'),
            'user_id'=>$user->id
          ]);

          $leccionescurso=DB::select("select numero,nombre,descripcion,tiempolectura
                                        from lecciones
                                        where modulo_id=:modulo_id",
                                ['modulo_id'=>$modulo->id]);
          foreach($leccionescurso as $leccion){
              DB::table('lecciones')->insertGetId([
                'modulo_id'=>$idmodulo,
                'numero'=>$leccion->numero,
                'nombre'=>$leccion->nombre,
                'descripcion'=>$leccion->descripcion,
                'tiempolectura'=>$leccion->tiempolectura,
                'fecha_creacion'=>date('Y-m-d H:i:s'),
                'user_id'=>$user->id
              ]);
          }
      }

      /*se replica los examenes creados por la institucion*/
      $examenesCurosInst=DB::select("select id,nombre,descripcion,duracion,calificacion,preguntas,fecha_inicio,fecha_finalizacion from ejercicios
                                        where curso_id=:curso_id and user_id=:user_id",
                              ['curso_id'=>$request->id,'user_id'=>$user->id]);

      foreach($examenesCurosInst as $examenInst){
          $idexamen=DB::table('ejercicios')->insertGetId([
            'curso_id'=>$idcurso,
            'nombre'=>$examenInst->nombre,
            'descripcion'=>$examenInst->descripcion,
            'duracion'=>$examenInst->duracion,
            'calificacion'=>$examenInst->calificacion,
            'preguntas'=>$examenInst->preguntas,
            'entregas'=>0,
            'fecha_inicio'=>$examenInst->fecha_inicio,
            'fecha_finalizacion'=>$examenInst->fecha_finalizacion,
            'fecha_creacion'=>date('Y-m-d H:i:s'),
            'user_id'=>$user->id
          ]);

          $preguntasExamen=DB::select("select id,nombre,tipo,descripcion,textoaudio,textorellenar,calificacion
                            from preguntas
                            where ejercicio_id=:ejercicio_id",
              ['ejercicio_id'=>$examenInst->id]);

          foreach($preguntasExamen as $pregunta){
              $idpregunta=DB::table('preguntas')->insertGetId([
                'ejercicio_id'=>$idexamen,
                'nombre'=>$pregunta->nombre,
                'tipo'=>$pregunta->tipo,
                'descripcion'=>$pregunta->descripcion,
                'textoaudio'=>$pregunta->textoaudio,
                'textorellenar'=>$pregunta->textorellenar,
                'calificacion'=>$pregunta->calificacion,
                'fecha_creacion'=>date('Y-m-d H:i:s'),
                'user_id'=>$user->id
              ]);

              DB::update("insert into respuestas(puntaje,seleccion,respuesta,relacionar,pregunta_id,user_id,fecha_creacion)
                            select puntaje,seleccion,respuesta,relacionar,".$idpregunta.",".$user->id.",'".date('Y-m-d H:i:s')."' from respuestas where pregunta_id=".$pregunta->id);
          }
      }



      DB::commit();
      return response()->json([
          'message' => 'Curso replicado correctamente!',
          'message2' => 'Click para continuar!'
      ]);
    }
    catch(\Exception $e){
        Log::info('replica de cursos : '.$e->getMessage());
        DB::rollback();
        return response()->json([
            //'error' =>$e->getMessage()
            'error' =>'Hubo inconsistencias el intentar replicar el curso'
        ], 400);
    }
  }

  function exportar(Request $request){
    $user =Auth::user();
    $rol  =$user->slugrol;

    $nombreArchivo = 'export_xls/nuevo_archivo.xlsx';
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Hello World !');
    $writer = new Xlsx($spreadsheet);
    $writer->save($nombreArchivo);
  
    $public_path = public_path();
    $url =storage_path('app/public/' . $nombreArchivo);

    if (Storage::disk('public')->exists($nombreArchivo))
    {
      return response()->download($url);
    }

    /*if($rol !='in'){
      return view('layouts.errors.access_denied');
    }*/

    return response()->json([
          'message' => 'Curso eliminado correctamente!',
          'urlArchivo' => $nombreArchivo
    ]);
    
    return response()->json([
        'error' =>'Hubo una inconsistencias al intentar realizar la descarga'
    ], 400);
  }

  function exportar2(Request $request){
    $user =Auth::user();
    $rol  =$user->slugrol;

    $nombreArchivo = 'nuevo_archivo.xlsx';
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Hello World !');
    $writer = new Xlsx($spreadsheet);
    $writer->save('export_xls/'.$nombreArchivo);
  
    $public_path = public_path();
    $url =storage_path('app/public/export_xls/' . $nombreArchivo);

    if (Storage::disk('public_export')->exists('/'.$nombreArchivo))
    {
      return response()->download($url);
    }
    echo "llego";

  }
}
