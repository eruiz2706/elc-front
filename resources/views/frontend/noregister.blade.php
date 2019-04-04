@extends('layouts.unicat.app')

@section('htmlheader')
@parent
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/styles/style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/styles/responsive.css') }}">
@stop

@section('content')

<div class="features" style='padding-top:200px'>
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="section_title_container text-center">
          <h2 class="section_title">{{trans('frontend.no_register')}}</h2>
          
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Newsletter -->
@include('frontend.partials.newsletter')
@endsection
@section('scripts')
  @parent
  <script src="{{ URL::asset('js/fe/registro.js') }}"></script>
  <!--<script src="{{ URL::asset('js/fe/noregister.js') }}"></script>-->
@stop
