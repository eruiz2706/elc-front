<?php

namespace App\Http\Controllers\backend\es;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class InicioEsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('backend.es.inicio.index');
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

    /*busqueda de los cursos del perfil estudiante*/
    public function busqueda(Request $request){
      $cursos  =DB::select("select * from cursos");

      $jsonresponse=[
          'status' =>'success',
          'cursos'=>$cursos
      ];
      return response()->json($jsonresponse,200);
    }

    public function detallecurso($id){
      $idcurso=$id;
      return view('backend.es.inicio.detcurso',compact('idcurso'));
    }

    public function curso($id){
      $curso  =DB::select("select * from cursos where id= :id",['id'=>$id])[0];

      $jsonresponse=[
          'status' =>'success',
          'curso'=>$curso
      ];
      return response()->json($jsonresponse,200);
    }
}
