<div class="col-md-12">
  <div class="alert alert-info alert-dismissible">
    <h5><i class="icon fa fa-info"></i>Informacion</h5>
    Los campos marcados en <code>*</code> son obligatorios
  </div>
</div>

<div class="col-md-12">
  <div class="card card-outline">
    <div class="card-header no-border" style="height: 60px;">
      <h2>Nuevo curso</h2>
    </div>
    <div class="card-body">
      <div class="form-group">
        <label>Nombre <code>*</code></label>
        <input type="text" class="form-control" name='nombre'  v-model='o_curso.nombre' v-bind:class="[e_curso.nombre ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_curso.nombre">@{{ e_curso.nombre[0] }}</span>
      </div>

      <div class="form-group">
        <label>Fecha de Inicio <code>*</code></label>
        <input type="date" class="form-control" name='fecha_inicio' v-model='o_curso.fecha_inicio'  v-bind:class="[e_curso.fecha_inicio ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_curso.fecha_inicio">@{{ e_curso.fecha_inicio[0] }}</span>
      </div>

      <div class="form-group">
        <label>Fecha de Finalizacion <code>*</code></label>
        <input type="date" class="form-control" name='fecha_finalizacion' v-model='o_curso.fecha_finalizacion'  v-bind:class="[e_curso.fecha_finalizacion ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_curso.fecha_finalizacion">@{{ e_curso.fecha_finalizacion[0] }}</span>
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

      <button type="button" class="btn btn-outline-primary btn-sm float-left" :disabled="loader_guardar" v-on:click.prevent='guardar()'>
        Crear curso
        <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_guardar"></i>
      </button>
    </div>
  </div>
</div>


@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/cursos/crear.js') }}"></script>
@stop
