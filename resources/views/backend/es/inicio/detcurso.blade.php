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
      </div>

      <div class="col-md-9" style='padding-top:70px;'>
        <div class="row"  v-if="preload">
          <div class="d-block mx-auto" >
            <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <!-- accepted payments column -->
                <div class="col-md-6">
                  <img src="{{ URL::asset('rsc/dist/img/photo1.png') }}" alt="Photo" class="img-fluid">
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead"><strong>@{{obj_curso.nombre}}</strong></p>

                  <div class="table-responsive">
                    <table class="table">
                      <tbody><tr>
                        <th style="width:50%">DURACIÓN:</th>
                        <td>$250.30</td>
                      </tr>
                      <tr>
                        <th>FECHA DE INICIO</th>
                        <td>$10.34</td>
                      </tr>
                      <tr>
                        <th>&nbsp;</th>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <th colspan='2'>
                          <button type="button" class="btn btn-primary float-right btn-block" style="margin-right: 5px;">
                          <i class="fa fa-download"></i> Registrate
                          </button>
                        </td>
                      </tr>
                    </tbody></table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div>

        <div class='row'>
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fa fa-text-width"></i>
                  Descripcion del curso
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <dl class="dl-horizontal">
                  <dt>Description lists</dt>
                  <dd>A description list is perfect for defining terms.</dd>
                  <dt>Euismod</dt>
                  <dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
                  <dd>Donec id elit non mi porta gravida at eget metus.</dd>
                  <dt>Malesuada porta</dt>
                  <dd>Etiam porta sem malesuada magna mollis euismod.</dd>
                  <dt>Felis euismod semper eget lacinia</dt>
                  <dd>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo
                    sit amet risus.
                  </dd>
                </dl>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <input type='hidden' name='id' id='id' value="{{$idcurso}}"></input>
      </div>
  </div>
</div>
@endsection

@section('scripts')
@parent
<script src="{{ URL::asset('js/be/es/inicio/detcurso.js') }}"></script>
@stop
