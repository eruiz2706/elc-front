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
          </h2>
        </div>
        <div class="card-body" style='padding:0px'>
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='' || menu_content=='foro-curso') ? 'active' : ''" v-on:click.prevent="setMenuContent('foro-curso')">Foro</a></li>
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='progreso-pr') ? 'active' : ''" v-on:click.prevent="setMenuContent('progreso-pr')">Progreso</a></li>
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='tareas-lista' || menu_content=='tareas-crear' || menu_content=='tareas-edit' || menu_content=='tareas-lista-entrega') ? 'active' : ''" v-on:click.prevent="setMenuContent('tareas-lista')">Tareas</a></li>
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='examenes-lista' || menu_content=='examenes-crear' || menu_content=='examenes-edit' || menu_content=='examenes-lista-entrega' || menu_content=='preguntas-lista' || menu_content=='preguntas-crear' || menu_content=='preguntas-edit') ? 'active' : ''" v-on:click.prevent="setMenuContent('examenes-lista')">Examenes</a></li>
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='calendario') ? 'active' : ''" v-on:click.prevent="setMenuContent('calendario')">Calendario</a></li>
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='integrantes') ? 'active' : ''" v-on:click.prevent="setMenuContent('integrantes')">Integrantes</a></li>
          </ul>
        </div>
      </div>

      <div v-if="menu_content=='' || menu_content=='foro-curso'">
        <foro-curso></foro-curso>
      </div>
      <div v-if="menu_content=='progreso-pr'">
        <progreso-pr></progreso-pr>
      </div>
      <div v-if="menu_content=='tareas-lista'">
        <tareas-lista></tareas-lista>
      </div>
      <div v-if="menu_content=='tareas-crear'">
        <tareas-crear></tareas-crear>
      </div>
      <div v-if="menu_content=='tareas-edit'">
        <tareas-edit></tareas-edit>
      </div>
      <div v-if="menu_content=='tareas-lista-entrega'">
        <tareas-lista-entrega></tareas-lista-entrega>
      </div>
      <div v-if="menu_content=='examenes-lista'">
        <examenes-lista></examenes-lista>
      </div>
      <div v-if="menu_content=='examenes-crear'">
        <examenes-crear></examenes-crear>
      </div>
      <div v-if="menu_content=='examenes-edit'">
        <examenes-edit></examenes-edit>
      </div>
      <div v-if="menu_content=='examenes-lista-entrega'">
        <examenes-lista-entrega></examenes-lista-entrega>
      </div>
      <div v-if="menu_content=='preguntas-lista'">
        <preguntas-lista></preguntas-lista>
      </div>

      <div v-if="menu_content=='preguntas-crear'">
        <preguntas-crear></preguntas-crear>
      </div>

      <div v-if="menu_content=='preguntas-edit'">
        <preguntas-edit></preguntas-edit>
      </div>

      <div v-if="menu_content=='calendario'">
        <calendario></calendario>
      </div>

      <div v-if="menu_content=='integrantes'">
        <integrantes></integrantes>
      </div>
    </div>

</div>
<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
<input type='hidden' name='id' id='id' value=""></input>
<input type='hidden' name='id2' id='id2' value=""></input>
@endsection
