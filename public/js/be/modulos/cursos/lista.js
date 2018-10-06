new Vue({
    el : '#vue',
    ready: function(){
    },
    created : function(){
      this.listado();
    },
    data : {
      preload:false,
      a_curso:[],
    },
    computed : {

    },
    methods : {
      listado:function(){
        var url =base_url+'/cursos/lista';
        this.preload=true;
        axios.post(url,this.o_curso).then(response =>{
            this.preload=false;
            this.a_curso=response.data.cursos;
        }).catch(error =>{
            this.preload=false;
            this.a_curso=[];
            if(error.response.data.errors){
              this.e_curso=error.response.data.errors;
            }
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "2500"
              });
            }
            console.log(error.response.data);
        });
      },
    }
});
