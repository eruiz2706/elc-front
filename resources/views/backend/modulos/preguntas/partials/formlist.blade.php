
<div class="row" v-if="preload">
  <div class="d-block mx-auto" >
    <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
  </div>
</div>

<div class="row" v-if="!preload">
  <div class="col-sm-6">
    <h5 class="m-0 text-dark">
      <strong>Preguntas </strong>
      <button type="button" class="btn btn-tool" v-on:click.prevent="redirectVolver()">
        <i class="fa fa-arrow-circle-left" style="font-size: 24px;"></i>
      </button>
      <button type="button" class="btn btn-tool" v-on:click.prevent="redirectCrear()">
        <i class="fa fa-plus-circle"  style="font-size: 24px;"></i>
      </button>
    </h5>
  </div>
</div>

<div class="card" v-if="!preload" v-for="pregunta in a_preguntas">
  <div class="card-header no-border">
    <h5 class="card-title" style='cursor:pointer' v-on:click.prevent="redirectEdit(pregunta.id)" v-text='pregunta.nombre'></h5>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" v-on:click.prevent="redirectEdit(pregunta.id)">
        <i class="fa  fa-pencil" style="font-size: 20px;"></i>
      </button>
    </div>

    <div class='row'>
      <div class="col-md-4 col-sm-6">
        <b>Tipo :</b> <span v-text='pregunta.tipo'></span>
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Creado :</b> <span v-text='pregunta.fecha_creacion'></span>
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Puntaje :</b> <span v-text='pregunta.puntaje'></span>
      </div>
    </div>
</div>
</div>


<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
<input type='hidden' name='idejerc' id='idejerc' value="{{$idejerc}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/preguntas/lista.js') }}"></script>
@stop
