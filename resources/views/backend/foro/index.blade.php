@extends('layouts.adminlte.app')

@section('banner')
  @include('backend.elementos.bannertop')
@endsection

@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-3">
        @include('backend.nav.index')

        @if(Session::get('rol')=='es')
          @include('backend.es.navcursos')
        @endif
</div>

      <div class="col-md-9" style='padding-top:70px;'>
        @include('backend.foro.partials.publicacion')


      </div>
  </div>
</div>
@endsection

@section('scripts')
@parent
<script src="{{ URL::asset('js/be/foro/index.js') }}"></script>
@stop
