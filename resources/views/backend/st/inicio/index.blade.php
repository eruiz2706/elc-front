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
        @include('backend.st.nav')
      </div>

      <div class="col-md-9" style='padding-top:70px;'>
          @include('backend.st.inicio.course')
      </div>
  </div>
</div>
@endsection

@section('scripts')
@parent

@stop
