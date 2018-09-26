@extends('layouts.unicat.app')

@section('htmlheader')
@parent
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/styles/responsive.css') }}">
@stop

@section('content')
<!-- Home -->
<div class="home">
  <div class="home_slider_container">

    <!-- Home Slider -->
    <div class="owl-carousel owl-theme home_slider">

      <!-- Home Slider Item -->
      <div class="owl-item">
        <div class="home_slider_background" style="background-image:url({{ URL::asset('rfend/images/home_slider_1.jpg') }})"></div>
        <div class="home_slider_content">
          <div class="container">
            <div class="row">
              <div class="col text-center">
                <div class="home_slider_title">Sistema educativo</div>
                <div class="home_slider_subtitle">Futuro de la educacion online</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Home Slider Item -->
      <div class="owl-item">
        <div class="home_slider_background" style="background-image:url({{ URL::asset('rfend/images/home_slider_1.jpg') }})"></div>
        <div class="home_slider_content">
          <div class="container">
            <div class="row">
              <div class="col text-center">
                <div class="home_slider_title">Sistema educativo</div>
                <div class="home_slider_subtitle">Futuro de la educacion online</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Home Slider Nav -->
  <div class="home_slider_nav home_slider_prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
  <div class="home_slider_nav home_slider_next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
</div>

<!-- Features -->

<div class="features">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="section_title_container text-center">
          <h2 class="section_title">Bienvenido a Aula Virtual</h2>
          <div class="section_subtitle"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel gravida arcu. Vestibulum feugiat, sapien ultrices fermentum congue, quam velit venenatis sem</p></div>
        </div>
      </div>
    </div>
    <div class="row features_row">

      <!-- Features Item -->
      <div class="col-lg-3 feature_col">
        <div class="feature text-center trans_400">
          <div class="feature_icon"><img src="{{ URL::asset('rfend/images/icon_1.png') }}" alt=""></div>
          <h3 class="feature_title">The Experts</h3>
          <div class="feature_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p></div>
        </div>
      </div>

      <!-- Features Item -->
      <div class="col-lg-3 feature_col">
        <div class="feature text-center trans_400">
          <div class="feature_icon"><img src="{{ URL::asset('rfend/images/icon_2.png') }}" alt=""></div>
          <h3 class="feature_title">Book & Library</h3>
          <div class="feature_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p></div>
        </div>
      </div>

      <!-- Features Item -->
      <div class="col-lg-3 feature_col">
        <div class="feature text-center trans_400">
          <div class="feature_icon"><img src="{{ URL::asset('rfend/images/icon_3.png') }}" alt=""></div>
          <h3 class="feature_title">Best Courses</h3>
          <div class="feature_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p></div>
        </div>
      </div>

      <!-- Features Item -->
      <div class="col-lg-3 feature_col">
        <div class="feature text-center trans_400">
          <div class="feature_icon"><img src="{{ URL::asset('rfend/images/icon_4.png') }}" alt=""></div>
          <h3 class="feature_title">Award & Reward</h3>
          <div class="feature_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p></div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Popular Courses -->

<div class="courses">
  <div class="section_background parallax-window" data-parallax="scroll" data-image-src="{{ URL::asset('rfend/images/courses_background.jpg') }}" data-speed="0.8"></div>
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="section_title_container text-center">
          <h2 class="section_title">Cursos Recientes</h2>
          <div class="section_subtitle"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel gravida arcu. Vestibulum feugiat, sapien ultrices fermentum congue, quam velit venenatis sem</p></div>
        </div>
      </div>
    </div>
    <div class="row courses_row">

      <!-- Course -->
      <div class="col-lg-4 course_col">
        <div class="course">
          <div class="course_image"><img src="{{ URL::asset('rfend/images/course_1.jpg') }}" alt=""></div>
          <div class="course_body">
            <h3 class="course_title"><a href="course.html">Software Training</a></h3>
            <div class="course_teacher">Mr. John Taylor</div>
            <!--<div class="course_text">
              <p>Lorem ipsum dolor sit amet, consectetur adipi elitsed do eiusmod tempor</p>
            </div>-->
          </div>
          <!--<div class="course_footer">
            <div class="course_footer_content d-flex flex-row align-items-center justify-content-start">
              <div class="course_info">
                <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                <span>20 Student</span>
              </div>
              <div class="course_info">
                <i class="fa fa-star" aria-hidden="true"></i>
                <span>5 Ratings</span>
              </div>
              <div class="course_price ml-auto">$130</div>
            </div>
          </div>-->
        </div>
      </div>

      <!-- Course -->
      <div class="col-lg-4 course_col">
        <div class="course">
          <div class="course_image"><img src="{{ URL::asset('rfend/images/course_2.jpg') }}" alt=""></div>
          <div class="course_body">
            <h3 class="course_title"><a href="course.html">Developing Mobile Apps</a></h3>
            <div class="course_teacher">Ms. Lucius</div>
            <!--<div class="course_text">
              <p>Lorem ipsum dolor sit amet, consectetur adipi elitsed do eiusmod tempor</p>
            </div>-->
          </div>
          <!--<div class="course_footer">
            <div class="course_footer_content d-flex flex-row align-items-center justify-content-start">
              <div class="course_info">
                <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                <span>20 Student</span>
              </div>
              <div class="course_info">
                <i class="fa fa-star" aria-hidden="true"></i>
                <span>5 Ratings</span>
              </div>
              <div class="course_price ml-auto">Free</div>
            </div>
          </div>-->
        </div>
      </div>

      <!-- Course -->
      <div class="col-lg-4 course_col">
        <div class="course">
          <div class="course_image"><img src="{{ URL::asset('rfend/images/course_3.jpg') }}" alt=""></div>
          <div class="course_body">
            <h3 class="course_title"><a href="course.html">Starting a Startup</a></h3>
            <div class="course_teacher">Mr. Charles</div>
            <!--<div class="course_text">
              <p>Lorem ipsum dolor sit amet, consectetur adipi elitsed do eiusmod tempor</p>
            </div>-->
          </div>
          <!--<div class="course_footer">
            <div class="course_footer_content d-flex flex-row align-items-center justify-content-start">
              <div class="course_info">
                <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                <span>20 Student</span>
              </div>
              <div class="course_info">
                <i class="fa fa-star" aria-hidden="true"></i>
                <span>5 Ratings</span>
              </div>
              <div class="course_price ml-auto"><span>$320</span>$220</div>
            </div>
          </div>-->
        </div>
      </div>

    </div>
    <div class="row">
      <div class="col">
        <div class="courses_button trans_200"><a href="#">Ver mas cursos</a></div>
      </div>
    </div>
  </div>
</div>

<!-- Newsletter -->

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
