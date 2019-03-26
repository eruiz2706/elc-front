<template>
<div>
  <div class="row" v-if="preload">
    <div class="d-block mx-auto" >
      <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
    </div>
  </div>

  <div class="card" v-if="!preload">
    <div class="card-body">
      <p>
        <strong v-text='traslate.homework.toUpperCase()'></strong>
        <strong class='float-right' v-text='traslate.note'></strong>
      </p>
      <div class="progress-group" v-for="tarea in a_tareas">
        <span v-text="tarea.nombre"></span>
        <span class="float-right">
          <b><span v-text='tarea.notaes'></span></b> de <span v-text='tarea.calificacion'></span>
        </span>
        <div class="progress progress-sm">
          <div class="progress-bar bg-primary" v-bind:style="'width:'+porcent(tarea.notaes,tarea.calificacion)+'%'"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="card" v-if="!preload" >
    <div class="card-body">
      <p>
        <strong v-text='traslate.test.toUpperCase()'></strong>
        <strong class='float-right' v-text='traslate.note'></strong>
      </p>
      <div class="progress-group" v-for="examen in a_examenes">
        <span v-text="examen.nombre"></span>
        <span class="float-right">
          <b><span v-text='examen.notaes'></span></b> de <span v-text='examen.notamaxima'></span>
        </span>
        <div class="progress progress-sm">
          <div class="progress-bar bg-primary" v-bind:style="'width:'+porcent(examen.notaes,examen.notamaxima)+'%'"></div>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
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
            preload:true,
            a_tareas:[],
            a_examenes:[],
            traslate:{
              'homework':trans('backend.homework'),
              'test':trans('backend.test'),
              'note':trans('backend.note'),
              'of':trans('backend.of'),
            }
          }
        },
        methods : {
          listado:function(){
            var url =this.base_url+'/resultados/lista_es';
            this.preload=true;
            axios.post(url,{idcurso:this.idcurso}).then(response =>{
                this.preload=false;
                this.a_tareas=response.data.tareas;
                this.a_examenes=response.data.examenes;
            }).catch(error =>{
                this.preload=false;
                this.a_tareas=[];
                this.a_examenes=[];
                if(error.response.data.errors){
                }
                if(error.response.data.error){
                  toastr.error(error.response.data.error,'',{
                      "timeOut": "3500"
                  });
                }
            });
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
