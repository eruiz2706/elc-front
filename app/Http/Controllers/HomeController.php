<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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
     public function __construct(UserRepository $user_repo){
         $this->user_repo     =$user_repo;
     }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $cursos   =DB::select("select
                              c.id,c.nombre,c.imagen,u.nombre as usercrea
                              from cursos c
                              left join users u on(c.user_id=u.id)
                              where visibilidad=true
                              limit 3");

      Auth::logout();
      $link_inic='';
      return view('frontend.inicio',compact('link_inic','cursos'));
      //return redirect('/login');
    }

    public function cursos($estado=''){
      $fecha  =date('Y-m-d');
      $cursos=DB::table('cursos as c')
                  ->join('users as u', 'c.user_id', '=', 'u.id');


      /*if($estado =='AB'){
        $cursos =$cursos->where('c.fecha_inicio','>=',$fecha);
      }
      if($estado =='EC'){
        $cursos =$cursos->where('c.fecha_finalizacion','<=',$fecha)
                ;
      }
      if($estado =='FI'){
        $cursos =$cursos->where('c.fecha_finalizacion','>',$fecha);
      }*/

      $cursos =$cursos->where('visibilidad',true)
                  ->select('c.id','c.nombre', 'c.imagen', 'u.nombre as usercrea')
                  ->paginate(6);

      $link_curs='';
      return view('frontend.cursos',compact('link_curs','cursos'));
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

    public function registro(){
      return view('frontend.registro');
    }

    public function guardarRegistro(Request $request){
      $validator =Validator::make($request->all(),[
        'nombre' =>'required|string',
        'email' =>'required|string|email|max:255|unique:users',
        'password' =>'required|string|min:6',
        'rol' =>'required'
      ]);

      if ($validator->fails()) {
          return response()->json([
              'status' =>'error',
              'errors' => $validator->messages(),
              'message' =>'Debe validar los campos obligatorios'
          ], 400);
      }
      $attributes =[
          'fecha_vencimiento'=>date('Y-m-d',strtotime('-1 days', strtotime(date('Y-m-d')))),
          'nombre'  =>$request->input('nombre'),
          'email'=>$request->input('email'),
          'password'=>Hash::make($request->input('password')),
          'uniqid'=>uniqid('',true)
      ];
      $params=[
        'rol'=>$request->input('rol')
      ];
      $return   =$this->user_repo->create($attributes,$params);

      if($return->response){
          return response()->json([
              'status' =>'success',
              'message' => 'Tu registro ha sido exitoso!',
              'message2' => 'Click para continuar!'
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
                              c.fecha_finalizacion
                              from cursos c
                              left join users u on(c.user_id=u.id)
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
