@extends('layouts.adminlte.app')

@section('content')
<div class="row">
    <div class="col-md-3">
      @include('backend.nav.pr.nav_user')

      @include('backend.nav.pr.navoptions')
    </div>

    <div class="col-md-9" style='padding-top:70px;'>
      @include('backend.modulos.foro.partials.publicacion')
    </div>
</div>
@endsection
