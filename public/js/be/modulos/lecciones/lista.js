new Vue({
    el : '#vue',
    ready: function(){
    },
    created : function(){
      this.idcurso=document.getElementById('idcurso').value;
      this.idmodulo=document.getElementById('idmodulo').value;
      this.listado();
      console.log('fafd');
    },
    data : {
      id : 0,
      preload:false,
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
                  "timeOut": "2500"
              });
            }
            console.log(error.response.data);
        });
      },
      crear:function(){
        window.location.href=base_url+'/lecciones/'+this.idcurso+'/'+this.idmodulo+'/v_crear';
      },
      editar:function(idleccion){
        window.location.href=base_url+'/lecciones/'+this.idcurso+'/'+this.idmodulo+'/v_editar/'+idleccion;
      }
    }
});
