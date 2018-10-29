new Vue({
    el : '#vue',
    ready: function(){
    },
    created : function(){
      this.idcurso=document.getElementById('idcurso').value;
    },
    data : {
      idcurso:0,
      o_baseejercicio:{'nombre':'','fecha_inicio':'','duracion':0,'descripcion':''},
      o_ejercicio:{'nombre':'','fecha_inicio':'','duracion':0,'descripcion':''},
      e_ejercicio:[],
      loader_guardar :false,
    },
    computed : {

    },
    methods : {
      guardar:function(){
        this.loader_guardar=true;
        this.o_ejercicio.idcurso=this.idcurso;
        this.o_ejercicio.descripcion=$('#summernote').summernote('code');
        var url =base_url+'/ejercicios/guardar';
        axios.post(url,this.o_ejercicio).then(response =>{
            this.loader_guardar=false;
            this.e_ejercicio=[];
            this.o_ejercicio=this.o_baseejercicio;
            swal({
                title:response.data.message,
                text:response.data.message2,
                type: "success"
            },function(){
                var idcurso=document.getElementById('idcurso').value;
                window.location.href=base_url+'/ejercicios/'+idcurso;
            });
        }).catch(error =>{
            this.loader_guardar=false;
            if(error.response.data.errors){
              this.e_ejercicio=error.response.data.errors;
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
