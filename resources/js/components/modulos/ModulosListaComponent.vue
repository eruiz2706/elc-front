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
        <strong>Lista de modulos</strong>
        <button type="button" class="btn btn-tool" v-on:click.prevent="redirectCrear()">
          <i class="fa fa-plus-circle"  style="font-size: 24px;"></i>
        </button>
      </h4>
    </div>
  </div>

  <div class="card"  v-for="modulo in a_modulos">
    <div class="card-header no-border">
      <h5 class="card-title" style='cursor:pointer' v-on:click.prevent="redirectEdit(modulo.id)">Modulo <span v-text='modulo.numero'></span></h5>
      <div class="card-tools">
        <div class="btn-group">
          <button type="button" class="btn btn-tool" v-on:click.prevent="redirectEdit(modulo.id)">
            <i class="fa  fa-pencil" style="font-size: 20px;"></i>
          </button>
          <button type="button" class="btn btn-tool" v-on:click.prevent="optionBorrar(modulo.id)">
              <i class="fa  fa-trash" style="font-size:20px"></i>
        </button>
        </div>
      </div>

      <div class='row'>
        <div class="col-md-4 col-sm-6">
          <b>Titulo :</b> <span v-text='modulo.nombre'></span>
        </div>
        <div class="col-md-4 col-sm-6">
          <b>Creado :</b> <span v-text='modulo.fecha_creacion'></span>
        </div>
        <div class="col-md-4 col-sm-6">
          <b>Lecciones :</b> <span v-text='modulo.numlec'></span>
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
            preload:false,
            a_modulos:[],
          }
        },
        methods : {
          listado:function(){
            var url =this.base_url+'/modulos/lista';
            this.preload=true;
            axios.post(url,{idcurso:this.idcurso}).then(response =>{
                this.preload=false;
                this.a_modulos=response.data.modulos;

            }).catch(error =>{
                this.preload=false;
                this.a_modulos=[];
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
            this.$root.$emit('setMenu','modulos-crear');
          },
          redirectEdit:function(id){
            document.getElementById('id').value=id;
            this.$root.$emit('setMenu','modulos-edit');
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
              inst.borrarModulo(id);
            });  
          },
          borrarModulo:function(id){
            var url =base_url+'/modulos/borrar';
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
