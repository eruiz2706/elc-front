@extends('layouts.unicat.app')

@section('htmlheader')
@parent
<link href="{{ URL::asset('rfend/plugins/colorbox/colorbox.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/styles/about.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/styles/about_responsive.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/styles/newsletter.css') }}">
@stop

@section('content')
<div class="modal fade" id="modal_recover" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="counter_form_title" style='margin:0px;margin-top:3px'>{{ trans('frontend.recover_pass') }}</div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row fill_height">
            <div class="col fill_height">
              <form class="counter_form_content d-flex flex-column align-items-center justify-content-center" method="post" v-on:submit.prevent="recover()">
                <input type="text" class="counter_input" name='recov_email' placeholder="{{ trans('frontend.page_register.form_email') }}" autocomplete="off" v-model="o_recover.email">
                <label v-if="errores_recover.email" class="text-danger">@{{ errores_recover.email[0] }}</label>

                <button type="submit" class="counter_form_button"  :disabled="loader_recover">
                  {{ trans('frontend.send') }}
                  <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader" v-if="loader_recover"></i>
                </button>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_register" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="counter_form_title" style='margin:0px;margin-top:3px'>{{ trans('frontend.sign_up') }}</div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row fill_height">
            <div class="col fill_height">
              <form class="counter_form_content d-flex flex-column align-items-center justify-content-center" method="post" v-on:submit.prevent="crear()">
                <select name="counter_select" id="counter_select" class="counter_input counter_options"  v-model="o_user.rol">
                  <option value=''>{{ trans('frontend.page_register.tittle_type') }}</option>
                  <option value='es'>{{ trans('frontend.page_register.type_es') }}</option>
                  <option value='pr'>{{ trans('frontend.page_register.type_pr') }}</option>
                  <option value='pa'>{{ trans('frontend.page_register.type_pa') }}</option>
                </select>
                <label v-if="errores.rol" class="text-danger">@{{ errores.rol[0] }}</label>

                <input type="text" class="counter_input" name='nombre' placeholder="{{ trans('frontend.page_register.form_name') }}" autocomplete="off"  v-model="o_user.nombre">
                <label v-if="errores.nombre" class="text-danger">@{{ errores.nombre[0] }}</label>

                <input type="text" class="counter_input" name='email' placeholder="{{ trans('frontend.page_register.form_email') }}" autocomplete="off"  v-model="o_user.email">
                <label v-if="errores.email" class="text-danger">@{{ errores.email[0] }}</label>

               <button type="submit" class="counter_form_button"  :disabled="loader_crear">
                  {{ trans('frontend.sign_up') }}
                  <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader" v-if="loader_crear"></i>
                </button>

                <p>- OR -</p>
                <div class="social-auth-links text-center mb-3">
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
              </form>
            </div>
          </div>

      </div>
    </div>
  </div>
</div>

<!-- Home -->
<div class="home">
  <div class="breadcrumbs_container">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="breadcrumbs">
            <ul>
              <li><a href="{{url('/')}}">{{ trans('frontend.nav.home') }}</a></li>
              <li>{{ trans('frontend.log_in') }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Counter -->
<div class="counter">
  <div class="counter_background" style="background-image:url({{ URL::asset('rfend/images/home_slider_2.png') }})"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="counter_content">
          <h2 class="counter_title">{{ trans('frontend.page_login.tittle') }}</h2>
          <div class="counter_text">
            <p>{{ trans('frontend.page_login.text1') }}</p>
            <p>{{ trans('frontend.page_login.text2') }}</p>
            <p>{{ trans('frontend.page_login.text3') }}</p>
          </div>

          <!-- Milestones -->

          <div class="milestones d-flex flex-md-row flex-column align-items-center justify-content-between">
          </div>
        </div>

      </div>
    </div>

    <div class="counter_form">
      <div class="row ">
        <div class="col ">
          <form class="counter_form_content d-flex flex-column align-items-center justify-content-center" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="counter_form_title">{{ trans('frontend.log_in') }}</div>

            <input type="email" class="counter_input"  id="email" name="email"  autocomplete="off" placeholder="{{ trans('frontend.email') }}" >
            @if ($errors->has('email'))
                <span class="text-danger">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif

            <input type="password" class="counter_input" id="password" name="password" autocomplete="off" placeholder="{{ trans('frontend.pass') }}" >
            @if ($errors->has('password'))
                <span class="text-danger">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif

            <button type="submit" class="counter_form_button">
              {{ trans('frontend.enter') }}
            </button>

            <hr>
            <div class="social-auth-links text-center mb-3">
              <div class='row'>
              <div class='col-md-6'>
                <div class='form-group'>
                <a href="{{ url('/redirect/facebook') }}" class="btn  btn-primary">
                  <i class="fa fa-facebook mr-2"></i> Facebook
                </a>
                </div>
              </div>
              <div class='col-md-6'>
                <div class='form-group'>
                <a href="{{ url('/redirect/google') }}" class="btn  btn-danger">
                  <i class="fa fa-google mr-2"></i> Google
                </a>
                </div>
              </div>
              </div>
            </div>
            <a href="#" class="text-left float-left" v-on:click.prevent='openregister();'>{{ trans('frontend.sign_up') }}</a>
            <a href="#" class="text-left float-left" v-on:click.prevent='openrecover()'>{{ trans('frontend.forget_pass') }}</a>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>

<div class="newsletter">
  <div class="newsletter_background parallax-window" data-parallax="scroll" data-image-src="{{ URL::asset('rfend/images/newsletter.jpg') }}" data-speed="0.8"></div>
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="newsletter_container d-flex flex-lg-row flex-column align-items-center justify-content-start">

          <!-- Newsletter Content -->
          <div class="newsletter_content text-lg-left text-center">
            <div class="newsletter_title">{{ trans('frontend.newsletter_title') }}</div>
            <div class="newsletter_subtitle">{{ trans('frontend.newsletter_subtitle') }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
  @parent
  <script src="{{ URL::asset('js/fe/registro.js') }}"></script>
@stop
