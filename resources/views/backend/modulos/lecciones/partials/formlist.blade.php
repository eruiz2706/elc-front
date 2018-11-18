

<div class="row" v-if="preload">
  <div class="d-block mx-auto" >
    <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
  </div>
</div>

<div class="row" v-if="!preload">
  <div class="col-md-12 col-sm-12">
    <h5 class="m-0 text-dark">
      <strong>Lista de lecciones</strong>
      <button type="button" class="btn btn-tool" v-on:click.prevent="redirectCrear()">
        <i class="fa fa-plus-circle"  style="font-size: 24px;"></i>
      </button>
    </h5>
  </div>
</div>

<div class="row" v-if="!preload">
  <div class='col-md-12'>
    <div class="form-group">
    <select class="form-control" name="select_mod" v-model='idmodulo' @change="busqueda_modulo">
      <option v-bind:value='0'>Seleccione un modulo</option>
      <option v-bind:value='s_mod.id' v-for='s_mod in select_mod'>@{{s_mod.nombre}}</option>
    </select>
    </div>
  </div>
</div>
<div class="card" v-if="!preload" v-for="leccion in a_leccion">
  <div class="card-header no-border">
    <h5 class="card-title" style='cursor:pointer' v-on:click.prevent="redirectEdit(leccion.id)">Leccion @{{leccion.numero}}</h5>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" v-on:click.prevent="redirectEdit(leccion.id)">
        <i class="fa  fa-pencil" style='font-size:20px'></i>
      </button>
    </div>

    <div class='row'>
      <div class="col-md-4 col-sm-6">
        <b>Nombre :</b> @{{leccion.nombre}}
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Creado :</b> @{{leccion.fecha_creacion}}
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Tiempo de lectura :</b> @{{leccion.tiempolectura}} minutos
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Modulo :</b> @{{leccion.nommod}}
      </div>
    </div>
  </div>
</div>

<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/lecciones/lista.js') }}"></script>
@stop
