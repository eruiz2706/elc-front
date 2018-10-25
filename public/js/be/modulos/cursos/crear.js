new Vue({
    el : '#vue',
    ready: function(){
    },
    created : function(){
    },
    data : {
      o_basecurso:{'nombre':'','fecha_inicio':'','fecha_finalizacion':'','duracion':'','urlvideo':'','visibilidad':false,'inscripcion':true},
      o_curso:{'nombre':'','fecha_inicio':'','fecha_finalizacion':'','duracion':'','urlvideo':'','visibilidad':false,'inscripcion':true},
      e_curso:[],
      loader_guardar :false,
    },
    computed : {

    },
    methods : {
      guardar:function(){
        this.loader_guardar=true;
        var url =base_url+'/cursos/guardar';
        axios.post(url,this.o_curso).then(response =>{
            this.loader_guardar=false;
            this.e_curso=[];
            this.o_curso=this.o_basecurso;
            swal({
                title:response.data.message,
                text:response.data.message2,
                type: "success"
            },function(){
              window.location.href=base_url+'/cursos';
            });
        }).catch(error =>{
            this.loader_guardar=false;
            if(error.response.data.errors){
              this.e_curso=error.response.data.errors;
            }
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "3500"
              });
            }
        });
      },
    }
});
