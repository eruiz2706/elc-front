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
      o_basepregunta:{'nombre':'','descripicion':'','tipo':'','texto_audio':''},
      o_pregunta:{'nombre':'','descripicion':'','tipo':'','texto_audio':''},
      e_pregunta:[],
      loader_guardar :false,

      //respuesta Abierta
      view_resp_abierta:false,
      o_resp_abierta:{},

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
      id_relacionar:0,

      //respuesta Rellenar
      view_resp_rellenar:false,
      a_resp_rellenar:[],
      resp_rellenar:'',
      id_rellenar:0
    },
    computed : {

    },
    methods : {
      guardar:function(){
        this.loader_guardar=true;
        this.o_pregunta.idcurso=this.idcurso;
        this.o_pregunta.idejerc=this.idejerc;
        this.o_pregunta.descripcion=$('#summernote').summernote('code');
        this.o_pregunta.resp_abierta=this.o_resp_abierta;
        this.o_pregunta.resp_unica=this.a_resp_unica;
        this.o_pregunta.radio_unica=this.radio_unica
        this.o_pregunta.resp_multiple=this.a_resp_multiple;
        this.o_pregunta.resp_relacionar=this.a_resp_relacionar;
        this.o_pregunta.resp_rellenar=this.a_resp_rellenar;
        this.o_pregunta.texto_rellenar=this.resp_rellenar;
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
      playAudio:function(){
        artyom.initialize({
              lang:"en-US",// Más lenguajes son soportados, lee la documentación
              continuous:false,// Reconoce 1 solo comando y basta de escuchar
              listen:true, // Iniciar !
              debug:false, // Muestra un informe en la consola
              speed:0.8 // Habla normalmente
        }).then(() => {
          //artyom.say("Artyom succesfully initialized");
          console.log("Artyom succesfully initialized");
        }).catch((err) => {
            //artyom.say("Artyom couldn't be initialized, please check the console for errors");
            console.log("Artyom couldn't be initialized, please check the console for errors");
            console.log(err);
        });

        var palabra=this.o_pregunta.texto_audio;
        artyom.say(palabra,{
            onStart:function(){
                console.log("Comenzando a leer texto");
            },
            onEnd:function(){
                console.log("Texto leido satisfactoriamente");
            }
        });

      },
      stopAudio:function(){
        console.log("stop");
        artyom.fatality().then(() => {
            console.log("Artyom succesfully stopped !");
        });
      },
      viewtipo:function(){
        this.view_resp_abierta=false;
        this.view_resp_unica=false;
        this.view_resp_multiple=false;
        this.view_resp_relacionar=false;
        this.view_resp_rellenar=false;

        //respuesta Abierta
        if(this.o_pregunta.tipo=='abierta'){
          this.view_resp_abierta=true;
          this.o_resp_abierta={'puntaje':0};
        }

        if(this.o_pregunta.tipo=='unica'){
          this.view_resp_unica=true;
          this.radio_unica=1;
          this.id_unica=2;
          this.a_resp_unica=[
            {'id':1,'respuesta':'','puntaje':0,'delete':true},
            {'id':2,'respuesta':'','puntaje':0,'delete':true}
          ];
        }

        if(this.o_pregunta.tipo=='relacionar'){
          this.view_resp_relacionar=true;
          this.id_relacionar=2;
          this.a_resp_relacionar=[
            {'id':1,'respuesta':'','relacionar':'','puntaje':0,'delete':true},
            {'id':2,'respuesta':'','relacionar':'','puntaje':0,'delete':true},
          ];
        }

        if(this.o_pregunta.tipo=='multiple'){
          this.view_resp_multiple=true;
          this.id_multiple=2;
          this.a_resp_multiple=[
            {'id':1,'option':false,'respuesta':'','puntaje':0,'delete':true},
            {'id':2,'option':false,'respuesta':'','puntaje':0,'delete':true}
          ];
        }

        if(this.o_pregunta.tipo=='rellenar'){
          this.view_resp_rellenar=true;
          this.resp_rellenar='';
          this.id_rellenar=0;
          this.a_resp_rellenar=[];

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
      obtenerRellenar:function(){
        var cadena  =this.resp_rellenar;
        this.id_rellenar=0;
        this.a_resp_rellenar=[];

        var abrir   ='0';
        var palabra ='';
        for(var i = 0; i < cadena.length; i++) {
          //var letra=cadena[i].toLowerCase();
          var letra=cadena[i];
          if(letra=='['){
            abrir='1';
          }else if(abrir=='1' && letra !=']'){
            palabra +=letra;
          }else if(letra ==']'){
            this.a_resp_rellenar.push({'id':this.id_rellenar,'respuesta':palabra,'relacionar':'','puntaje':0});
            abrir=0;
            palabra='';
          }

          //if (cadena[i].toLowerCase() === caracter) indices.push(i);
        }
      },
      redirectVolver:function(){
        window.location.href=base_url+'/preguntas/'+this.idcurso+'/'+this.idejerc;
      }
    }
});
