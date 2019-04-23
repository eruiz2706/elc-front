<template>
<div>
  <div class="row" v-show="preload">
    <div class="d-block mx-auto" >
      <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
    </div>
  </div>

  <div class="row" v-show="!preload">
    <div class="col-md-6 col-sm-6">
      <h4 class="m-0 text-dark">
        <strong>Nueva leccion</strong>
        <button type="button" class="btn btn-tool" v-on:click.prevent="redirectVolver()">
          <i class="fa fa-arrow-circle-left"  style="font-size: 24px;"></i>
        </button>
      </h4>
    </div>
  </div>

  <div class="card" v-show="!preload">
    <div class="card-body">
      <div class="callout callout-info">
      	<p>
      	  <i class="fa fa-fw fa-info"></i>Los campos marcados en <code>*</code> son obligatorios
      	</p>
      </div>

      <div class='row'>
        <div class="form-group col-md-2 col-sm-4">
          <label>Numero <code>*</code></label>
          <input type="number" min="0"  step="0.01" class="form-control" name='numero'  v-model='o_leccion.numero' v-bind:class="[e_leccion.numero ? 'is-invalid' : '']">
          <span class="text-danger" v-if="e_leccion.numero" v-text='e_leccion.numero[0]'></span>
        </div>

        <div class="form-group col-md-10 col-sm-12">
          <label>Titulo <code>*</code></label>
          <input type="text" class="form-control" name='nombre'  v-model='o_leccion.nombre' v-bind:class="[e_leccion.nombre ? 'is-invalid' : '']">
          <span class="text-danger" v-if="e_leccion.nombre" v-text='e_leccion.nombre[0]'></span>
        </div>
      </div>

      <div class="form-group">
        <label>Modulo <code>*</code></label>
        <select class="form-control" name="select_mod" v-model='o_leccion.modulo' v-bind:class="[e_leccion.modulo ? 'is-invalid' : '']">
          <option v-bind:value="''"> - </option>
          <option v-bind:value='s_mod.id' v-for='s_mod in select_mod' v-text='s_mod.nombre'></option>
        </select>
        <span class="text-danger" v-if="e_leccion.modulo" v-text='e_leccion.modulo[0]'></span>
      </div>

      <div class="form-group">
      <label>Tiempo de lectura(Minutos)</label>
        <input type="number" class="form-control" name='tiempo' min="0" max="1000"  v-model='o_leccion.tiempolectura'>
      </div>

      <div class="form-group">
        <div id="summernote"></div>
      </div>

      <button type="button" class="btn btn-outline-primary btn-sm float-left" :disabled="loader_guardar" v-on:click.prevent='guardar()'>
        Crear leccion
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
            height: 350
          });
        },created : function(){
          this.base_url=base_url;
          this.idcurso=document.getElementById('idcurso').value;
          this.list_select();
        },
        data: function () {
          return {
            idcurso:0,
            preload:true,
            o_baseleccion:{'modulo':'','nombre':'','descripcion':'','tiempolectura':0},
            o_leccion:{'modulo':'','nombre':'','descripcion':'','tiempolectura':0},
            e_leccion:[],
            loader_guardar :false,
            select_mod:[],
          }
        },
        methods : {
          list_select:function(){
            var url =this.base_url+'/lecciones/select_mod';
            this.preload=true;
            axios.post(url,{idcurso:this.idcurso}).then(response =>{
                this.preload=false;
                this.select_mod=response.data.select_mod;
                this.a_leccion=response.data.lecciones;
            }).catch(error =>{
                this.preload=false;
                this.a_leccion=[];
                if(error.response.data.errors){
                }
                if(error.response.data.error){
                  toastr.error(error.response.data.error,'',{
                      "timeOut": "3500"
                  });
                }
            });
          },
          guardar:function(){
            this.loader_guardar=true;
            this.o_leccion.descripcion=$('#summernote').summernote('code');
            var url =this.base_url+'/lecciones/guardar';
            let inst=this;
            axios.post(url,this.o_leccion).then(response =>{
                this.loader_guardar=false;
                this.o_leccion=this.o_baseleccion;
                swal({
                    title:response.data.message,
                    text:response.data.message2,
                    type: "success"
                },function(){
                  document.getElementById('id').value='';
                  inst.$root.$emit('setMenu','lecciones-lista');
                });
            }).catch(error =>{
                this.loader_guardar=false;
                if(error.response.data.errors){
                  this.e_leccion=error.response.data.errors;
                }
                if(error.response.data.error){
                  toastr.error(error.response.data.error,'',{
                      "timeOut": "3500"
                  });
                }
            });
          },
          redirectVolver:function(){
            this.$root.$emit('setMenu','lecciones-lista');
          }
        }
    }
</script>
