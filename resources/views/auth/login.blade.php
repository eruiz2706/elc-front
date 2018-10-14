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
          <h2 class="counter_title">Iniciar sesiòn</h2>
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
          <form class="counter_form_content d-flex flex-column align-items-center justify-content-center" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="counter_form_title">Iniciar sesiòn</div>

            <input type="email" class="counter_input"  id="email" name="email"  autocomplete="off" placeholder="Email" required="required">
            @if ($errors->has('email'))
                <span class="text-danger">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif

            <input type="password" class="counter_input" id="password" name="password" autocomplete="off" placeholder="Contraseña" required="required">
            @if ($errors->has('password'))
                <span class="text-danger">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif

            <button type="submit" class="counter_form_button">
              Acceder
            </button>

            <br>
            <a href="{{ url('/registro') }}" class="text-left text-info">REGISTRATE</a>
            <a href="{{ url('/redirect') }}" class="text-left text-info">FACEBOOK_ID</a>
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
            <div class="newsletter_title">Lorem ipsum</div>
            <div class="newsletter_subtitle">Lorem ipsum dolor sit ametium, consectetur adipiscing elit.</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
