<template>
<div>

  <div class="row">
    <div class="col-md-12 col-sm-12">
      <h4 class="m-0 text-dark">
        <strong>Nuevo modulo</strong>
        <button type="button" class="btn btn-tool" v-on:click.prevent="redirectVolver()">
          <i class="fa fa-arrow-circle-left"  style="font-size: 24px;"></i>
        </button>
      </h4>
    </div><!-- /.col -->
  </div>


  <div class="card">
    <div class="card-body">
      <div class="callout callout-info">
      	<p>
      	  <i class="fa fa-fw fa-info"></i>Los campos marcados en <code>*</code> son obligatorios
      	</p>
      </div>

      <div class='row'>
      <div class="form-group col-md-2 col-sm-4">
        <label>Numero <code>*</code></label>
        <input type="number" min="0"  step="0.01" class="form-control" name='numero'  v-model='o_modulo.numero' v-bind:class="[e_modulo.numero ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_modulo.numero" v-text='e_modulo.numero[0]'></span>
      </div>

      <div class="form-group col-md-10 col-sm-12">
        <label>Titulo <code>*</code></label>
        <input type="text" class="form-control" name='nombre'  v-model='o_modulo.nombre' v-bind:class="[e_modulo.nombre ? 'is-invalid' : '']">
        <span class="text-danger" v-if="e_modulo.nombre" v-text='e_modulo.nombre[0]'></span>
      </div>
      </div>

      <button type="button" class="btn btn-outline-primary btn-sm float-left" :disabled="loader_guardar" v-on:click.prevent='guardar()'>
        Crear modulo
        <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_guardar"></i>
      </button>
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
        },
        data: function () {
          return {
            idcurso:0,
            o_basemodulo:{'nombre':''},
            o_modulo:{'nombre':''},
            e_modulo:[],
            loader_guardar :false,
          }
        },
        methods : {
          guardar:function(){
            this.loader_guardar=true;
            this.o_modulo.idcurso=this.idcurso;
            var url =this.base_url+'/modulos/guardar';
            axios.post(url,this.o_modulo).then(response =>{
                this.loader_guardar=false;
                this.e_modulo=[];
                this.o_modulo=this.o_basemodulo;
                let inst=this;
                swal({
                    title:response.data.message,
                    text:response.data.message2,
                    type: "success"
                },function(){
                    document.getElementById('id').value='';
                    inst.$root.$emit('setMenu','modulos-lista');
                });
            }).catch(error =>{
                this.loader_guardar=false;
                if(error.response.data.errors){
                  this.e_modulo=error.response.data.errors;
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
            this.$root.$emit('setMenu','modulos-lista');
          }
        }
    }
</script>
