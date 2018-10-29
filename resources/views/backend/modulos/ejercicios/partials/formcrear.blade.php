<div class="col-md-12">
<div class="alert alert-info alert-dismissible">
  <h5><i class="icon fa fa-info"></i>Informacion</h5>
  Los campos marcados en <code>*</code> son obligatorios
</div>
</div>

<div class="col-md-12">
  <div class="card">
    <div class="card-header no-border" style="height: 60px;">
      <h2>Nuevo ejercicio</h2>
    </div>
    <div class="card-body">
      <div class="form-group">
        <label>Nombre <code>*</code></label>
        <input type="text" class="form-control" name='nombre'  v-model='o_ejercicio.nombre' v-bind:class="[e_ejercicio.nombre ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_ejercicio.nombre">@{{ e_ejercicio.nombre[0] }}</span>
      </div>

      <div class="form-group">
        <label>Fecha de Inicio <code>*</code></label>
        <input type="date" class="form-control" name='fecha_inicio' v-model='o_ejercicio.fecha_inicio'  v-bind:class="[e_ejercicio.fecha_inicio ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_ejercicio.fecha_inicio">@{{ e_ejercicio.fecha_inicio[0] }}</span>
      </div>

      <div class="form-group">
      <label>Duracion(Minutos) <code>*</code></label>
        <input type="number" class="form-control" name='duracion' min="0" max="1000"  v-model='o_ejercicio.duracion'  v-bind:class="[e_ejercicio.duracion ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_ejercicio.duracion">@{{ e_ejercicio.duracion[0] }}</span>
      </div>

      <div class="form-group">
        <div id="summernote"></div>
      </div>

      <button type="button" class="btn btn-outline-primary btn-sm float-left" :disabled="loader_guardar" v-on:click.prevent='guardar()'>
        Crear ejercicio
        <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_guardar"></i>
      </button>
    </div>
  </div>
</div>
<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/ejercicios/crear.js') }}"></script>
<script>
  $('#summernote').summernote({
    height: 200
  });
</script>
@stop
