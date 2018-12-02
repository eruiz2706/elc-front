<!-- Modal -->
<div class="modal fade" id="modalcambiocl" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cambiar contraseña</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" v-on:submit.prevent="cambiocl()">
        @csrf
      <div class="modal-body">
        <div class="col-md-12">
          <div class="form-group">
              <input type="password" class="form-control" placeholder="Nueva contraseña" v-model='o_cambiocl.password' v-bind:class="[e_cambiocl.password ? 'is-invalid' : '']">
              <span class="text-danger" v-if="e_cambiocl.password" v-text='e_cambiocl.password[0]'></span>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
              <input type="password" class="form-control" placeholder="Confirmar contraseña"  v-model='o_cambiocl.repassword' v-bind:class="[e_cambiocl.repassword ? 'is-invalid' : '']">
              <span class="text-danger" v-if="e_cambiocl.repassword" v-text='e_cambiocl.repassword[0]'></span>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" :disabled="loader_cambiocl">
          Actualizar
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
                  <p style='margin:0px'><strong>Nombre:</strong></p>
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
                    <strong>Contraseña:</strong>
                  </p>
                  <span>************</span>  <i class="fa  fa-pencil" style='cursor:pointer' v-on:click.prevent="modalcambiocl()"></i>
                </td>
              </tr>
              <tr>
                <td colspan='2' style="padding-top:1px">
                  <p style='margin:0px'><strong>Email:</strong></p>
                  <span v-text='o_user.email'></span>
                </td>
              </tr>
              <tr>
                <td colspan='2' style="padding-top:1px">
                  <p style='margin:0px'><strong>Telefono:</strong></p>
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
                  <p style='margin:0px'> <strong>Ciudad:</strong></p>
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
                  <p style='margin:0px'><strong>Direccion:</strong></p>
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
                  <p style='margin:0px'><strong>Facebook:</strong></p>
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
                  <p style='margin:0px'><strong>Linkedin:</strong></p>
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
                  <p style='margin:0px'><strong>Biografia:</strong></p>
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
                  <button type="button" class="btn btn-outline-primary btn-sm" v-if='!modo_edit' v-on:click.prevent='editar()'>Editar</button>
                  <button type="button" class="btn btn-outline-primary btn-sm" v-if='modo_edit' v-on:click.prevent='actualizar()' :disabled="loader_act" >
                    Actualizar
                    <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_act"></i>
                  </button>
                  <button type="button" class="btn btn-outline-primary btn-sm" v-if='modo_edit' v-on:click.prevent='cancelar()'>Cancelar</button>
                </th>
              </tr>
            </tbody></table>
          </div>
    </div>

    <div class="col-md-4">
      <div class="media">
          <div class="media-left">
              <a href="#" class="ad-click-event">
                  <img id="logo-user" src="{{ URL::asset(Auth::user()->imagen) }}" class="media-object" style="width: 150px;height: 150px;border-radius: 4px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
              </a>
          </div>
      </div>
      <form method="post" enctype="multipart/form-data" id="uploadForm" v-on:submit.prevent="actualizarImg()">
        @csrf
        <input type="file" class="form-control-file border" id="file_avatar" >
        <button type="submit" class="btn btn-block btn-outline-primary btn-sm" :disabled="loader_img"  >
          Cargar Imagen
          <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_img"></i>
        </button>
      </form>
    </div>
  </div>
</div>
