
<div class="row">
  <div class="col-md-6 col-sm-6">
    <h5 class="m-0 text-dark">
      <strong>Nueva pregunta</strong>
      <button type="button" class="btn btn-tool" v-on:click.prevent="redirectVolver()">
        <i class="fa fa-arrow-circle-left"  style="font-size: 24px;"></i>
      </button>
    </h5>
  </div>
</div>

<div class="card">
  <div class="card-body">
    <div class="callout callout-info">
    	<p>
    	  <i class="fa fa-fw fa-info"></i>Los campos marcados en <code>*</code> son obligatorios
    	</p>
    </div>

    <div class="form-group">
      <label>Nombre <code>*</code></label>
      <input type="text" class="form-control" name='nombre'  v-model='o_pregunta.nombre' v-bind:class="[e_pregunta.nombre ? 'is-invalid' : '']">
      <span class="text-danger" v-if="e_pregunta.nombre" v-text='e_pregunta.nombre[0]'></span>
    </div>

    <div class="form-group">
      <label>Descripcion</label>
      <div id="summernote" ></div>
    </div>

    <div class="form-group">
      <label>Tipo respuesta  <code>*</code></label>
      <select class="form-control" name='tipo' v-model='o_pregunta.tipo' @change="viewtipo()" v-bind:class="[e_pregunta.tipo ? 'is-invalid' : '']">
        <option value=''>Seleccione el tipo</option>
        <option value='abierta'>Abierta</option>
        <option value='unica'>Unica</option>
        <option value='multiple'>Multiple</option>
        <option value='relacionar'>Relacionar</option>
        <option value='rellenar'>Rellenar</option>
      </select>
      <span class="text-danger" v-if="e_pregunta.tipo" v-text='e_pregunta.tipo[0]'></span>
    </div>

    @include('backend.modulos.preguntas.partials.formresp')

    <div id="accordion">
      <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
      <div class="card ">
        <div class="card-header" style="padding:.2rem 1.25rem">
          <h5 class="card-title" style="font-size:1rem">
            <a data-toggle="collapse" data-parent="#accordion" href="#colapse1" class="collapsed" aria-expanded="false">
              Parametros adicionales
            </a>
          </h5>
        </div>
        <div id="colapse1" class="panel-collapse in collapse" style="">
          <div class="card-body">
            <div class="form-group">
              <label>
                Agregar audio(Ingles)
                <button type="button" class="btn btn-outline-primary btn-sm" v-on:click.prevent='playAudio()'>
                  <i class="fa fa-play" ></i>
                </button>&nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-outline-danger btn-sm" v-on:click.prevent='stopAudio()'>
                  <i class="fa fa-stop" ></i>
                </button>
              </label>
              <textarea class="form-control" rows="2" placeholder="Escriba el texto que desea ser reproducido"v-model="o_pregunta.texto_audio"></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>

    <button type="button" class="btn btn-outline-primary btn-sm float-left" :disabled="loader_guardar" v-on:click.prevent='guardar()'>
      Crear Pregunta
      <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_guardar"></i>
    </button>
  </div>
</div>

<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
<input type='hidden' name='idejerc' id='idejerc' value="{{$idejerc}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('plugins/artyom/artyom.window.min.js') }}"></script>
<script>const artyom = new Artyom();</script>
<script src="{{ URL::asset('js/be/modulos/preguntas/crear.js') }}"></script>
<script>
  $('#summernote').summernote({
    height: 55
  });
</script>
@stop
