new Vue({
    el : '#vue',
    ready: function(){
    },
    created : function(){
      this.idcurso=document.getElementById('idcurso').value;
      this.listado();
    },
    data : {
      id : 0,
      preload:true,
      a_leccion:[],
      select_mod:[],
      idmodulo:0
    },
    computed : {

    },
    methods : {
      listado:function(){
        var url =base_url+'/lecciones/lista';
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
      redirectCrear:function(){
        window.location.href=base_url+'/lecciones/v_crear/'+this.idcurso;
      },
      redirectEdit:function(id){
        window.location.href=base_url+'/lecciones/v_editar/'+this.idcurso+'/'+id;
      },
      busqueda_modulo:function(){
        var url =base_url+'/lecciones/listamod';
        this.preload=true;
        axios.post(url,{idmodulo:this.idmodulo}).then(response =>{
            this.preload=false;
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
      }
    }
});
