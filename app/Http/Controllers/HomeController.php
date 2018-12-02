<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Helpers\Mailgun;
use App\Helpers\Templatehtml;
use Validator;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     private $user_repo;
     private $mailgun;
     private $templatehtml;

     public function __construct(UserRepository $user_repo,Mailgun $mailgun,Templatehtml $templatehtml){
         $this->user_repo   =$user_repo;
         $this->mailgun     =$mailgun;
         $this->templatehtml=$templatehtml;
     }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $cursos   =DB::select("select
                              c.id,c.nombre,c.imagen,u.nombre as usercrea,
                              e.nombre as nomestado
                              from cursos c
                              left join users u on(c.user_id=u.id)
                              left join estados e on(c.estado=e.slug and e.tipo='cursos')
                              where visibilidad=true
                              order by fecha_creacion desc
                              limit 3");

      Auth::logout();
      $link_inic='';
      return view('frontend.inicio',compact('link_inic','cursos'));
    }

    public function noaccess(){
      Auth::logout();
      return view('frontend.noaccess');
    }

    public function noregister(){
      return view('frontend.noregister');
    }

    public function cursos($estado=''){
      $fecha  =date('Y-m-d');

      $select_curso  =DB::select("select e.slug,e.nombre
                            from estados e
                            where e.tipo='cursos'");

      $cursos=DB::table('cursos as c')
                  ->leftjoin('users as u', 'c.user_id', '=', 'u.id')
                  ->leftJoin('estados as e','c.estado', '=', 'e.slug')
                  ->where('e.tipo','cursos');


      if($estado != ''){
        $cursos =$cursos->where('c.estado','=',$estado);
      }

      $cursos =$cursos->where('visibilidad',true)
                  ->select('e.nombre as nomestado','c.id','c.nombre', 'c.imagen', 'u.nombre as usercrea')
                  ->paginate(6);

      $link_curs='';
      return view('frontend.cursos',compact('link_curs','cursos','select_curso'));
    }

    public function cursosdet($id){
      $link_curs='';
      return view('frontend.cursodet',compact('link_curs','id'));
    }

    public function acercade(){
      $link_acerca='';
      return view('frontend.acercade',compact('link_acerca'));
    }

    public function contacto(){
      $link_contac='';
      return view('frontend.contacto',compact('link_contac'));
    }

    public function recuperarPass(Request $request){
      $validator =Validator::make($request->all(),[
        'email' =>'required|string|email',
      ]);

      if ($validator->fails()) {
          return response()->json([
              'status' =>'error',
              'errors' => $validator->messages(),
              'message' =>'Debe validar los campos obligatorios'
          ], 400);
      }

      $iduser='';
      $data_users  =DB::select("select id
                            from users
                            where email= :email"
                       ,['email'=>$request->input('email')]);

      if(!empty($data_users)){
        $iduser=$data_users[0]->id;
      }

      if($iduser==''){
        return response()->json([
            'status' =>'error',
            'errors' => 'El email no se encuentra registrado',
            'message' =>'Debe validar los campos obligatorios'
        ], 400);
      }



      $password   = substr( md5(microtime()),1,8);
      DB::beginTransaction();
      try{

        DB::table('users')->where('id',$iduser)->update([
          'password'=>Hash::make($password),
        ]);

        $titulo='Contraseña de recuperacion';
        $content="<p>Se te ha generado una contraseña automatica, recuerda que puedes cambiarla en cualquier momento desde el perfil de tu usuario.</p>
                  <br><p><strong>Contraseña</strong><br>$password</p>";

        $html=$this->templatehtml->generic([
          'titulo'=>$titulo,
          'content'=>$content
        ]);

        $response =$this->mailgun->send([
          'to'=>$request->input('email'),
          'subject'=>'Registro de usuario',
          'html'=>$html
        ]);

        DB::commit();
        return response()->json([
            'status' =>'success',
            'message' => '',
            'message2' => 'Se te ha enviado una contraeña de acceso al email ingresado'.$iduser
        ]);
      }
      catch(\Exception $e){
          Log::info('creacion tarea : '.$e->getMessage());
          DB::rollback();
          //$e->getMessage();

          return response()->json([
              'error' =>'Hubo una inconsistencias al intentar recuperar la contraseña'
          ], 400);
      }
    }

    public function guardarRegistro(Request $request){
      $validator =Validator::make($request->all(),[
        'nombre' =>'required|string',
        'email' =>'required|string|email|max:255|unique:users',
        //'password' =>'required|string|min:6',
        'rol' =>'required'
      ]);

      if ($validator->fails()) {
          return response()->json([
              'status' =>'error',
              'errors' => $validator->messages(),
              'message' =>'Debe validar los campos obligatorios'
          ], 400);
      }


      $password   = substr( md5(microtime()),1,8);
      $attributes =[
          'fecha_vencimiento'=>date('Y-m-d',strtotime('-1 days', strtotime(date('Y-m-d')))),
          'nombre'  =>$request->input('nombre'),
          'email'=>$request->input('email'),
          'password'=>Hash::make($password),
          'uniqid'=>uniqid('',true)
      ];
      $params=[
        'rol'=>$request->input('rol')
      ];
      $return   =$this->user_repo->create($attributes,$params);

      if($return->response){
        $titulo='Tu registro se realizo satisfactoriamente';
        $content="<p>Se te ha generado una contraseña automatica, recuerda que puedes cambiarla en cualquier momento desde el perfil de tu usuario.</p>
                  <br><p><strong>Contraseña</strong><br>$password</p>";

        $html=$this->templatehtml->generic([
          'titulo'=>$titulo,
          'content'=>$content
        ]);

        $response =$this->mailgun->send([
          'to'=>$request->input('email'),
          'subject'=>'Registro de usuario',
          'html'=>$html
        ]);

        return response()->json([
            'status' =>'success',
            'message' => 'Tu registro ha sido exitoso!',
            'message2' => 'Se te ha enviado tu contraseña de acceso al email ingresado!'
        ]);
      }else{
          return response()->json([
              'status' =>'error',
              'message' =>'Hubo una inconsistencias al intentar guardar los datos',
              'error' =>$return->error
          ], 400);
      }
    }

    public function getCursodet($id){
      $curso   =DB::select("select
                              c.id,c.nombre,c.imagen,u.nombre as usercrea,c.urlvideo,
                              c.plan_estudio,u.imagen as imgusucrea,c.fecha_inicio,
                              c.fecha_finalizacion,e.nombre as nombestado
                              from cursos c
                              left join users u on(c.user_id=u.id)
                              left join estados e on(c.estado=e.slug and e.tipo='cursos')
                              where visibilidad=true and c.id = :id",['id'=>$id]);

      if(!empty($curso)){
        $curso  =$curso[0];
      }

      $jsonresponse=[
          'curso'=>$curso
      ];
      return response()->json($jsonresponse,200);
    }

}
