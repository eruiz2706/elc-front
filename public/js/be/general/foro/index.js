
new Vue({
    el : '#vue',
    ready: function(){
    },
    created : function(){
      this.getData();
    },
    data : {
      preload :false,
      a_foros :[],
      loader_publicar:false,
      o_publicar:{'comentario':''},
      e_publicar:[],
      o_comentario:{'indexforo':-1,'idforo':'','comentario':''},
      preload_coment:false,
      a_comentarios:[],
      loader_responder:false,
      e_comentarios:[]
    },
    computed : {

    },
    methods : {
      getData:function(){
          this.preload=true;
          var url ='foro/data';
          axios.post(url,{}).then(response =>{
              this.preload=false;
              this.a_foros=response.data.foros;
          }).catch(error =>{
              this.preload=false;
              console.log(error.response.data);
          });
      },
      publicacion:function(){
          this.loader_publicar=true;
          var url ='foro/publicar';
          axios.post(url,this.o_publicar).then(response =>{
              //this.a_foros.unshift({'nombreuser':'cargfasdf'});
              this.getData();
              this.o_publicar={'comentario':''};
              this.loader_publicar=false;
              this.e_publicar=[];
              console.log(response.data.foros);
          }).catch(error =>{
              this.loader_publicar=false;
              if(error.response.data.errors){
                this.e_publicar=error.response.data.errors;
              }
              if(error.response.data.error){
                toastr.error(error.response.data.error,'',{
                    "timeOut": "2500"
                });
              }
              console.log(error.response.data);
          });
      },
      openComentarios:function(idforo,indexforo){

        $('#modalcomentforo').modal('show');
        this.a_comentarios=[];
        this.o_comentario.idforo=idforo;
        this.o_comentario.comentario='';
        this.o_comentario.indexforo=indexforo;
        this.verComentarios();
      },
      verComentarios:function(){
        this.preload_coment=true;
        var url ='foro/datacoment';
        axios.post(url,{idforo:this.o_comentario.idforo}).then(response =>{
            this.preload_coment=false;
            this.a_comentarios=response.data.comentarios;
        }).catch(error =>{
            this.preload_coment=false;
        });
      },
      agregarComentario:function(){
        this.loader_responder=true;
        this.e_comentarios=[];
        var url ='foro/comentar';
        axios.post(url,this.o_comentario).then(response =>{
            this.loader_responder=false;
            this.o_comentario.comentario='';
            this.a_foros[this.o_comentario.indexforo].comentarios=response.data.contcoment;
            this.verComentarios();
        }).catch(error =>{
            this.loader_responder=false;
            if(error.response.data.errors){
                this.e_comentarios=error.response.data.errors;
            }
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "2500"
              });
            }
            console.log(error.response.data);
        });
      }
    }
});