<template>
<div>
  <div class="row" v-if="preload">
    <div class="d-block mx-auto" >
      <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
    </div>
  </div>

  <div class="card" v-for="(progreso,index) in a_progreso">
    <div class="card-header no-border">
      <h3 class="card-title" >
        <div class="progress-group">
            <span v-text='traslate.module'></span> <span v-text='progreso.numero'></span> : <span v-text='progreso.nombre'></span>
            <span class="float-right" style='font-size:14px'>
              <span v-text='traslate.lessons'></span> <span v-text='progreso.cantlec_leidas'></span> <span v-text='traslate.of'></span> <b><span v-text='progreso.cantlec'></span></b>
            </span>
            <div class="progress">
              <div class="progress-bar bg-primary" v-bind:style="'width:'+porcent(progreso.cantlec_leidas,progreso.cantlec)+'%'">
                <span v-text="porcent(progreso.cantlec_leidas,progreso.cantlec)+'%'"></span>
              </div>
            </div>
          </div>
      </h3>
  </div>
    <div class="card-body">
        <div class="card" v-for="leccion in a_lecciones" v-if="leccion.modulo_id==progreso.id">
          <div class="card-header" style="padding:.2rem 1.25rem">
            <h5 class="card-title" style="font-size:1rem">
              <a data-toggle="collapse" v-bind:href="'#'+progreso.id+'-'+leccion.id" class="collapsed" aria-expanded="false" v-if="leccion.leido">
              <span v-text='traslate.lesson'></span> <span v-text='leccion.numero'></span> : <span v-text='leccion.nombre'></span> <i class="fa fa-check" v-if="leccion.leido"></i>
              </a>
              <small class="badge badge-primary float-right" v-if="leccion.leido">
                <i class="fa fa-clock-o"></i> <span v-text='leccion.tiempolectura'></span> <span v-text='traslate.minutes'></span>
              </small>

              <a data-toggle="collapse" v-bind:href="'#'+progreso.id+'-'+leccion.id" class="collapsed" aria-expanded="false" style='color:grey' v-if="!leccion.leido">
                <span v-text='traslate.lesson'></span> <span v-text='leccion.numero'></span> : <span v-text='leccion.nombre'></span> <i class="fa fa-check" v-if="leccion.leido"></i>
              </a>
              <small class="badge badge-default float-right" v-if="!leccion.leido">
                <i class="fa fa-clock-o"></i> <span v-text='leccion.tiempolectura'></span> <span v-text='traslate.minutes'></span>
              </small>
            </h5>
          </div>
          <div v-bind:id="progreso.id+'-'+leccion.id" class="panel-collapse in collapse" style="">
            <div class="card-body" v-html="leccion.descripcion">
            </div>
            <div class="card-footer">
              <a class="btn btn-outline-primary btn-sm collapsed" data-toggle="collapse" v-bind:href="'#'+progreso.id+'-'+leccion.id" aria-expanded="false" v-on:click.prevent="leccionLeida(progreso.id,leccion.id,leccion.leido)">
                <span v-text='traslate.finalize'></span>
              </a>

            </div>
          </div>
        </div>
    </div>
  </div>
</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component pregreso mounted.');

        },created : function(){
          this.base_url=base_url;
          this.idcurso=document.getElementById('idcurso').value;
          this.listado();
        },
        data: function () {
          return {
            id : 0,
            preload:false,
            a_progreso:[],
            a_lecciones:[],
            traslate:{
              'module':trans('backend.module'),
              'lesson':trans('backend.lesson'),
              'lessons':trans('backend.lessons'),
              'minutes':trans('backend.minutes'),
              'finalize':trans('backend.finalize'),
              'of':trans('backend.of'),
            }
          }
        },
        methods : {
          listado:function(){
            var url =this.base_url+'/progreso/lista';
            this.preload=true;
            axios.post(url,{idcurso:this.idcurso}).then(response =>{
                this.preload=false;
                this.a_progreso=response.data.progreso;
                this.a_lecciones=response.data.lecciones;
            }).catch(error =>{
                this.preload=false;
                this.a_progreso=[];
                if(error.response.data.errors){
                }
                if(error.response.data.error){
                  toastr.error(error.response.data.error,'',{
                      "timeOut": "3500"
                  });
                }

            });
          },
          leccionLeida:function(idmodulo,idleccion,leido){
            if(leido==false){
              var url =this.base_url+'/progreso/guardar';
              axios.post(url,{idmodulo:idmodulo,id:idleccion}).then(response =>{
                  this.listado();
                  swal({
                      title:response.data.message,
                      text:response.data.message2,
                      type: "success"
                  });
              }).catch(error =>{
                  if(error.response.data.errors){
                    this.e_curso=error.response.data.errors;
                  }
                  if(error.response.data.error){
                    toastr.error(error.response.data.error,'',{
                        "timeOut": "3500"
                    });
                  }
              });
            }
          },
          porcent:function(numerador,denominador){

            if(denominador==0){
              return 0;
            }else{
              return (numerador/denominador)*100;
            }
          }
        }
    }
</script>
