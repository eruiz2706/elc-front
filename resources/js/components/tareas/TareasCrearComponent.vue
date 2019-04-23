<template>
<div>
  <div class="row">
    <div class="col-md-6 col-sm-6">
      <h4 class="m-0 text-dark">
        <strong v-text='traslate.new_homework'></strong>
        <button type="button" class="btn btn-tool" v-on:click.prevent="redirectVolver()">
          <i class="fa fa-arrow-circle-left"  style="font-size: 24px;"></i>
        </button>
      </h4>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <div class="callout callout-info">
      	<p>
      	  <i class="fa fa-fw fa-info"></i><span v-text='traslate.required_fields_msg'></span> <code>*</code> <span v-text='traslate.required_fields_msg2'></span>
      	</p>
      </div>
      <div class="form-group">
        <label v-text='traslate.title'> <code>*</code></label>
        <input type="text" class="form-control" name='nombre'  v-model='o_tarea.nombre' v-bind:class="[e_tarea.nombre ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_tarea.nombre" v-text='e_tarea.nombre[0]'></span>
      </div>

      <div class="form-group">
      <label v-text='traslate.maximum_note'> <code>*</code></label>
        <input type="number" class="form-control" name='calificacion' min="0" max="1000"  v-model='o_tarea.calificacion' v-bind:class="[e_tarea.calificacion ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_tarea.calificacion" v-text='e_tarea.calificacion[0]'></span>
      </div>

      <div class="form-group">
        <label v-text='traslate.expiration_date'></label>
        <input type="date" class="form-control" name='fecha_vencimiento' v-model='o_tarea.fecha_vencimiento'  v-bind:class="[e_tarea.fecha_vencimiento ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_tarea.fecha_vencimiento" v-text='e_tarea.fecha_vencimiento[0]'></span>
      </div>

      <div class="form-group">
        <div id="summernote"></div>
      </div>

      <button type="button" class="btn btn-outline-primary btn-sm float-left" :disabled="loader_guardar" v-on:click.prevent='guardar()'>
        <span v-text='traslate.create'></span>
        <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_guardar"></i>
      </button>
    </div>
  </div>
</div>
</template>

<script>
    export default {
        mounted() {
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
        },created : function(){
          this.base_url=base_url;
          this.idcurso=document.getElementById('idcurso').value;
        },
        data: function () {
          return {
            idcurso:0,
            o_basetarea:{'nombre':'','calificacion':0,'fecha_vencimiento':'','descripcion':''},
            o_tarea:{'nombre':'','calificacion':0,'fecha_vencimiento':'','descripcion':''},
            e_tarea:[],
            loader_guardar :false,
            traslate:{
              'required_fields_msg':trans('backend.required_fields_msg'),
              'required_fields_msg2':trans('backend.required_fields_msg2'),
              'title':trans('backend.title'),
              'maximum_note':trans('backend.maximum_note'),
              'expiration_date':trans('backend.expiration_date'),
              'create':trans('backend.create'),
              'new_homework':trans('backend.new_homework'),
            }
          }
        },
        methods : {
          guardar:function(){
            this.loader_guardar=true;
            this.o_tarea.idcurso=this.idcurso;
            this.o_tarea.descripcion=$('#summernote').summernote('code');
            var url =this.base_url+'/tareas/guardar';
            axios.post(url,this.o_tarea).then(response =>{
                this.loader_guardar=false;
                this.e_tarea=[];
                this.o_tarea=this.o_basetarea;
                let inst=this;

                this.$root.$emit('notifi_cli',response.data.notifi_tk);

                swal({
                    title:response.data.message,
                    text:response.data.message2,
                    type: "success"
                },function(){
                    inst.redirectVolver();
                });
            }).catch(error =>{
                this.loader_guardar=false;
                if(error.response.data.errors){
                  this.e_tarea=error.response.data.errors;
                }
                if(error.response.data.error){
                  toastr.error(error.response.data.error,'',{
                      "timeOut": "2500"
                  });
                }
            });
          },
          redirectVolver:function(){
            document.getElementById('id').value='';
            this.$root.$emit('setMenu','tareas-lista');
          }
        }
    }
</script>
