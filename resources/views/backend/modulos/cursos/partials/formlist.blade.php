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
    <h5 class="card-title" style='cursor:pointer' v-on:click.prevent="redirectAbrir(curso.id)" v-text='curso.nombre'></h5>
    <div class='row'>
      <div class="col-md-4 col-sm-6">
        <b>Creado :</b> <span v-text='curso.fecha_creacion'></span>
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Inicia :</b> <span v-text='curso.fecha_inicio'></span>
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Finaliza :</b> <span v-text='curso.fecha_finalizacion'></span>
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Limite notas :</b> <span v-text='curso.fecha_limite'></span>
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Visibilidad :</b>
        <span class="badge bg-success" v-if="curso.visibilidad">Publico</span>
        <span class="badge bg-danger" v-else>Privado</span>
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Inscripcion :</b>
        <span class="badge bg-success" v-if="curso.inscripcion">Estudiante</span>
        <span class="badge bg-info" v-else>Administrador</span>
      </div>
      <div class="col-md-4 col-sm-6" v-for="profesor in curso.profesores">
        <b>Profesor :</b>
        <span v-text='profesor.email'></span>
      </div>

    </div>
</div>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/cursos/lista.js') }}"></script>
@stop
