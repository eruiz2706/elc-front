

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
    <h5 class="card-title" style='cursor:pointer' v-on:click.prevent="redirectEdit(ejercicio.id)">@{{ejercicio.nombre}}</h5>
    <div class="card-tools">
      <div class="btn-group">
        <button type="button" class="btn btn-tool" v-on:click.prevent="redirectEdit(ejercicio.id)">
          <i class="fa  fa-pencil" style="font-size: 20px;"></i>
        </button>
        <button type="button" class="btn btn-tool" v-on:click.prevent="redirectPreguntas(ejercicio.id)">
          <i class="fa  fa-list-alt" style="font-size: 20px;"></i>
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
        <b>Preguntas :</b> @{{ejercicio.cant_preg}}
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Nota sobre :</b> @{{ejercicio.notamaxima}}
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Realizado :</b> 0/@{{cantUser}}
      </div>
    </div>
</div>
<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/ejercicios/lista.js') }}"></script>
@stop
