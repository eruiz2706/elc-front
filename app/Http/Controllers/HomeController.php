<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      Auth::logout();
      return view('frontend.inicio');
      //return redirect('/login');
    }

    public function cursos(){
      return view('frontend.cursos');
    }

    public function acercade(){
      return view('frontend.acercade');
    }

    public function contacto(){
      return view('frontend.contacto');
    }

    public function nuevoregistro(){
      return view('frontend.registro');
    }

}
