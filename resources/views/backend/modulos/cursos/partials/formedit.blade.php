
<div class="col-md-12">
  <div class="card  card-primary card-outline">
    <div class="card-header no-border" style="height: 60px;">
      <h2>Editar Curso</h2>
    </div>
    <div class="card-body">
      <div class="form-group">
        <label>Nombre</label>
        <input type="text" class="form-control" name='nombre'  v-model='o_curso.nombre' v-bind:class="[e_curso.nombre ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_curso.nombre">@{{ e_curso.nombre[0] }}</span>
      </div>

      <div class="form-group">
        <label>Fecha de Inicio</label>
        <input type="date" class="form-control" name='fecha_inicio' v-model='o_curso.fecha_inicio'  v-bind:class="[e_curso.fecha_inicio ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_curso.fecha_inicio">@{{ e_curso.fecha_inicio[0] }}</span>
      </div>

      <div class="form-group">
        <label>Fecha de Finalizacion</label>
        <input type="date" class="form-control" name='fecha_finalizacion' v-model='o_curso.fecha_finalizacion'  v-bind:class="[e_curso.fecha_finalizacion ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_curso.fecha_finalizacion">@{{ e_curso.fecha_finalizacion[0] }}</span>
      </div>

      <div class='form-group'>
        <label>Visibilidad</label>
        <div class="form-check">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" checked name="optradio" value='true' v-model='o_curso.visibilidad'>SI
          </label>
        </div>
        <div class="form-check">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="optradio" value='false' v-model='o_curso.visibilidad'>NO
          </label>
        </div>
      </div>

      <button type="button" class="btn btn-primary btn-sm float-right" :disabled="loader_actualizar" v-on:click.prevent='actualizar()'>
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
