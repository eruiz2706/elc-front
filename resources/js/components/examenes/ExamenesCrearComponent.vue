<template>
<div>
  <div class="row">
    <div class="col-md-6 col-sm-6">
      <h5 class="m-0 text-dark">
        <strong>Nuevo examen</strong>
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
        <label>Titulo de evaluación <code>*</code></label>
        <input type="text" class="form-control" name='nombre'  v-model='o_ejercicio.nombre' v-bind:class="[e_ejercicio.nombre ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_ejercicio.nombre" v-text='e_ejercicio.nombre[0]'></span>
      </div>

      <div class="form-group">
        <label>Fecha de Inicio <code>*</code></label>
        <input type="date" class="form-control" name='fecha_inicio' v-model='o_ejercicio.fecha_inicio'  v-bind:class="[e_ejercicio.fecha_inicio ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_ejercicio.fecha_inicio" v-text='e_ejercicio.fecha_inicio[0]'></span>
      </div>

      <div class="form-group">
        <label>Fecha de Finalizacion</label>
        <input type="date" class="form-control" name='fecha_inicio' v-model='o_ejercicio.fecha_finalizacion'  v-bind:class="[e_ejercicio.fecha_finalizacion ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_ejercicio.fecha_finalizacion" v-text='e_ejercicio.fecha_finalizacion[0]'></span>
      </div>

      <div class="form-group">
      <label>Duracion(Minutos) <code>*</code></label>
        <input type="number" class="form-control" name='duracion' min="0" max="1000"  v-model='o_ejercicio.duracion'  v-bind:class="[e_ejercicio.duracion ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_ejercicio.duracion" v-text='e_ejercicio.duracion[0]'></span>
      </div>

      <div class="form-group">
        <label>Contenido de preguntas</label>
        <div id="summernote"></div>
      </div>

      <button type="button" class="btn btn-outline-primary btn-sm float-left" :disabled="loader_guardar" v-on:click.prevent='guardar()'>
        Crear examen
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
            height: 100
          });
        },created : function(){
          this.base_url=base_url;
          this.idcurso=document.getElementById('idcurso').value;
        },
        data: function () {
          return {
            idcurso:0,
            o_baseejercicio:{'nombre':'','fecha_inicio':'','duracion':0,'descripcion':''},
            o_ejercicio:{'nombre':'','fecha_inicio':'','duracion':0,'descripcion':''},
            e_ejercicio:[],
            loader_guardar :false,
          }
        },
        methods : {
          guardar:function(){
            this.loader_guardar=true;
            this.o_ejercicio.idcurso=this.idcurso;
            this.o_ejercicio.descripcion=$('#summernote').summernote('code');
            var url =this.base_url+'/ejercicios/guardar';
            let inst=this;
            axios.post(url,this.o_ejercicio).then(response =>{
                this.loader_guardar=false;
                this.e_ejercicio=[];
                this.o_ejercicio=this.o_baseejercicio;
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
                  this.e_ejercicio=error.response.data.errors;
                }
                if(error.response.data.error){
                  toastr.error(error.response.data.error,'',{
                      "timeOut": "3500"
                  });
                }
            });
          },
          redirectVolver:function(){
            document.getElementById('id').value='';
            this.$root.$emit('setMenu','examenes-lista');
          }
        }
    }
</script>
