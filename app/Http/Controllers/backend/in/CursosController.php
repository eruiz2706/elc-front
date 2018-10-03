<?php

namespace App\Http\Controllers\backend\in;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CursosController extends Controller
{
    public function index(){
      return view('backend.in.cursos.index');
    }

    public function crear(){
      return view('backend.in.cursos.crear');
    }
}
