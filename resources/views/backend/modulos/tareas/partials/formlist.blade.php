

<div class="row" v-if="preload">
  <div class="d-block mx-auto" >
    <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
  </div>
</div>

<div class="row" v-if="!preload">
  <div class="col-sm-6">
    <h5 class="m-0 text-dark">
      <strong>Lista de tareas</strong>
      <button type="button" class="btn btn-tool" v-on:click.prevent="redirectCrear()">
        <i class="fa fa-plus-circle"  style="font-size: 24px;"></i>
      </button>
    </h5>
  </div>
</div>

<div class="card" v-if="!preload" v-for="tarea in a_tareas">
  <div class="card-header no-border">
    <h5 class="card-title" style='cursor:pointer' v-on:click.prevent="redirectEdit(tarea.id)">@{{tarea.nombre}}</h5>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" v-on:click.prevent="redirectEdit(tarea.id)">
        <i class="fa  fa-pencil" style="font-size: 20px;"></i>
      </button>
    </div>

    <div class='row'>
      <div class="col-md-4 col-sm-6">
        <b>Creado :</b> @{{tarea.fecha_creacion}}
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Vence :</b> @{{tarea.fecha_vencimiento}}
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Califacion Sobre :</b> @{{tarea.calificacion}}
      </div>
      <div class="col-md-4 col-sm-6">
        <i class="fa fa-list-alt" style="cursor:pointer" v-on:click.prevent="redirectEnt(tarea.id)"></i> <b>Entregas :</b> @{{tarea.cant_respuest}}/@{{cantUser}}
      </div>
    </div>
</div>
</div>

<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/tareas/lista.js') }}"></script>
@stop
