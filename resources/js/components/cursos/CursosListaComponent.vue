<template>
<div>
  <div class="row" v-if="preload">
    <div class="d-block mx-auto" >
      <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
    </div>
  </div>

  <div class="card" v-if="!preload">
    <div class="card-header card-header-cuorse">
      <h2 class="card-title-course">
        Lista de cursos
        <button type="button" class="btn btn-tool" v-on:click.prevent="redirectCrear('cursos-crear')">
          <i class="fa fa-plus-circle"  style="font-size: 24px;color:white"></i>
        </button>
      </h2>
    </div>
  </div>
  <div class="card" v-if="!preload" v-for="curso in a_cursos">
    <div class="card-header no-border">
      <div class="card-tools float-left">
        <button type="button" class="btn btn-tool" v-on:click.prevent="redirectAbrir(curso.id)">
              Ingresar <i class="fa fa-folder-open" style="font-size:20px"></i>
        </button>
        <button type="button" class="btn btn-tool" v-on:click.prevent="duplicar(curso.id)">
              <i class="fa fa-copy" style="font-size:20px"></i>
        </button>
        <button type="button" class="btn btn-tool" v-on:click.prevent="optionBorrarCurso(curso.id)">
              <i class="fa  fa-trash" style="font-size:20px"></i>
        </button>
      </div>
      <h5 class="card-title" style='cursor:pointer' v-on:click.prevent="redirectAbrir(curso.id)" v-text='curso.nombre'></h5>
      <div class='row'>
        <div class="col-md-4 col-sm-6">
          <b>Creado :</b> <span v-text='curso.fecha_creacion'></span>
        </div>
        <div class="col-md-4 col-sm-6">
          <b>Inicia :</b> <span v-text='curso.fecha_inicio'></span>
        </div>
        <div class="col-md-4 col-sm-6">
          <b>Finaliza :</b> <span v-text='curso.fecha_finalizacion'></span>
        </div>
        <div class="col-md-4 col-sm-6">
          <b>Limite notas :</b> <span v-text='curso.fecha_limite'></span>
        </div>
        <div class="col-md-4 col-sm-6">
          <b>Visibilidad :</b>
          <span class="badge bg-success" v-if="curso.visibilidad">Visible al publico</span>
          <span class="badge bg-danger" v-else>Oculto al publico</span>
        </div>
        <!--<div class="col-md-4 col-sm-6">
          <b>Inscripcion :</b>
          <span class="badge bg-success" v-if="curso.inscripcion">Estudiante</span>
          <span class="badge bg-info" v-else>Administrador</span>
        </div>-->
        <div class="col-md-4 col-sm-6">
          <b>Valor :</b>
          <span v-text='curso.valor'></span>
        </div>
        <div class="col-md-4 col-sm-6" v-for="profesor in curso.profesores">
          <b>Profesor :</b>
          <span v-text='profesor.email'></span>
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
          this.listado();
        },
        data: function () {
          return {
            preload:false,
            a_cursos:[],
          }
        },
        methods : {
          listado:function(){
            var url =this.base_url+'/cursos/lista';
            this.preload=true;
            axios.post(url,{}).then(response =>{
                this.preload=false;
                this.a_cursos=response.data.cursos;
            }).catch(error =>{
                this.preload=false;
                this.a_cursos=[];
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
            this.$root.$emit('setMenu','cursos-crear');
          },
          redirectAbrir:function(id){
            window.location.href=this.base_url+'/cursos/config/'+id;
          },
          optionBorrarCurso:function(id){
            let inst=this;
            swal({
              title: "Seguro desea borrar el curso!",
              text: "",
              type: "info",
              showCancelButton: true,
              confirmButtonClass: "btn-success",
              confirmButtonText: "Aceptar",
              closeOnConfirm: true
            },
            function(){
              inst.borrarCurso(id);
            });  
          },
          borrarCurso:function(id){
            var url =base_url+'/cursos/borrar';
              axios.post(url,{id}).then(response =>{
                  this.listado();
                  swal({
                      title:response.data.message,
                      text:response.data.message2,
                      type: "success"
                  });
              }).catch(error =>{
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
          duplicar:function(id){
            let inst=this;
            swal({
              title: "Seguro desea duplicar el curso!",
              text: "",
              type: "info",
              showCancelButton: true,
              confirmButtonClass: "btn-success",
              confirmButtonText: "Aceptar",
              closeOnConfirm: true
            },
            function(){
              inst.replicarCurso(id);
            });  
          },
          replicarCurso:function(id){
            var url =base_url+'/cursos/replicar';
              axios.post(url,{id}).then(response =>{
                  this.listado();
                  swal({
                      title:response.data.message,
                      text:response.data.message2,
                      type: "success"
                  });
              }).catch(error =>{
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
