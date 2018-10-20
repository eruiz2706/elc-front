@extends('layouts.adminlte.app')

@section('content')
<div class="row">
    <div class="col-md-3">
      @include('backend.nav.in.nav_user')

      @include('backend.nav.in.navoptions')
    </div>

    <div class="col-md-9" style='padding-top:70px;'>
        @include('backend.nav.in.tabcontent')

        @include('backend.modulos.modulos.partials.lista')
    </div>
</div>
@endsection
