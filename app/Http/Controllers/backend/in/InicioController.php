<?php

namespace App\Http\Controllers\backend\in;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InicioController extends Controller
{
    public function index(){
      return view('backend.in.inicio.index');
    }
}
