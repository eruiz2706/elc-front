<div class="row" v-if="preload">
  <div class="d-block mx-auto" >
    <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
  </div>
</div>
<div class="col-md-12" v-if="!preload">
  <div class="card card-outline">
    <div class="card-body">
      <div class="callout callout-info">
      	<p>
      	  <i class="fa fa-fw fa-info"></i>Los campos marcados en <code>*</code> son obligatorios
      	</p>
      </div>

      <div class="form-group">
        <label>Nombre <code>*</code></label>
        <input type="text" class="form-control" name='nombre'  v-model='o_curso.nombre' v-bind:class="[e_curso.nombre ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_curso.nombre" v-text='e_curso.nombre[0]'></span>
      </div>

      <div class="form-group">
        <label>Fecha de Inicio <code>*</code></label>
        <input type="date" class="form-control" name='fecha_inicio' v-model='o_curso.fecha_inicio'  v-bind:class="[e_curso.fecha_inicio ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_curso.fecha_inicio" v-text='e_curso.fecha_inicio[0]'></span>
      </div>

      <div class="form-group">
        <label>Fecha de Finalizacion <code>*</code></label>
        <input type="date" class="form-control" name='fecha_finalizacion' v-model='o_curso.fecha_finalizacion'  v-bind:class="[e_curso.fecha_finalizacion ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_curso.fecha_finalizacion" v-text='e_curso.fecha_finalizacion[0]'></span>
      </div>

      <div class="form-group">
        <label>Fecha limite ver notas <code>*</code></label>
        <input type="date" class="form-control" name='fecha_limite' v-model='o_curso.fecha_limite'  v-bind:class="[e_curso.fecha_limite ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_curso.fecha_limite" v-text='e_curso.fecha_limite[0]'></span>
      </div>

      <div class="form-group">
        <label>Profesor(email)</label>
        <input type="text" class="form-control" name='profesor' v-model='o_curso.profesor'  v-bind:class="[e_curso.profesor ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_curso.profesor" v-text='e_curso.profesor[0]'></span>
      </div>

      <div class="form-group">
        <label>Profesor2(email)</label>
        <input type="text" class="form-control" name='profesor2' v-model='o_curso.profesor2'  v-bind:class="[e_curso.profesor2 ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_curso.profesor2" v-text='e_curso.profesor2[0]'></span>
      </div>

      <div class='form-group'>
        <label>Acceso al curso</label>
        <div class="form-check">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" checked name="accesradio" value='true' v-model='o_curso.visibilidad'>Publico
          </label>
        </div>
        <div class="form-check">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="accesradio" value='false' v-model='o_curso.visibilidad'>Privado
          </label>
        </div>
      </div>

      <div class='form-group'>
        <label>Inscripcion</label>
        <div class="form-check">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" checked name="permitradio" value='true' v-model='o_curso.inscripcion'>Permitido al usuario
          </label>
        </div>
        <div class="form-check">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="permitradio" value='false' v-model='o_curso.inscripcion'>Disponible para administrador del curso
          </label>
        </div>
      </div>

      <button type="button" class="btn btn-outline-primary btn-sm float-left" :disabled="loader_actualizar" v-on:click.prevent='actualizar()'>
        Actualizar
        <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_actualizar"></i>
      </button>
    </div>
    <input type='hidden' name='id' id='id' value="{{$id}}"></input>
  </div>
</div>


@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/cursos/edit.js') }}"></script>
@stop
