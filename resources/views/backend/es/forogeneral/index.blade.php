{{--@extends('layouts.app')--}}

@extends('layouts.adminlte.app')

@section('banner')
<div class="img-bannerhome" style="background-image: url('{{ URL::asset('rsc/dist/img/banner.jpg') }}');">
  <!--<div class="inner-bannerhome">
      <h1>IMAGE SAMPLE</h1>
      <h2>The Quick Brown Fox jumps Over the lazy dog</h2>
      <a class="btn" href="#">CLICK HERE</a>
  </div>-->
</div>
@endsection

@section('content')

<div class="container">

  <div class="row">
    <div class="col-md-3">
      @include('backend.es.nav')

      @include('backend.es.navcursos')
    </div>

    <div class="col-md-9" style='padding-top:70px;'>
      <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Foro General</h3>
              </div>

              <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link" href="#progress" data-toggle="tab">Calendario general</a></li>
                    <li class="nav-item"><a class="nav-link" href="#test" data-toggle="tab">Resultados generales</a></li>
                    <li class="nav-item"><a class="nav-link" href="#calendar" data-toggle="tab">Diccionario</a></li>
                    <li class="nav-item"><a class="nav-link" href="#results" data-toggle="tab">Preguntas frecuentes</a></li>
                  </ul>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
@parent

@stop
