<div class="row" v-if="preload">
  <div class="d-block mx-auto" >
    <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
  </div>
</div>

<div class="row" v-if="!preload">
  <div class="col-md-6 col-sm-6">
    <h5 class="m-0 text-dark">
      <strong>Actualizar tarea</strong>
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

    <button type="button" class="btn btn-outline-primary btn-sm float-left" :disabled="loader_actualizar" v-on:click.prevent='actualizar()'>
      Actualizar
      <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_actualizar"></i>
    </button>
  </div>
</div>

<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
<input type='hidden' name='id' id='id' value="{{$id}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/tareas/edit.js') }}"></script>
<script>
  $('#summernote').summernote({
    height: 350
  });
</script>
@stop
