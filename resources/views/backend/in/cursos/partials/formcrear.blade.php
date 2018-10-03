
<div class="col-md-12">
  <div class="card  card-primary card-outline">
    <div class="card-header no-border" style="height: 60px;">
      <h2>Crear Curso</h2>
    </div>
    <div class="card-body">
      <div class="form-group">
        <label>Titulo</label>
        <input type="text" class="form-control">
      </div>

      <div class="form-group">
        <label>Fecha de Inicio</label>
        <input type="date" class="form-control">
      </div>

      <div class="form-group">
        <label>Duracion</label>
        <input type="text" class="form-control">
      </div>

      <div class="form-group">
        <label for="exampleInputFile">Logo (Dimensiones 125x125)</label>
        <div class="input-group">
          <input type="file" class="form-control">
        </div>
      </div>

      <div class="form-group">
        <label>Url Youtube</label>
        <input type="text" class="form-control">
      </div>

      <div class='form-group'>
        <label>Visibilidad</label>
        <div class="form-check">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" checked name="optradio">SI
          </label>
        </div>
        <div class="form-check">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" name="optradio">NO
          </label>
        </div>
      </div>

      <div class="form-group">
        <label>Plan de estudio</label>
        <div id="summernote"></div>
      </div>

      <button type="button" class="btn btn-primary btn-sm float-right">
        Guardar
      </button>
    </div>
  </div>
</div>
