
new Vue({
    el : '#vue',
    ready: function(){

    },
    created : function(){
      var id=document.getElementById('id').value;
      this.id_curso=id;
      this.getCurso();
    },
    data : {
      loader_actualizar:false,
      id_curso :0,
      o_curso:{},
      e_curso:[],
      preload :false,
    },
    computed : {

    },
    methods : {
      getCurso:function(){
          this.preload=true;
          var url =base_url+'/cursos/editar/'+this.id_curso;
          axios.get(url,{}).then(response =>{
              this.o_curso=response.data.curso;
              this.preload=false;
              console.log(this.o_curso);
          }).catch(error =>{
              this.preload=false;
              console.log(error.response.data);
          });
      },
      actualizar:function(){
        this.loader_actualizar=true;
        var url =base_url+'/cursos/actualizar';
        this.o_curso.id=this.id_curso;
        console.log(this.o_curso.id);
        axios.post(url,this.o_curso).then(response =>{
            this.loader_actualizar=false;
            this.e_curso=[];
            swal({
                title:response.data.message,
                text:response.data.message2,
                type: "success"
            },function(){
              window.location.href=base_url+'/cursos';
            });
        }).catch(error =>{
            this.loader_actualizar=false;
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
