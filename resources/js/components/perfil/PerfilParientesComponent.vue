<template>
<div>
<div class="card">
  <div class="card-header">
    <h3 class="card-title" v-text='traslate.family_member'></h3>

    <div class="card-tools">
      <div class="input-group input-group-sm" style="width: 250px;">
        <input type="text" name="table_search" class="form-control float-right" v-bind:placeholder="traslate.email" v-model="email_pariente">
        <div class="input-group-append">
          <button type="button" class="btn btn-primary" v-on:click.prevent='agregarpariente();'>
            <i class="fa fa-plus" v-if="!loader_add"></i>
            <i class="fa fa-spinner fa-spin fa-loader"  v-if="loader_add"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body p-0">
    <ul class="users-list clearfix">
      <li v-for='pariente in o_pariente'>
        <img v-bind:src="base_url+'/'+pariente.imagen" class="profile-user-img img-fluid img-circle">
        <a class="users-list-name" href="#" style='white-space:normal;text-overflow:inherit' v-text='pariente.nombre'></a>
        <a class="users-list-name" v-on:click.prevent="eliminar(pariente.id);">
            <i class="fa fa-trash" style="cursor:pointer;color:red;font-size:20px"></i>
        </a>
      </li>
    </ul>
  </div>
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
            email_pariente:'',
            loader_add :false,
            o_pariente:[],
            traslate:{
              'family_member':trans('backend.family_member'),
              'email':trans('backend.email'),
              'delete_confirm':trans('backend.delete_confirm'),
              'accept':trans('backend.accept'),
            }
          }
        },
        methods : {
          agregarpariente:function(){
            this.loader_cambiocl=true;
            var url =this.base_url+'/perfil/agregarPariente';
            axios.post(url,{email_pariente:this.email_pariente}).then(response =>{
                this.loader_add=false;
                swal({
                    title:response.data.message,
                    text:response.data.message2,
                    type: "success"
                });
                this.getData();
            }).catch(error =>{
                this.loader_add=false;
                if(error.response.data.error){
                  toastr.error(error.response.data.error,'',{
                      "timeOut": "2500"
                  });
                }
            });
          },
          getData:function(){
            this.preload=true;
            var url =this.base_url+'/perfil/dataPariente';
            axios.post(url,{}).then(response =>{
                this.preload=false;
                this.o_pariente=response.data.parientes
            }).catch(error =>{
                this.preload=false;
            });
          },
          eliminar:function(id){
            let inst = this;
            swal({
              title: inst.traslate.delete_confirm,
              text: "",
              type: "info",
              showCancelButton: true,
              confirmButtonClass: "btn-success",
              confirmButtonText: inst.traslate.accept,
              closeOnConfirm: true
            },
            function(){
              inst.borrarPariente(id);
            });
          },
          borrarPariente:function(id){
            var url =this.base_url+'/perfil/borrarPariente';
            axios.post(url,{id:id}).then(response =>{
              swal({
                  title:response.data.message,
                  text:response.data.message2,
                  type: "success"
              });
              this.getData();
            }).catch(error =>{
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
