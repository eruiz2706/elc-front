/*function para previsualizar la imagen */
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

new Vue({
    el : '#vue',
    ready: function(){
    },
    created : function(){
      this.getConfig();
    },
    data : {
      o_curso:{},
      loader_updplan:false,
      loader_updvideo:false,
      loader_updlogo:false
    },
    computed : {

    },
    methods : {
      getConfig:function(){
          this.preload=true;
          var url =base_url+'/cursos/e_config';
          axios.get(url,{}).then(response =>{
              this.o_curso=response.data.curso;
              $('#summernote').summernote('code',this.o_curso.plan_estudio);
              this.preload=false;
              console.log(this.o_curso);
          }).catch(error =>{
              this.preload=false;
              console.log(error.response.data);
          });
      },
      upd_planestudio:function(){
        this.loader_updplan=true;
        var url =base_url+'/cursos/u_configplan';
        axios.post(url,{
          plan_estudio : $('#summernote').summernote('code')
        }).then(response =>{
            this.loader_updplan=false;
            swal({
                title:response.data.message,
                text:response.data.message2,
                type: "success"
            },function(){
              location.reload();
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
        var url =base_url+'/cursos/u_configvideo';
        axios.post(url,{
          urlvideo : this.o_curso.urlvideo
        }).then(response =>{
            this.loader_updvideo=false;
            swal({
                title:response.data.message,
                text:response.data.message2,
                type: "success"
            },function(){
              location.reload();
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
        var url =base_url+'/cursos/u_configlogo';
        axios.post(url,formData,{avatar:imagen}).then(response =>{
            this.loader_updlogo=false;
            swal({
                title:response.data.message,
                text:response.data.message2,
                type: "success"
            },function(){
              location.reload();
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
});
