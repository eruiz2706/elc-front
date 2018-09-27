<?php

namespace App\Http\Controllers\backend\pr;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InicioController extends Controller
{
  public function index(){
    return view('backend.pr.inicio.index');
  }
}
