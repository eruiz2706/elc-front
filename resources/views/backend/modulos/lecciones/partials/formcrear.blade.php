<div class="col-md-12">
<div class="alert alert-info alert-dismissible">
  <h5><i class="icon fa fa-info"></i>Informacion</h5>
  Los campos marcados en <code>*</code> son obligatorios
</div>
</div>

<div class="col-md-12">
  <div class="card">
    <div class="card-header no-border" style="height: 60px;">
      <h2>Nueva leccion</h2>
    </div>
    <div class="card-body">
      <div class="form-group">
        <label>Nombre <code>*</code></label>
        <input type="text" class="form-control" name='nombre'  v-model='o_leccion.nombre' v-bind:class="[e_leccion.nombre ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_leccion.nombre">@{{ e_leccion.nombre[0] }}</span>
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
</div>
<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
<input type='hidden' name='idmodulo' id='idmodulo' value="{{$idmodulo}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/lecciones/crear.js') }}"></script>
<script>
  $('#summernote').summernote({
    height: 350
  });
</script>
@stop
