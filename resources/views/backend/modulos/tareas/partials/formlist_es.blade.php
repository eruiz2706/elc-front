

<div class="row" v-if="preload">
  <div class="d-block mx-auto" >
    <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
  </div>
</div>

<div class="card" v-if="!preload" v-for="tarea in a_tareas">
  <div class="card-header no-border">
    <h5 class="card-title" v-text='tarea.nombre'></h5>

    <div class='row'>
      <div class="col-md-4 col-sm-6">
        <b><i class="fa  fa-clock-o"></i> Vence :</b> <span v-text='tarea.fecha_vencimiento'></span>
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Calificacion Sobre :</b> <span v-text='tarea.calificacion'></span>
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Estado :</b>
        <small v-bind:class="'badge badge-'+tarea.status"><span v-text='tarea.nombestado'></span></small>
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Nota : <span v-text='tarea.notaes'></span></b>
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
