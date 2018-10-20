
<div class="col-md-12">
  <div class="card">
    <div class="card-header no-border">
      <h3 class="card-title">Editar leccion</h3>
    </div>
    <div class="card-body">
      <div class="form-group">
        <label>Nombre</label>
        <input type="text" class="form-control" name='nombre'  v-model='o_leccion.nombre' v-bind:class="[e_leccion.nombre ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_leccion.nombre">@{{ e_leccion.nombre[0] }}</span>
      </div>

      <button type="button" class="btn btn-primary btn-sm float-right" :disabled="loader_actualizar" v-on:click.prevent='actualizar()'>
        Actualizar
        <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_actualizar"></i>
      </button>
    </div>
  </div>
</div>
<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
<input type='hidden' name='idmodulo' id='idmodulo' value="{{$idmodulo}}"></input>
<input type='hidden' name='id' id='id' value="{{$id}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/lecciones/edit.js') }}"></script>
@stop
