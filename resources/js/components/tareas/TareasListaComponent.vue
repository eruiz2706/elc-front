<template>
<div>
  <div class="row" v-if="preload">
    <div class="d-block mx-auto" >
      <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
    </div>
  </div>

  <div class="row" v-if="!preload">
    <div class="col-sm-6">
      <h4 class="m-0 text-dark">
        <strong v-text='traslate.list_homework'></strong>
        <button type="button" class="btn btn-tool" v-on:click.prevent="redirectCrear()">
          <i class="fa fa-plus-circle"  style="font-size: 24px;"></i>
        </button>
      </h4>
    </div>
  </div>

  <div class="card" v-if="!preload" v-for="tarea in a_tareas">
    <div class="card-header no-border">
      <h5 class="card-title" style='cursor:pointer' v-on:click.prevent="redirectEdit(tarea.id)" v-text='tarea.nombre'></h5>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" v-on:click.prevent="redirectEdit(tarea.id)">
          <i class="fa  fa-pencil" style="font-size: 20px;"></i>
        </button>
        <button type="button" class="btn btn-tool" v-on:click.prevent="optionBorrar(tarea.id)">
              <i class="fa  fa-trash" style="font-size:20px"></i>
        </button>
      </div>

      <div class='row'>
        <div class="col-md-4 col-sm-6">
          <b><span v-text='traslate.created'></span> :</b> <span v-text='tarea.fecha_creacion'></span>
        </div>
        <div class="col-md-4 col-sm-6">
          <b><span v-text='traslate.expires'></span> :</b> <span v-text='tarea.fecha_vencimiento'></span>
        </div>
        <div class="col-md-4 col-sm-6">
          <b><span v-text='traslate.maximum_note'></span> :</b> <span v-text='tarea.calificacion'></span>
        </div>
        <div class="col-md-4 col-sm-6">
          <i class="fa fa-list-alt" style="cursor:pointer" v-on:click.prevent="redirectEnt(tarea.id)"></i> <b><span v-text='traslate.deliveries'></span> :</b> <span v-text='tarea.cant_respuest'></span>/<span v-text='cantUser'></span>
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
            preload:true,
            a_tareas:[],
            cantUser : 0,
            traslate:{
              'list_homework':trans('backend.list_homework'),
              'created':trans('backend.created'),
              'expires':trans('backend.expires'),
              'maximum_note':trans('backend.maximum_note'),
              'deliveries':trans('backend.deliveries'),
            }
          }
        },
        methods : {
          listado:function(){
            var url =this.base_url+'/tareas/lista';
            this.preload=true;
            axios.post(url,{idcurso:this.idcurso}).then(response =>{
                this.preload=false;
                this.a_tareas=response.data.tareas;
                this.cantUser=response.data.cantUser;
            }).catch(error =>{
                this.preload=false;
                this.modulos=[];
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
            this.$root.$emit('setMenu','tareas-crear');
          },
          redirectEdit:function(id){
            document.getElementById('id').value=id;
            this.$root.$emit('setMenu','tareas-edit');
          },
          redirectEnt:function(id){
            document.getElementById('id').value=id;
            this.$root.$emit('setMenu','tareas-lista-entrega');
          },
          optionBorrar:function(id){
            let inst=this;
            swal({
              title: "Seguro desea borrar el registro!",
              text: "",
              type: "info",
              showCancelButton: true,
              confirmButtonClass: "btn-success",
              confirmButtonText: "Aceptar",
              closeOnConfirm: true
            },
            function(){
              inst.borrarTarea(id);
            });  
          },
          borrarTarea:function(id){
            var url =base_url+'/tareas/borrar';
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
