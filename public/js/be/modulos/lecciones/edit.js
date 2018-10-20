
new Vue({
    el : '#vue',
    ready: function(){

    },
    created : function(){
      this.idmodulo=document.getElementById('idmodulo').value;
      this.idcurso=document.getElementById('idcurso').value;
      this.id=document.getElementById('id').value;
      this.getCurso();
    },
    data : {
      loader_actualizar:false,
      id :0,
      idmodulo:0,
      idcurso :0,
      o_leccion:{},
      e_leccion:[],
      preload :false,
    },
    computed : {

    },
    methods : {
      getCurso:function(){
          this.preload=true;
          var url =base_url+'/lecciones/editar/'+this.id;
          axios.get(url,{}).then(response =>{
              this.o_leccion=response.data.leccion;
              this.preload=false;
          }).catch(error =>{
              this.preload=false;
              console.log(error.response.data);
          });
      },
      actualizar:function(){
        this.loader_actualizar=true;
        var url =base_url+'/lecciones/actualizar';
        this.o_leccion.id=this.id;
        axios.post(url,this.o_leccion).then(response =>{
            this.loader_actualizar=false;
            this.e_leccion=[];
            swal({
                title:response.data.message,
                text:response.data.message2,
                type: "success"
            },function(){
              var idmodulo=document.getElementById('idmodulo').value;
              var idcurso=document.getElementById('idcurso').value;
              window.location.href=base_url+'/lecciones/'+idcurso+'/'+idmodulo;
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
