
new Vue({
    el : '#vue',
    ready: function(){

    },
    created : function(){
      var id=document.getElementById('id').value;
      this.id=id;
      this.getCurso();
    },
    data : {
      loader_actualizar:false,
      id :0,
      o_curso:{},
      e_curso:[],
      preload :false,
      traduction:{}
    },
    computed : {

    },
    methods : {
      getCurso:function(){
          this.preload=true;
          var url =base_url+'/getcursodet/'+this.id;
          axios.get(url,{}).then(response =>{
              this.o_curso=response.data.curso;
              this.traduction=response.data.traduction;
              this.preload=false;
              console.log(this.o_curso);
          }).catch(error =>{
              this.preload=false;
              console.log(error.response.data);
          });
      }
    }
});
