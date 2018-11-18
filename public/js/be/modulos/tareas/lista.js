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
      cantUser : 0
    },
    computed : {

    },
    methods : {
      listado:function(){
        var url =base_url+'/tareas/lista';
        this.preload=true;
        axios.post(url,{idcurso:this.idcurso}).then(response =>{
            this.preload=false;
            this.a_tareas=response.data.tareas;
            this.cantUser=response.data.cantUser;
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
      redirectCrear:function(){
        window.location.href=base_url+'/tareas/v_crear/'+this.idcurso;
      },
      redirectEdit:function(id){
        window.location.href=base_url+'/tareas/v_editar/'+this.idcurso+'/'+id;
      }

    }
});
