<template>
<div>
  <div class="row" v-if="preload">
    <div class="d-block mx-auto" >
      <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
    </div>
  </div>

  <div class="card" v-if="!preload">
    <div class="card-header">
      <h3 class="card-title">Pagos realizados</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
      <table class="table table-hover">
        <tbody><tr>
          <th>Id</th>
          <th>Curso</th>
          <th>Valor</th>
          <th>Fecha de Pago</th>
        </tr>
        <tr v-for="pago in a_pagos">
          <td v-text='pago.reference_code'></td>
          <td v-text='pago.nombre_curso'></td>
          <td v-text='pago.valor'></td>
          <td v-text='pago.fecha_creacion'></td>
        </tr>
      </tbody></table>
    </div>
    <!-- /.card-body -->
  </div>
</div>
</template>

<script>
    export default {
        mounted() {

        },created : function(){
          this.base_url=base_url;
          this.getData();
        },
        data: function () {
          return {
            preload :false,
            a_pagos:[]
          }
        },
        methods : {
        getData:function(){
            this.preload=true;
            var url =this.base_url+'/perfil/pagos';
            axios.post(url,{}).then(response =>{
                this.preload=false;
                this.a_pagos=response.data.pagos;
            }).catch(error =>{
                this.preload=false;
            });
        }
      }
    }
</script>
