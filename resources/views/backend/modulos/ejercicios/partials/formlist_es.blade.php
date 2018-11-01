

<div class="row" v-if="preload">
  <div class="d-block mx-auto" >
    <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
  </div>
</div>

<div class="card" v-if="!preload" v-for="ejercicio in a_ejercicios">
  <div class="card-header no-border">
    <h5 class="card-title">@{{ejercicio.nombre}}</h5>

    <div class='row'>
      <div class="col-md-4 col-sm-6">
        <b>Inicia :</b> @{{ejercicio.fecha_inicio}}
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Duracion :</b> @{{ejercicio.duracion}} minutos
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Estado :</b>
        <small class="badge badge-danger">Pendiente</small>
      </div>
    </div>
  </div>

  <div class="card-body">
    <button type="button" class="btn btn-outline-primary btn-sm float-left">
      Comenzar
    </button>
  </div>
</div>

<!--<div class="card">
  <div class="card-header no-border">
    <h3 class="card-title">Lista de examenes</h3>

    <div class="card-tools">
      <div class="btn-group">
        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <i class="fa  fa-bars"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right" role="menu" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(45px, 31px, 0px);">
          <a href="#" class="dropdown-item" v-on:click.prevent="redirectCrear()">Nuevo examen</a>
        </div>
      </div>
    </div>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-striped table-valign-middle ">
      <thead>
      <tr>
        <th>Nombre</th>
        <th>Duracion</th>
        <th>Inicia</th>
        <th>Creado</th>
        <th>Realizado</th>
        <th>Acciones</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="ejercicio in a_ejercicios">
        <td>
          @{{ejercicio.nombre}}
        </td>
        <td>
          @{{ejercicio.duracion}} minutos
        </td>
        <td>
          @{{ejercicio.fecha_inicio}}
        </td>
        <td>
          @{{ejercicio.fecha_creacion}}
        </td>
        <td>
          0/12
        </td>
        <td>
          <a href="#" v-on:click.prevent="redirectEdit(ejercicio.id)" class="text-muted">
            <i class="fa fa-edit"></i> Editar
          </a><br>
          <a href="#" v-on:click.prevent="redirectPreguntas(ejercicio.id)" class="text-muted">
            <i class="fa fa-edit"></i> Preguntas
          </a>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</div>-->

<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/ejercicios/lista_es.js') }}"></script>
@stop
