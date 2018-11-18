

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
    <button type="button" class="btn btn-outline-primary btn-sm float-left" v-on:click="abrir(tarea.id)">
      Abrir tarea
    </button>
  </div>

</div>
<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/tareas/lista_es.js') }}"></script>
@stop
