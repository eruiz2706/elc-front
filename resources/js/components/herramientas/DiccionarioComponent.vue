<template>
<div>
  <div class="row justify-content-center" style="padding-top:10%" v-if="!open_dicc">
      <div class="col-12 col-md-10 col-lg-8">
          <form class="card card-sm">
              <div class="card-body row no-gutters align-items-center">
                  <div class="col-auto">
                      <i class="fa  fa-search"></i>
                  </div>
                  <div class="col">
                      <input class="form-control form-control-lg form-control-borderless" type="search" placeholder="Buscar palabra clave" v-model="palabra_clave">
                  </div>
                  <div class="col-auto">
                      <button class="btn btn-lg btn-success " v-on:click.prevent="busqueda();">Buscar</button>
                  </div>
              </div>
          </form>
      </div>
      <!--end of col-->
  </div>
  <center v-if="open_dicc">
    <iframe v-bind:src="url_dicc"  frameborder="0" allowfullscreen></iframe>
  </center>
</div>
</template>

<script>


    export default {
        mounted() {

        },created : function(){
          this.base_url=base_url;
          this.url_dicc='https://www.wordreference.com/es/translation.asp';
        },
        data: function () {
          return {
            url_dicc:'',
            palabra_clave:'',
            open_dicc:false
          }
        },
        methods : {
          busqueda:function(){
            var palabra_clave=this.palabra_clave;
            this.url_dicc +="?tranword="+palabra_clave.replace(/' '/g,'%20');
            this.open_dicc=true;
          },
          playAudio:function(){
            /*let vm=this;
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
            });*/
          }
        }
    }
</script>
