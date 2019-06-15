<?php

namespace App\Http\Controllers\backend\modulos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DB;

class OfertadosController extends Controller
{
    public function index(Request $request){
      $user =Auth::user();
      $rol  =$user->slugrol;
      if($rol !='es'){
        return view('layouts.errors.access_denied');
      }
      return view('backend.modulos.ofertados.view_index');
    }

    public function listacursos(Request $request){

      $a_where=[];
      $where='';
      if($request->select_bsq !=''){
        $a_where['estado']=$request->select_bsq;
        $where    ="and c.estado = :estado";
      }

      $id       =Auth::user()->id;
      $cursos   =DB::select("select
                              c.id,c.nombre,c.imagen,e.nombre as nombestado,c.valor,e.slug
                              from cursos c
                              left join estados e on(c.estado=e.slug and e.tipo='cursos')
                              where c.visibilidad=true $where
                              ",$a_where);
      $jsonresponse=[
          'cursos'=>$cursos
      ];
      return response()->json($jsonresponse,200);
    }

    public function vercurso(Request $request){
      $user     =Auth::user();
      $subscrip =false;
      $validasub=DB::select("select curso_id
                            from cursos_user
                            where user_id = :user_id and curso_id = :curso_id",
                            ['user_id'=>$user->id,'curso_id'=>$request->id]);

      if(!empty($validasub)){
        $validasub=$validasub[0];
        $subscrip =($validasub->curso_id==$request->id) ? true : false;
      }

      $curso   =DB::select("select
                              c.id,c.nombre,c.imagen,c.plan_estudio,c.urlvideo,c.estado,c.valor,
                              c.fecha_inicio,
                              case when c.fecha_finalizacion='9999-12-31' then 'Indefinido' else c.fecha_finalizacion::varchar end as fecha_finalizacion,
                              u.imagen as img_usercrea
                              from cursos c
                              left join users u on(c.user_id=u.id)
                              where c.visibilidad=true and c.id = :id",['id'=>$request->id])[0];


      /*$action='https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/';
      $responseUrl=env('APP_URL').'ofertados/respuestapago';
      $confirmationUrl=env('APP_URL')."ofertados/cofirmacionpago";
      $apiKey="4Vj8eK4rloUd272L48hsrarnUA";
      $merchantId="508029";
      $referenceCode=$curso->id.'-'.$user->id.'-'.date('hidmY');
      $amount=$curso->valor;
      $tax=0;
      $taxReturnBase=0;
      $currency="COP";
      $accountId="512321";//pais
      $test="1";
      $buyerEmail=$user->email;
      $description=$curso->nombre;
      $signature=md5($apiKey."~".$merchantId."~".$referenceCode."~".$amount."~".$currency);*/
  
      $action='https://checkout.payulatam.com/ppp-web-gateway-payu/';
      $responseUrl=env('APP_URL').'ofertados/respuestapago';
      $confirmationUrl=env('APP_URL')."ofertados/cofirmacionpago";
      $apiKey="Zfl5A7AnRXN46ogamlRJfBd81E";
      $merchantId="787130";
      $referenceCode=$curso->id.'-'.$user->id.'-'.date('hidmY');
      $amount=$curso->valor;
      $tax=0;
      $taxReturnBase=0;
      $currency="COP";
      $accountId="793967";//pais
      $test="0";
      $buyerEmail=$user->email;
      $description=$curso->nombre;
      $signature=md5($apiKey."~".$merchantId."~".$referenceCode."~".$amount."~".$currency);

      $jsonresponse=[
          'curso'=>$curso,
          'subscrip'=>$subscrip,
          'webcheckout'=>[
            'action'=>$action,
            'responseUrl'=>$responseUrl,
            'confirmationUrl'=>$confirmationUrl,
            'merchantId'=>$merchantId,
            'accountId'=>$accountId,
            'amount'=>$amount,
            'tax'=>$tax,
            'taxReturnBase'=>$taxReturnBase,
            'currency'=>$currency,
            'referenceCode'=>$referenceCode,
            'buyerEmail'=>$buyerEmail,
            'description'=>$description,
            'signature'=>$signature,
            'test'=>$test
          ]
      ];
      return response()->json($jsonresponse,200);
    }

    public function suscripcion(Request $request){
      $user =Auth::user();
      $rol  =$user->slugrol;
      $id   =Auth::user()->id;

      if ($request->idcurso=='') {
          return response()->json([
              'error' =>'No existe un id de curso a suscribir',
          ], 400);
      }

      ############guardar datos ########
      DB::beginTransaction();
      try{
        DB::table('cursos_user')->insert([
          'user_id'=>$id,
          'curso_id'=>$request->idcurso,
          'slugrol'=>$rol,
          'fecha_creacion'=>date('Y-m-d H:i:s')
        ]);
        DB::commit();

        return response()->json([
            'message' => 'Tu suscripción se realizo correctamente!',
            'message2' => 'Click para continuar!'
        ]);
      }
      catch(\Exception $e){
          Log::info('suscripción curso : '.$e->getMessage());
          DB::rollback();
          //$e->getMessage();

          return response()->json([
              'error' =>'Hubo una inconsistencias al intentar realizar el proceso'
          ], 400);
      }
    }

    public function respuestapago(){
        $user =Auth::user();
        $rol  =$user->slugrol; 
        $id     =Auth::user()->id;

        $referenceCode    =$_REQUEST['referenceCode'];
        $TX_VALUE         =$_REQUEST['TX_VALUE'];
        $New_value        =number_format($TX_VALUE, 1, '.', '');
        $description      =$_REQUEST['description'];
        $transactionId    =$_REQUEST['transactionId'];
        $buyerEmail       =$_REQUEST['buyerEmail'];

        if ($_REQUEST['transactionState'] == 4 ) {//Transacción aprobada
          $r_code=explode('-',$referenceCode);
          DB::beginTransaction();
          try{
            DB::table('pagos')->insert([
              'reference_code'=>$referenceCode,
              'transaction_id'=>$transactionId,
              'nombre_curso'=>$description,
              'valor'=>$New_value,
              'email'=>$buyerEmail,
              'user_id'=>$id,
              'fecha_creacion'=>date('Y-m-d H:i:s')
            ]);

            DB::table('cursos_user')->insert([
              'user_id'=>$id,
              'curso_id'=>$r_code[0],
              'slugrol'=>$rol,
              'fecha_creacion'=>date('Y-m-d H:i:s')
            ]);
            DB::commit();

            return view('backend.modulos.ofertados.view_confirmacion');
          }
          catch(\Exception $e){
              Log::info('suscripcion curso : '.$e->getMessage());
              DB::rollback();
              //$e->getMessage();
              return view('backend.modulos.ofertados.view_errorconfirmacion');
          }
        }else{
          return view('backend.modulos.ofertados.view_errorconfirmacion');
        }
    }

    public function confirmacionpago(){

    }
}
