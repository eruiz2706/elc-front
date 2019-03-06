@extends('layouts.unicat.app')

@section('htmlheader')
@parent
<link href="{{ URL::asset('rfend/plugins/colorbox/colorbox.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/styles/contact.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/styles/contact_responsive.css') }}">
<script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />
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
              <!--<div class="contact_info_location_title">Cali colombia</div>-->
              <ul class="location_list">
                <li><strong>{{ trans('frontend.telephone') }} : </strong>{{ trans('frontend.elcolp_phone') }}</li>
                <li><strong>{{ trans('frontend.email') }} : </strong>{{ trans('frontend.elcolp_email') }}</li>
              </ul>
            </div>
            <div class="contact_map">
              <div class="map">
                <div id="google_map" class="google_map">
                  <div class="map_container">
                    <div id="map" style="box-shadow: 5px 5px 5px #888;z-index:2;width:100%; height: 400px;"></div>
                  </div>
                </div>
              </div>
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

@section('scripts')
@parent
<script>
var map = L.map('map').
setView([5.690039698717132,-76.66133874254979],
15);

L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
    maxZoom: 50
}).addTo(map);

L.control.scale().addTo(map);
L.marker([5.690466155074229,-76.66156768798828], {draggable: true}).addTo(map);
</script>
@stop
