
<div class="col-md-12">
  <div class="card">
    <div class="card-header no-border">
      <h3 class="card-title">Crear pregunta</h3>
    </div>
    <div class="card-body">
      <div class="form-group">
        <label>Nombre</label>
        <input type="text" class="form-control" name='nombre'  v-model='o_pregunta.nombre' v-bind:class="[e_pregunta.nombre ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_pregunta.nombre">@{{ e_pregunta.nombre[0] }}</span>
      </div>

      <button type="button" class="btn btn-primary btn-sm float-right" :disabled="loader_guardar" v-on:click.prevent='guardar()'>
        Guardar
        <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_guardar"></i>
      </button>
    </div>
  </div>
</div>
<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
<input type='hidden' name='idejerc' id='idejerc' value="{{$idejerc}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/preguntas/crear.js') }}"></script>
@stop
