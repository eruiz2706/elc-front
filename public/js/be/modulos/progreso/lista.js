new Vue({
    el : '#vue',
    ready: function(){
    },
    created : function(){

      this.idcurso=document.getElementById('idcurso').value;
      this.listado();
    },
    data : {
      id : 0,
      preload:false,
      a_progreso:[],
    },
    computed : {

    },
    methods : {
      listado:function(){
        var url =base_url+'/progreso/lista';
        this.preload=true;
        axios.post(url,{idcurso:this.idcurso}).then(response =>{
            this.preload=false;
            this.a_progreso=response.data.progreso;
        }).catch(error =>{
            this.preload=false;
            this.a_progreso=[];
            if(error.response.data.errors){
            }
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "3500"
              });
            }

        });
      },
      leccionLeida:function(idmodulo,idleccion,leido){
        if(leido==false){
          var url =base_url+'/progreso/guardar';
          axios.post(url,{idmodulo:idmodulo,id:idleccion}).then(response =>{
              this.listado();
              swal({
                  title:response.data.message,
                  text:response.data.message2,
                  type: "success"
              });
          }).catch(error =>{
              if(error.response.data.errors){
                this.e_curso=error.response.data.errors;
              }
              if(error.response.data.error){
                toastr.error(error.response.data.error,'',{
                    "timeOut": "3500"
                });
              }
          });
        }
      },
      porcent:function(numerador,denominador){

        if(denominador==0){
          return 0;
        }else{
          return (numerador/denominador)*100;
        }
      }
    }
});
