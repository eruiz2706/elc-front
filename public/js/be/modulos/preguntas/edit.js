
new Vue({
    el : '#vue',
    ready: function(){

    },
    created : function(){
      this.idcurso=document.getElementById('idcurso').value;
      this.idejerc=document.getElementById('idejerc').value;
      this.id=document.getElementById('id').value;
      this.getCurso();
    },
    data : {
      loader_actualizar:false,
      id :0,
      idcurso :0,
      idejerc:0,
      o_pregunta:{},
      e_pregunta:[],
      preload :false,
    },
    computed : {

    },
    methods : {
      getCurso:function(){
          this.preload=true;
          var url =base_url+'/preguntas/editar/'+this.id;
          axios.get(url,{}).then(response =>{
              this.o_pregunta=response.data.pregunta;
              this.preload=false;
          }).catch(error =>{
              this.preload=false;
              console.log(error.response.data);
          });
      },
      actualizar:function(){
        this.loader_actualizar=true;
        var url =base_url+'/preguntas/actualizar';
        this.o_pregunta.id=this.id;
        this.o_pregunta.idejerc=this.idejerc;
        axios.post(url,this.o_pregunta).then(response =>{
            this.loader_actualizar=false;
            this.e_pregunta=[];
            swal({
                title:response.data.message,
                text:response.data.message2,
                type: "success"
            },function(){
              var idcurso=document.getElementById('idcurso').value;
              var idejerc=document.getElementById('idejerc').value;
              window.location.href=base_url+'/preguntas/'+idcurso+'/'+idejerc;
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
