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
            Ingresar <i class="fa fa-folder-open"></i>
      </button>
    </div>
    <h5 class="card-title">@{{curso.nombre}}</h5>
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

<!--<div class="card" v-if="!preload">
  <div class="card-header no-border">
    <h3 class="card-title">Lista Cursos</h3>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-striped table-valign-middle ">
      <thead>
      <tr>
        <th>Nombre</th>
        <th>Visibilidad</th>
        <th>Inicia</th>
        <th>Finaliza</th>
        <th>Creado</th>
        <th>Acciones</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="curso in a_cursos">
        <td>
          @{{curso.nombre}}
        </td>
        <td>
          <span class="badge bg-success" v-if="curso.visibilidad">Publico</span>
          <span class="badge bg-danger" v-if="!curso.visibilidad">Privado</span>
        </td>
        <td>
          @{{curso.fecha_inicio}}
        </td>
        <td>
          @{{curso.fecha_finalizacion}}
        </td>
        <td>
          @{{curso.fecha_creacion}}
        </td>
        <td>
          <a href="#" class="text-muted" v-on:click.prevent="redirectEdit(curso.id)">
            <i class="fa fa-edit"></i> Editar
          </a><br>
          <a href="#"  class="text-muted" v-on:click.prevent="redirectAbrir(curso.id)">
            <i class="fa fa-folder-open-o"></i> Abrir
          </a>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</div>-->

@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/cursos/lista.js') }}"></script>
@stop
