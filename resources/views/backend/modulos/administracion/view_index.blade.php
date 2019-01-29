@extends('layouts.adminlte.app')

@section('content')
<div class="row">
    <div class="col-md-3">
      @include('backend.nav.nav_user')
      @include('backend.nav.nav_options')
      @include('backend.nav.nav_social')

    </div>
    <div class="col-md-9" style='padding-top:70px;'>
      <div class="card card-primary card-outline">
        <div class="card-header card-header-cuorse">
          <h2 class="card-title-course">
            Administraciòn
          </h2>
        </div>
        <div class="card-body" style='padding:0px'>
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='' || menu_content=='usuarios-lista') ? 'active' : ''" v-on:click.prevent="setMenuContent('usuarios-lista')">Lista de Usuarios</a></li>
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='pago-manual') ? 'active' : ''" v-on:click.prevent="setMenuContent('pago-manual')">Pago Manual</a></li>
          </ul>
        </div>
      </div>

      <div v-if="menu_content=='' || menu_content=='usuarios-lista'">
        <usuarios-lista></usuarios-lista>
      </div>
      <div v-if="menu_content=='pago-manual'">
        
      </div>
    </div>

</div>

@endsection
