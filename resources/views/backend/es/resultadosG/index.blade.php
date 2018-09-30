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
            @include('backend.es.navtabgeneral')

            <div class="col-md-12">
          <p class="text-center">
            <strong>Evaluaciones</strong>
          </p>

          <div class="progress-group">
            Examen1
            <span class="float-right"><b>160</b>/200</span>
            <div class="progress progress-sm">
              <div class="progress-bar bg-primary" style="width: 80%"></div>
            </div>
          </div>
          <!-- /.progress-group -->

          <div class="progress-group">
            Examen2
            <span class="float-right"><b>310</b>/400</span>
            <div class="progress progress-sm">
              <div class="progress-bar bg-danger" style="width: 75%"></div>
            </div>
          </div>

          <!-- /.progress-group -->
          <div class="progress-group">
            Examen3
            <span class="float-right"><b>250</b>/500</span>
            <div class="progress progress-sm">
              <div class="progress-bar bg-warning" style="width: 50%"></div>
            </div>
          </div>
          <!-- /.progress-group -->
        </div>

        <div class="col-md-12">
                  <p class="text-center">
                    <strong>Tareas</strong>
                  </p>

                  <div class="progress-group">
                    tarea1
                    <span class="float-right"><b>160</b>/200</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-primary" style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->

                  <div class="progress-group">
                    tarea2
                    <span class="float-right"><b>310</b>/400</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-danger" style="width: 75%"></div>
                    </div>
                  </div>

                  <!-- /.progress-group -->
                  <div class="progress-group">
                    tarea3
                    <span class="float-right"><b>250</b>/500</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-warning" style="width: 50%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
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
