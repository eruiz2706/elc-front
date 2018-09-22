
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
          var url ='inicio/busq';
          axios.post(url,{}).then(response =>{
              this.cursos=response.data.cursos;
              this.preload=false;
              console.log(this.cursos);
          }).catch(error =>{
              this.preload=false;
              console.log(error.response.data);
          });
      },
      detcurso:function(id){
        window.location ='inicio/detcurso/'+id;
      }
    }
});
