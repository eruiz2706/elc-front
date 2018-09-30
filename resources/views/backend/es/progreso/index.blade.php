{{--@extends('layouts.app')--}}

@extends('layouts.adminlte.app')

@section('banner')
<div class="img-bannerhome" style="background-image: url('{{ URL::asset('img/app/slide.jpg') }}');">
</div>
@endsection

@section('content')

<div class="container">

  <div class="row">
    <div class="col-md-3">
      @include('backend.nav.index')

      @include('backend.es.navcursos')
    </div>

    <div class="col-md-9" style='padding-top:70px;'>
      <div class="row">
            @include('backend.es.navtabgrupo')
      </div>

      <h4>Modulo 1</h4>
      <div id="accordion">
        <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
        <div class="card ">
          <div class="card-header">
            <h4 class="card-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#colapse1" class="collapsed" aria-expanded="false">
                Leccion 1
              </a>
            </h4>
          </div>
          <div id="colapse1" class="panel-collapse in collapse" style="">
            <div class="card-body">
              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-outline-primary btn-sm">Finalizar</button>
            </div>
          </div>
        </div>
      </div>
      <div id="accordion">
        <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
        <div class="card ">
          <div class="card-header">
            <h4 class="card-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#colapse2" class="collapsed" aria-expanded="false">
                Leccion 2
              </a>
            </h4>
          </div>
          <div id="colapse2" class="panel-collapse in collapse" style="">
            <div class="card-body">
              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
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
