<?php

namespace App\Http\Controllers\backend\es;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiccionarioController extends Controller
{
  public function index(Request $reques){
    return view('backend.es.diccionario.index');
  }
}
