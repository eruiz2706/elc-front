new Vue({
    el : '#vue',
    ready: function(){
    },
    created : function(){
      this.idcurso=document.getElementById('idcurso').value;
    },
    data : {
      idcurso:0,
      o_basetarea:{'nombre':''},
      o_tarea:{'nombre':''},
      e_tarea:[],
      loader_guardar :false,
    },
    computed : {

    },
    methods : {
      guardar:function(){
        this.loader_guardar=true;
        this.o_tarea.idcurso=this.idcurso;
        var url =base_url+'/tareas/guardar';
        axios.post(url,this.o_tarea).then(response =>{
            this.loader_guardar=false;
            this.e_tarea=[];
            this.o_tarea=this.o_basetarea;
            swal({
                title:response.data.message,
                text:response.data.message2,
                type: "success"
            },function(){
                var idcurso=document.getElementById('idcurso').value;
                window.location.href=base_url+'/tareas/'+idcurso;
            });
        }).catch(error =>{
            this.loader_guardar=false;
            if(error.response.data.errors){
              this.e_modulo=error.response.data.errors;
            }
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "2500"
              });
            }
            console.log(error.response.data);
        });
      },
    }
});
