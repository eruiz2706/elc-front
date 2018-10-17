<div class="card">
  <div class="card-header">
    <h4 class="card-title">
      Multimedia
    </h4>
  </div>
  <div class="card-body">
    <div class="form-group">
      <label>Url Youtube</label>
      <input type="text" class="form-control" name='urlvideo'>
    </div>

    <div class="form-group">
    <label for="exampleInputFile">Logo (Dimensiones 125x125)</label>
      <div class="input-group">
        <input type="file" class="form-control">
      </div>
    </div>
  </div>
  <div class="card-footer">
    <button type="button" class="btn btn-outline-primary btn-sm">
      Actualizar
    </button>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <h4 class="card-title">
      Plan de estudio
    </h4>
  </div>
  <div class="card-body">
    <div class="form-group">
      <div id="summernote"></div>
    </div>
  </div>
  <div class="card-footer">
    <button type="button" class="btn btn-outline-primary btn-sm">
      Actualizar
    </button>
  </div>
</div>

@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/cursos/config.js') }}"></script>
<script>
  $('#summernote').summernote({
    height: 350
  });
</script>
@stop
