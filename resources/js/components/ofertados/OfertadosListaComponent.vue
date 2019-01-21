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

    <div class="col-lg-4 " v-for="curso in cursos">
      <div class="course">
        <div class="course_image">
          <a href="#" v-on:click.prevent="detcurso(curso.id)">
          <img class="card-img-top" v-bind:src="base_url+'/'+curso.imagen">
          </a>
        </div>
        <div class="course_body">
          <h6 class="course_title" v-text='curso.nombre'></h6>
          <!--<div class="course_teacher"></div>-->
        </div>
        <div class="course_footer">
          <div class="course_footer_content d-flex flex-row align-items-center justify-content-start">
            <div class="course_info">
              <i class="fa fa-bank" aria-hidden="true"></i>
              <span v-text='curso.nombestado'></span>
            </div>
            <div class="course_price ml-auto" v-text="curso.valor>0 ? '$'+curso.valor : 'Gratis'"></div>
          </div>
        </div>
      </div>
    </div>

    <!--<div class="col-sm-6 col-md-4" v-for="curso in cursos">
      <div class="card" >
        <a href="#" v-on:click.prevent="detcurso(curso.id)">
        <img class="card-img-top" v-bind:src="base_url+'/'+curso.imagen">
        </a>
        <div class="card-body">
          <h5 class="card-title" v-text='curso.nombre'></h5>
          <p class="card-text" v-text='curso.nombestado'></p>
          <p class="card-text" v-text='curso.valor'></p>
        </div>
      </div>
    </div>-->
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
