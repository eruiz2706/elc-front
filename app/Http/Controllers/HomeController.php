<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Helpers\Mailgun;
use App\Helpers\Templatehtml;
use Lang;
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
                              e.nombre as nomestado,c.valor,e.slug
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
                  ->select('e.slug','e.nombre as nomestado','c.id','c.nombre', 'c.imagen', 'u.nombre as usercrea','c.valor')
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
              'message' =>Lang::get('frontend.page_register.required_email')
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
            'errors' => Lang::get('frontend.page_register.email_noregister'),
            'message' =>Lang::get('frontend.page_register.email_noregister')
        ], 400);
      }

      $password   = substr( md5(microtime()),1,8);
      DB::beginTransaction();
      try{

        DB::table('users')->where('id',$iduser)->update([
          'password'=>Hash::make($password),
        ]);

        $content="<p>".Lang::get('frontend.page_register.msg_recovery')."</p>";
        $content.="<br><p><strong>".Lang::get('frontend.page_register.form_pass')."</strong><br>$password</p>";


        $html=$this->templatehtml->generic([
          'titulo'=>Lang::get('frontend.page_register.msg_pasrecovery'),
          'content'=>$content
        ]);

        $response =$this->mailgun->send([
          'to'=>$request->input('email'),
          'subject'=>Lang::get('frontend.elcolp'),
          'html'=>$html
        ]);

        DB::commit();
        return response()->json([
            'status' =>'success',
            'message' => '',
            'message2' => Lang::get('frontend.page_register.msg_send')
        ]);
      }
      catch(\Exception $e){
          Log::info('recuperacion de contraseña : '.$e->getMessage());
          DB::rollback();
          //$e->getMessage();

          return response()->json([
              'error' =>Lang::get('frontend.error_send')
          ], 400);
      }
    }

    public function guardarRegistro(Request $request){
      $validator =Validator::make($request->all(),[
        'nombre' =>'required|string',
        'email' =>'required|string|email|max:255|unique:users',
        'rol' =>'required'
        //'password' =>'required|string|min:6',
      ]);

      if ($validator->fails()) {
          return response()->json([
              'status' =>'error',
              'errors' => $validator->messages(),
              'message' =>Lang::get('validation.required_all')
          ], 400);
      }


      $password   = substr( md5(microtime()),1,8);
      $attributes =[
          'nombre'  =>$request->input('nombre'),
          'email'=>$request->input('email'),
          'password'=>Hash::make($password),
          'slugrol'=>$request->input('rol'),
          'uniqid'=>uniqid('',true)
      ];
      $params=[
        'rol'=>$request->input('rol')
      ];
      $return   =$this->user_repo->createUser($attributes,$params);

      if($return->response){
        $content="<p>".Lang::get('frontend.page_register.msg_recovery')."</p>";
        $content.="<br><p><strong>".Lang::get('frontend.page_register.form_pass')."</strong><br>$password</p>";

        $html=$this->templatehtml->generic([
          'titulo'=>Lang::get('frontend.page_register.msg_register'),
          'content'=>$content
        ]);

        $response =$this->mailgun->send([
          'to'=>$request->input('email'),
          'subject'=>Lang::get('frontend.elcolp'),
          'html'=>$html
        ]);

        $users_notifi   =DB::select("select id
                                      from users
                                      where slugrol in('in','ad')");
        foreach ($users_notifi as $u_notifi) {
          DB::table('notificaciones')->insert([
              'descripcion'=>'Se creo nuevo usuario:<strong> '.$request->input('email').'</strong>',
              'fecha_creacion'=>date('Y-m-d H:i:s'),
              'user_id'=>$u_notifi->id
          ]);
        }

        return response()->json([
            'status' =>'success',
            'message' => Lang::get('frontend.page_register.msg_register'),
            'message2' => Lang::get('frontend.page_register.msg_send')
        ]);
      }else{
          return response()->json([
              'status' =>'error',
              'message' =>Lang::get('frontend.error_send'),
              'error' =>$return->error
          ], 400);
      }
    }

    public function getCursodet($id){
      $indefinido=Lang::get('frontend.page_courses.indefinido');
      $curso   =DB::select("select
                              c.id,c.nombre,c.imagen,u.nombre as usercrea,c.urlvideo,
                              c.plan_estudio,u.imagen as imgusucrea,c.fecha_inicio,
                              case when c.fecha_finalizacion='9999-12-31' then '$indefinido' else c.fecha_finalizacion::varchar  end as fecha_finalizacion,
                              e.nombre as nombestado,e.slug
                              from cursos c
                              left join users u on(c.user_id=u.id)
                              left join estados e on(c.estado=e.slug and e.tipo='cursos')
                              where visibilidad=true and c.id = :id",['id'=>$id]);

      if(!empty($curso)){
        $curso  =$curso[0];
      }

      $jsonresponse=[
          'curso'=>$curso,
          'traduction'=>Lang::get('frontend.page_courses')
      ];
      return response()->json($jsonresponse,200);
    }

}
