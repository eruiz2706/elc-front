@extends('layouts.adminlte.app')

@section('content')
<div class="row">
    <div class="col-md-3">
      @include('backend.nav.in.nav_user')

      @include('backend.nav.in.navoptions')
    </div>

    <div class="col-md-9" style='padding-top:70px;'>
      @include('backend.modulos.cursos.partials.listacursos')
    </div>
</div>
@endsection

@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/cursos/lista.js') }}"></script>
@stop
