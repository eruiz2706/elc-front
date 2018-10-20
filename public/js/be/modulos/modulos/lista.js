new Vue({
    el : '#vue',
    ready: function(){
    },
    created : function(){
      this.id=document.getElementById('id').value;
      this.listado();
      console.log('fafd');
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
        axios.post(url,{idcurso:this.id}).then(response =>{
            this.preload=false;
            this.a_modulos=response.data.modulos;
        }).catch(error =>{
            this.preload=false;
            this.modulos=[];
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
        window.location.href=base_url+'/modulos/'+this.id+'/v_crear';
      },
      editar:function(idmodulo){
        window.location.href=base_url+'/modulos/'+this.id+'/v_editar/'+idmodulo;
      },lecciones:function(idmodulo){
        window.location.href=base_url+'/lecciones/'+this.id+'/'+idmodulo;
      },

    }
});
