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
      preload:false,
      a_modulos:[],
    },
    computed : {

    },
    methods : {
      listado:function(){
        var url =base_url+'/modulos/lista';
        this.preload=true;
        axios.post(url,{idcurso:this.idcurso}).then(response =>{
            this.preload=false;
            this.a_modulos=response.data.modulos;

        }).catch(error =>{
            this.preload=false;
            this.a_modulos=[];
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
        window.location.href=base_url+'/modulos/v_crear/'+this.idcurso;
      },
      redirectEdit:function(id){
        window.location.href=base_url+'/modulos/v_editar/'+this.idcurso+'/'+id;
      },redirectLecciones:function(id){
        window.location.href=base_url+'/lecciones/'+this.idcurso+'/'+id;
      },

    }
});
