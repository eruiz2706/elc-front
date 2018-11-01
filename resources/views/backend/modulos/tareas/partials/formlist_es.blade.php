

<div class="row" v-if="preload">
  <div class="d-block mx-auto" >
    <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
  </div>
</div>

<div class="card" v-if="!preload" v-for="tarea in a_tareas">
  <div class="card-header no-border">
    <h5 class="card-title">@{{tarea.nombre}}</h5>

    <div class='row'>
      <div class="col-md-4 col-sm-6">
        <b><i class="fa  fa-clock-o"></i> Vence :</b> @{{tarea.fecha_vencimiento}}
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Calificacion Sobre :</b> @{{tarea.calificacion}}
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Estado :</b>
        <small class="badge badge-danger">Pendiente por Entregar</small>
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Nota :</b>
      </div>
    </div>
  </div>
  <div class="card-body">
    <button type="button" class="btn btn-outline-primary btn-sm float-left">
      Entregar
    </button>
  </div>

</div>

<!--<div class="card" v-if="!preload">
  <div class="card-header no-border">
    <h3 class="card-title">Lista de tareas</h3>

    <div class="card-tools">
      <div class="btn-group">
        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <i class="fa  fa-bars"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right" role="menu" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(45px, 31px, 0px);">
          <a href="#" class="dropdown-item" v-on:click.prevent="redirectCrear()">Nueva tarea</a>
        </div>
      </div>
    </div>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-striped table-valign-middle ">
      <thead>
      <tr>
        <th>Nombre</th>
        <th>Vencimiento</th>
        <th>Creado</th>
        <th>Calificacion sobre</th>
        <th>Entregas</th>
        <th>Acciones</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="tarea in a_tareas">
        <td>
          @{{tarea.nombre}}
        </td>
        <td>
          @{{tarea.fecha_vencimiento}}
        </td>
        <td>
          @{{tarea.fecha_creacion}}
        </td>
        <td>
          @{{tarea.calificacion}}
        </td>
        <td>
          0/12
        </td>
        <td>
          <a href="#" v-on:click.prevent="redirectEdit(tarea.id)" class="text-muted">
            <i class="fa fa-edit"></i> Editar
          </a><br>
          <a href="#" class="text-muted">
            <i class="fa fa-eye"></i> Ver
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
<script src="{{ URL::asset('js/be/modulos/tareas/lista_es.js') }}"></script>
@stop
