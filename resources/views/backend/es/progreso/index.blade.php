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
                <h3 class="card-title">Curso Programacion interactiva</h3>

                <div class="card-tools">
                  <div class="user-block" style="width:80px;">
                   <img class="img-circle img-bordered-sm" src="{{ URL::asset('rsc/dist/img/user1-128x128.jpg') }}" alt="user image">
                  </div>
                </div>
              </div>

              <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link " href="{{url('es/foro')}}">Foro</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{url('es/prog')}}">Progreso</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('es/calend')}}">Calendario</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('es/evalua')}}">Evaluaciones</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('es/result')}}">Resultados</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('es/tutor')}}">Tutor</a></li>
                  </ul>
              </div>
            </div>
          </div>
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
                    3
                    wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                    laborum
                    eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                    nulla
                    assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                    nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft
                    beer
                    farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                    labore sustainable VHS.
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
                    3
                    wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                    laborum
                    eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                    nulla
                    assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                    nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft
                    beer
                    farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                    labore sustainable VHS.
                  </div>
                </div>
              </div>
            </div>

            <div id="accordion">
              <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
              <div class="card ">
                <div class="card-header">
                  <h4 class="card-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#colapse3" class="collapsed" aria-expanded="false">
                      Leccion 3
                    </a>
                  </h4>
                </div>
                <div id="colapse3" class="panel-collapse in collapse" style="">
                  <div class="card-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                    3
                    wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                    laborum
                    eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                    nulla
                    assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                    nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft
                    beer
                    farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                    labore sustainable VHS.
                  </div>
                </div>
              </div>
            </div>

            <h4>Modulo 2</h4>
            <div id="accordion">
              <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
              <div class="card ">
                <div class="card-header">
                  <h4 class="card-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#colapse4" class="collapsed" aria-expanded="false">
                      Leccion 1
                    </a>
                  </h4>
                </div>
                <div id="colapse4" class="panel-collapse in collapse" style="">
                  <div class="card-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                    3
                    wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                    laborum
                    eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                    nulla
                    assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                    nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft
                    beer
                    farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                    labore sustainable VHS.
                  </div>
                </div>
              </div>
            </div>

            <div id="accordion">
              <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
              <div class="card ">
                <div class="card-header">
                  <h4 class="card-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#colapse5" class="collapsed" aria-expanded="false">
                      Leccion 2
                    </a>
                  </h4>
                </div>
                <div id="colapse5" class="panel-collapse in collapse" style="">
                  <div class="card-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                    3
                    wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                    laborum
                    eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                    nulla
                    assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                    nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft
                    beer
                    farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                    labore sustainable VHS.
                  </div>
                </div>
              </div>
            </div>

            <div id="accordion">
              <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
              <div class="card ">
                <div class="card-header">
                  <h4 class="card-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#colapse6" class="collapsed" aria-expanded="false">
                      Leccion 3
                    </a>
                  </h4>
                </div>
                <div id="colapse6" class="panel-collapse in collapse" style="">
                  <div class="card-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                    3
                    wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                    laborum
                    eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                    nulla
                    assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                    nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft
                    beer
                    farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                    labore sustainable VHS.
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
