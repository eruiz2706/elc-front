@extends('layouts.adminlte.app')

@section('banner')
    @include('backend.partials.bannertop')
@endsection

@section('content')

<div class="container">
  <div class="row">
      <div class="col-md-3">
        @include('backend.partials.navuser')

        @include('backend.partials.navoptions')
      </div>

      <div class="col-md-9" style='padding-top:70px;'>
        <div class="row"  v-if="preload">
          <div class="d-block mx-auto" >
            <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 mb-3">
            <h1 class='pl-1' style='border-left:3px solid #007bff'>CURSO PROGRAMACION INTERACTIVA</h1>
          </div>

          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-0 mb-3">
              <!-- title row -->
              <div class="row">
                <!-- accepted payments column -->
                <div class="col-md-8">
                  <iframe class="img-fluid" style='width:100%;height:400px' frameborder="0" allowfullscreen allow="autoplay; encrypted-media"
                    src="https://www.youtube.com/embed/GCW1LzzdFsU">
                  </iframe>
                  <!--<img src="{{ URL::asset('rsc/dist/img/photo1.png') }}" alt="Photo" class="img-fluid">-->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                      <tr>
                          <td>
                              <img src="{{ URL::asset('rsc/dist/img/photo3.jpg') }}" alt="Ample Admin" class="media-object" style="width: 150px;height: auto;border-radius: 4px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
                          </td>
                      </tr>
                      <tr>
                        <th>DURACIÓN:</th>
                      </tr>
                      <tr>
                        <td>6 semanas (15 horas de estudio estimadas)</td>
                      </tr>
                      <tr>
                        <th>FECHA INICIO:</th>
                      </tr>
                      <tr>
                        <td>24 de septiembre 2018</td>
                      </tr>
                      <tr>
                        <th colspan='2'>
                          <button type="button" class="btn btn-block btn-outline-primary btn-sm" style="margin-right: 5px;">
                          <i class="fa fa-thumbs-o-up"></i> Unirse
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
<script src="{{ URL::asset('js/be/es/cursos/detcurso.js') }}"></script>
@stop
