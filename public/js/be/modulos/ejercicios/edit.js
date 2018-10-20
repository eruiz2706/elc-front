
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
      o_ejercicio:{},
      e_ejercicio:[],
      preload :false,
    },
    computed : {

    },
    methods : {
      getCurso:function(){
          this.preload=true;
          var url =base_url+'/ejercicios/editar/'+this.id;
          axios.get(url,{}).then(response =>{
              this.o_ejercicio=response.data.ejercicio;
              this.preload=false;
          }).catch(error =>{
              this.preload=false;
              console.log(error.response.data);
          });
      },
      actualizar:function(){
        this.loader_actualizar=true;
        var url =base_url+'/ejercicios/actualizar';
        this.o_ejercicio.id=this.id;
        axios.post(url,this.o_ejercicio).then(response =>{
            this.loader_actualizar=false;
            this.e_ejercicio=[];
            swal({
                title:response.data.message,
                text:response.data.message2,
                type: "success"
            },function(){
              var idcurso=document.getElementById('idcurso').value;
              window.location.href=base_url+'/ejercicios/'+idcurso;
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
