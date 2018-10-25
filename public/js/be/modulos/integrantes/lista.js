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
      a_integrantes:[],
    },
    computed : {

    },
    methods : {
      listado:function(){
        var url =base_url+'/integrantes/lista';
        this.preload=true;
        axios.post(url,{idcurso:this.idcurso}).then(response =>{
            this.preload=false;
            this.a_integrantes=response.data.integrantes;
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
      }
    }
});
