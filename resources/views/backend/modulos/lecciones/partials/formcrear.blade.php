
<div class="row" v-show="preload">
  <div class="d-block mx-auto" >
    <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
  </div>
</div>

<div class="row" v-show="!preload">
  <div class="col-md-6 col-sm-6">
    <h5 class="m-0 text-dark">
      <strong>Nueva leccion</strong>
      <button type="button" class="btn btn-tool" v-on:click.prevent="redirectVolver()">
        <i class="fa fa-arrow-circle-left"  style="font-size: 24px;"></i>
      </button>
    </h5>
  </div>
</div>

<div class="card" v-show="!preload">
  <div class="card-body">
    <div class="callout callout-info">
    	<p>
    	  <i class="fa fa-fw fa-info"></i>Los campos marcados en <code>*</code> son obligatorios
    	</p>
    </div>

    <div class="form-group">
      <label>Modulo <code>*</code></label>
      <select class="form-control" name="select_mod" v-model='o_leccion.modulo' v-bind:class="[e_leccion.modulo ? 'is-invalid' : '']">
        <option v-bind:value="''"> - </option>
        <option v-bind:value='s_mod.id' v-for='s_mod in select_mod' v-text='s_mod.nombre'></option>
      </select>
      <span class="text-danger" v-if="e_leccion.modulo" v-text='e_leccion.modulo[0]'></span>
    </div>

    <div class="form-group ">
      <label>Numero <code>*</code></label>
      <input type="number" step="0.01" class="form-control" name='numero'  v-model='o_leccion.numero' v-bind:class="[e_leccion.numero ? 'is-invalid' : '']">
      <span class="text-danger" v-if="e_leccion.numero" v-text='e_leccion.numero[0]'></span>
    </div>

    <div class="form-group">
      <label>Nombre <code>*</code></label>
      <input type="text" class="form-control" name='nombre'  v-model='o_leccion.nombre' v-bind:class="[e_leccion.nombre ? 'is-invalid' : '']">
      <span class="text-danger" v-if="e_leccion.nombre" v-text='e_leccion.nombre[0]'></span>
    </div>

    <div class="form-group">
    <label>Tiempo de lectura(Minutos)</label>
      <input type="number" class="form-control" name='tiempo' min="0" max="1000"  v-model='o_leccion.tiempolectura'>
    </div>

    <div class="form-group">
      <div id="summernote"></div>
    </div>

    <button type="button" class="btn btn-outline-primary btn-sm float-left" :disabled="loader_guardar" v-on:click.prevent='guardar()'>
      Crear leccion
      <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_guardar"></i>
    </button>
  </div>
</div>

<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/lecciones/crear.js') }}"></script>
<script>
  $('#summernote').summernote({
    height: 250
  });
</script>
@stop
