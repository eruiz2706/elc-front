<template>
<div>
  <div class="row">
    <div class="col-md-6 col-sm-6">
      <h5 class="m-0 text-dark">
        <strong>Actualizar pregunta</strong>
        <button type="button" class="btn btn-tool" v-on:click.prevent="redirectVolver()">
          <i class="fa fa-arrow-circle-left"  style="font-size: 24px;"></i>
        </button>
      </h5>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <div class="callout callout-info">
      	<p>
      	  <i class="fa fa-fw fa-info"></i>Los campos marcados en <code>*</code> son obligatorios
      	</p>
      </div>

      <!--<div class="form-group">
        <label>Titulo <code>*</code></label>
        <input type="text" class="form-control" name='nombre'  v-model='o_pregunta.nombre' v-bind:class="[e_pregunta.nombre ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_pregunta.nombre" v-text='e_pregunta.nombre[0]'></span>
      </div>-->

      <div class="form-group">
        <label>Contenido de pregunta</label>
        <div id="summernote" ></div>
        <span class="text-danger" v-if="e_pregunta.descripcion" v-text='e_pregunta.descripcion[0]'></span>
      </div>

      <div class="form-group">
        <label>Tipo respuesta  <code>*</code></label>
        <select class="form-control" name='tipo' v-model='o_pregunta.tipo' @change="viewtipo()" v-bind:class="[e_pregunta.tipo ? 'is-invalid' : '']">
          <option value=''>Seleccione el tipo</option>
          <option value='abierta'>Abierta</option>
          <option value='unica'>Unica</option>
          <option value='multiple'>Multiple</option>
          <option value='relacionar'>Relacionar</option>
          <option value='rellenar'>Rellenar</option>
        </select>
        <span class="text-danger" v-if="e_pregunta.tipo" v-text='e_pregunta.tipo[0]'></span>
      </div>

      <div v-if='view_resp_abierta'>
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label>Puntaje</label>
              <input type="number" min="0"  class="form-control" name='puntaje'  v-model='o_resp_abierta.puntaje'>
            </div>
          </div>
        </div>
      </div>

      <div v-if='view_resp_unica'>
        <div class="card">
          <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
              <thead>
              <tr>
                <th>Verdadera</th>
                <th>Posibles respuestas</th>
                <th>Puntaje</th>
                <th>
                  <button type="button" class="btn btn-outline-primary btn-sm float-left" v-on:click.prevent='addRespUnica()'>
                    <i class="fa fa-plus" ></i>
                  </button>
                </th>
              </tr>
              </thead>
              <tbody>
                <tr v-for='(fila,index) in a_resp_unica'>
                  <td>&nbsp;&nbsp;
                      <input type="radio" v-bind:id="fila.id" v-bind:value="fila.id" v-model='radio_unica'>
                  </td>
                  <td>
                    <textarea class="form-control" rows="2" cols="100" v-model='fila.respuesta'></textarea>
                  </td>
                  <td>
                    <input type="number" min="0"  class="form-control" name='puntaje'  v-model='fila.puntaje'>
                  </td>
                  <td>
                    <button type="button" class="btn btn-outline-danger btn-sm float-left" v-if="fila.delete" v-on:click.prevent='removeRespUnica(index)'>
                      <i class="fa fa-remove" ></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div v-if='view_resp_multiple'>
        <div class="card">
          <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
              <thead>
              <tr>
                <th>Verdadera</th>
                <th>Posibles respuestas</th>
                <th>Puntaje</th>
                <th>
                  <button type="button" class="btn btn-outline-primary btn-sm float-left" v-on:click.prevent='addRespMultiple()'>
                    <i class="fa fa-plus" ></i>
                  </button>
                </th>
              </tr>
              </thead>
              <tbody>
                <tr v-for='(fila,index) in a_resp_multiple'>
                  <td>
                    <input type="checkbox"  v-model='fila.option'>
                  </td>
                  <td>
                    <textarea class="form-control" rows="2" cols="100" v-model='fila.respuesta'></textarea>
                  </td>
                  <td>
                    <input type="number" min="0"  class="form-control" name='puntaje'  v-model='fila.puntaje'>
                  </td>
                  <td>
                    <button type="button" class="btn btn-outline-danger btn-sm float-left" v-if="fila.delete" v-on:click.prevent='removeRespMultiple(index)'>
                      <i class="fa fa-remove" ></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div v-if='view_resp_relacionar'>
        <div class="card">
          <div class="card-body table-responsive p-0">
            <table class="table table-striped table-valign-middle">
              <thead>
              <tr>
                <th>Posibles respuestas</th>
                <th>Corresponde a</th>
                <th>Puntaje</th>
                <th>
                  <button type="button" class="btn btn-outline-primary btn-sm float-left" v-on:click.prevent='addRespRelacionar()'>
                    <i class="fa fa-plus" ></i>
                  </button>
                </th>
              </tr>
              </thead>
              <tbody>
                <tr v-for='(fila,index) in a_resp_relacionar'>
                  <td>
                    <textarea class="form-control" rows="2" cols="50" v-model='fila.respuesta'></textarea>
                  </td>
                  <td>
                    <textarea class="form-control" rows="2" cols="50" v-model='fila.relacionar'></textarea>
                  </td>
                  <td>
                    <input type="number" min="0"  class="form-control" name='puntaje'  v-model='fila.puntaje'>
                  </td>
                  <td>
                    <button type="button" class="btn btn-outline-danger btn-sm float-left" v-if="fila.delete" v-on:click.prevent='removeRespRelacionar(index)'>
                      <i class="fa fa-remove" ></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div v-if='view_resp_rellenar'>
        <div class="card">
          <div class="card-body table-responsive p-0">
            <div class="form-group">
              <strong style='padding:5px'>Parar marcar los puntos de separacion utilize [palabra]</strong>
              <textarea class="form-control" rows="4" placeholder="Escribe el texto" v-model='resp_rellenar' @keyup="obtenerRellenar()" ></textarea>
            </div>

            <table class="table table-striped table-valign-middle">
              <thead>
              <tr>
                <th>Opcion</th>
                <th>Respuesta</th>
                <th>Puntaje</th>
              </tr>
              </thead>
              <tbody>
                <tr v-for='(fila,index) in a_resp_rellenar'>
                  <td>
                    <input type="text" class="form-control" name='respuesta' readonly  v-model='fila.respuesta'>
                  </td>
                  <td>
                    <input type="text" class="form-control" name='relacionar'  v-model='fila.relacionar'>
                  </td>
                  <td>
                    <input type="number" min="0"  class="form-control" name='puntaje'  v-model='fila.puntaje'>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div id="accordion">
        <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
        <div class="card ">
          <div class="card-header" style="padding:.2rem 1.25rem">
            <h5 class="card-title" style="font-size:1rem">
              <a data-toggle="collapse" data-parent="#accordion" href="#colapse1" class="collapsed" aria-expanded="false">
                Parametros adicionales
              </a>
            </h5>
          </div>
          <div id="colapse1" class="panel-collapse in collapse" style="">
            <div class="card-body">
              <div class="form-group">
                <label>
                  Agregar audio(Ingles)
                  <button type="button" class="btn btn-outline-primary btn-sm" v-on:click.prevent='playAudio()'>
                    <i class="fa fa-play" ></i>
                  </button>&nbsp;&nbsp;&nbsp;
                  <button type="button" class="btn btn-outline-danger btn-sm" v-on:click.prevent='stopAudio()'>
                    <i class="fa fa-stop" ></i>
                  </button>
                </label>
                <textarea class="form-control" rows="2" placeholder="Escriba el texto que desea ser reproducido"v-model="o_pregunta.texto_audio"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>

      <button type="button" class="btn btn-outline-primary btn-sm float-left" :disabled="loader_actualizar" v-on:click.prevent='actualizar()'>
        Actualizar Pregunta
        <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_actualizar"></i>
      </button>
    </div>
  </div>
</div>
</template>

<script>
  const artyom = new Artyom();

    export default {
        mounted() {
          $('#summernote').summernote({
            callbacks: {
             onImageUpload: function(image) {
                   var sizeKB = image[0]['size'] / 1000;
                   var tmp_pr = 0;
                   if(sizeKB > 1100){
                      tmp_pr = 1;
                      swal({
                          title:"Seleccione una imagen menor o igual a 1mb",
                          text:'',
                          type: "info"
                      });
                  }
                   if(image[0]['type'] != 'image/jpeg' && image[0]['type'] != 'image/png'){
                      tmp_pr = 1;
                      swal({
                          title:"La imagen debe ser formato png o jpg",
                          text:'',
                          type: "info"
                      });
                  }
                   if(tmp_pr == 0){
                       var file = image[0];
                       var reader = new FileReader();
                      reader.onloadend = function() {
                          var image = $('<img>').attr('src',  reader.result);
                          $('#summernote').summernote("insertNode", image[0]);
                      }
                     reader.readAsDataURL(file);
                   }
                }
            },
            toolbar: [
              ['font', ['fontname']],
              ['para', ['ul', 'ol','paragraph','strikethrough']],
              ['style', ['bold', 'italic', 'underline', 'clear']],
              ['fontsize', ['fontsize']],
              ['color', ['color']],
              ['height', ['height']],
              ['groupName', ['picture','link','video','table','hr','fullscreen']],
            ],
            height: 70
          });
        },created : function(){
          this.base_url=base_url;
          this.idcurso=document.getElementById('idcurso').value;
          this.idejerc=document.getElementById('id').value;
          this.id=document.getElementById('id2').value;
          this.getPregunta();
        },
        data: function () {
          return {
            idcurso:0,
            idejerc:0,
            id:0,
            o_basepregunta:{'nombre':'','descripicion':'','tipo':'','texto_audio':''},
            o_pregunta:{'nombre':'','descripicion':'','tipo':'','texto_audio':''},
            e_pregunta:[],
            loader_actualizar :false,

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
          }
        },
        methods : {
          getPregunta:function(){
              this.preload=true;
              var url =this.base_url+'/preguntas/editar';
              axios.post(url,{id:this.id}).then(response =>{
                  console.log(response.data);
                  this.o_pregunta=response.data.pregunta;
                  $('#summernote').summernote('code',this.o_pregunta.descripcion);
                  this.o_resp_abierta.puntaje=response.data.resp_abierta;
                  this.a_resp_unica=response.data.resp_unica;
                  this.radio_unica=response.data.radio_unica;
                  this.a_resp_multiple=response.data.resp_multiple;
                  this.a_resp_relacionar=response.data.resp_relacionar;
                  this.a_resp_rellenar=response.data.resp_rellenar;
                  this.resp_rellenar=this.o_pregunta.textorellenar;

                  if(this.o_pregunta.tipo=='abierta')this.view_resp_abierta=true;
                  if(this.o_pregunta.tipo=='unica')this.view_resp_unica=true;
                  if(this.o_pregunta.tipo=='multiple')this.view_resp_multiple=true;
                  if(this.o_pregunta.tipo=='relacionar')this.view_resp_relacionar=true;
                  if(this.o_pregunta.tipo=='rellenar')this.view_resp_rellenar=true;
                  this.preload=false;
              }).catch(error =>{
                  this.preload=false;
              });
          },
          actualizar:function(){
            this.loader_actualizar=true;
            this.o_pregunta.idcurso=this.idcurso;
            this.o_pregunta.id=this.id;
            this.o_pregunta.descripcion=$('#summernote').summernote('code');
            this.o_pregunta.resp_abierta=this.o_resp_abierta;
            this.o_pregunta.resp_unica=this.a_resp_unica;
            this.o_pregunta.radio_unica=this.radio_unica
            this.o_pregunta.resp_multiple=this.a_resp_multiple;
            this.o_pregunta.resp_relacionar=this.a_resp_relacionar;
            this.o_pregunta.resp_rellenar=this.a_resp_rellenar;
            this.o_pregunta.texto_rellenar=this.resp_rellenar;
            let inst=this;
            var url =this.base_url+'/preguntas/actualizar';
            axios.post(url,this.o_pregunta).then(response =>{
                this.loader_actualizar=false;
                this.e_pregunta=[];
                this.o_pregunta=this.o_basepregunta;
                swal({
                    title:response.data.message,
                    text:response.data.message2,
                    type: "success"
                },function(){
                    inst.redirectVolver();
                });
            }).catch(error =>{
                this.loader_actualizar=false;
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
            this.$root.$emit('setMenu','preguntas-lista');
          }
        }
    }
</script>
