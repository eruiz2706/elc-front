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
          @include('backend.es.inicio.cursos')
      </div>
  </div>
</div>
@endsection

@section('scripts')
@parent
<script src="{{ URL::asset('js/be/es/inicio/index.js') }}"></script>
@stop
