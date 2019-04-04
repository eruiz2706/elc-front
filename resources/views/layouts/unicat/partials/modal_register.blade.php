<div class="modal fade" id="modal_register" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="counter_form_title" style='margin:0px;margin-top:3px'>{{ trans('frontend.create_account') }}</div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row fill_height">
            <div class="col fill_height">
              <form class="counter_form_content d-flex flex-column align-items-center justify-content-center" method="post" v-on:submit.prevent="crear()">
                <input type="text" class="counter_input" name='nombre' placeholder="{{ trans('frontend.page_register.form_name') }}" autocomplete="off"  v-model="o_user.nombre">
                <label v-if="errores.nombre" class="text-danger">@{{ errores.nombre[0] }}</label>

                <input type="text" class="counter_input" name='email' placeholder="{{ trans('frontend.page_register.form_email') }}" autocomplete="off"  v-model="o_user.email">
                <label v-if="errores.email" class="text-danger">@{{ errores.email[0] }}</label>

                <select name="counter_select" id="counter_select" class="counter_input counter_options"  v-model="o_user.rol">
                  <option value=''>{{ trans('frontend.page_register.tittle_type') }}</option>
                  <option value='es'>{{ trans('frontend.page_register.type_es') }}</option>
                  <option value='pr'>{{ trans('frontend.page_register.type_pr') }}</option>
                  <option value='pa'>{{ trans('frontend.page_register.type_pa') }}</option>
                </select>
                <label v-if="errores.rol" class="text-danger">@{{ errores.rol[0] }}</label>

                <p>---------- OR ----------</p>
                <div class="social-auth-links text-center mt-2">
                  <div class='row'>
                  <div class='col-md-6'>
                    <div class="form-group">
                      <a href="#" class="btn  btn-primary" v-on:click.prevent="crearRedes('facebook')">
                        <i class="fa fa-facebook mr-2"></i> Facebook
                      </a>
                    </div>
                  </div>
                  <div class='col-md-6'>
                    <div class="form-group">
                      <a href="#" class="btn  btn-danger" v-on:click.prevent="crearRedes('google')">
                        <i class="fa fa-google mr-2"></i> Google
                      </a>
                    </div>
                  </div>
                  </div>
                </div>

               <button type="submit" class="counter_form_button"  :disabled="loader_crear">
                  {{ trans('frontend.sign_up') }}
                  <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader" v-if="loader_crear"></i>
                </button>
              </form>
            </div>
          </div>

      </div>
    </div>
  </div>
</div>