<template>
<div>
  <div class="row" v-if="preload">
    <div class="d-block mx-auto" >
      <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
    </div>
  </div>

  <div class="card" v-if="!preload" v-for="tarea in a_tareas">
    <div class="card-header no-border">
      <h5 class="card-title" v-text='tarea.nombre'></h5>

      <div class='row'>
        <div class="col-md-4 col-sm-6">
          <b><i class="fa  fa-clock-o"></i> Vence :</b> <span v-text='tarea.fecha_vencimiento'></span>
        </div>
        <div class="col-md-4 col-sm-6">
          <b>Calificacion Sobre :</b> <span v-text='tarea.calificacion'></span>
        </div>
        <div class="col-md-4 col-sm-6">
          <b>Estado :</b>
          <small v-bind:class="'badge badge-'+tarea.status"><span v-text='tarea.nombestado'></span></small>
        </div>
        <div class="col-md-4 col-sm-6">
          <b>Nota : <span v-text='tarea.notaes'></span></b>
        </div>
      </div>
    </div>
    <div class="card-body">
      <button type="button" class="btn btn-outline-primary btn-sm float-left" v-on:click="abrir(tarea.id)">
        Abrir tarea
      </button>
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
          }
        },
        methods : {
          listado:function(){
            var url =this.base_url+'/tareas/lista_es';
            this.preload=true;
            axios.post(url,{idcurso:this.idcurso}).then(response =>{
                this.preload=false;
                this.a_tareas=response.data.tareas;
            }).catch(error =>{
                this.preload=false;
                this.modulos=[];
                if(error.response.data.errors){
                }
                if(error.response.data.error){
                  toastr.error(error.response.data.error,'',{
                      "timeOut": "3500"
                  });
                }
            });
          },
          abrir:function(id){
            document.getElementById('id').value=id;
            this.$root.$emit('setMenu','tareas-entrega-es');
          },
        }
    }
</script>
