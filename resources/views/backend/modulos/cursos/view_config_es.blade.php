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
            @if(isset($curso))
              {{$curso->nombre}}
            @endif

            @if(isset($profesor))
              @foreach($profesor as $prof)
                <p><small>{{$prof->nombre}}</small></p>
              @endforeach
            @endif
          </h2>
          <div class="card-tools">
            <div style="width:50px;display:inline">
              @if(isset($profesor))
                @foreach($profesor as $prof)
                  <img class="profile-user-img img-circle img-bordered-sm img-fluid" src="{{ URL::asset($prof->imagen) }}" style='cursor:pointer'>
                @endforeach
              @endif
            </div>
          </div>
        </div>
        <div class="card-body" style='padding:0px'>
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='' || menu_content=='foro-curso') ? 'active' : ''" v-on:click.prevent="setMenuContent('foro-curso')">Foro</a></li>
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='progreso-es') ? 'active' : ''" v-on:click.prevent="setMenuContent('progreso-es')">Progreso</a></li>
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='tareas-lista-es' || menu_content=='tareas-entrega-es') ? 'active' : ''" v-on:click.prevent="setMenuContent('tareas-lista-es')">Tareas</a></li>
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='examenes-lista-es') ? 'active' : ''" v-on:click.prevent="setMenuContent('examenes-lista-es')">Examenes</a></li>
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='calendario') ? 'active' : ''" v-on:click.prevent="setMenuContent('calendario')">Calendario</a></li>
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='resultados-es') ? 'active' : ''" v-on:click.prevent="setMenuContent('resultados-es')">Resultados</a></li>
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='integrantes') ? 'active' : ''" v-on:click.prevent="setMenuContent('integrantes')">Integrantes</a></li>
          </ul>
        </div>
      </div>

      <div v-if="menu_content=='' || menu_content=='foro-curso'">
        <foro-curso></foro-curso>
      </div>
      <div v-if="menu_content=='progreso-es'">
        <progreso-es></progreso-es>
      </div>
      <div v-if="menu_content=='tareas-lista-es'">
        <tareas-lista-es></tareas-lista-es>
      </div>
      <div v-if="menu_content=='tareas-entrega-es'">
        <tareas-entrega-es></tareas-entrega-es>
      </div>
      <div v-if="menu_content=='examenes-lista-es'">
        <examenes-lista-es></examenes-lista-es>
      </div>
      <div v-if="menu_content=='calendario'">
        <calendario></calendario>
      </div>
      <div v-if="menu_content=='resultados-es'">
        <resultados-es></resultados-es>
      </div>
      <div v-if="menu_content=='integrantes'">
        <integrantes></integrantes>
      </div>
    </div>

</div>
<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
<input type='hidden' name='id' id='id' value=""></input>
@endsection
