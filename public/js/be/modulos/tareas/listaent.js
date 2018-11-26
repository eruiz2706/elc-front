new Vue({
    el : '#vue',
    ready: function(){
    },
    created : function(){
      this.idcurso=document.getElementById('idcurso').value;
      this.id=document.getElementById('id').value;
      this.listado();
    },
    data : {
      idcurso : 0,
      id : 0,
      preload:true,
      a_tareas:[],
      o_tarea:{},

      preloadmodal:true,
      o_revision:{},
      loader_revision :false,
    },
    computed : {

    },
    methods : {
      listado:function(){
        var url =base_url+'/tareas/listaent';
        this.preload=true;
        axios.post(url,{idcurso:this.idcurso,id:this.id}).then(response =>{
            this.preload=false;
            this.a_tareas=response.data.tareas;
            this.o_tarea=response.data.tarea;
        }).catch(error =>{
            this.preload=false;
            if(error.response.data.errors){
            }
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "3500"
              });
            }
        });
      },
      redirectVolver:function(){
        window.location.href=base_url+'/tareas/'+this.idcurso;
      },
      openRevisar:function(id){
        $('#modal_revision').modal('show');
        var url =base_url+'/tareas/revision';
        this.preloadmodal=true;
        axios.post(url,{id:id}).then(response =>{
            this.preloadmodal=false;
            this.o_revision=response.data.tarea;
            this.o_revision.id=id;
            console.log(response.data);
        }).catch(error =>{
            this.preloadmodal=false;
            this.o_revision={};
            if(error.response.data.errors){
            }
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "3500"
              });
            }

        });
      },
      updrevision:function(){
        this.loader_revision=true;
        var url =base_url+'/tareas/updrevision';
        axios.post(url,this.o_revision).then(response =>{
            this.loader_revision=false;
            this.o_revision={};
            $('#modal_revision').modal('hide');
            this.listado();
            swal({
                title:response.data.message,
                text:response.data.message2,
                type: "success"
            });
        }).catch(error =>{
            this.loader_revision=false;
            if(error.response.data.errors){
              this.e_tarea=error.response.data.errors;
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
