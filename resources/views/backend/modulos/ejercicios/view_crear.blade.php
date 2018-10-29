@extends('layouts.adminlte.app')

@section('content')
<div class="row">
    <div class="col-md-3">
      @include('backend.nav.nav_user')

      @include('backend.nav.navoptions')
    </div>

    <div class="col-md-9" style='padding-top:70px;'>
        @include('backend.nav.tabcontent')

        @include('backend.modulos.ejercicios.partials.formcrear')
    </div>
</div>
@endsection
