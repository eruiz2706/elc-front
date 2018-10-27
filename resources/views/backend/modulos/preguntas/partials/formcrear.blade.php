<div class="col-md-12">
<div class="alert alert-info alert-dismissible">
  <h5><i class="icon fa fa-info"></i>Informacion</h5>
  Los campos marcados en <code>*</code> son obligatorios
</div>
</div>


<div class="col-md-12">
  <div class="card">
    <div class="card-header no-border" style="height: 60px;">
      <h2>Nueva pregunta</h2>
    </div>
    <div class="card-body">
      <div class="form-group">
        <label>Nombre <code>*</code></label>
        <input type="text" class="form-control" name='nombre'  v-model='o_pregunta.nombre' v-bind:class="[e_pregunta.nombre ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_pregunta.nombre">@{{ e_pregunta.nombre[0] }}</span>
      </div>

      <div class="card card-default collapsed-card">
        <div class="card-header">
          <h3 class="card-title">Parametros adicionales</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
          </div>
        </div>
        <div class="card-body" >
          <div class="form-group">
            <label>Descripcion</label>
            <div id="summernote"></div>
          </div>

          <div class="form-group">
            <label>
              Texto Audio   
              <button type="button" class="btn btn-outline-primary btn-sm" v-on:click.prevent='addRespMultiple()'>
                <i class="fa fa-play" ></i>
              </button>
            </label>
            <textarea class="form-control" rows="2"></textarea>
          </div>
        </div>
      </div>



      <div class="form-group">
        <label>Tipo respuesta  <code>*</code></label>
        <select class="form-control" name='tipo' v-model='o_pregunta.tipo' @change="viewtipo()" v-bind:class="[e_pregunta.tipo ? 'is-invalid' : '']">
          <option value=''>Seleccione el tipo</option>
          <option value='unica'>Unica</option>
          <option value='multiple'>Multiple</option>
          <option value='relacionar'>Relacionar</option>
        </select>
        <span class="text-danger" v-if="e_pregunta.tipo">@{{ e_pregunta.tipo[0] }}</span>
      </div>

      @include('backend.modulos.preguntas.partials.formresp')

      <button type="button" class="btn btn-outline-primary btn-sm float-left" :disabled="loader_guardar" v-on:click.prevent='guardar()'>
        Crear Pregunta
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
<script>
  $('#summernote').summernote({
    height: 250
  });
</script>
@stop
