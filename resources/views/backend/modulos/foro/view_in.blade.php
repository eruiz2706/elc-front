@extends('layouts.adminlte.app')

@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-3">
        @include('backend.nav.in.nav_user')

        @include('backend.nav.in.navoptions')
      </div>

      <div class="col-md-9" style='padding-top:70px;'>
        @include('backend.modulos.foro.partials.publicacion')
      </div>
  </div>
</div>
@endsection