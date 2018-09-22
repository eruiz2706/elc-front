<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Repository\UserRepository;
use Validator;

class RegistroController extends Controller
{

    private $user_repo;

    public function __construct(UserRepository $user_repo){
        $this->user_repo     =$user_repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.registro.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator =Validator::make($request->all(),[
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

        if($request->input('password') != $request->input('repassword')){
            return response()->json([
                'status' =>'error',
                'errors' => ['password'=>['La contraseña y la confirmacion deben ser iguales']],
                'message' =>'Debe validar los campos obligatorios'
            ], 400);
        }

        $attributes =[
            'fecha_vencimiento'=>date('Y-m-d',strtotime('-1 days', strtotime(date('Y-m-d')))),
            'nombre'  =>$request->input('email'),
            'email'=>$request->input('email'),
            'password'=>Hash::make($request->input('password'))
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
