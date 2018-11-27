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
      a_ejercicios:[],
      o_ejercicio:{},

      preloadmodal:true,
      a_revision:[],
      o_revision:{},
      loader_revision :false,
    },
    computed : {

    },
    methods : {
      listado:function(){
        var url =base_url+'/ejercicios/listaent';
        this.preload=true;
        axios.post(url,{idcurso:this.idcurso,id:this.id}).then(response =>{
            this.preload=false;
            this.a_ejercicios=response.data.ejercicios;
            this.o_ejercicio=response.data.ejercicio;
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
        window.location.href=base_url+'/ejercicios/'+this.idcurso;
      },
      openRevisar:function(id){
        $('#modal_revision').modal('show');
        var url =base_url+'/ejercicios/revision';
        this.preloadmodal=true;
        axios.post(url,{id:id}).then(response =>{
            this.preloadmodal=false;
            this.a_revision=response.data.ejercicio;
            this.o_revision.id=id;
            console.log(response.data);
        }).catch(error =>{
            this.preloadmodal=false;
            this.a_revision=[];
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
        /*this.loader_revision=true;
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
        });*/
      }
    }
});
