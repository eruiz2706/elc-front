<template>
<div>
  <div class="row" v-if="preload">
    <div class="d-block mx-auto" >
      <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
    </div>
  </div>

  <div class="row" v-if="!preload">
    <div class="col-sm-6">
      <h5 class="m-0 text-dark">
        <strong>Lista de examenes</strong>
        <button type="button" class="btn btn-tool" v-on:click.prevent="redirectCrear()">
          <i class="fa fa-plus-circle"  style="font-size: 24px;"></i>
        </button>
      </h5>
    </div>
  </div>

  <div class="card" v-if="!preload" v-for="ejercicio in a_ejercicios">
    <div class="card-header no-border">
      <h5 class="card-title" style='cursor:pointer' v-on:click.prevent="redirectEdit(ejercicio.id)">
        <span v-text='ejercicio.nombre'></span> <i class="fa  fa-pencil btn-tool" style="font-size: 20px;" v-on:click.prevent="redirectEdit(ejercicio.id)"></i>
      </h5>
      <div class="card-tools">
        <div class="btn-group">
          <button type="button" class="btn btn-tool" v-on:click.prevent="redirectPreguntas(ejercicio.id)">
            <i class="fa  fa-list-alt" style="font-size: 20px;"></i>
          </button>
        </div>
      </div>

      <div class='row'>
        <div class="col-md-4 col-sm-6">
          <b>Creado :</b> <span v-text='ejercicio.fecha_creacion'></span>
        </div>
        <div class="col-md-4 col-sm-6">
          <b>Inicia :</b> <span v-text='ejercicio.fecha_inicio'></span>
        </div>
        <div class="col-md-4 col-sm-6">
          <b>Duracion :</b> <span v-text='ejercicio.duracion'></span> minutos
        </div>
        <div class="col-md-4 col-sm-6">
          <b>Preguntas :</b> <span v-text='ejercicio.cant_preg'></span>
        </div>
        <div class="col-md-4 col-sm-6">
          <b>Nota sobre :</b> <span v-text='ejercicio.notamaxima'></span>
        </div>
        <div class="col-md-4 col-sm-6">
          <i class="fa fa-list-alt" style="cursor:pointer" v-on:click.prevent="redirectEnt(ejercicio.id)"></i> <b>Realizado :</b> <span v-text='ejercicio.entregas'></span>/<span v-text='cantUser'></span>
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
            preload:false,
            a_ejercicios:[],
            cantUser : 0
          }
        },
        methods : {
          listado:function(){
            var url =this.base_url+'/ejercicios/lista';
            this.preload=true;
            axios.post(url,{idcurso:this.idcurso}).then(response =>{
                this.preload=false;
                this.a_ejercicios=response.data.ejercicios;
                this.cantUser=response.data.cantUser;
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
          redirectCrear:function(){
            this.$root.$emit('setMenu','examenes-crear');
          },
          redirectEdit:function(id){
            document.getElementById('id').value=id;
            this.$root.$emit('setMenu','examenes-edit');
          },
          redirectPreguntas:function(id){
            document.getElementById('id').value=id;
            this.$root.$emit('setMenu','preguntas-lista');
          },
          redirectEnt:function(id){
            document.getElementById('id').value=id;
            this.$root.$emit('setMenu','examenes-lista-entrega');
          }
        }
    }
</script>
