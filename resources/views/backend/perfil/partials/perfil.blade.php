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
              <input type="password" class="form-control" placeholder="Contraseña" v-model='o_cambiocl.password' v-bind:class="[e_cambiocl.password ? 'is-invalid' : '']">
              <span class="text-danger" v-if="e_cambiocl.password">@{{ e_cambiocl.password[0] }}</span>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
              <input type="password" class="form-control" placeholder="Confirmar contraseña"  v-model='o_cambiocl.repassword' v-bind:class="[e_cambiocl.repassword ? 'is-invalid' : '']">
              <span class="text-danger" v-if="e_cambiocl.repassword">@{{ e_cambiocl.repassword[0] }}</span>
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
    <div class="col-md-4">
      <img style='width:250px;height:200px;' class="img-fluid" src="{{ URL::asset(Auth::user()->imagen) }}" alt="Avatar user" id="logo-user">
      <form method="post" enctype="multipart/form-data" id="uploadForm" v-on:submit.prevent="actualizarImg()">
        @csrf
        <input type="file" class="form-control-file border" id="file_avatar" >
        <button type="submit" class="btn btn-block btn-outline-primary btn-sm" :disabled="loader_img"  >
          Cargar Imagen
          <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_img"></i>
        </button>
      </form>
    </div>

    <div class="col-md-8">
          <div class="table-responsive">
            <table class="table">
              <tbody>
              <tr>
                <td colspan='2'>
                  <p><strong>Nombre:</strong></p>
                  <span v-if='!modo_edit'>@{{o_user.nombre}}</span>
                  <div class="col-md-12" v-if='modo_edit'>
                    <div class="form-group">
                        <input type="text" class="form-control" v-model="o_user.nombre">
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan='2'>
                  <p><strong>Telefono:</strong></p>
                  <span v-if='!modo_edit'>@{{o_user.telefono}}</span>
                  <div class="col-md-12" v-if='modo_edit'>
                    <div class="form-group">
                        <input type="text" class="form-control" v-model="o_user.telefono">
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan='2'>
                  <p><strong>Ciudad:</strong></p>
                  <span v-if='!modo_edit'>@{{o_user.ciudad}}</span>
                  <div class="col-md-12" v-if='modo_edit'>
                    <div class="form-group">
                        <input type="text" class="form-control" v-model="o_user.ciudad">
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan='2'>
                  <p><strong>Direccion:</strong></p>
                  <span v-if='!modo_edit'>@{{o_user.direccion}}</span>
                  <div class="col-md-12" v-if='modo_edit'>
                    <div class="form-group">
                        <input type="text" class="form-control" v-model="o_user.direccion">
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan='2'>
                  <p><strong>Email:</strong></p>
                  <span>@{{o_user.email}}</span>
                </td>
              </tr>
              <tr>
                <td colspan='2'>
                  <p><strong>Facebook:</strong></p>
                  <span v-if='!modo_edit'>@{{o_user.facebook}}</span>
                  <div class="col-md-12" v-if='modo_edit'>
                    <div class="form-group">
                        <input type="text" class="form-control" v-model="o_user.facebook">
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan='2'>
                  <p><strong>Linkedin:</strong></p>
                  <span v-if='!modo_edit'>@{{o_user.linkedin}}</span>
                  <div class="col-md-12" v-if='modo_edit'>
                    <div class="form-group">
                        <input type="text" class="form-control" v-model="o_user.linkedin">
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan='2'>
                  <p><strong>Biografia:</strong></p>
                  <span v-if='!modo_edit'>@{{o_user.biografia}}</span>
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
                <td><button type="button" class="btn btn-outline-primary btn-sm float-right" v-on:click.prevent="modalcambiocl()">Cambiar Contraseña</button></td>
              </tr>
            </tbody></table>
          </div>
    </div>
  </div>
</div>
