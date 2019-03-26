<template>
<div>
<div class="modal fade" id="modalcambiocl" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" v-text="traslate.change_pass"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" v-on:submit.prevent="cambiocl()">
      <div class="modal-body">
        <div class="col-md-12">
          <div class="form-group">
              <input type="password" class="form-control" v-bind:placeholder="traslate.new_pass" v-model='o_cambiocl.password' v-bind:class="[e_cambiocl.password ? 'is-invalid' : '']">
              <span class="text-danger" v-if="e_cambiocl.password" v-text='e_cambiocl.password[0]'></span>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
              <input type="password" class="form-control" v-bind:placeholder="traslate.confirm_pass"  v-model='o_cambiocl.repassword' v-bind:class="[e_cambiocl.repassword ? 'is-invalid' : '']">
              <span class="text-danger" v-if="e_cambiocl.repassword" v-text='e_cambiocl.repassword[0]'></span>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" :disabled="loader_cambiocl">
          <span v-text='traslate.update'></span>
          <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_cambiocl"></i>
        </button>
      </div>
      </form>
    </div>
  </div>
</div>


<div class="callout">
  <div class="row">
    <div class="col-md-8">
          <div class="table-responsive">
            <table class="table">
              <tbody>
              <tr>
                <td colspan='2' style="padding-top:1px">
                  <p style='margin:0px'><strong v-text='traslate.name'></strong></p>
                  <span v-if='!modo_edit' v-text='o_user.nombre'></span>
                  <div class="col-md-12" v-if='modo_edit'>
                    <div class="form-group">
                        <input type="text" class="form-control" v-model="o_user.nombre">
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan='2' style="padding-top:1px">
                  <p style='margin:0px'>
                    <strong v-text='traslate.password'></strong>
                  </p>
                  <span>************</span>  <i class="fa  fa-pencil" style='cursor:pointer' v-on:click.prevent="modalcambiocl()"></i>
                </td>
              </tr>
              <tr>
                <td colspan='2' style="padding-top:1px">
                  <p style='margin:0px'><strong v-text='traslate.email'></strong></p>
                  <span v-text='o_user.email'></span>
                </td>
              </tr>
              <tr>
                <td colspan='2' style="padding-top:1px">
                  <p style='margin:0px'><strong v-text='traslate.telefono'></strong></p>
                  <span v-if='!modo_edit' v-text='o_user.telefono'></span>
                  <div class="col-md-12" v-if='modo_edit'>
                    <div class="form-group">
                        <input type="text" class="form-control" v-model="o_user.telefono">
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan='2' style="padding-top:1px">
                  <p style='margin:0px'> <strong v-text='traslate.city'></strong></p>
                  <span v-if='!modo_edit' v-text='o_user.ciudad'></span>
                  <div class="col-md-12" v-if='modo_edit'>
                    <div class="form-group">
                        <input type="text" class="form-control" v-model="o_user.ciudad">
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan='2' style="padding-top:1px">
                  <p style='margin:0px'><strong v-text='traslate.address'></strong></p>
                  <span v-if='!modo_edit' v-text='o_user.direccion'></span>
                  <div class="col-md-12" v-if='modo_edit'>
                    <div class="form-group">
                        <input type="text" class="form-control" v-model="o_user.direccion">
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan='2' style="padding-top:1px">
                  <p style='margin:0px'><strong v-text='traslate.facebook'></strong></p>
                  <span v-if='!modo_edit' v-text='o_user.facebook'></span>
                  <div class="col-md-12" v-if='modo_edit'>
                    <div class="form-group">
                        <input type="text" class="form-control" v-model="o_user.facebook">
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan='2' style="padding-top:1px">
                  <p style='margin:0px'><strong v-text='traslate.linkedin'></strong></p>
                  <span v-if='!modo_edit'  v-text='o_user.linkedin'></span>
                  <div class="col-md-12" v-if='modo_edit'>
                    <div class="form-group">
                        <input type="text" class="form-control" v-model="o_user.linkedin">
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan='2' style="padding-top:1px">
                  <p style='margin:0px'><strong v-text='traslate.biography'></strong></p>
                  <span v-if='!modo_edit' v-text='o_user.biografia'></span>
                  <div class="col-md-12" v-if='modo_edit'>
                    <div class="form-group">
                        <textarea class="form-control" rows="3" v-model="o_user.biografia"></textarea>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <th>
                  <button type="button" class="btn btn-outline-primary btn-sm" v-if='!modo_edit' v-on:click.prevent='editar()'><span v-text='traslate.edit'></span></button>
                  <button type="button" class="btn btn-outline-primary btn-sm" v-if='modo_edit' v-on:click.prevent='actualizar()' :disabled="loader_act" >
                    <span v-text='traslate.update'></span>
                    <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_act"></i>
                  </button>
                  <button type="button" class="btn btn-outline-primary btn-sm" v-if='modo_edit' v-on:click.prevent='cancelar()'><span v-text='traslate.cancel'></span></button>
                </th>
              </tr>
            </tbody></table>
          </div>
    </div>

    <div class="col-md-4">
      <div class="media">
          <div class="media-left">
              <a href="#" class="ad-click-event">
                  <img id="logo-user" v-bind:src="base_url+'/'+o_user.imagen" class="media-object" style="width: 150px;height: 150px;border-radius: 4px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
              </a>
          </div>
      </div>
      <form method="post" enctype="multipart/form-data" id="uploadForm" v-on:submit.prevent="actualizarImg()">
        <input type="file" class="form-control-file border" id="file_avatar" >
        <button type="submit" class="btn btn-block btn-outline-primary btn-sm" :disabled="loader_img"  >
          <span v-text='traslate.upload_image'></span>
          <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_img"></i>
        </button>
      </form>
    </div>
  </div>
</div>
</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component perfil usuario mounted.');
            /*function para previsualizar la imagen */
            jQuery(function (){
              jQuery("input[type=file]").change(function() {
                readURL(this);
              });
              const readURL = (input) => {
                if (input.files && input.files[0]) {
                  const reader = new FileReader();
                  reader.onload = (e) => {
                    jQuery('#logo-user').attr('src', e.target.result)
                  }
                  reader.readAsDataURL(input.files[0]);
                }
              };
            })
        },created : function(){
          this.base_url=base_url;
          this.getData();
        },
        data: function () {
          return {
            preload :false,
            o_userbase:{'nombre':'','telefono':'','ciudad':'','direccion':'','email':'','facebook':'','linkedin':'','biografia':''},
            o_user:{'nombre':'','telefono':'','ciudad':'','direccion':'','email':'','facebook':'','linkedin':'','biografia':''},

            loader_img :false,

            loader_cambiocl :false,
            o_cambiocl:{'password':'','repassword':''},
            e_cambiocl :[],

            modo_edit:false,
            loader_act:false,
            traslate:{
              'name':trans('backend.name'),
              'password':trans('backend.password'),
              'email':trans('backend.email'),
              'telefono':trans('backend.telefono'),
              'city':trans('backend.city'),
              'address':trans('backend.address'),
              'facebook':trans('backend.facebook'),
              'linkedin':trans('backend.linkedin'),
              'biography':trans('backend.biography'),
              'edit':trans('backend.edit'),
              'upload_image':trans('backend.upload_image'),
              'update':trans('backend.update'),
              'cancel':trans('backend.cancel'),
              'change_pass':trans('backend.change_pass'),
              'new_pass':trans('backend.new_pass'),
              'confirm_pass':trans('backend.confirm_pass'),
            }
          }
        },
        methods : {
        actualizarImg:function(){
          let inst=this;
          this.loader_img=true;
          var imagen  =$('#file_avatar')[0].files[0];
          var formData = new FormData();
          formData.append('avatar',imagen);
          var url =this.base_url+'/perfil/actimg';
          axios.post(url,formData,{avatar:imagen}).then(response =>{
              this.loader_img=false;
              swal({
                  title:response.data.message,
                  text:response.data.message2,
                  type: "success"
              }, function() {
                  location.reload(true);
              });
          }).catch(error =>{
              this.loader_img=false;
              if(error.response.data.error){
                toastr.error(error.response.data.error,'',{
                    "timeOut": "2500"
                });
              }
          });
        },
        modalcambiocl:function(){
          this.o_cambiocl={'password':'','repassword':''};
          $('#modalcambiocl').modal('show');
        },
        cambiocl:function(){
          this.loader_cambiocl=true;
          var url =this.base_url+'/perfil/cambiocl';
          axios.post(url,this.o_cambiocl).then(response =>{
              this.loader_cambiocl=false;
              this.e_cambiocl=[];
              $('#modalcambiocl').modal('hide');
              swal({
                  title:response.data.message,
                  text:response.data.message2,
                  type: "success"
              });
          }).catch(error =>{
              this.loader_cambiocl=false;
              if(error.response.data.errors){
                this.e_cambiocl=error.response.data.errors;
              }
              if(error.response.data.error){
                toastr.error(error.response.data.error,'',{
                    "timeOut": "2500"
                });
              }
          });
        },
        getData:function(){
            this.preload=true;
            var url =this.base_url+'/perfil/data';
            axios.post(url,{}).then(response =>{
                this.preload=false;
                this.o_user=response.data.user;
                this.o_userbase=response.data.user;
            }).catch(error =>{
                this.preload=false;
                console.log(error.response.data);
            });
        },
        editar:function(){
          this.modo_edit=true;
        },
        cancelar:function(){
          this.o_user=this.o_userbase;
          this.modo_edit=false;
        },
        actualizar:function(){
          this.loader_act=true;
          var url =this.base_url+'/perfil/act';
          axios.post(url,this.o_user).then(response =>{
              this.loader_act=false;
              this.modo_edit=false;
              swal({
                  title:response.data.message,
                  text:response.data.message2,
                  type: "success"
              });
          }).catch(error =>{
              this.loader_act=false;
              if(error.response.data.errors){
                //
              }
              if(error.response.data.error){
                toastr.error(error.response.data.error,'',{
                    "timeOut": "2500"
                });
              }
              console.log(error.response.data);
          });
        }
      }
    }
</script>
