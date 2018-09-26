<?php

namespace App\Http\Controllers\backend\es;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DB;
use Log;

class PerfilEsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.es.perfil.index');
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
        //
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

    public function info(Request $request){
      $idUsu  =Auth::user()->id;
      $user   =DB::select("select nombre,email,fecha_vencimiento
                            from users
                            where id =:id",['id'=>$idUsu])[0];

      $suscripcion=DB::select("select valor from precios")[0];

      $pagos   =DB::select("select valor,fecha_creacion,fecha_vencimiento
                              from pagos
                              where user_id =:user_id
                              order by fecha_creacion desc",['user_id'=>$idUsu]);

      $jsonresponse=[
          'status' =>'success',
          'user'=>$user,
          'vrlsuscrip'=>$suscripcion->valor,
          'pagos'=>$pagos
      ];
      return response()->json($jsonresponse,200);
    }

    /*funcion para realizar el pago de la suscripcion del estudiante*/
    public function pagar(){
      $idUsu=Auth::user()->id;

      $return =(Object)[
          'response' => false,
      ];
      $pagos=[];
      DB::beginTransaction();
        try{
          $vlrsuscrip=DB::select("select valor from precios")[0];
          $fecha     =date('Y-m-d');
          $fechavenc =date('Y-m-d',strtotime('+12 months', strtotime($fecha)));

          DB::table('pagos')->insert([
            'valor' =>$vlrsuscrip->valor,
            'fecha_creacion' =>$fecha,
            'fecha_vencimiento' =>$fechavenc,
            'user_id' =>$idUsu
          ]);

          DB::table('users')
            ->where('id',$idUsu)
            ->update(['fecha_vencimiento' =>$fechavenc]);
            $return->response=true;
            //$return->success=$user;

          $pagos   =DB::select("select valor,fecha_creacion,fecha_vencimiento
                                  from pagos
                                  where user_id =:user_id
                                  order by fecha_creacion desc",['user_id'=>$idUsu]);


            DB::commit();
        }
        catch(\Exception $e){
            Log::info('create : '.$e->getMessage());
            $return->response=false;
            $return->error=$e->getMessage();
            DB::rollback();
        }

        if($return->response){
          $jsonresponse=[
              'status' =>'success',
              'message' => 'Su cuenta se ha renovado correctamente',
              'message2' => 'Click para continuar!',
              'fecha_vencimiento'=>$fechavenc,
              'pagos'=>$pagos
          ];
          return response()->json($jsonresponse,200);
        }else{
          return response()->json([
              'status' =>'error',
              'message' =>'Hubo un inconveniente al intentar realizar el pago, intente nuevamente en unos minutos',
              'message2' => 'Click para continuar!',
              'error'=>$return->error
          ], 400);
          return response()->json($jsonresponse,400);
        }

    }

    function cargarAvatar(Request $request){
      //obtenemos el campo file definido en el formulario
    //  $file = $request->file('avatar')->storage('public');
  //  return $request;
      //obtenemos el nombre del archivo
    //      $tmp_name = $_FILES['avatar']['tmp_name'];
       $file = $request->file('avatar');
       //$nombre = $file->getPathName();
       $nombre='holamundo.'.$file->getClientOriginalExtension();

      //indicamos que queremos guardar un nuevo archivo en el disco local
      //Storage::disk('local')->put($nombre,  \File::get($file));
      //$responseImg  =Storage::disk('assets')->put("almacenarimagen.jpg",  \File::get($file));
      $responseImg  =Storage::disk('public')->put($nombre,  \File::get($file));

      if($responseImg){
        $jsonresponse=[
            'status' =>public_path()
        ];
        return response()->json($jsonresponse,200);
      }else{
        $jsonresponse=[
            'error' =>'fasdf'
        ];
        return response()->json($jsonresponse,400);
      }



    }
}
