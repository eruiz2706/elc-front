@extends('layouts.unicat.app')

@section('htmlheader')
@parent
<link href="{{ URL::asset('rfend/plugins/colorbox/colorbox.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/styles/courses.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/styles/courses_responsive.css') }}">
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
              <li>Cursos</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Courses -->
<div class="courses">

  <div class="container">
    <div class="row">
			<div class="col">
				<div class="section_title_container text-center">
					<h2 class="section_title">Cursos</h2>
					<div class="section_subtitle"><p></p></div>
				</div>
			</div>
		</div>

    <div class="row">
      <!-- Courses Main Content -->
      <div class="col-lg-12">
        <div class="courses_search_container">
          <form action="#" id="courses_search_form" class="courses_search_form d-flex flex-row align-items-center justify-content-start">
            <select id="courses_search_select" class="courses_search_select courses_search_input">
              <option>Todas las categorias</option>
              <option>Categoria1</option>
              <option>Categoria2</option>
              <option>Categoria3</option>
            </select>
            <select id="courses_search_select" class="courses_search_select courses_search_input">
              <option>Seleccione el estado</option>
              <option>Abierto</option>
              <option>Inscripcion abierta</option>
            </select>
            <button action="submit" class="courses_search_button ml-auto">Buscar</button>
          </form>
        </div>
        <div class="courses_container">
          <div class="row courses_row">

            <!-- Course -->
            <div class="col-lg-4 course_col">
              <div class="course">
                <div class="course_image"><img src="{{ URL::asset('rfend/images/course_4.jpg') }}" alt=""></div>
                <div class="course_body">
                  <h3 class="course_title"><a href="course.html">Software Training</a></h3>
                  <div class="course_teacher">Mr. John Taylor</div>
                </div>
              </div>
            </div>

            <!-- Course -->
            <div class="col-lg-4 course_col">
              <div class="course">
                <div class="course_image"><img src="{{ URL::asset('rfend/images/course_5.jpg') }}" alt=""></div>
                <div class="course_body">
                  <h3 class="course_title"><a href="course.html">Developing Mobile Apps</a></h3>
                  <div class="course_teacher">Ms. Lucius</div>
                </div>
              </div>
            </div>

            <!-- Course -->
            <div class="col-lg-4 course_col">
              <div class="course">
                <div class="course_image"><img src="{{ URL::asset('rfend/images/course_6.jpg') }}" alt=""></div>
                <div class="course_body">
                  <h3 class="course_title"><a href="course.html">Starting a Startup</a></h3>
                  <div class="course_teacher">Mr. Charles</div>
                </div>
              </div>
            </div>

            <!-- Course -->
            <div class="col-lg-4 course_col">
              <div class="course">
                <div class="course_image"><img src="{{ URL::asset('rfend/images/course_7.jpg') }}" alt=""></div>
                <div class="course_body">
                  <h3 class="course_title"><a href="course.html">Learn Basic German Fast</a></h3>
                  <div class="course_teacher">Mr. John Taylor</div>
                </div>
              </div>
            </div>

            <!-- Course -->
            <div class="col-lg-4 course_col">
              <div class="course">
                <div class="course_image"><img src="{{ URL::asset('rfend/images/course_8.jpg') }}" alt=""></div>
                <div class="course_body">
                  <h3 class="course_title"><a href="course.html">Business Groud Up</a></h3>
                  <div class="course_teacher">Ms. Lucius</div>
                </div>
              </div>
            </div>

            <!-- Course -->
            <div class="col-lg-4 course_col">
              <div class="course">
                <div class="course_image"><img src="{{ URL::asset('rfend/images/course_9.jpg') }}" alt=""></div>
                <div class="course_body">
                  <h3 class="course_title"><a href="course.html">Java Technology</a></h3>
                  <div class="course_teacher">Mr. Charles</div>
                </div>
              </div>
            </div>

          </div>
          <div class="row pagination_row">
            <div class="col">
              <div class="pagination_container d-flex flex-row align-items-center justify-content-start">
                <ul class="pagination_list">
                  <li class="active"><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                </ul>
              </div>
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
