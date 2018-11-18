<div class="row" v-if="preload">
  <div class="d-block mx-auto" >
    <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
  </div>
</div>

<div class="card" v-if="!preload">
  <div class="card-header card-header-cuorse">
    <h2 class="card-title-course">Lista de cursos</h2>
  </div>
</div>
<div class="card" v-if="!preload" v-for="curso in a_cursos">
  <div class="card-header no-border">
    <div class="card-tools float-left">
      <button type="button" class="btn btn-tool" v-on:click.prevent="redirectAbrir(curso.id)">
            Ingresar <i class="fa fa-folder-open" style="font-size:20px"></i>
      </button>
    </div>
    <h5 class="card-title" style='cursor:pointer' v-on:click.prevent="redirectAbrir(curso.id)">@{{curso.nombre}}</h5>
    <div class='row'>
      <div class="col-md-4 col-sm-6">
        <b>Creado :</b> @{{curso.fecha_creacion}}
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Inicia :</b> @{{curso.fecha_inicio}}
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Finaliza :</b> @{{curso.fecha_finalizacion}}
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Limite notas :</b> @{{curso.fecha_limite}}
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Visibilidad :</b>
        <span class="badge bg-success" v-if="curso.visibilidad">Publico</span>
        <span class="badge bg-danger" v-if="!curso.visibilidad">Privado</span>
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Inscripcion :</b>
        <span class="badge bg-success" v-if="curso.inscripcion">Estudiante</span>
        <span class="badge bg-info" v-if="!curso.inscripcion">Administrador</span>
      </div>
    </div>
</div>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/cursos/lista.js') }}"></script>
@stop
