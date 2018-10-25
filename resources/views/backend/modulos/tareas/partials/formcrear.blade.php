<div class="col-md-12">
  <div class="alert alert-info alert-dismissible">
    <h5><i class="icon fa fa-info"></i>Informacion</h5>
    Los campos marcados en <code>*</code> son obligatorios
  </div>
</div>

<div class="col-md-12">
  <div class="card">
    <div class="card-header no-border" style="height: 60px;">
      <h2>Nueva tarea</h2>
    </div>
    <div class="card-body">
      <div class="form-group">
        <label>Nombre <code>*</code></label>
        <input type="text" class="form-control" name='nombre'  v-model='o_tarea.nombre' v-bind:class="[e_tarea.nombre ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_tarea.nombre">@{{ e_tarea.nombre[0] }}</span>
      </div>

      <div class="form-group">
      <label>Calificacion sobre <code>*</code></label>
        <input type="number" class="form-control" name='calificacion' min="0" max="1000"  v-model='o_tarea.calificacion' v-bind:class="[e_tarea.calificacion ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_tarea.calificacion">@{{ e_tarea.calificacion[0] }}</span>
      </div>

      <div class="form-group">
        <label>Fecha vencimiento <code>*</code></label>
        <input type="date" class="form-control" name='fecha_vencimiento' v-model='o_tarea.fecha_vencimiento'  v-bind:class="[e_tarea.fecha_vencimiento ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_tarea.fecha_vencimiento">@{{ e_tarea.fecha_vencimiento[0] }}</span>
      </div>

      <div class="form-group">
        <div id="summernote"></div>
      </div>

      <button type="button" class="btn btn-outline-primary btn-sm float-left" :disabled="loader_guardar" v-on:click.prevent='guardar()'>
        Crear tarea
        <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_guardar"></i>
      </button>
    </div>
  </div>
</div>
<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/tareas/crear.js') }}"></script>
<script>
  $('#summernote').summernote({
    height: 350
  });
</script>
@stop
