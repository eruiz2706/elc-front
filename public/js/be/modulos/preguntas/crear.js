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
      o_basepregunta:{'nombre':'','descripicion':'','tipo':''},
      o_pregunta:{'nombre':'','descripicion':'','tipo':''},
      e_pregunta:[],
      loader_guardar :false,

      //respuesta Unica
      view_resp_unica:false,
      a_resp_unica:[],
      radio_unica:0,
      id_unica:0,

      //respuesta Multiple
      view_resp_multiple:false,
      a_resp_multiple:[],
      id_multiple:0,

      //respuesta relacionar
      view_resp_relacionar:false,
      a_resp_relacionar:[],
      id_relacionar:0
    },
    computed : {

    },
    methods : {
      guardar:function(){
        this.loader_guardar=true;
        this.o_pregunta.idcurso=this.idcurso;
        this.o_pregunta.idejerc=this.idejerc;
        this.o_pregunta.descripcion=$('#summernote').summernote('code');
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
                  "timeOut": "3500"
              });
            }
            console.log(error.response.data);
        });
      },
      viewtipo:function(){
        this.view_resp_unica=false;
        this.view_resp_multiple=false;
        this.view_resp_relacionar=false;

        if(this.o_pregunta.tipo=='unica'){
          this.view_resp_unica=true;
          this.radio_unica=1;
          this.id_unica=2;
          this.a_resp_unica=[
            {'id':1,'respuesta':'','puntaje':0,'delete':true},
            {'id':2,'respuesta':'','puntaje':0,'delete':true}
          ];
        }

        if(this.o_pregunta.tipo=='multiple'){
          this.view_resp_multiple=true;
          this.id_multiple=4;
          this.a_resp_multiple=[
            {'id':1,'option':false,'respuesta':'','puntaje':0,'delete':true},
            {'id':2,'option':false,'respuesta':'','puntaje':0,'delete':true},
            {'id':3,'option':false,'respuesta':'','puntaje':0,'delete':true},
            {'id':4,'option':false,'respuesta':'','puntaje':0,'delete':true}
          ];
        }

        if(this.o_pregunta.tipo=='relacionar'){
          this.view_resp_relacionar=true;
          this.id_relacionar=4;
          this.a_resp_relacionar=[
            {'id':1,'respuesta':'','relacionar':'','puntaje':0,'delete':true},
            {'id':2,'respuesta':'','relacionar':'','puntaje':0,'delete':true},
            {'id':3,'respuesta':'','relacionar':'','puntaje':0,'delete':true},
            {'id':4,'respuesta':'','relacionar':'','puntaje':0,'delete':true}
          ];
        }
      },
      addRespUnica:function(){
        this.id_unica++;
        this.a_resp_unica.push({'id':this.id_unica,'respuesta':'','puntaje':0,'delete':true});
      },
      removeRespUnica:function(index){
        this.a_resp_unica.splice(index, 1);
      },
      addRespMultiple:function(){
        this.id_multiple++;
        this.a_resp_multiple.push({'id':this.id_multiple,'option':false,'respuesta':'','puntaje':0,'delete':true});
      },
      removeRespMultiple:function(index){
        this.a_resp_multiple.splice(index, 1);
      },
      addRespRelacionar:function(){
        this.id_relacionar++;
        this.a_resp_relacionar.push({'id':this.id_relacionar,'option':false,'respuesta':'','puntaje':0,'delete':true});
      },
      removeRespRelacionar:function(index){
        this.a_resp_relacionar.splice(index, 1);
      },
    }
});
