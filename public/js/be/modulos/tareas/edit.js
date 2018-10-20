
new Vue({
    el : '#vue',
    ready: function(){

    },
    created : function(){
      this.idcurso=document.getElementById('idcurso').value;
      this.id=document.getElementById('id').value;
      this.getCurso();
    },
    data : {
      loader_actualizar:false,
      id :0,
      idcurso :0,
      o_tarea:{},
      e_tarea:[],
      preload :false,
    },
    computed : {

    },
    methods : {
      getCurso:function(){
          this.preload=true;
          var url =base_url+'/tareas/editar/'+this.id;
          axios.get(url,{}).then(response =>{
              this.o_tarea=response.data.tarea;
              this.preload=false;
          }).catch(error =>{
              this.preload=false;
              console.log(error.response.data);
          });
      },
      actualizar:function(){
        this.loader_actualizar=true;
        var url =base_url+'/tareas/actualizar';
        this.o_tarea.id=this.id;
        axios.post(url,this.o_tarea).then(response =>{
            this.loader_actualizar=false;
            this.e_tarea=[];
            swal({
                title:response.data.message,
                text:response.data.message2,
                type: "success"
            },function(){
              var idcurso=document.getElementById('idcurso').value;
              window.location.href=base_url+'/tareas/'+idcurso;
            });
        }).catch(error =>{
            this.loader_actualizar=false;
            if(error.response.data.errors){
              this.e_modulo=error.response.data.errors;
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
