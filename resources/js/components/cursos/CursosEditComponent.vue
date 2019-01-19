<template>
<div>
  <div class="row" v-if="preload">
    <div class="d-block mx-auto" >
      <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
    </div>
  </div>
  <div class="col-md-12" v-if="!preload">
    <div class="card card-outline">
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
          <label>Fecha de Finalizacion</label>
          <input type="date" class="form-control" name='fecha_finalizacion' v-model='o_curso.fecha_finalizacion'  v-bind:class="[e_curso.fecha_finalizacion ? 'is-invalid' : '']">
          <span class="text-danger" v-if="e_curso.fecha_finalizacion" v-text='e_curso.fecha_finalizacion[0]'></span>
        </div>

        <div class="form-group">
          <label>Fecha limite ver notas</label>
          <input type="date" class="form-control" name='fecha_limite' v-model='o_curso.fecha_limite'  v-bind:class="[e_curso.fecha_limite ? 'is-invalid' : '']">
          <span class="text-danger" v-if="e_curso.fecha_limite" v-text='e_curso.fecha_limite[0]'></span>
        </div>

        <div class="form-group">
          <label>Valor</label>
          <input type="number" class="form-control" name='fecha_limite' v-model='o_curso.valor'  v-bind:class="[e_curso.fecha_limite ? 'is-invalid' : '']">
          <span class="text-danger" v-if="e_curso.valor" v-text='e_curso.valor[0]'></span>
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
              <input type="radio" class="form-check-input" checked name="permitradio" value='true' v-model='o_curso.inscripcion'>Permitido al usuario
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="permitradio" value='false' v-model='o_curso.inscripcion'>Disponible para administrador del curso
            </label>
          </div>
        </div>

        <button type="button" class="btn btn-outline-primary btn-sm float-left" :disabled="loader_actualizar" v-on:click.prevent='actualizar()'>
          Actualizar
          <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_actualizar"></i>
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
          this.id_curso=document.getElementById('idcurso').value;
          this.getCurso();
        },
        data: function () {
          return {
            preload :true,
            id_curso :0,
            o_curso:{},
            e_curso:[],
            loader_actualizar:false,
          }
        },
        methods : {
          getCurso:function(){
              this.preload=true;
              var url =this.base_url+'/cursos/editar';
              axios.post(url,{id:this.id_curso}).then(response =>{
                  this.o_curso=response.data.curso;
                  this.o_curso.profesor=response.data.profesor;
                  this.o_curso.profesor2=response.data.profesor2;
                  this.preload=false;
              }).catch(error =>{
                  this.preload=false;
              });
          },
          actualizar:function(){
            this.loader_actualizar=true;
            var url =this.base_url+'/cursos/actualizar';
            this.o_curso.id=this.id_curso;
            let inst=this;
            axios.post(url,this.o_curso).then(response =>{
                this.loader_actualizar=false;
                this.e_curso=[];
                swal({
                    title:response.data.message,
                    text:response.data.message2,
                    type: "success"
                },function(){
                  inst.getCurso();
                });
            }).catch(error =>{
                this.loader_actualizar=false;
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
        }
    }
</script>
