new Vue({
    el : '#vue',
    ready: function(){
    },
    created : function(){
      this.idcurso=document.getElementById('idcurso').value;
    },
    data : {
      idcurso:0,
      o_basetarea:{'nombre':'','calificacion':0,'fecha_vencimiento':'','descripcion':''},
      o_tarea:{'nombre':'','calificacion':0,'fecha_vencimiento':'','descripcion':''},
      e_tarea:[],
      loader_guardar :false,
    },
    computed : {

    },
    methods : {
      guardar:function(){
        this.loader_guardar=true;
        this.o_tarea.idcurso=this.idcurso;
        this.o_tarea.descripcion=$('#summernote').summernote('code');
        var url =base_url+'/tareas/guardar';
        axios.post(url,this.o_tarea).then(response =>{
            this.loader_guardar=false;
            this.e_tarea=[];
            this.o_tarea=this.o_basetarea;

            socket.emit('notifi_cli',{
              'notifi_tk':response.data.notifi_tk
            });
            console.log(response.data.notifi_tk);
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
        window.location.href=base_url+'/tareas/'+this.idcurso;
      }
    }
});
