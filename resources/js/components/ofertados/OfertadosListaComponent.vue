<template>
<div>
  <div class="row">
    <div class='col-md-12'>
      <div class="card">
          <div class="card-body">
            <select class="form-control" v-model='select_bsq' v-on:change="getBusqueda();">
              <option value=''>Seleccione el estado</option>
              <option value='abierto'>Abierto</option>
              <option value='encurso'>En curso</option>
              <option value='finalizado'>Finalizado</option>
            </select>
          </div>
      </div>
    </div>

    <div class="col-sm-6 col-md-4" v-for="curso in cursos">
      <div class="card" >
        <a href="#" v-on:click.prevent="detcurso(curso.id)">
        <img class="card-img-top" v-bind:src="base_url+'/'+curso.imagen">
        </a>
        <div class="card-body">
          <h5 class="card-title" v-text='curso.nombre'></h5>
          <p class="card-text" v-text='curso.nombestado'></p>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component ofertados mounted.');
        },created : function(){
          this.base_url=base_url;
          this.getBusqueda();
        },
        data: function () {
          return {
            cursos:[],
            errores :[],
            preload :false,
            select_bsq:''
          }
        },
        methods : {
          getBusqueda:function(){
              this.preload=true;
              var url =base_url+'/ofertados/busq';
              axios.post(url,{select_bsq:this.select_bsq}).then(response =>{
                  this.cursos=response.data.cursos;
                  this.preload=false;
              }).catch(error =>{
                  this.preload=false;
              });
          },
          detcurso:function(id){
            document.getElementById('id').value=id;
            this.$root.$emit('setMenu','ofertados_det');
          }
        }
    }
</script>
