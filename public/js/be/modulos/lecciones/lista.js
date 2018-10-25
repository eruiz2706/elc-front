new Vue({
    el : '#vue',
    ready: function(){
    },
    created : function(){
      this.idcurso=document.getElementById('idcurso').value;
      this.idmodulo=document.getElementById('idmodulo').value;
      this.listado();
    },
    data : {
      id : 0,
      preload:true,
      a_leccion:[],
    },
    computed : {

    },
    methods : {
      listado:function(){
        var url =base_url+'/lecciones/lista';
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
            console.log(error.response.data);
        });
      },
      redirectCrear:function(){
        window.location.href=base_url+'/lecciones/v_crear/'+this.idcurso+'/'+this.idmodulo;
      },
      redirectEdit:function(id){
        window.location.href=base_url+'/lecciones/v_editar/'+this.idcurso+'/'+this.idmodulo+'/'+id;
      }
    }
});
