<div class="col-md-12">
<div class="alert alert-info alert-dismissible">
  <h5><i class="icon fa fa-info"></i>Informacion</h5>
  Los campos marcados en <code>*</code> son obligatorios
</div>
</div>

<div class="col-md-12">
  <div class="card">
    <div class="card-header no-border" style="height: 60px;">
      <h2>Nuevo modulo</h2>
    </div>
    <div class="card-body">
      <div class="form-group">
        <label>Nombre <code>*</code></label>
        <input type="text" class="form-control" name='nombre'  v-model='o_modulo.nombre' v-bind:class="[e_modulo.nombre ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_modulo.nombre">@{{ e_modulo.nombre[0] }}</span>
      </div>

      <button type="button" class="btn btn-outline-primary btn-sm float-left" :disabled="loader_guardar" v-on:click.prevent='guardar()'>
        Crear modulo
        <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_guardar"></i>
      </button>
    </div>
  </div>
</div>
<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/modulos/crear.js') }}"></script>
@stop