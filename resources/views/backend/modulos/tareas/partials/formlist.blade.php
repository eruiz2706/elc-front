

<div class="row" v-if="preload">
  <div class="d-block mx-auto" >
    <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
  </div>
</div>

<div class="card">
  <div class="card-header no-border">
    <h3 class="card-title">Lista de tareas</h3>

    <div class='card-tools'>
      <button type="button" class="btn float-right btn-primary btn-sm" v-on:click.prevent="crear()">Crear tarea</button>
    </div>
  </div>
  <div class="card-body p-0">
    <table class="table table-striped table-valign-middle">
      <thead>
      <tr>
        <th>Nombre</th>
        <th>Opciones</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="tarea in a_tareas">
        <td>
          @{{tarea.nombre}}
        </td>
        <td>
          <a href="#" v-on:click.prevent="editar(tarea.id)" class="text-muted">
            <i class="fa fa-edit"></i> Editar
          </a>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</div>

<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/tareas/lista.js') }}"></script>
@stop