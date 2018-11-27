
<div class="row" v-if="preload">
  <div class="d-block mx-auto" >
    <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
  </div>
</div>

<div class="row" v-if="!preload">
  <div class="col-md-12 col-sm-12">
    <h5 class="m-0 text-dark">
      <strong>Lista de modulos</strong>
      <button type="button" class="btn btn-tool" v-on:click.prevent="redirectCrear()">
        <i class="fa fa-plus-circle"  style="font-size: 24px;"></i>
      </button>
    </h5>
  </div>
</div>

<div class="card"  v-for="modulo in a_modulos">
  <div class="card-header no-border">
    <h5 class="card-title" style='cursor:pointer' v-on:click.prevent="redirectEdit(modulo.id)">Modulo <span v-text='modulo.numero'></span></h5>
    <div class="card-tools">
      <div class="btn-group">
        <button type="button" class="btn btn-tool" v-on:click.prevent="redirectEdit(modulo.id)">
          <i class="fa  fa-pencil" style="font-size: 20px;"></i>
        </button>
      </div>
    </div>

    <div class='row'>
      <div class="col-md-4 col-sm-6">
        <b>Nombre :</b> <span v-text='modulo.nombre'></span>
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Creado :</b> <span v-text='modulo.fecha_creacion'></span>
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Lecciones :</b> <span v-text='modulo.numlec'></span>
      </div>
    </div>
</div>

<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/modulos/lista.js') }}"></script>
@stop
