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
      preloadmodal:false,
      a_progreso:[],
      a_progmod:[]
    },
    computed : {

    },
    methods : {
      listado:function(){
        var url =base_url+'/progreso/lista_pr';
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
      porcent:function(numerador,denominador){

        if(denominador==0){
          return 0;
        }else{
          return (numerador/denominador)*100;
        }
      },
      estadoporcent:function(numerador,denominador){

        if(denominador==0){
          return false;
        }else{
          var porcen=(numerador/denominador)*100;
          if(porcen<100)return false;
          return true;
        }
      },
      progresomodulo:function(id){
        $('#modal_progmod').modal('show');
        var url =base_url+'/progreso/progmod';
        this.preloadmodal=true;
        axios.post(url,{idcurso:this.idcurso,idmodulo:id}).then(response =>{
            this.preloadmodal=false;
            this.a_progmod=response.data.progmod;
            console.log(response.data);
        }).catch(error =>{
            this.preloadmodal=false;
            this.a_progmod=[];
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
