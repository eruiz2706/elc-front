
<div class="row">
  <div class="col-md-12 col-sm-12">
    <h5 class="m-0 text-dark">
      <strong>Nuevo modulo</strong>
      <button type="button" class="btn btn-tool" v-on:click.prevent="redirectVolver()">
        <i class="fa fa-arrow-circle-left"  style="font-size: 24px;"></i>
      </button>
    </h5>
  </div><!-- /.col -->
</div>


<div class="card">
  <div class="card-body">
    <div class="callout callout-info">
    	<p>
    	  <i class="fa fa-fw fa-info"></i>Los campos marcados en <code>*</code> son obligatorios
    	</p>
    </div>

    <div class='row'>
    <div class="form-group col-md-2 col-sm-4">
      <label>Numero <code>*</code></label>
      <input type="number" step="0.01" class="form-control" name='numero'  v-model='o_modulo.numero' v-bind:class="[e_modulo.numero ? 'is-invalid' : '']">
      <span class="text-danger" v-if="e_modulo.numero">@{{ e_modulo.numero[0] }}</span>
    </div>

    <div class="form-group col-md-10 col-sm-12">
      <label>Nombre <code>*</code></label>
      <input type="text" class="form-control" name='nombre'  v-model='o_modulo.nombre' v-bind:class="[e_modulo.nombre ? 'is-invalid' : '']">
      <span class="text-danger" v-if="e_modulo.nombre">@{{ e_modulo.nombre[0] }}</span>
    </div>
    </div>

    <button type="button" class="btn btn-outline-primary btn-sm float-left" :disabled="loader_guardar" v-on:click.prevent='guardar()'>
      Crear modulo
      <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_guardar"></i>
    </button>
  </div>
</div>

<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/modulos/crear.js') }}"></script>
@stop
