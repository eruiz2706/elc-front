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
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='' || menu_content=='cursos-edit') ? 'active' : ''" v-on:click.prevent="setMenuContent('cursos-edit')">{{trans('backend.basic_data')}}</a></li>
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='cursos-config') ? 'active' : ''" v-on:click.prevent="setMenuContent('cursos-config')">{{trans('backend.advanced_data')}}</a></li>
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='modulos-lista' || menu_content=='modulos-crear' || menu_content=='modulos-edit') ? 'active' : ''" v-on:click.prevent="setMenuContent('modulos-lista')">{{trans('backend.modules')}}</a></li>
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='lecciones-lista' || menu_content=='lecciones-crear' || menu_content=='lecciones-edit') ? 'active' : ''" v-on:click.prevent="setMenuContent('lecciones-lista')">{{trans('backend.lessons')}}</a></li>
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='examenes-lista' || menu_content=='examenes-crear' || menu_content=='examenes-edit' || menu_content=='examenes-lista-entrega' || menu_content=='preguntas-lista' || menu_content=='preguntas-crear' || menu_content=='preguntas-edit') ? 'active' : ''" v-on:click.prevent="setMenuContent('examenes-lista')">{{trans('backend.test')}}</a></li>
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='foro-curso') ? 'active' : ''" v-on:click.prevent="setMenuContent('foro-curso')">{{trans('backend.forum')}}</a></li>
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='integrantes') ? 'active' : ''" v-on:click.prevent="setMenuContent('integrantes')">{{trans('backend.members')}}</a></li>
          </ul>
        </div>
      </div>

      <div v-if="menu_content=='' || menu_content=='cursos-edit'">
        <cursos-edit></cursos-edit>
      </div>
      <div v-if="menu_content=='cursos-config'">
        <cursos-config></cursos-config>
      </div>
      <div v-if="menu_content=='modulos-lista'">
        <modulos-lista></modulos-lista>
      </div>
      <div v-if="menu_content=='modulos-crear'">
        <modulos-crear></modulos-crear>
      </div>
      <div v-if="menu_content=='modulos-edit'">
        <modulos-edit></modulos-edit>
      </div>
      <div v-if="menu_content=='lecciones-lista'">
        <lecciones-lista></lecciones-lista>
      </div>
      <div v-if="menu_content=='lecciones-crear'">
        <lecciones-crear></lecciones-crear>
      </div>
      <div v-if="menu_content=='lecciones-edit'">
        <lecciones-edit></lecciones-edit>
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
      <div v-if="menu_content=='foro-curso'">
        <foro-curso></foro-curso>
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
