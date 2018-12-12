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
        <strong>Preguntas </strong>
        <button type="button" class="btn btn-tool" v-on:click.prevent="redirectVolver()">
          <i class="fa fa-arrow-circle-left" style="font-size: 24px;"></i>
        </button>
        <button type="button" class="btn btn-tool" v-on:click.prevent="redirectCrear()">
          <i class="fa fa-plus-circle"  style="font-size: 24px;"></i>
        </button>
      </h5>
    </div>
  </div>

  <div class="card" v-if="!preload" v-for="pregunta in a_preguntas">
    <div class="card-header no-border">
      <h5 class="card-title" style='cursor:pointer' v-on:click.prevent="redirectEdit(pregunta.id)" v-text='pregunta.nombre'></h5>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" v-on:click.prevent="redirectEdit(pregunta.id)">
          <i class="fa  fa-pencil" style="font-size: 20px;"></i>
        </button>
      </div>

      <div class='row'>
        <div class="col-md-4 col-sm-6">
          <b>Tipo :</b> <span v-text='pregunta.tipo'></span>
        </div>
        <div class="col-md-4 col-sm-6">
          <b>Creado :</b> <span v-text='pregunta.fecha_creacion'></span>
        </div>
        <div class="col-md-4 col-sm-6">
          <b>Puntaje :</b> <span v-text='pregunta.puntaje'></span>
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
          this.idejerc=document.getElementById('id').value;
          this.listado();
        },
        data: function () {
          return {
            idcurso : 0,
            idejerc : 0,
            preload:false,
            a_preguntas:[],
          }
        },
        methods : {
          listado:function(){
            var url =this.base_url+'/preguntas/lista';
            this.preload=true;
            axios.post(url,{idcurso:this.idcurso,idejerc:this.idejerc}).then(response =>{
                this.preload=false;
                this.a_preguntas=response.data.preguntas;
            }).catch(error =>{
                this.preload=false;
                if(error.response.data.errors){
                }
                if(error.response.data.error){
                  toastr.error(error.response.data.error,'',{
                      "timeOut": "2500"
                  });
                }
            });
          },
          redirectCrear:function(){
            this.$root.$emit('setMenu','preguntas-crear');
          },
          redirectEdit:function(idpregunta){
            document.getElementById('id2').value=idpregunta;
            this.$root.$emit('setMenu','preguntas-edit');
          },
          redirectVolver:function(){
            this.$root.$emit('setMenu','examenes-lista');
          }
        }
    }
</script>
