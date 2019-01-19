@extends('layouts.adminlte.app')

@section('content')
<div class="row">
    <div class="col-md-3">
      @include('backend.nav.nav_user')
      @include('backend.nav.nav_options')
      @include('backend.nav.nav_social')
    </div>

    <div class="col-md-9" style='padding-top:70px;'>
      <div v-if="menu_content=='cursos' || menu_content==''">
          <cursos-lista></cursos-lista>
      </div>
      <div v-if="menu_content=='cursos-crear'">
        <cursos-crear></cursos-crear>
      </div>
    </div>
</div>
@endsection
