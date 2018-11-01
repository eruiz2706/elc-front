
<div class="row">
<div class="col-md-6 col-sm-12">
<div class="card">
  <div class="card-header">
    <h4 class="card-title">
      Video
    </h4>
  </div>
  <div class="card-body">
    <div class="form-group">
      <label>Url Youtube</label>
      <input type="text" class="form-control" name='urlvideo' v-model="o_curso.urlvideo">
    </div>
    <div class="col-md-12">
      <iframe class="img-fluid" style='width:100%;height:223px' frameborder="0" allowfullscreen allow="autoplay; encrypted-media"
        v-bind:src="replaceurlYoutube(o_curso.urlvideo)" >
      </iframe>
    </div>
  </div>
  <div class="card-footer">
    <button type="button" class="btn btn-outline-primary btn-sm" :disabled="loader_updvideo" v-on:click="upd_urlvideo()">
      Actualizar
      <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_updvideo"></i>
    </button>
  </div>
</div>
</div>

<div class="col-md-6 col-sm-12">
<div class="card">
  <div class="card-header">
    <h4 class="card-title">
      Logo
    </h4>
  </div>
  <div class="card-body mb-2">
    <div class="form-group">
    <label for="exampleInputFile">Logo (Dimensiones 750*425)</label>
      <div class="input-group">
        <input type="file" class="form-control-file border" id="file_avatar" >
      </div>
    </div>
    <div class="col-md-12">
        <img style='width:345px;height:223px;' class="img-fluid" id="logo-curso" v-bind:src="base_url+'/'+o_curso.imagen">
    </div>

  </div>
  <div class="card-footer">
    <button type="button" class="btn btn-outline-primary btn-sm" :disabled="loader_updlogo" v-on:click="upd_urllogo()">
      Actualizar
      <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_updlogo"></i>
    </button>
  </div>
</div>
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
    <button type="button" class="btn btn-outline-primary btn-sm" :disabled="loader_updplan" v-on:click="upd_planestudio()">
      Actualizar
      <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_updplan"></i>
    </button>
  </div>
</div>

<input type='hidden' name='id' id='id' value="{{$curso->id}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/cursos/config.js') }}"></script>
<script>
  $('#summernote').summernote({
    height: 350
  });
</script>
@stop
