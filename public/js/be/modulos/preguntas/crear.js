new Vue({
    el : '#vue',
    ready: function(){
    },
    created : function(){
      this.idcurso=document.getElementById('idcurso').value;
      this.idejerc=document.getElementById('idejerc').value;
    },
    data : {
      idcurso:0,
      idejerc:0,
      o_basepregunta:{'nombre':''},
      o_pregunta:{'nombre':''},
      e_pregunta:[],
      loader_guardar :false,
    },
    computed : {

    },
    methods : {
      guardar:function(){
        this.loader_guardar=true;
        this.o_pregunta.idcurso=this.idcurso;
        this.o_pregunta.idejerc=this.idejerc;
        var url =base_url+'/preguntas/guardar';
        axios.post(url,this.o_pregunta).then(response =>{
            this.loader_guardar=false;
            this.e_pregunta=[];
            this.o_pregunta=this.o_basepregunta;
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
            this.loader_guardar=false;
            if(error.response.data.errors){
              this.e_pregunta=error.response.data.errors;
            }
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "2500"
              });
            }
            console.log(error.response.data);
        });
      },
    }
});
