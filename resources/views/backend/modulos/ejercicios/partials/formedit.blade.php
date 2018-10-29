<div class="row" v-if="preload">
  <div class="d-block mx-auto" >
    <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
  </div>
</div>

<div class="col-md-12" v-show="!preload">
  <div class="alert alert-info alert-dismissible">
    <h5><i class="icon fa fa-info"></i>Informacion</h5>
    Los campos marcados en <code>*</code> son obligatorios
  </div>
</div>

<div class="col-md-12" v-show="!preload">
  <div class="card">
    <div class="card-header no-border" style="height: 60px;">
      <h2>Editar ejercicio</h2>
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

      <button type="button" class="btn btn-outline-primary btn-sm float-lef" :disabled="loader_actualizar" v-on:click.prevent='actualizar()'>
        Actualizar
        <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_actualizar"></i>
      </button>
    </div>
  </div>
</div>
<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
<input type='hidden' name='id' id='id' value="{{$id}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/ejercicios/edit.js') }}"></script>
<script>
  $('#summernote').summernote({
    height: 200
  });
</script>
@stop
