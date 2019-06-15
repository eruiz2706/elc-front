<template>
<div>
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
</div>
</template>

<script>
    export default {
        mounted() {
          jQuery(function (){
            jQuery("input[type=file]").change(function() {
              readURL(this);
            });
            const readURL = (input) => {
              if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => {
                  jQuery('#logo-curso').attr('src', e.target.result)
                }
                reader.readAsDataURL(input.files[0]);
              }
            };
          })

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
          this.id=document.getElementById('idcurso').value;
          this.getConfig();
        },
        data: function () {
          return {
            id : 0,
            o_curso:{'urlvideo':'','plan_estudio':''},
            loader_updplan:false,
            loader_updvideo:false,
            loader_updlogo:false
          }
        },
        methods : {
          replaceurlYoutube:function(dirurl){
            if(typeof dirurl !== 'undefined'){
              var cadena  =dirurl+"";
              return cadena.replace("watch?v=", "embed/");
            }
            return "";
          },
          getConfig:function(){
              this.preload=true;
              var url =this.base_url+'/cursos/e_config';
              axios.post(url,{id:this.id}).then(response =>{
                  this.o_curso=response.data.curso;
                  $('#summernote').summernote('code',this.o_curso.plan_estudio);
                  this.preload=false;
              }).catch(error =>{
                  this.preload=false;
              });
          },
          upd_planestudio:function(){
            this.loader_updplan=true;
            var url =this.base_url+'/cursos/u_configplan/'+this.id;
            let inst=this;
            axios.post(url,{
              plan_estudio : $('#summernote').summernote('code')
            }).then(response =>{
                this.loader_updplan=false;
                swal({
                    title:response.data.message,
                    text:response.data.message2,
                    type: "success"
                },function(){
                  inst.getConfig();
                });
            }).catch(error =>{
                this.loader_updplan=false;
                if(error.response.data.errors){
                  this.e_curso=error.response.data.errors;
                }
                if(error.response.data.error){
                  toastr.error(error.response.data.error,'',{
                      "timeOut": "2500"
                  });
                }
            });
          },
          upd_urlvideo:function(){
            this.loader_updvideo=true;
            var url =this.base_url+'/cursos/u_configvideo/'+this.id;
            let inst=this;
            axios.post(url,{
              urlvideo : this.o_curso.urlvideo
            }).then(response =>{
                this.loader_updvideo=false;
                swal({
                    title:response.data.message,
                    text:response.data.message2,
                    type: "success"
                },function(){
                  inst.getConfig();
                });
            }).catch(error =>{
                this.loader_updvideo=false;
                if(error.response.data.errors){
                  this.e_curso=error.response.data.errors;
                }
                if(error.response.data.error){
                  toastr.error(error.response.data.error,'',{
                      "timeOut": "2500"
                  });
                }
            });
          },
          upd_urllogo:function(){
            this.loader_updlogo=true;
            var imagen  =$('#file_avatar')[0].files[0];
            var formData = new FormData();
            formData.append('avatar',imagen);
            var url =this.base_url+'/cursos/u_configlogo/'+this.id;
            let inst=this;
            axios.post(url,formData,{avatar:imagen}).then(response =>{
                this.loader_updlogo=false;
                swal({
                    title:response.data.message,
                    text:response.data.message2,
                    type: "success"
                },function(){
                  inst.getConfig();
                });
            }).catch(error =>{
                this.loader_updlogo=false;
                if(error.response.data.errors){
                  this.e_curso=error.response.data.errors;
                }
                if(error.response.data.error){
                  toastr.error(error.response.data.error,'',{
                      "timeOut": "2500"
                  });
                }
            });
          }
        }
    }
</script>
