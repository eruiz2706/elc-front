
new Vue({
    el : '#vue',
    ready: function(){

    },
    created : function(){
      this.idcurso=document.getElementById('idcurso').value;
      this.id=document.getElementById('id').value;
      this.getCurso();
    },
    data : {
      loader_actualizar:false,
      id :0,
      idcurso :0,
      o_modulo:{},
      e_modulo:[],
      preload :false,
    },
    computed : {

    },
    methods : {
      getCurso:function(){
          this.preload=true;
          var url =base_url+'/modulos/editar/'+this.id;
          axios.get(url,{}).then(response =>{
              this.o_modulo=response.data.modulo;
              this.preload=false;
          }).catch(error =>{
              this.preload=false;
              console.log(error.response.data);
          });
      },
      actualizar:function(){
        this.loader_actualizar=true;
        var url =base_url+'/modulos/actualizar';
        this.o_modulo.id=this.id;
        axios.post(url,this.o_modulo).then(response =>{
            this.loader_actualizar=false;
            this.e_modulo=[];
            swal({
                title:response.data.message,
                text:response.data.message2,
                type: "success"
            },function(){
              window.location.href=base_url+'/modulos/'+document.getElementById('idcurso').value;
            });
        }).catch(error =>{
            this.loader_actualizar=false;
            if(error.response.data.errors){
              this.e_modulo=error.response.data.errors;
            }
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "2500"
              });
            }
        });
      }
    }
});
