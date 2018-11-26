
var curso_edit=new Vue({
    el : '#vue',
    ready: function(){

    },
    created : function(){
      this.id_curso=document.getElementById('id').value;
      this.getCurso();
    },
    data : {
      preload :true,
      id_curso :0,
      o_curso:{},
      e_curso:[],
      loader_actualizar:false,
    },
    computed : {

    },
    methods : {
      getCurso:function(){
          this.preload=true;
          var url =base_url+'/cursos/editar/'+this.id_curso;
          axios.get(url,{}).then(response =>{
              this.o_curso=response.data.curso;
              this.o_curso.profesor=response.data.profesor;
              this.o_curso.profesor2=response.data.profesor2;
              this.preload=false;
          }).catch(error =>{
              this.preload=false;
          });
      },
      actualizar:function(){
        this.loader_actualizar=true;
        var url =base_url+'/cursos/actualizar';
        this.o_curso.id=this.id_curso;
        axios.post(url,this.o_curso).then(response =>{
            this.loader_actualizar=false;
            this.e_curso=[];
            swal({
                title:response.data.message,
                text:response.data.message2,
                type: "success"
            },function(){
              curso_edit.getCurso();
            });
        }).catch(error =>{
            this.loader_actualizar=false;
            if(error.response.data.errors){
              this.e_curso=error.response.data.errors;
            }
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "3500"
              });
            }
        });
      }
    }
});
