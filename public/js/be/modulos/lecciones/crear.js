new Vue({
    el : '#vue',
    ready: function(){
    },
    created : function(){
      this.idcurso=document.getElementById('idcurso').value;
      this.idmodulo=document.getElementById('idmodulo').value;
    },
    data : {
      idmodulo:0,
      idcurso:0,
      o_baseleccion:{'nombre':'','descripcion':'','tiempolectura':0},
      o_leccion:{'nombre':'','descripcion':'','tiempolectura':0},
      e_leccion:[],
      loader_guardar :false,
    },
    computed : {

    },
    methods : {
      guardar:function(){
        this.loader_guardar=true;
        this.o_leccion.idmodulo=this.idmodulo;
        this.o_leccion.descripcion=$('#summernote').summernote('code');
        var url =base_url+'/lecciones/guardar';
        axios.post(url,this.o_leccion).then(response =>{
            this.loader_guardar=false;
            this.o_leccion=this.o_baseleccion;
            swal({
                title:response.data.message,
                text:response.data.message2,
                type: "success"
            },function(){
                var idcurso=document.getElementById('idcurso').value;
                var idmodulo=document.getElementById('idmodulo').value;
                window.location.href=base_url+'/lecciones/'+idcurso+'/'+idmodulo;
            });
        }).catch(error =>{
            this.loader_guardar=false;
            if(error.response.data.errors){
              this.e_leccion=error.response.data.errors;
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
