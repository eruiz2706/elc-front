
new Vue({
    el : '#vue',
    ready: function(){

    },
    created : function(){
      var id=document.getElementById('id').value;
      this.getCurso(id);
    },
    data : {
      obj_curso:{},
      preload :false,
    },
    computed : {

    },
    methods : {
      getCurso:function(id){
          this.preload=true;
          var url =base_url+'/es/inicio/curso/'+id;
          axios.get(url,{}).then(response =>{
              this.obj_curso=response.data.curso;
              this.preload=false;
              console.log(this.obj_curso);
          }).catch(error =>{
              this.preload=false;
              console.log(error.response.data);
          });
      },
    }
});
