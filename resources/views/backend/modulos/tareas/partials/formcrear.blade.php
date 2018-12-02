<div class="row">
  <div class="col-md-6 col-sm-6">
    <h5 class="m-0 text-dark">
      <strong>Nueva tarea</strong>
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
      <label>Titulo <code>*</code></label>
      <input type="text" class="form-control" name='nombre'  v-model='o_tarea.nombre' v-bind:class="[e_tarea.nombre ? 'is-invalid' : '']">
      <span class="text-danger" v-if="e_tarea.nombre" v-text='e_tarea.nombre[0]'></span>
    </div>

    <div class="form-group">
    <label>Calificacion sobre <code>*</code></label>
      <input type="number" class="form-control" name='calificacion' min="0" max="1000"  v-model='o_tarea.calificacion' v-bind:class="[e_tarea.calificacion ? 'is-invalid' : '']">
      <span class="text-danger" v-if="e_tarea.calificacion" v-text='e_tarea.calificacion[0]'></span>
    </div>

    <div class="form-group">
      <label>Fecha vencimiento <code>*</code></label>
      <input type="date" class="form-control" name='fecha_vencimiento' v-model='o_tarea.fecha_vencimiento'  v-bind:class="[e_tarea.fecha_vencimiento ? 'is-invalid' : '']">
      <span class="text-danger" v-if="e_tarea.fecha_vencimiento" v-text='e_tarea.fecha_vencimiento[0]'></span>
    </div>

    <div class="form-group">
      <div id="summernote"></div>
    </div>

    <button type="button" class="btn btn-outline-primary btn-sm float-left" :disabled="loader_guardar" v-on:click.prevent='guardar()'>
      Crear tarea
      <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_guardar"></i>
    </button>
  </div>
</div>

<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/tareas/crear.js') }}"></script>
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
