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
            {{trans('backend.tools')}}
          </h2>
        </div>
        <div class="card-body" style='padding:0px'>
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='' || menu_content=='diccionario') ? 'active' : ''" v-on:click.prevent="setMenuContent('diccionario')">{{trans('backend.dictionary')}}</a></li>
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='reproductor') ? 'active' : ''" v-on:click.prevent="setMenuContent('reproductor')">{{trans('backend.hear')}}</a></li>
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='pronunciacion') ? 'active' : ''" v-on:click.prevent="setMenuContent('pronunciacion')">{{trans('backend.pronunciation')}}</a></li>
          </ul>
        </div>
      </div>

      <div v-if="menu_content=='' || menu_content=='diccionario'">
          <diccionario></diccionario>
      </div>
      <div v-if="menu_content=='reproductor'">
        <reproductor></reproductor>
      </div>
      <div v-if="menu_content=='pronunciacion'">
        <pronunciacion></pronunciacion>
      </div>
    </div>

</div>
@endsection
