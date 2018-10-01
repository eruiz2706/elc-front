<?php

namespace App\Http\Controllers\backend\es;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Log;
use Session;


class CursosController extends Controller
{
  public function index(Request $request){
    return view('backend.es.cursos.index');
  }

  public function listacursos(Request $request){
    $cursos   =DB::select("select
                            id,nombre
                            from cursos");
    $jsonresponse=[
        'cursos'=>$cursos
    ];
    return response()->json($jsonresponse,200);
  }

  public function verCurso(Request $request,$id){
    $idcurso=$id;
    return view('backend.es.cursos.detcurso',compact('idcurso'));
  }

  public function curso(Request $request){

  }
}
