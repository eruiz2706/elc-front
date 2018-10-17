@extends('layouts.adminlte.app')

@section('content')
<div class="row">
    <div class="col-md-3">
      @include('backend.nav.in.nav_user')

      @include('backend.nav.in.navoptions')
    </div>
    <div class="col-md-9" style='padding-top:70px;'>
      @include('backend.modulos.cursos.partials.formedit')
    </div>
</div>
@endsection
