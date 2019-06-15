<template>
<div>
  <!-- Modal -->
  <div class="modal fade" id="modal_revision" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class='modal-header'>
            Revision<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="height:450px;overflow-y: auto;">
          <div class="row" v-if="preloadmodal">
            <div class="d-block mx-auto" >
              <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
            </div>
          </div>

          <div v-for='revision in a_revision'>
            <div class="form-group">
              <label>Pregunta</label>
              <p v-text="revision.nombre"></p>
              <p v-html="revision.descripcion"></p>
            </div>
            <div class="form-group">
              <label>Respuesta</label>
              <p v-html="revision.respuesta"></p>
            </div>
            <div class="form-group">
              <label>Calificacion sobre <span v-text="revision.notapreg"></span></label>
              <input type="number" name="calificacion" min="0" max="1000" class="form-control" v-model='revision.calificacion'>
            </div>
            <hr>
          </div>


        </div>

        <div class='modal-footer'>
          <button type="button" class="btn btn-outline-primary btn-sm float-left" :disabled="loader_revision" v-on:click.prevent='updrevision()'>
            Enviar revision
            <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_revision"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="row" v-if="preload">
    <div class="d-block mx-auto" >
      <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
    </div>
  </div>

  <div class="row" v-if="!preload">
    <div class="col-sm-6">
      <h4 class="m-0 text-dark">
        <strong>Entrega: </strong><span v-text="o_ejercicio.nombre"></span>
        <button type="button" class="btn btn-tool" v-on:click.prevent="redirectVolver()">
          <i class="fa fa-arrow-circle-left"  style="font-size: 24px;"></i>
        </button>
      </h4>
    </div>
  </div>

  <div class="card" v-if="!preload" v-for="ejercicio in a_ejercicios">
    <div class="card-header no-border">
      <h5 class="card-title" style='cursor:pointer'  v-text='ejercicio.nombre'></h5>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" v-on:click.prevent="openRevisar(ejercicio.ident)" v-if="ejercicio.slugstatus !='calificado'">
          <i class="fa  fa-eye" style="font-size: 20px;"></i>
        </button>
      </div>

      <div class='row'>
        <div class="col-md-4 col-sm-6">
          <b>Estado :</b>
          <small v-bind:class="'badge badge-'+ejercicio.status"><span v-text='ejercicio.nombestado'></span></small>
        </div>
        <div class="col-md-4 col-sm-6">
          <b>Calificacion :</b> <span v-text='ejercicio.notaes'></span>/<span v-text='ejercicio.calificacion'></span>
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
          this.id=document.getElementById('id').value;
          this.listado();
        },
        data: function () {
          return {
            idcurso : 0,
            id : 0,
            preload:true,
            a_ejercicios:[],
            o_ejercicio:{},

            preloadmodal:true,
            a_revision:[],
            o_revision:{},
            loader_revision :false,
          }
        },
        methods : {
          listado:function(){
            var url =this.base_url+'/ejercicios/listaent';
            this.preload=true;
            axios.post(url,{idcurso:this.idcurso,id:this.id}).then(response =>{
                this.preload=false;
                this.a_ejercicios=response.data.ejercicios;
                this.o_ejercicio=response.data.ejercicio;
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
          redirectVolver:function(){
            document.getElementById('id').value='';
            this.$root.$emit('setMenu','examenes-lista');
          },
          openRevisar:function(id){
            $('#modal_revision').modal('show');
            var url =this.base_url+'/ejercicios/revision';
            this.preloadmodal=true;
            axios.post(url,{id:id}).then(response =>{
                this.preloadmodal=false;
                this.a_revision=response.data.ejercicio;
                this.o_revision.id=id;
                console.log(response.data);
            }).catch(error =>{
                this.preloadmodal=false;
                this.a_revision=[];
                this.o_revision={};
                if(error.response.data.errors){
                }
                if(error.response.data.error){
                  toastr.error(error.response.data.error,'',{
                      "timeOut": "3500"
                  });
                }

            });
          },
          updrevision:function(){
            this.loader_revision=true;
            var url =this.base_url+'/ejercicios/updrevision';
            axios.post(url,{revision:this.a_revision,idejeruser:this.o_revision.id}).then(response =>{
                this.loader_revision=false;
                this.a_revision=[];
                this.o_revision={};
                $('#modal_revision').modal('hide');
                this.listado();
                swal({
                    title:response.data.message,
                    text:response.data.message2,
                    type: "success"
                });
            }).catch(error =>{
                this.loader_revision=false;
                if(error.response.data.errors){
                  this.e_tarea=error.response.data.errors;
                }
                if(error.response.data.error){
                  toastr.error(error.response.data.error,'',{
                      "timeOut": "2500"
                  });
                }
            });
          }
        }
    }
</script>
