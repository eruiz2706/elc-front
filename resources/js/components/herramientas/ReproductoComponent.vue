<template>
<div>
  <div class="card">
    <div class="card-body">
      <div class="callout callout-info">
      	<p>
      	  <i class="fa fa-fw fa-info"></i>
          <span v-text='traslate.msg_listen'></span>
      	</p>
      </div>
      <div class="form-group">
        <label for="formControlRange"><span v-text='traslate.speed'></span> (<span v-text="artyom_speed"></span>)</label>
        <input type="range" min="0" max="1" step="0.1" class="form-control-range" v-model="artyom_speed">
      </div>
      <div class="form-group">
        <label>
          <button type="button" class="btn btn-outline-primary btn-sm" v-on:click.prevent='playAudio()' :disabled="disabled_play">
            <span v-text='traslate.hear'></span> <i class="fa fa fa-volume-up" style="font-size:20px" ></i>
          </button>&nbsp;&nbsp;&nbsp;
        </label>
        <textarea class="form-control" rows="10" v-bind:placeholder="traslate.msg_listen2" v-model="texto_audio"></textarea>
      </div>


    </div>
  </div>
</div>
</template>

<script>
    const artyom = new Artyom();

    export default {
        mounted() {

        },created : function(){
          this.base_url=base_url;
        },
        data: function () {
          return {
            texto_audio:'',
            disabled_play:false,
            artyom_speed:0.7,
            traslate:{
              'stop':trans('backend.stop'),
              'speed':trans('backend.speed'),
              'play':trans('backend.play'),
              'hear':trans('backend.hear'),
              'msg_listen':trans('backend.msg_listen'),
              'msg_listen2':trans('backend.msg_listen2'),
            }
          }
        },
        methods : {
          playAudio:function(){
            let vm=this;
            artyom.initialize({
                  lang:"en-US",// Más lenguajes son soportados, lee la documentación
                  continuous:false,// Reconoce 1 solo comando y basta de escuchar
                  listen:true, // Iniciar !
                  debug:false, // Muestra un informe en la consola
                  speed:vm.artyom_speed, // Habla normalmente,
                  volume:1
            }).then(() => {
              //artyom.say("Artyom succesfully initialized");
              console.log("Artyom succesfully initialized");
            }).catch((err) => {
                //artyom.say("Artyom couldn't be initialized, please check the console for errors");
                console.log("Artyom couldn't be initialized, please check the console for errors");
                console.log(err);
            });

            artyom.say(vm.texto_audio,{
                onStart:function(){
                  vm.disabled_play=true;
                  console.log("Comenzando a leer texto");
                },
                onEnd:function(){
                    vm.disabled_play=false;
                    console.log("Texto leido satisfactoriamente");
                }
            });
          },

        }
    }
</script>
