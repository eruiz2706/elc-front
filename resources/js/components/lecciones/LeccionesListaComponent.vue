<template>
<div>
  <div class="row" v-if="preload">
    <div class="d-block mx-auto" >
      <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
    </div>
  </div>

  <div class="row" v-if="!preload">
    <div class="col-md-12 col-sm-12">
      <h4 class="m-0 text-dark">
        <strong>Lista de lecciones</strong>
        <button type="button" class="btn btn-tool" v-on:click.prevent="redirectCrear()">
          <i class="fa fa-plus-circle"  style="font-size: 24px;"></i>
        </button>
      </h4> 
    </div>
  </div>

  <div class="row" v-if="!preload">
    <div class='col-md-12'>
      <div class="form-group">
      <select class="form-control" name="select_mod" v-model='idmodulo' @change="busqueda_modulo">
        <option v-bind:value='0'>Seleccione un modulo</option>
        <option v-bind:value='s_mod.id' v-for='s_mod in select_mod' v-text='s_mod.nombre'></option>
      </select>
      </div>
    </div>
  </div>
  <div class="card" v-if="!preload" v-for="leccion in a_leccion">
    <div class="card-header no-border">
      <h5 class="card-title" style='cursor:pointer' v-on:click.prevent="redirectEdit(leccion.id)">Leccion <span v-text='leccion.numero'></span></h5>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" v-on:click.prevent="redirectEdit(leccion.id)">
          <i class="fa  fa-pencil" style='font-size:20px'></i>
        </button>
        <button type="button" class="btn btn-tool" v-on:click.prevent="optionBorrar(leccion.id)">
              <i class="fa  fa-trash" style="font-size:20px"></i>
        </button>
      </div>

      <div class='row'>
        <div class="col-md-4 col-sm-6">
          <b>Titulo :</b> <span v-text='leccion.nombre'></span>
        </div>
        <div class="col-md-4 col-sm-6">
          <b>Creado :</b> <span v-text='leccion.fecha_creacion'></span>
        </div>
        <div class="col-md-4 col-sm-6">
          <b>Tiempo de lectura :</b> <span v-text='leccion.tiempolectura'></span> minutos
        </div>
        <div class="col-md-4 col-sm-6">
          <b>Modulo :</b> <span v-text='leccion.nommod'></span>
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
            id : 0,
            preload:true,
            a_leccion:[],
            select_mod:[],
            idmodulo:0
          }
        },
        methods : {
          listado:function(){
            var url =this.base_url+'/lecciones/lista';
            this.preload=true;
            axios.post(url,{idcurso:this.idcurso}).then(response =>{
                this.preload=false;
                this.select_mod=response.data.select_mod;
                this.a_leccion=response.data.lecciones;
            }).catch(error =>{
                this.preload=false;
                this.a_leccion=[];
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
            this.$root.$emit('setMenu','lecciones-crear');
          },
          redirectEdit:function(id){
            document.getElementById('id').value=id;
            this.$root.$emit('setMenu','lecciones-edit');
          },
          busqueda_modulo:function(){
            var url =this.base_url+'/lecciones/listamod';
            this.preload=true;
            axios.post(url,{idmodulo:this.idmodulo}).then(response =>{
                this.preload=false;
                this.a_leccion=response.data.lecciones;
            }).catch(error =>{
                this.preload=false;
                this.a_leccion=[];
                if(error.response.data.errors){
                }
                if(error.response.data.error){
                  toastr.error(error.response.data.error,'',{
                      "timeOut": "3500"
                  });
                }
            });
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
              inst.borrarLeccion(id);
            });  
          },
          borrarLeccion:function(id){
            var url =base_url+'/lecciones/borrar';
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
