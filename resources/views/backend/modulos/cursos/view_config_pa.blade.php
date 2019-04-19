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
          <h2 class="card-title-course" style="padding-right:50px">
            @if(isset($curso))
              {{$curso->nombre}}
            @endif

            @if(isset($profesor))
              @foreach($profesor as $prof)
                <p><small>{{$prof->nombre}}</small></p>
              @endforeach
            @endif
          </h2>
        </div>
        <div class="card-body" style='padding:0px'>
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='' || menu_content=='progreso-pa') ? 'active' : ''" v-on:click.prevent="setMenuContent('progreso-pa')">{{trans('backend.progress')}}</a></li>
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='calendario') ? 'active' : ''" v-on:click.prevent="setMenuContent('calendario')">{{trans('backend.calendar')}}</a></li>
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='resultados-pa') ? 'active' : ''" v-on:click.prevent="setMenuContent('resultados-pa')">{{trans('backend.results')}}</a></li>
          </ul>
        </div>
      </div>

      <div v-if="menu_content=='' || menu_content=='progreso-pa'">
        <progreso-pa></progreso-pa>
      </div>
      <div v-if="menu_content=='calendario'">
        <calendario></calendario>
      </div>
      <div v-if="menu_content=='resultados-pa'">
        <resultados-pa></resultados-pa>
      </div>
    </div>

</div>
<input type='text' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
<input type='text' name='id' id='id' value=""></input>
<input type='text' name='idest' id='idest' value="{{$id2}}"></input>
@endsection
