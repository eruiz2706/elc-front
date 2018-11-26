
new Vue({
    el : '#vue',
    ready: function(){

    },
    created : function(){
      this.getBusqueda();
    },
    data : {
      cursos:[],
      errores :[],
      preload :false,
    },
    computed : {

    },
    methods : {
      getBusqueda:function(){
          this.preload=true;
          var select_bsq=document.getElementById('select_bsq')
          var url =base_url+'/ofertados/busq';
          axios.post(url,{select_bsq:select_bsq.value}).then(response =>{
              this.cursos=response.data.cursos;
              this.preload=false;
              console.log(this.cursos);
          }).catch(error =>{
              this.preload=false;
              console.log(error.response.data);
          });
      },
      detcurso:function(id){
        window.location =base_url+'/ofertados/det/'+id;
      }
    }
});
