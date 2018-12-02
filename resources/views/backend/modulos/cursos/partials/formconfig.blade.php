
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
    callbacks: {
     onImageUpload: function(image) {
           var sizeKB = image[0]['size'] / 1000;
           var tmp_pr = 0;
           if(sizeKB > 1100){
              tmp_pr = 1;
              swal({
                  title:"Seleccione una imagen menor o igual a 1mb",
                  text:'',
                  type: "info"
              });
          }
           if(image[0]['type'] != 'image/jpeg' && image[0]['type'] != 'image/png'){
              tmp_pr = 1;
              swal({
                  title:"La imagen debe ser formato png o jpg",
                  text:'',
                  type: "info"
              });
          }
           if(tmp_pr == 0){
               var file = image[0];
               var reader = new FileReader();
              reader.onloadend = function() {
                  var image = $('<img>').attr('src',  reader.result);
                  $('#summernote').summernote("insertNode", image[0]);
              }
             reader.readAsDataURL(file);
           }
        }
    },
    toolbar: [
      ['font', ['fontname']],
      ['para', ['ul', 'ol','paragraph','strikethrough']],
      ['style', ['bold', 'italic', 'underline', 'clear']],
      ['fontsize', ['fontsize']],
      ['color', ['color']],
      ['height', ['height']],
      ['groupName', ['picture','link','video','table','hr','fullscreen']],
    ],
    height: 350
  });
</script>
@stop
