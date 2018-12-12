@extends('layouts.adminlte.app')

@section('content')
<div class="row">
    <div class="col-md-3">
      @include('backend.nav.nav_user')
      @include('backend.nav.nav_options')
      @include('backend.nav.nav_social')
    </div>

    <div class="col-md-9"  style='padding-top:70px;' >
      <div class="row">
          <div class="col-md-12">
            <perfil-usu></perfil-usu>
          </div>
      </div>
    </div>
</div>
@endsection
