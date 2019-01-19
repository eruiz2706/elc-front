@extends('layouts.adminlte.app')

@section('content')
<div class="row">
    <div class="col-md-3">
      @include('backend.nav.nav_user')
      @include('backend.nav.nav_options')
      @include('backend.nav.nav_social')
    </div>

    <div class="col-md-9" style='padding-top:70px;'>
      <div v-if="menu_content=='' || menu_content=='ofertados'">
          <ofertados-lista></ofertados-lista>
      </div>
      <div v-if="menu_content=='ofertados_det'">
          <ofertados-detalle></ofertados-detalle>
      </div>
    </div>
</div>
<input type='hidden' name='id' id='id' value=""></input>
@endsection
