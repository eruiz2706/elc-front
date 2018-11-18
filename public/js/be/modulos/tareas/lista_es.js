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
      preload:true,
      a_tareas:[],
    },
    computed : {

    },
    methods : {
      listado:function(){
        var url =base_url+'/tareas/lista_es';
        this.preload=true;
        axios.post(url,{idcurso:this.idcurso}).then(response =>{
            this.preload=false;
            this.a_tareas=response.data.tareas;
        }).catch(error =>{
            this.preload=false;
            this.modulos=[];
            if(error.response.data.errors){
            }
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "3500"
              });
            }
        });
      },
      abrir:function(id){
        window.location.href=base_url+'/tareas/v_entrega/'+this.idcurso+'/'+id;
      },
    }
});
