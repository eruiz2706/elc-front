@extends('layouts.adminlte.app')

@section('banner')
<div class="img-bannerhome" style="background-image: url('{{ URL::asset('img/app/slide.jpg') }}');">
</div>
@endsection

@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-3">
        @include('backend.pa.nav')
      </div>

      <div class="col-md-9" style='padding-top:70px;'>
        <div class="row" style='display:none'>
        <!--<div class="row"  v-if="preload">-->
          <div class="d-block mx-auto" >
            <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection

@section('scripts')
@parent
@stop
