<?php

namespace App\Http\Controllers\backend\pa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InicioController extends Controller
{
  public function index(){
    return view('backend.pa.inicio.index');
  }
}
