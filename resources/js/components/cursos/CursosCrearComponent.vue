<template>
<div>
  <div class="col-md-12">
    <div class="card ">
      <div class="card-header card-header-cuorse">
        <h2 class="card-title-course">
          Nuevo curso
          <button type="button" class="btn btn-tool" v-on:click.prevent="redirectVolver()">
            <i class="fa fa-arrow-circle-left"  style="font-size: 24px;"></i>
          </button>
        </h2>
      </div>
      <div class="card-body">
        <div class="callout callout-info">
          <p>
            <i class="fa fa-fw fa-info"></i>Los campos marcados en <code>*</code> son obligatorios
          </p>
        </div>

        <div class="form-group">
          <label>Titulo <code>*</code></label>
          <input type="text" class="form-control" name='nombre'  v-model='o_curso.nombre' v-bind:class="[e_curso.nombre ? 'is-invalid' : '']">
          <span class="text-danger" v-if="e_curso.nombre" v-text='e_curso.nombre[0]'></span>
        </div>

        <div class="form-group">
          <label>Fecha de Inicio <code>*</code></label>
          <input type="date" class="form-control" name='fecha_inicio' v-model='o_curso.fecha_inicio'  v-bind:class="[e_curso.fecha_inicio ? 'is-invalid' : '']">
          <span class="text-danger" v-if="e_curso.fecha_inicio" v-text='e_curso.fecha_inicio[0]'></span>
        </div>

        <div class="form-group">
          <label>Fecha de Finalizacion <code>*</code></label>
          <input type="date" class="form-control" name='fecha_finalizacion' v-model='o_curso.fecha_finalizacion'  v-bind:class="[e_curso.fecha_finalizacion ? 'is-invalid' : '']">
          <span class="text-danger" v-if="e_curso.fecha_finalizacion" v-text='e_curso.fecha_finalizacion[0]'></span>
        </div>

        <div class="form-group">
          <label>Fecha limite ver notas <code>*</code></label>
          <input type="date" class="form-control" name='fecha_limite' v-model='o_curso.fecha_limite'  v-bind:class="[e_curso.fecha_limite ? 'is-invalid' : '']">
          <span class="text-danger" v-if="e_curso.fecha_limite" v-text='e_curso.fecha_limite[0]'></span>
        </div>

        <div class="form-group">
          <label>Profesor(email)</label>
          <input type="text" class="form-control" name='profesor' v-model='o_curso.profesor'  v-bind:class="[e_curso.profesor ? 'is-invalid' : '']">
          <span class="text-danger" v-if="e_curso.profesor" v-text='e_curso.profesor[0]'></span>
        </div>

        <div class="form-group">
          <label>Profesor2(email)</label>
          <input type="text" class="form-control" name='profesor2' v-model='o_curso.profesor2'  v-bind:class="[e_curso.profesor2 ? 'is-invalid' : '']">
          <span class="text-danger" v-if="e_curso.profesor2" v-text='e_curso.profesor2[0]'></span>
        </div>

        <div class='form-group'>
          <label>Acceso al curso</label>
          <div class="form-check">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" checked name="accesradio" value='true' v-model='o_curso.visibilidad'>Publico
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="accesradio" value='false' v-model='o_curso.visibilidad'>Privado
            </label>
          </div>
        </div>

        <div class='form-group'>
          <label>Inscripcion</label>
          <div class="form-check">
            <label class="form-check-label">
              <input type="radio" class="form-check-input"  name="permitradio" value='true' v-model='o_curso.inscripcion'>Estudiante
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="permitradio" value='false' v-model='o_curso.inscripcion'>Administrador
            </label>
          </div>
        </div>

        <button type="button" class="btn btn-outline-primary btn-sm float-left" :disabled="loader_guardar" v-on:click.prevent='guardar()'>
          Crear curso
          <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_guardar"></i>
        </button>
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
      },
        data: function () {
          return {
            o_basecurso:{'nombre':'','fecha_inicio':'','fecha_finalizacion':'','fecha_limite':'','duracion':'','urlvideo':'','visibilidad':false,'inscripcion':true,'profesor':'','profesor2':''},
            o_curso:{'nombre':'','fecha_inicio':'','fecha_finalizacion':'','fecha_limite':'','duracion':'','urlvideo':'','visibilidad':false,'inscripcion':true,'profesor':'','profesor2':''},
            e_curso:[],
            loader_guardar :false,
          }
        },
        methods : {
          guardar:function(){
            this.loader_guardar=true;
            var url =base_url+'/cursos/guardar';
            let inst=this;
            axios.post(url,this.o_curso).then(response =>{
                this.loader_guardar=false;
                this.e_curso=[];
                this.o_curso=this.o_basecurso;
                swal({
                    title:response.data.message,
                    text:response.data.message2,
                    type: "success"
                },function(){
                  inst.$root.$emit('setMenu','cursos');
                });
            }).catch(error =>{
                this.loader_guardar=false;
                if(error.response.data.errors){
                  this.e_curso=error.response.data.errors;
                }
                if(error.response.data.error){
                  toastr.error(error.response.data.error,'',{
                      "timeOut": "3500"
                  });
                }
            });
          },
          redirectVolver:function(){
            this.$root.$emit('setMenu','cursos');
          }
        }
    }
</script>
