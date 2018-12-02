<!-- Modal -->
<div class="modal fade" id="modalcomentforo" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class='modal-header'>
        <div class="input-group">
            <input type="text" name="message" placeholder="Escribe una respuesta" class="form-control" v-model='o_comentario.comentario' v-bind:class="[e_comentarios.comentario ? 'is-invalid' : '']">
            <span class="input-group-append">
              <button type="button" class="btn btn-outline-primary btn-sm" :disabled="loader_responder"  v-on:click.prevent='agregarComentario()'>
                Responder
                <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_responder"></i>
              </button>
            </span>
        </div>
        <!--<span class="text-danger" v-if="e_comentarios.comentario">@{{ e_comentarios.comentario[0] }}</span>-->
      </div>
      <div class="modal-body" style="height:300px;overflow-y: auto;">
        <div class="card-footer card-comments">
          <div class="col-md-12" v-if="preload_coment">
            <div class="d-block mx-auto" >
              <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
            </div>
          </div>
          <div class="card-comment"  v-for="comentario in a_comentarios">
            <!-- User image -->
            <img class="user-img-foro  img-circle img-sm" v-bind:class="border(comentario.role)"  v-bind:src="base_url+'/'+comentario.imagen" alt="User Image">

            <div class="comment-text">
              <span class="username">
                <span v-text='comentario.nombre'></span>
                <span class="text-muted float-right" v-text='comentario.fecha_creacion'></span>
              </span><!-- /.username -->
              <p v-html = "comentario.descripcion"></p>
            </div>
            <!-- /.comment-text -->
          </div>
        </div>
      </div>
      <div class='modal-footer'>
          <button type="button" class="btn btn-default float-right btn-sm" v-on:click.prevent='cerrarComentarios()'><i class="fa fa-close"></i> Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class='col-md-12'>
    <div class="card ">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <div id="summernote"></div>
                  <span class="text-danger" v-if="e_publicar.comentario" v-text='e_publicar.comentario[0]'></span>
                </div>
              </div>
            </div>
            <button type="button" class="btn btn-outline-primary btn-sm float-right"  :disabled="loader_publicar" v-on:click.prevent='publicacion()'>
              Publicar
              <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_publicar"></i>
            </button>
          </div>
        </div>
  </div>

  <div class="col-md-12" v-if="preload">
    <div class="d-block mx-auto" >
      <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
    </div>
  </div>

  <div class="col-md-12" v-for="(foro,indexforo) in a_foros">
    <div class="card card-widget">
      <div class="card-header">
        <div class="user-block">
          <img class="user-img-foro img-circle" v-bind:class="border(foro.role)" v-bind:src="base_url+'/'+foro.imagenuser" alt="User Image">
          <span class="username" v-text='foro.nombreuser'></span>
          <span class="description" v-text='foro.fecha_creacion'></span>
        </div>
      </div>
      <div class="card-body">
        <p v-html = "foro.descripcion"></p>
        <span class="float-right text-muted">
          <a href="#" v-on:click.prevent="openComentarios(foro.id,indexforo)">
            <span v-text='foro.comentarios'></span> comentarios
          </a>
        </span>
      </div>
      <div class="card-footer">
          <div class="img-push">
            <input type="text" class="form-control form-control-sm" placeholder="Escribe una respuesta"  v-on:click="openComentarios(foro.id,indexforo)">
          </div>
      </div>

    </div>
  </div>
</div>

<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/forocurso/index.js') }}"></script>
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
  placeholder: 'Escribe tu comentario aqui',
  toolbar: [
    ['groupName', ['picture','link','video']],

  ],
  image: [

  ],
  height: 150
});
</script>
@stop
