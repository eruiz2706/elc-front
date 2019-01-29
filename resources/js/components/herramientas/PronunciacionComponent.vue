<template>
<div>
  <div class="card">
    <div class="card-body">
      <div class="callout callout-info">
        <p>
          <i class="fa fa-fw fa-info"></i>
          Escribe la palabra a pronunciar y da en evaluar para verificar tu pronunciacion,
        </p>
      </div>

      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Palabra" aria-label="Recipient's username" aria-describedby="basic-addon2" v-model="texto_escucha">
        <div class="input-group-append">
          <button class="btn btn-outline-primary" type="button" v-on:click.prevent='escucharAudio()' :disabled="disabled_escuchar">
            Escuchar <i class="fa fa-volume-up"></i>
          </button>
        </div>
      </div>

      <div class="form-group">
        <label>
          <button type="button" class="btn btn-outline-primary btn-sm" v-on:click.prevent='evaluarAudio()' :disabled="disabled_evaluar">
            Hablar <i class="fa fa-microphone" style="font-size:20px" ></i>
          </button>&nbsp;&nbsp;&nbsp;
          <span id="resultado_pronun"></span>
        </label>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <div class="callout callout-info">
      	<p>
      	  <i class="fa fa-fw fa-info"></i>
          Da click en el boton hablar y verifica tu pronunciacion, una vez termines de hablar da click en el boton detener para
          ver tus resultados
      	</p>
      </div>
      <div class="form-group">
        <label>
          <button type="button" class="btn btn-outline-primary btn-sm" v-on:click.prevent='playAudio()' :disabled="disabled_play">
            Hablar <i class="fa fa-microphone"></i>
          </button>&nbsp;&nbsp;&nbsp;
          <button type="button" class="btn btn-outline-danger btn-sm" v-on:click.prevent='stopAudio()' :disabled="!disabled_play">
            Detener <i class="fa fa-stop" ></i>
          </button>
        </label>
        <textarea class="form-control" rows="10" id="texto_voz_audio"></textarea>
      </div>
    </div>
  </div>
</div>
</template>

<script>
    var artyom = new Artyom();
    export default {
        mounted() {

        },created : function(){
          this.base_url=base_url;
        },
        data: function () {
          return {
            disabled_play:false,
            disabled_escuchar:false,
            disabled_evaluar:false,
            texto_escucha:''
          }
        },
        methods : {
          playAudio:function(){
            let vm=this;
            artyom.addCommands([
            {
                description :"",
                indexes:[""],
                action:function(i){

                }
              }
            ]);
            artyom.redirectRecognizedTextOutput(function(recognized,isFinal){
              if(!isFinal){
                var texto_voz_audio=document.getElementById("texto_voz_audio");
                texto_voz_audio.value ='';
                console.log("Dictation started by the user");
              }else{
                vm.disabled_play=false;
                var texto_voz_audio=document.getElementById("texto_voz_audio");
                texto_voz_audio.value +=recognized+'\n';
                texto_voz_audio.scrollTop = texto_voz_audio.scrollHeight;
              }
            });
            artyom.initialize({
                  lang:"en-GB",// Más lenguajes son soportados, lee la documentación
                  continuous:false,// Reconoce 1 solo comando y basta de escuchar
                  listen:true, // Iniciar !
                  debug:true, // Muestra un informe en la consola
                  speed:1 // Habla normalmente
            }).then(() => {
              console.log("Artyom succesfully initialized");
              var texto_voz_audio=document.getElementById("texto_voz_audio");
              texto_voz_audio.value ='';
              vm.disabled_play=true;
            }).catch((err) => {
                //artyom.say("Artyom couldn't be initialized, please check the console for errors");
                vm.disabled_play=false;
                console.log("Artyom couldn't be initialized, please check the console for errors");
                console.log(err);
            });

          },
          stopAudio:function(){
            let vm=this;
            artyom.fatality();
            vm.disabled_play=false;
          },
          escucharAudio:function(){
            let vm=this;
            artyom.initialize({
                  lang:"en-US",// Más lenguajes son soportados, lee la documentación
                  continuous:false,// Reconoce 1 solo comando y basta de escuchar
                  listen:true, // Iniciar !
                  debug:false, // Muestra un informe en la consola
                  speed:0.6, // Habla normalmente,
                  volume:1
            }).then(() => {
              //artyom.say("Artyom succesfully initialized");
              console.log("Artyom succesfully initialized");
            }).catch((err) => {
                //artyom.say("Artyom couldn't be initialized, please check the console for errors");
                console.log("Artyom couldn't be initialized, please check the console for errors");
                console.log(err);
            });

            artyom.say(vm.texto_escucha,{
                onStart:function(){
                  vm.disabled_escuchar=true;
                  console.log("Comenzando a leer texto");
                },
                onEnd:function(){
                    vm.disabled_escuchar=false;
                    console.log("Texto leido satisfactoriamente");
                }
            });
          },
          evaluarAudio:function(){
              let vm=this;

              artyom.addCommands([
              {
                  description :"",
                  indexes:[""],
                  action:function(i){

                  }
                }
              ]);
              artyom.redirectRecognizedTextOutput(function(recognized,isFinal){
                if(!isFinal){
                  //var texto_voz_audio=document.getElementById("texto_voz_audio");
                  //texto_voz_audio.value ='';
                  console.log("Dictation started by the user");
                }else{
                  vm.disabled_evaluar=false;
                  if(vm.texto_escucha.toLowerCase()==recognized){
                    document.getElementById('resultado_pronun').innerHTML=recognized+" <i class='fa fa-check'></i>";
                    document.getElementById("resultado_pronun").style.color='#4CAF50';
                  }else{
                    document.getElementById('resultado_pronun').innerHTML=recognized+" <i class='fa  fa-close'></i>";
                    document.getElementById("resultado_pronun").style.color='#ff0000';
                  }
                }
              });
              artyom.initialize({
                    lang:"en-GB",// Más lenguajes son soportados, lee la documentación
                    continuous:false,// Reconoce 1 solo comando y basta de escuchar
                    listen:true, // Iniciar !
                    debug:true, // Muestra un informe en la consola
                    speed:1 // Habla normalmente
              }).then(() => {
                console.log("Artyom succesfully initialized");
                vm.disabled_evaluar=true;
                document.getElementById("resultado_pronun").value='';
              }).catch((err) => {
                  vm.disabled_evaluar=false;
                  console.log("Artyom couldn't be initialized, please check the console for errors");
                  console.log(err);
              });

          }
        }
    }
</script>
