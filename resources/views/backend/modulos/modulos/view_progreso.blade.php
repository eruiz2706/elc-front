@extends('layouts.adminlte.app')

@section('content')
<div class="row">
    <div class="col-md-3">
      @include('backend.nav.es.nav_user')

      @include('backend.nav.es.navoptions')
    </div>

    <div class="col-md-9" style='padding-top:70px;'>
        @include('backend.nav.es.tabcontent')

        @include('backend.modulos.modulos.partials.progreso')
    </div>
</div>
@endsection
