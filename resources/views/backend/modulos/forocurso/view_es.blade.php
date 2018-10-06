@extends('layouts.adminlte.app')

@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-3">
        @include('backend.nav.es.nav_user')

        @include('backend.nav.es.navoptions')
      </div>

      <div class="col-md-9" style='padding-top:70px;'>
        @include('backend.nav.es.tabcontent')

        @include('backend.modulos.forocurso.partials.publicacion')
      </div>
  </div>
</div>
@endsection
