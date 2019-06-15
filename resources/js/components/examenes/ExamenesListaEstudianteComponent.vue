<template>
<div>
  <!-- Resultado -->
  <div class="modal fade" id="modal_resultado" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class='modal-header' style='padding:0px'>
          <h5 class="modal-title" style="padding-top:5px;padding-left:10px">
            Resultado
          </h5>
          <ul class="nav nav-pills ml-auto" >
            <li class="nav-item" v-for="(examen,index) in a_resultado">
              <a class="nav-link  show" v-bind:href="'#tab_'+index"  v-bind:class="(index==tab_active) ? 'active':''" v-text="index+1" v-on:click.prevent="tabtoogle(index)"></a>
            </li>
          </ul>
        </div>
        <div class="modal-body" style="height:450px;overflow-y: auto;">
          <div class="row" v-if="preloadmodal">
            <div class="d-block mx-auto" >
              <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
            </div>
          </div>
          <div class="tab-content">
            <!--<p>@{{a_examen}}</p>-->
            <div class="tab-pane show" v-bind:class="(index==tab_active) ? 'active':''" v-bind:id="'tab_'+index" v-for="(examen,index) in a_resultado">
              <p>
                <b> Puntuaciòn <span v-text='examen.puntaje'></span> de <span v-text='examen.calificacion'></span></b>
              </p>
              <strong v-text="(index+1)+')'+examen.tipo"></strong>
              <p v-html="examen.descripcion"></p>
              <p v-html="examen.textorellenar"></p>
              <hr>
              <div v-for='(fila,i) in examen.respuestas' v-if="examen.tipo=='abierta'">
                <table class="table no-border">
                  <thead>
                    <th>Su respuesta</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <p v-text="fila.respuesta_user"></p>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <table class="table no-border" v-if="examen.tipo=='unica'">
                <thead>
                  <th>Su seleccion</th>
                  <th>Seleccion correcta</th>
                  <th>Respuesta</th>
                </thead>
                <tbody>
                  <tr v-for='(fila,i) in examen.respuestas'>
                    <td>
                      <i class="fa fa-fw fa-check" style="color:green;font-size:20px" v-if="fila.option"></i>
                    </td>
                    <td>
                      <i class="fa fa-fw fa-check" style="color:green;font-size:20px" v-if="fila.seleccion_user"></i>
                    </td>
                    <td>
                      <p v-text="fila.respuesta"></p>
                    </td>
                  </tr>
                </tbody>
              </table>

              <table class="table no-border" v-if="examen.tipo=='multiple'">
                <thead>
                  <th>Su seleccion</th>
                  <th>Seleccion correcta</th>
                  <th>Respuesta</th>
                </thead>
                <tbody>
                  <tr v-for='(fila,i) in examen.respuestas'>
                    <td>
                      <i class="fa fa-fw fa-check" style="color:green;font-size:20px" v-if="fila.option"></i>
                    </td>
                    <td>
                      <i class="fa fa-fw fa-check" style="color:green;font-size:20px" v-if="fila.seleccion_user"></i>
                    </td>
                    <td>
                      <p v-text="fila.respuesta"></p>
                    </td>
                  </tr>
                </tbody>
              </table>

              <table class="table no-border" v-if="examen.tipo=='relacionar'">
                <thead>
                  <th>Su seleccion</th>
                  <th>Seleccion correcta</th>
                  <th>Respuesta</th>
                </thead>
                <tbody>
                  <tr v-for='(fila,i) in examen.respuestas'>
                    <td>
                      <p v-text="fila.relacionar_user"></p>
                    </td>
                    <td>
                      <p v-text="fila.relacionar"></p>
                    </td>
                    <td>
                      <p v-text="fila.respuesta"></p>
                    </td>
                  </tr>
                </tbody>
              </table>

              <table class="table no-border" v-if="examen.tipo=='rellenar'">
                <thead>
                  <th>Su seleccion</th>
                  <th>Seleccion correcta</th>
                  <th>Respuesta</th>
                </thead>
                <tbody>
                  <tr v-for='(fila,i) in examen.respuestas'>
                    <td>
                      <p v-text="fila.relacionar_user"></p>
                    </td>
                    <td>
                      <p v-text="fila.relacionar"></p>
                    </td>
                    <td>
                      <p v-text="fila.respuesta"></p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class='modal-footer'>
          <button type="button" class="btn btn-outline-primary btn-sm float-left"  v-on:click.prevent="tabtoogle_menos()">
            <i style='font-size:20px' class="fa fa-angle-double-left"></i>
          </button>
          <button type="button" class="btn btn-outline-primary btn-sm float-left" v-if="!(tab_active==a_resultado.length-1)" v-on:click.prevent="tabtoogle_mas()">
              <i style='font-size:20px' class="fa fa-angle-double-right"></i>
          </button>

          <button type="button" class="btn btn-outline-primary btn-sm float-left" v-if="(tab_active==a_resultado.length-1)" v-on:click.prevent="cerrarResultado()">
            Cerrar
          </button>
        </div>
    </div>
  </div>
  </div>

  <!-- Examen -->
  <div class="modal fade" id="modal_ejercicio" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class='modal-header' style='padding:0px'>
          <h5 class="modal-title" style="padding-top:5px;padding-left:10px">
            <strong>
            <span id="minute"></span> : <span id="second"></span>
            </strong>
          </h5>
          <ul class="nav nav-pills ml-auto" >
            <li class="nav-item" v-for="(examen,index) in a_examen">
              <!--<a class="nav-link  show" v-bind:href="'#tab_'+index" data-toggle="tab" v-bind:class="(index==0) ? 'active':''" v-text="index+1"></a>-->
              <a class="nav-link  show" v-bind:href="'#tab_'+index"  v-bind:class="(index==tab_active) ? 'active':''" v-text="index+1" v-on:click.prevent="tabtoogle(index)"></a>
            </li>
          </ul>
        </div>
        <div class="modal-body" style="height:450px;overflow-y: auto;">
          <div class="row" v-if="preloadmodal">
            <div class="d-block mx-auto" >
              <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
            </div>
          </div>
          <div class="tab-content">
            <!--<p>@{{a_examen}}</p>-->
            <div class="tab-pane show" v-bind:class="(index==tab_active) ? 'active':''" v-bind:id="'tab_'+index" v-for="(examen,index) in a_examen">
              <strong v-text="(index+1)+')'+examen.tipo"></strong>
              <p v-html="examen.descripcion"></p>
              <p v-html="examen.textorellenar"></p>
              <div class="form-group" v-if="examen.audio =='A'">
                <label>
                  Reproducir
                  <button type="button" class="btn btn-outline-primary btn-sm" v-bind:id="'player_'+index" v-on:click.prevent="playAudio(index)">
                    <i class="fa fa-play" ></i>
                  </button>&nbsp;&nbsp;&nbsp;
                </label>
              </div>

              <hr>
              <div v-for='(fila,i) in examen.respuestas' v-if="examen.tipo=='abierta'">
                <div class="form-group">
                  <textarea rows="3" placeholder="Escribe tu respuesta" class="form-control" v-model="fila.respuesta">
                  </textarea>
                </div>
              </div>

              <table class="table no-border" v-if="examen.tipo=='unica'">
                <tbody>
                  <tr v-for='(fila,i) in examen.respuestas'>
                    <td>
                      <input type="radio" v-bind:id="fila.id" v-bind:value="fila.id" v-model="examen.idunica">
                      <p v-text="fila.respuesta"></p>
                    </td>
                  </tr>
                </tbody>
              </table>

              <table class="table no-border" v-if="examen.tipo=='multiple'">
                <tbody>
                  <tr v-for='(fila,i) in examen.respuestas'>
                    <td>
                      <input type="checkbox"  v-model='fila.seleccion'>
                      <p v-text="fila.respuesta"></p>
                    </td>
                  </tr>
                </tbody>
              </table>

              <table class="table no-border" v-if="examen.tipo=='relacionar'">
                <tbody>
                  <tr v-for='(fila,i) in examen.respuestas'>
                    <td>
                      <p v-text="fila.respuesta"></p>
                      <div class="form-group">
                        <select class='form-control' v-model='fila.relacionar2'>
                          <option value="''"> - </option>
                          <option v-bind:value='select.relacionar' v-text='select.relacionar' v-for='select in examen.respuestas'></option>
                        </select>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>

              <table class="table no-border" v-if="examen.tipo=='rellenar'">
                <tbody>
                  <tr v-for='(fila,i) in examen.respuestas'>
                    <td>
                      <p v-text="fila.respuesta+')'"></p>
                      <input type="text" class="form-control" v-model="fila.relacionar2">
                    </td>
                  </tr>
                </tbody>
              </table>
              <textarea class="form-control" rows="2" v-text='examen.textoaudio' v-bind:id="'audio_'+index" style='display:none'></textarea>
            </div>
          </div>
        </div>
        <div class='modal-footer'>
          <button type="button" class="btn btn-outline-primary btn-sm float-left"  v-on:click.prevent="tabtoogle_menos()">
            <i style='font-size:20px' class="fa fa-angle-double-left"></i>
          </button>
          <button type="button" class="btn btn-outline-primary btn-sm float-left" v-if="!(tab_active==a_examen.length-1)" v-on:click.prevent="tabtoogle_mas()">
              <i style='font-size:20px' class="fa fa-angle-double-right"></i>
          </button>

          <button type="button" class="btn btn-outline-primary btn-sm float-left" v-if="(tab_active==a_examen.length-1)" :disabled="loader_finalizar" v-on:click.prevent="finalizar()">
            Finalizar
            <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_finalizar"></i>
          </button>
        </div>
    </div>
  </div>
  </div>

  <div class="row" v-if="preload">
    <div class="d-block mx-auto" >
      <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
    </div>
  </div>

  <div class="card" v-if="!preload" v-for="ejercicio in a_ejercicios">
    <div class="card-header no-border">
      <h5 class="card-title" v-text='ejercicio.nombre'></h5>
      <div class='row'>
        <div class="col-md-4 col-sm-6">
          <b>Inicia :</b> <span v-text='ejercicio.fecha_inicio'></span>
        </div>
        <div class="col-md-4 col-sm-6">
          <b>Finalizacion :</b> <span v-text='ejercicio.fecha_finalizacion'></span>
        </div>
        <div class="col-md-4 col-sm-6">
          <b>Duracion :</b> <span v-text='ejercicio.duracion'></span> minutos
        </div>
        <div class="col-md-4 col-sm-6">
          <b>Estado :</b>
          <small v-bind:class="'badge badge-'+ejercicio.status" v-text='ejercicio.nombestado'></small>
        </div>
        <div class="col-md-4 col-sm-6">
          <b>Calificacion :</b>
          <span v-text='ejercicio.calificacion'></span> de <span v-text='ejercicio.notamaxima'></span>
        </div>
      </div>
    </div>

    <div class="card-body">
      <button type="button" class="btn btn-outline-primary btn-sm float-left" v-on:click.prevent="comenzar(ejercicio.id,ejercicio.status_user)" v-if='ejercicio.statusini==true && ejercicio.status_user==false'>
        Comenzar
      </button>
      <button type="button" class="btn btn-outline-primary btn-sm float-left" v-on:click.prevent="verresultado(ejercicio.id)" v-if='ejercicio.status_user==true'>
        Ver resultado
      </button>
      <button type="button" class="btn btn-outline-primary btn-sm float-left"  disabled v-if='ejercicio.statusini==false && ejercicio.status_user==false'>
        Cerrado
      </button>
    </div>
  </div>
</div>
</template>

<script>
    const artyom = new Artyom();
    var timeOut;

    export default {
        mounted() {

        },created : function(){
          this.base_url=base_url;
          this.idcurso=document.getElementById('idcurso').value;
          this.listado();
        },
        data: function () {
          return {
            idcurso : 0,
            preload:false,
            a_ejercicios:[],
            preloadmodal:false,
            a_examen:[],
            idejeruser:0,
            toSecond:0,
            toMinute:0,
            loader_finalizar:false,
            tab_active:0,
            a_resultado:[]
          }
        },
        methods : {
          playAudio:function(id){
            var vm=this;
            artyom.initialize({
                  lang:"en-US",// Más lenguajes son soportados, lee la documentación
                  continuous:false,// Reconoce 1 solo comando y basta de escuchar
                  listen:true, // Iniciar !
                  debug:false, // Muestra un informe en la consola
                  speed:0.7 // Habla normalmente
            }).then(() => {
              //artyom.say("Artyom succesfully initialized");
              console.log("Artyom succesfully initialized");
            }).catch((err) => {
                //artyom.say("Artyom couldn't be initialized, please check the console for errors");
                console.log("Artyom couldn't be initialized, please check the console for errors");
                console.log(err);
            });

            var palabra=document.getElementById('audio_'+id).value;
            artyom.say(palabra,{
                onStart:function(){
                    document.getElementById('player_'+id).disabled=true;
                    console.log("Comenzando a leer texto");
                },
                onEnd:function(){
                    document.getElementById('player_'+id).disabled=false;
                    artyom.fatality();
                    console.log("Texto leido satisfactoriamente");
                }
            });

          },
          tabtoogle_mas:function(){
            if(!(this.tab_active==this.a_examen.length-1)){
              this.tab_active=this.tab_active+1;
            }
          },
          tabtoogle_menos:function(){
            if(!(this.tab_active==0)){
                this.tab_active=this.tab_active-1;
            }
          },
          tabtoogle:function(index){
            this.tab_active=index;
          },
          listado:function(){
            var url =this.base_url+'/ejercicios/lista_es';
            this.preload=true;
            axios.post(url,{idcurso:this.idcurso}).then(response =>{
                this.preload=false;
                this.a_ejercicios=response.data.ejercicios;
            }).catch(error =>{
                this.preload=false;
                if(error.response.data.errors){
                }
                if(error.response.data.error){
                  toastr.error(error.response.data.error,'',{
                      "timeOut": "3500"
                  });
                }
            });
          },
          comenzar:function(id,status_user){
            let inst=this;
            if(status_user==true){
              swal({
                title: "Ya realizaste la prueba",
                text: "click para continuar",
                type: "info"
              });
              return;
            }

            swal({
              title: "Seguro deseas comenzar",
              text: "",
              type: "info",
              showCancelButton: true,
              confirmButtonClass: "btn-success",
              confirmButtonText: "Iniciar",
              closeOnConfirm: true
            },
            function(){
              inst.iniciar(id);
            });
          },
          iniciar:function(id){
            var url =this.base_url+'/ejercicios/iniciar';
            this.preloadmodal=true;
            $('#modal_ejercicio').modal({
              backdrop: 'static',
              keyboard: true,
              show: true
            });
            axios.post(url,{id:id}).then(response =>{
                this.tab_active=0;
                this.preloadmodal=false;
                this.idejeruser=response.data.idejeruser;
                this.a_examen=response.data.preguntas;
                this.toMinute=response.data.duracion;
                this.toSecond=0;
                this.countDown();
            }).catch(error =>{
                this.preloadmodal=false;
                if(error.response.data.errors){
                }
                if(error.response.data.error){
                  toastr.error(error.response.data.error,'',{
                      "timeOut": "3500"
                  });
                  //debe colocarse funcionalidad cerrar modal
                }
            });
          },
          finalizar:function(){
            var url =this.base_url+'/ejercicios/finalizar';
            this.loader_finalizar=true;
            axios.post(url,{idejeruser:this.idejeruser,examen:this.a_examen}).then(response =>{
                this.loader_finalizar=false;
                var vm=this;
                $('#modal_ejercicio').modal('hide');
                swal({
                    title:response.data.message,
                    text:response.data.message2,
                    type: "success"
                },function(){
                  clearTimeout(timeOut);
                  vm.$root.$emit('setMenu','examenes-lista-es');
                  vm.listado();
                  //location.reload();
                });
            }).catch(error =>{
                this.loader_finalizar=false;
                if(error.response.data.errors){
                }
                if(error.response.data.error){
                  toastr.error(error.response.data.error,'',{
                      "timeOut": "3500"
                  });
                }
            });
          },
          countDown:function(){
            var toSecond=this.toSecond;
            var toMinute=this.toMinute;
            var inst=this;
            toSecond=toSecond-1;
            if(toSecond<0)
            {
              toSecond=59;
              toMinute=toMinute-1;
            }
            document.getElementById('second').innerHTML=toSecond;
            this.toSecond=toSecond;

            if(toMinute==0 && toSecond==0)
            {
              swal({
                  title:'Envio automatico',
                  text:'Tu tiempo de prueba finalizo',
                  type: "info"
              });
              this.finalizar();
              return;
            }
            document.getElementById('minute').innerHTML=toMinute;
            this.toMinute=toMinute;

            timeOut=setTimeout(function(){
                inst.countDown();
                console.log(this.toSecond+'**'+this.toMinute);
            }, 1000);
          },
          verresultado:function(id){
            var url =this.base_url+'/ejercicios/verresultado';
            this.preloadmodal=true;
            $('#modal_resultado').modal("show");
            axios.post(url,{id:id}).then(response =>{
                this.tab_active=0;
                this.preloadmodal=false;
                this.a_resultado=response.data.preguntas;
                console.log(this.a_resultado);
            }).catch(error =>{
                this.preloadmodal=false;
                if(error.response.data.errors){
                }
                if(error.response.data.error){
                  toastr.error(error.response.data.error,'',{
                      "timeOut": "3500"
                  });
                  //debe colocarse funcionalidad cerrar modal
                }
            });
          },
          cerrarResultado:function(){
            this.a_resultado=[];
            $('#modal_resultado').modal("hide");
          }
        }
    }
</script>
