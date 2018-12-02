<div class="row" v-show="preload">
  <div class="d-block mx-auto" >
    <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
  </div>
</div>

<div class="row" v-show="!preload">
  <div class="col-md-6 col-sm-6">
    <h5 class="m-0 text-dark">
      <strong v-html='o_tarea.nombre'>ver tarea</strong>
      <button type="button" class="btn btn-tool" v-on:click.prevent="redirectVolver()">
        <i class="fa fa-arrow-circle-left"  style="font-size: 24px;"></i>
      </button>
    </h5>
  </div>
</div>

<div class="card" v-show="!preload">
  <div class="card-body">
    <label>Descripcion</label>
  	<p v-html='o_tarea.descripcion'></p>
    <hr>

    <label>Respuesta</label>
    <div class="form-group" v-show="o_tarea.entrega">
      <div id="summernote"></div>
    </div>
    <div class="form-group" v-if="!o_tarea.entrega">
      <div v-html="o_tarea.respuesta"></div>
    </div>

    <hr>
    <label v-if="!o_tarea.entrega">Comentarios Profesor</label>
    <div class="form-group" >
      <div v-html="o_tarea.comentario"   v-if="!o_tarea.entrega"></div>
    </div>

    <button type="button" class="btn btn-outline-primary btn-sm float-left" :disabled="loader_actualizar" v-on:click.prevent='entregar()' v-if="o_tarea.entrega">
      Entregar tarea
      <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_actualizar"></i>
    </button>
  </div>
</div>

<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
<input type='hidden' name='id' id='id' value="{{$id}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/tareas/entrega.js') }}"></script>
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
  height: 250
});

</script>
@stop
