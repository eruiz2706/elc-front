<template>
<div>
  <!-- Modal -->
  <div class="modal fade" id="modal_resultados" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class='modal-header'>
            Resultados<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="height:400px;overflow-y: auto;">
          <div class="row" v-if="preloadmodal">
            <div class="d-block mx-auto" >
              <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
            </div>
          </div>
          <div class="card" v-if="!preload">
            <div class="card-body">
            <p class="text-center">
                <strong>TAREAS</strong>
              </p>
              <div class="progress-group" v-for="tarea in a_tareas">
                <span v-text="tarea.nombre"></span>
                <span class="float-right">
                  <b><span v-text='tarea.notaes'></span></b>/<span v-text='tarea.calificacion'></span>
                </span>
                <div class="progress progress-sm">
                  <div class="progress-bar bg-primary" v-bind:style="'width:'+porcent(tarea.notaes,tarea.calificacion)+'%'"></div>
                </div>
              </div>
            </div>
          </div>

          <div class="card" v-if="!preload" >
            <div class="card-body">
            <p class="text-center">
                <strong>EXAMENES</strong>
              </p>
              <div class="progress-group" v-for="examen in a_examenes">
                <span v-text="examen.nombre"></span>
                <span class="float-right">
                  <b><span v-text='examen.notaes'></span></b>/<span v-text='examen.notamaxima'></span>
                </span>
                <div class="progress progress-sm">
                  <div class="progress-bar bg-primary" v-bind:style="'width:'+porcent(examen.notaes,examen.notamaxima)+'%'"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row" v-if="preload">
    <div class="d-block mx-auto" >
      <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
    </div>
  </div>

  <div class='row'>
    <div class='col-md-6 col-sm-12' v-for="integrante in a_integrantes">
      <div class="card" v-if="!preload" >
        <div class="card-header">
          <div class="card-tools">
            <div class="btn-group">
              <button type="button" class="btn btn-tool" v-on:click.prevent='openuser(integrante.id)'>
                <i class="fa  fa-list-alt" style="font-size: 20px;"></i>
              </button>
            </div>
          </div>
          <div class="post">
            <div class="user-block">
              <img class="img-circle img-bordered" v-bind:src="base_url+'/'+integrante.imagen">
              <span class="username">
                <a><span v-text='integrante.nombre'></span></a>
              </span>
            </div>
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
            console.log('Component integrantes mounted.');
        },created : function(){
          this.base_url=base_url;
          this.idcurso=document.getElementById('idcurso').value;
          this.listado();
        },
        data: function () {
          return {
            idcurso : 0,
            preload:true,
            a_integrantes:[],
            preloadmodal:false,
            a_tareas:[],
            a_examenes:[],
          }
        },
        methods : {
          listado:function(){
            var url =base_url+'/resultados/lista';
            this.preload=true;
            axios.post(url,{idcurso:this.idcurso}).then(response =>{
                this.preload=false;
                this.a_integrantes=response.data.integrantes;
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
          openuser:function(id){
            console.log(id);
            $('#modal_resultados').modal('show');
            var url =this.base_url+'/resultados/estudiante';
            this.preloadmodal=true;
            axios.post(url,{idcurso:this.idcurso,id:id}).then(response =>{
                this.preloadmodal=false;
                this.a_tareas=response.data.tareas;
                this.a_examenes=response.data.examenes;
            }).catch(error =>{
                this.preloadmodal=false;
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
