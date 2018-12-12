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

          <label>Descripcion</label>
        	<p v-html='o_revision.descripcion'></p>
          <hr>

          <label>Entrega</label>
        	<p v-html='o_revision.respuesta'></p>
          <hr>

          <div class="form-group">
            <label>Calificacion sobre <span v-text='o_revision.notasobre'></span></label>
            <input type="number" name="calificacion" min="0" max="1000" class="form-control" v-model='o_revision.notaes'>
          </div>

          <label>Comentario</label>
        	<div class="form-group">
            <textarea rows="3" placeholder="Escribe tu comentario aqui" name="p_descripcion" class="form-control" v-model='o_revision.comentario'>
            </textarea>
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
      <h5 class="m-0 text-dark">
        <strong>Entrega: </strong><span v-text="o_tarea.nombre"></span>
        <button type="button" class="btn btn-tool" v-on:click.prevent="redirectVolver()">
          <i class="fa fa-arrow-circle-left"  style="font-size: 24px;"></i>
        </button>
      </h5>
    </div>
  </div>

  <div class="card" v-if="!preload" v-for="tarea in a_tareas">
    <div class="card-header no-border">
      <h5 class="card-title" style='cursor:pointer' v-text='tarea.nombre'></h5>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" v-on:click.prevent="openRevisar(tarea.ident)">
          <i class="fa  fa-eye" style="font-size: 20px;"></i>
        </button>
      </div>

      <div class='row'>
        <div class="col-md-4 col-sm-6">
          <b>Estado :</b>
          <small v-bind:class="'badge badge-'+tarea.status"><span v-text='tarea.nombestado'></span></small>
        </div>
        <div class="col-md-4 col-sm-6">
          <b>Calificacion :</b> <span v-text='tarea.notaes'></span>/<span v-text='tarea.calificacion'></span>
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
            a_tareas:[],
            o_tarea:{},

            preloadmodal:true,
            o_revision:{},
            loader_revision :false,
          }
        },
        methods : {
          listado:function(){
            var url =this.base_url+'/tareas/listaent';
            this.preload=true;
            axios.post(url,{idcurso:this.idcurso,id:this.id}).then(response =>{
                this.preload=false;
                this.a_tareas=response.data.tareas;
                this.o_tarea=response.data.tarea;
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
          openRevisar:function(id){
            $('#modal_revision').modal('show');
            var url =base_url+'/tareas/revision';
            this.preloadmodal=true;
            axios.post(url,{id:id}).then(response =>{
                this.preloadmodal=false;
                this.o_revision=response.data.tarea;
                this.o_revision.id=id;
            }).catch(error =>{
                this.preloadmodal=false;
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
            var url =this.base_url+'/tareas/updrevision';
            axios.post(url,this.o_revision).then(response =>{
                this.loader_revision=false;
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
          },
          redirectVolver:function(){
            document.getElementById('id').value='';
            this.$root.$emit('setMenu','tareas-lista');
          },
        }
    }
</script>
