

<div class="row" v-if="preload">
  <div class="d-block mx-auto" >
    <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
  </div>
</div>

<div class="row" v-if="!preload">
  <div class="col-sm-6">
    <h5 class="m-0 text-dark">
      <strong>Lista de examenes</strong>
      <button type="button" class="btn btn-tool" v-on:click.prevent="redirectCrear()">
        <i class="fa fa-plus-circle"  style="font-size: 24px;"></i>
      </button>
    </h5>
  </div>
</div>

<div class="card" v-if="!preload" v-for="ejercicio in a_ejercicios">
  <div class="card-header no-border">
    <h5 class="card-title">@{{ejercicio.nombre}}</h5>
    <div class="card-tools">
      <div class="btn-group">
        <button type="button" class="btn btn-tool" v-on:click.prevent="redirectEdit(ejercicio.id)">
          <i class="fa  fa-pencil"></i>
        </button>
        <button type="button" class="btn btn-tool" v-on:click.prevent="redirectPreguntas(ejercicio.id)">
          <i class="fa  fa-list-alt"></i>
        </button>
      </div>
    </div>

    <div class='row'>
      <div class="col-md-4 col-sm-6">
        <b>Creado :</b> @{{ejercicio.fecha_creacion}}
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Inicia :</b> @{{ejercicio.fecha_inicio}}
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Duracion :</b> @{{ejercicio.duracion}} minutos
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Realizado :</b> 0/12
      </div>
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
<script src="{{ URL::asset('js/be/modulos/ejercicios/lista.js') }}"></script>
@stop
