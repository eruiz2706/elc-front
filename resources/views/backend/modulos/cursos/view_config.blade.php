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
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='' || menu_content=='cursos-edit') ? 'active' : ''" v-on:click.prevent="setMenuContent('cursos-edit')">Datos Basicos</a></li>
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='cursos-config') ? 'active' : ''" v-on:click.prevent="setMenuContent('cursos-config')">Datos Avanzados</a></li>
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='modulos-lista' || menu_content=='modulos-crear' || menu_content=='modulos-edit') ? 'active' : ''" v-on:click.prevent="setMenuContent('modulos-lista')">Modulos</a></li>
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='lecciones-lista' || menu_content=='lecciones-crear' || menu_content=='lecciones-edit') ? 'active' : ''" v-on:click.prevent="setMenuContent('lecciones-lista')">Lecciones</a></li>
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='foro-curso') ? 'active' : ''" v-on:click.prevent="setMenuContent('foro-curso')">Foro</a></li>
            <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='integrantes') ? 'active' : ''" v-on:click.prevent="setMenuContent('integrantes')">Integrantes</a></li>
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
@endsection
