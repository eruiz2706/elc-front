new Vue({
    el : '#vue',
    ready: function(){
    },
    created : function(){
      this.idcurso=document.getElementById('idcurso').value;
      this.list_select();
    },
    data : {
      idcurso:0,
      preload:true,
      o_baseleccion:{'modulo':'','nombre':'','descripcion':'','tiempolectura':0},
      o_leccion:{'modulo':'','nombre':'','descripcion':'','tiempolectura':0},
      e_leccion:[],
      loader_guardar :false,
      select_mod:[],
    },
    computed : {

    },
    methods : {
      list_select:function(){
        var url =base_url+'/lecciones/select_mod';
        this.preload=true;
        axios.post(url,{idcurso:this.idcurso}).then(response =>{
            this.preload=false;
            this.select_mod=response.data.select_mod;
            this.a_leccion=response.data.lecciones;
        }).catch(error =>{
            this.preload=false;
            this.a_leccion=[];
            if(error.response.data.errors){
            }
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "3500"
              });
            }
        });
      },
      guardar:function(){
        this.loader_guardar=true;
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
                window.location.href=base_url+'/lecciones/'+idcurso;
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
      redirectVolver:function(){
        window.location.href=base_url+'/lecciones/'+this.idcurso;
      }
    }
});
