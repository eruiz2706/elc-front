@extends('layouts.unicat.app')

@section('htmlheader')
@parent
<link href="{{ URL::asset('rfend/plugins/colorbox/colorbox.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/styles/about.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/styles/about_responsive.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/styles/newsletter.css') }}">
@stop

@section('content')
<!-- Home -->
<div class="home">
  <div class="breadcrumbs_container">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="breadcrumbs">
            <ul>
              <li><a href="{{url('/')}}">Inicio</a></li>
              <li>Registro</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Counter -->
<div class="counter">
  <div class="counter_background" style="background-image:url({{ URL::asset('rfend/images/counter_background.jpg') }})"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="counter_content">
          <h2 class="counter_title">Registrate</h2>
          <div class="counter_text"><p>Simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dumy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p></div>

          <!-- Milestones -->

          <div class="milestones d-flex flex-md-row flex-column align-items-center justify-content-between">
            <!--<div class="milestone">
              <div class="milestone_counter" data-end-value="15">0</div>
              <div class="milestone_text">years</div>
            </div>

            <div class="milestone">
              <div class="milestone_counter" data-end-value="120" data-sign-after="k">0</div>
              <div class="milestone_text">years</div>
            </div>

            <div class="milestone">
              <div class="milestone_counter" data-end-value="670" data-sign-after="+">0</div>
              <div class="milestone_text">years</div>
            </div>

            <div class="milestone">
              <div class="milestone_counter" data-end-value="320">0</div>
              <div class="milestone_text">years</div>
            </div>-->
          </div>
        </div>

      </div>
    </div>

    <div class="counter_form">
      <div class="row fill_height">
        <div class="col fill_height">
          <form class="counter_form_content d-flex flex-column align-items-center justify-content-center" method="post" v-on:submit.prevent="crear()">
            <div class="counter_form_title">Registrate</div>
            <select name="counter_select" id="counter_select" class="counter_input counter_options" required="required" v-model="o_user.rol">
              <option value=''>Seleccione el tipo</option>
              <option value='es'>Soy un estudiante</option>
              <option value='pr'>Soy un profesor</option>
              <option value='pa'>Soy un familiar</option>
            </select>

            <input type="text" class="counter_input" name='nombre' placeholder="Nombre" autocomplete="off" required="required" v-model="o_user.nombre">
            <label v-if="errores.nombre" class="text-danger">@{{ errores.nombre[0] }}</label>

            <input type="text" class="counter_input" name='email' placeholder="Email" autocomplete="off" required="required" v-model="o_user.email">
            <label v-if="errores.email" class="text-danger">@{{ errores.email[0] }}</label>

            <input type="password" class="counter_input" name='password' autocomplete="off" placeholder="Contraseña" required="required" v-model="o_user.password">
            <label v-if="errores.password" class="text-danger">@{{ errores.password[0] }}</label>

            <button type="submit" class="counter_form_button"  :disabled="loader_crear">
              Registrate
              <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader" v-if="loader_crear"></i>
            </button>

            <p>- OR -</p>
            <div class="social-auth-links text-center mb-3">
              <div class='row'>
              <div class='col-md-6'>
                <a href="#" class="btn  btn-primary" v-on:click.prevent="crearRedes('facebook')">
                  <i class="fa fa-facebook mr-2"></i> Facebook
                </a>
              </div>
              <div class='col-md-6'>
                <a href="#" class="btn  btn-danger" v-on:click.prevent="crearRedes('google')">
                  <i class="fa fa-google mr-2"></i> Google
                </a>
              </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- Newsletter -->
@include('frontend.partials.newsletter')


@endsection

@section('scripts')
  @parent
  <script src="{{ URL::asset('js/fe/registro.js') }}"></script>
@stop
