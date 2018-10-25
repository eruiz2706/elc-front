@extends('layouts.unicat.app')

@section('htmlheader')
@parent
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/styles/responsive.css') }}">
@stop

@section('content')

<div class="features" style='padding-top:200px'>
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="section_title_container text-center">
          <h2 class="section_title">El usuario no tiene un rol asignado</h2>
          <div class="section_subtitle">
            <p>
              El usuario no cuenta con un rol asignado valido,
             por favor intente de nuevo, de persistir el error
             comuniquese con el administrador del sistema
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Newsletter -->
@include('frontend.partials.newsletter')


@endsection
