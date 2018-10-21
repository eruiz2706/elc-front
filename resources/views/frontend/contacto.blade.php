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
              <li><a href="{{url('/')}}">{{ trans('frontend.nav.home') }}</a></li>
              <li>{{ trans('frontend.nav.contact') }}</li>
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
            <div class="contact_info_title">{{ trans('frontend.page_contact.contact_form_title') }}</div>
            <form action="#" class="comment_form">
              <div>
                <div class="form_title">{{ trans('frontend.page_contact.form_name') }}</div>
                <input type="text" class="comment_input" required="required">
              </div>
              <div>
                <div class="form_title">{{ trans('frontend.page_contact.form_email') }}</div>
                <input type="text" class="comment_input" required="required">
              </div>
              <div>
                <div class="form_title">{{ trans('frontend.page_contact.form_message') }}</div>
                <textarea class="comment_input comment_textarea" required="required"></textarea>
              </div>
              <div>
                <button type="submit" class="comment_button trans_200">{{ trans('frontend.page_contact.button_send') }}</button>
              </div>
            </form>
          </div>
        </div>

        <!-- Contact Info -->
        <div class="col-lg-6">
          <div class="contact_info">
            <div class="contact_info_title">{{ trans('frontend.page_contact.contact_info_title') }}</div>
            <div class="contact_info_text">
              <p>{{ trans('frontend.page_contact.contact_info_text') }}</p>
            </div>
            <div class="contact_info_location">
              <div class="contact_info_location_title">Cali colombia</div>
              <ul class="location_list">
                <li>Avenida 3 ·5-27</li>
                <li>01 8000 913 14 98</li>
                <li>elc@gmail.com</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Newsletter -->
@include('frontend.partials.newsletter')

@endsection
