<div class="row" v-if="preload">
  <div class="d-block mx-auto" >
    <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
  </div>
</div>

<div class="row" v-if="!preload">
  <div class="col-md-6 col-sm-6">
    <h5 class="m-0 text-dark">
      <strong>Actualizar examen</strong>
      <button type="button" class="btn btn-tool" v-on:click.prevent="redirectVolver()">
        <i class="fa fa-arrow-circle-left"  style="font-size: 24px;"></i>
      </button>
    </h5>
  </div>
</div>

<div class="card" v-show="!preload">
  <div class="card-body">
    <div class="callout callout-info">
      <p>
        <i class="fa fa-fw fa-info"></i>Los campos marcados en <code>*</code> son obligatorios
      </p>
    </div>
    <div class="form-group">
      <label>Titulo <code>*</code></label>
      <input type="text" class="form-control" name='nombre'  v-model='o_ejercicio.nombre' v-bind:class="[e_ejercicio.nombre ? 'is-invalid' : '']">
      <span class="text-danger" v-if="e_ejercicio.nombre" v-text='e_ejercicio.nombre[0]'></span>
    </div>

    <div class="form-group">
      <label>Fecha de Inicio <code>*</code></label>
      <input type="date" class="form-control" name='fecha_inicio' v-model='o_ejercicio.fecha_inicio'  v-bind:class="[e_ejercicio.fecha_inicio ? 'is-invalid' : '']">
      <span class="text-danger" v-if="e_ejercicio.fecha_inicio" v-text='e_ejercicio.fecha_inicio[0]'></span>
    </div>

    <div class="form-group">
    <label>Duracion(Minutos) <code>*</code></label>
      <input type="number" class="form-control" name='duracion' min="0" max="1000"  v-model='o_ejercicio.duracion'  v-bind:class="[e_ejercicio.duracion ? 'is-invalid' : '']">
      <span class="text-danger" v-if="e_ejercicio.duracion" v-text='e_ejercicio.duracion[0]'></span>
    </div>

    <div class="form-group">
      <label>Descripcion</label>
      <div id="summernote"></div>
    </div>

    <button type="button" class="btn btn-outline-primary btn-sm float-lef" :disabled="loader_actualizar" v-on:click.prevent='actualizar()'>
      Actualizar
      <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_actualizar"></i>
    </button>
  </div>
</div>

<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
<input type='hidden' name='id' id='id' value="{{$id}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/ejercicios/edit.js') }}"></script>
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
  height: 100
});

</script>
@stop
