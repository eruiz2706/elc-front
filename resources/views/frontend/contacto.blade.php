@extends('layouts.unicat.app')

@section('htmlheader')
@parent
<link href="{{ URL::asset('rfend/plugins/colorbox/colorbox.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/styles/contact.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/styles/contact_responsive.css') }}">
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
              <li>Contacto</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Contact -->

<div class="contact">

  <!-- Contact Map -->
  <!--<div class="contact_map">
    <div class="map">
      <div id="google_map" class="google_map">
        <div class="map_container">
          <div id="map"></div>
        </div>
      </div>
    </div>
  </div>-->

  <!-- Contact Info -->

  <div class="contact_info_container">
    <div class="container">
      <div class="row">

        <!-- Contact Form -->
        <div class="col-lg-6">
          <div class="contact_form">
            <div class="contact_info_title">Formulario de contacto</div>
            <form action="#" class="comment_form">
              <div>
                <div class="form_title">Name</div>
                <input type="text" class="comment_input" required="required">
              </div>
              <div>
                <div class="form_title">Email</div>
                <input type="text" class="comment_input" required="required">
              </div>
              <div>
                <div class="form_title">Message</div>
                <textarea class="comment_input comment_textarea" required="required"></textarea>
              </div>
              <div>
                <button type="submit" class="comment_button trans_200">Enviar</button>
              </div>
            </form>
          </div>
        </div>

        <!-- Contact Info -->
        <div class="col-lg-6">
          <div class="contact_info">
            <div class="contact_info_title">Informacion de contacto</div>
            <div class="contact_info_text">
              <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a distribution of letters.</p>
            </div>
            <div class="contact_info_location">
              <div class="contact_info_location_title">New York Office</div>
              <ul class="location_list">
                <li>T8/480 Collins St, Melbourne VIC 3000, New York</li>
                <li>1-234-567-89011</li>
                <li>info.deercreative@gmail.com</li>
              </ul>
            </div>
            <div class="contact_info_location">
              <div class="contact_info_location_title">Australia Office</div>
              <ul class="location_list">
                <li>Forrest Ray, 191-103 Integer Rd, Corona Australia</li>
                <li>1-234-567-89011</li>
                <li>info.deercreative@gmail.com</li>
              </ul>
            </div>
          </div>
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
