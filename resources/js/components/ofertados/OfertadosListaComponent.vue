<template>
<div>
  <div class="row">
    <div class='col-md-12'>
      <div class="card">
          <div class="card-body">
            <select class="form-control" v-model='select_bsq' v-on:change="getBusqueda();">
              <option value='' v-text='traslate.selected_status'></option>
              <option value='abierto' v-text='traslate.abierto'></option>
              <option value='encurso' v-text='traslate.encurso'></option>
              <option value='finalizado' v-text='traslate.finalizado'></option>
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
          <h3 class="course_title">
            <a href="#" v-on:click.prevent="detcurso(curso.id)" v-text='curso.nombre'></a>
          </h3>
          <!--<div class="course_teacher"></div>-->
        </div>
        <div class="course_footer">
          <div class="course_footer_content d-flex flex-row align-items-center justify-content-start">
            <div class="course_info">
              <i class="fa fa-bank" aria-hidden="true"></i>
              <span v-text='gettraslate(curso.slug)'></span>
            </div>
            <div class="course_price ml-auto" v-text="curso.valor>0 ? '$'+curso.valor : traslate.free"></div>
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
            select_bsq:'',
            traslate:{
              'abierto':trans('frontend.page_courses.abierto'),
              'encurso':trans('frontend.page_courses.encurso'),
              'finalizado':trans('frontend.page_courses.finalizado'),
              'free':trans('frontend.page_courses.free'),
              'indefinido':trans('frontend.page_courses.indefinido'),
              'selected_status':trans('frontend.page_courses.selected_status'),
            }
          }
        },
        methods : {
          gettraslate:function(estado){
            return trans('frontend.page_courses.'+estado);
          },
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
