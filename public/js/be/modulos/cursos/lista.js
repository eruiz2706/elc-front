new Vue({
    el : '#vue',
    ready: function(){
    },
    created : function(){
      this.listado();
    },
    data : {
      preload:false,
      a_cursos:[],
    },
    computed : {

    },
    methods : {
      listado:function(){
        var url =base_url+'/cursos/lista';
        this.preload=true;
        axios.post(url,{}).then(response =>{
            this.preload=false;
            this.a_cursos=response.data.cursos;
            console.log(this.a_cursos);
        }).catch(error =>{
            this.preload=false;
            this.a_cursos=[];
            if(error.response.data.errors){
              //this.e_curso=error.response.data.errors;
            }
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "2500"
              });
            }

        });
      },
      redirectEdit:function(cursoid){
        window.location.href=base_url+'/cursos/v_editar/'+cursoid;
      },
      redirectAbrir:function(cursoid){
        window.location.href=base_url+'/cursos/abrir/'+cursoid;
      },

    }
});
