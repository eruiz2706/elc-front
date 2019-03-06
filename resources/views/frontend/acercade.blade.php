@extends('layouts.unicat.app')

@section('htmlheader')
@parent
<link href="{{ URL::asset('rfend/plugins/colorbox/colorbox.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/styles/about.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/styles/about_responsive.css') }}">
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
              <li>{{ trans('frontend.nav.about') }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- About -->

<div class="about">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="section_title_container text-center">
          <h2 class="section_title">{{ trans('frontend.page_about.section_title') }}</h2>
        </div>
      </div>
    </div>
    <div class="row about_row">
      <!-- About Item -->
      <div class="col-lg-1">
      </div>

      <!-- About Item -->
      <div class="col-lg-5 about_col about_col_left">
        <div class="about_item">
          <div class="about_item_image"><img src="{{ URL::asset('rfend/images/about_1.jpg') }}" alt=""></div>
          <div class="about_item_title"><a href="#">{{ trans('frontend.page_about.about_item1_title') }}</a></div>
          <div class="about_item_text text-justify">
            <p>{{ trans('frontend.page_about.about_item1_text') }}</p>
          </div>
        </div>
      </div>

      <!-- About Item -->
      <div class="col-lg-5 about_col about_col_middle">
        <div class="about_item">
          <div class="about_item_image"><img src="{{ URL::asset('rfend/images/about_2.jpg') }}" alt=""></div>
          <div class="about_item_title"><a href="#">{{ trans('frontend.page_about.about_item2_title') }}</a></div>
          <div class="about_item_text text-justify">
            <p>{{ trans('frontend.page_about.about_item2_text') }}</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Feature -->
<div class="feature" style="padding-top:1px">
  <div class="feature_background" style="background-image:url({{URL::asset('rfend/images/courses_background.jpg') }})"></div>
  <div class="container">
    <!--<div class="row">
      <div class="col">
        <div class="section_title_container text-center">
          <h2 class="section_title">{{ trans('frontend.page_about.feature_title') }}</h2>
          <div class="section_subtitle">
            <p>{{ trans('frontend.page_about.feature_descrip') }}</p>
          </div>
        </div>
      </div>
    </div>-->
    <div class="row feature_row">

      <!-- Feature Content -->
      <div class="col-lg-7 feature_col">
        <div class="feature_content">
          <!-- Accordions -->
          <div class="accordions">

            <div class="elements_accordions">

              <div class="accordion_container">
                <div class="accordion d-flex flex-row align-items-center  active"><div>{{ trans('frontend.page_about.accordion_panel_tittle') }}</div></div>
                <div class="accordion_panel text-justify" style='max-height: 800px;'>
                  <p>{{ trans('frontend.page_about.accordion_panel_text1') }}</p>
                  <p>{{ trans('frontend.page_about.accordion_panel_text2') }}</p>
                  <p>{{ trans('frontend.page_about.accordion_panel_text3') }}</p>
                </div>
              </div>


            </div>

          </div>
          <!-- Accordions End -->
        </div>
      </div>

      <!-- Feature Video -->
      <div class="col-lg-5 feature_col">
        <div class="feature_video d-flex flex-column align-items-center justify-content-center">
          <div class="feature_video_background" style="background-image:url({{ URL::asset('rfend/images/video.jpg') }})"></div>
          <a class="vimeo feature_video_button" href="https://player.vimeo.com/video/99340873?title=0" title="OH, PORTUGAL - IN 4K - Basti Hansen - Stock Footage">
            <img src="images/play.png" alt="">
          </a>
        </div>
      </div>
    </div>
  </div>
</div>




@endsection
