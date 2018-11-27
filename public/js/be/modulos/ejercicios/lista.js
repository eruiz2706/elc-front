new Vue({
    el : '#vue',
    ready: function(){
    },
    created : function(){
      this.idcurso=document.getElementById('idcurso').value;
      this.listado();
    },
    data : {
      idcurso : 0,
      preload:false,
      a_ejercicios:[],
      cantUser : 0
    },
    computed : {

    },
    methods : {
      listado:function(){
        var url =base_url+'/ejercicios/lista';
        this.preload=true;
        axios.post(url,{idcurso:this.idcurso}).then(response =>{
            this.preload=false;
            this.a_ejercicios=response.data.ejercicios;
            this.cantUser=response.data.cantUser;
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
      redirectCrear:function(){
        window.location.href=base_url+'/ejercicios/v_crear/'+this.idcurso;
      },
      redirectEdit:function(id){
        window.location.href=base_url+'/ejercicios/v_editar/'+this.idcurso+'/'+id;
      },
      redirectPreguntas:function(id){
        window.location.href=base_url+'/preguntas/'+this.idcurso+'/'+id;
      },
      redirectEnt:function(id){
        window.location.href=base_url+'/ejercicios/v_listaent/'+this.idcurso+'/'+id;
      }

    }
});
