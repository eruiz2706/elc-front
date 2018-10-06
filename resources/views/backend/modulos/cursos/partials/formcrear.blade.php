
<div class="col-md-12">
  <div class="card  card-primary card-outline">
    <div class="card-header no-border" style="height: 60px;">
      <h2>Crear Curso</h2>
    </div>
    <div class="card-body">
      <div class="form-group">
        <label>Nombre</label>
        <input type="text" class="form-control" name='nombre'  v-model='o_curso.nombre' v-bind:class="[e_curso.nombre ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_curso.nombre">@{{ e_curso.nombre[0] }}</span>
      </div>

      <div class="form-group">
        <label>Fecha de Inicio</label>
        <input type="date" class="form-control" name='fecha_inicio' v-model='o_curso.fecha_inicio'>
      </div>

      <div class="form-group">
        <label>Duracion</label>
        <input type="text" class="form-control"  name='duracion' v-model='o_curso.duracion'>
      </div>

      <!--<div class="form-group">
        <label for="exampleInputFile">Logo (Dimensiones 125x125)</label>
        <div class="input-group">
          <input type="file" class="form-control">
        </div>
      </div>-->

      <div class="form-group">
        <label>Url Youtube</label>
        <input type="text" class="form-control" name='urlvideo' v-model='o_curso.urlvideo'>
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

      <div class="form-group">
        <label>Plan de estudio</label>
        <div id="summernote"></div>
      </div>

      <button type="button" class="btn btn-primary btn-sm float-right" :disabled="loader_guardar" v-on:click.prevent='guardar()'>
        Guardar
        <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_guardar"></i>
      </button>
    </div>
  </div>
</div>
