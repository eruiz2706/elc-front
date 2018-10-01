@extends('layouts.adminlte.app')

@section('banner')
      @include('backend.elementos.bannertop')
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

      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
@parent

@stop
