<?php

namespace App\Http\Controllers\backend\es;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EvaluacionesController extends Controller
{
  public function index(Request $reques){
    return view('backend.es.evaluaciones.index');
  }
}
