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
              <li><a href="{{url('/')}}">{{ trans('frontend.nav.home') }}</a></li>
              <li>{{ trans('frontend.nav.courses') }}</li>
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
					<h2 class="section_title">{{ trans('frontend.page_courses.section_title') }}</h2>
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
              <option value=''>Seleccione el estado</option>
              @foreach($select_curso as $select)
                <option value='{{$select->slug}}'>{{$select->nombre}}</option>
              @endforeach
            </select>
            <button type='button' onclick="busqueda();" class="courses_search_button ml-auto">{{ trans('frontend.page_courses.button_search') }}</button>
          </form>
        </div>


        <div class="courses_container">
          <div class="row courses_row">

            <!-- Course -->
            @foreach($cursos as $curso)
            <div class="col-lg-4 course_col">
              <div class="course">
                <div class="course_image">
                  <a href="{{url('cursodet/'.$curso->id)}}">
                  <img src="{{ URL::asset($curso->imagen) }}" alt="">
                  </a>
                </div>
                <div class="course_body">
                  <h3 class="course_title"><a href="{{url('cursodet/'.$curso->id)}}">{{$curso->nombre}}</a></h3>
                  <div class="course_teacher">{{$curso->usercrea}}</div>
                  <div class="course_price ml-auto">{{$curso->nomestado}}</div>
                </div>
              </div>
            </div>
            @endforeach

          </div>

          @if ($cursos->lastPage() > 1)
            <div class="row pagination_row">
              <div class="col">
                <div class="pagination_container d-flex flex-row align-items-center justify-content-start">
                  <ul class="pagination_list">
                    <li class="{{ ($cursos->currentPage() == 1) ? ' disabled' : '' }} ">
                        <a href="{{ $cursos->url(1) }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $cursos->lastPage(); $i++)
                        <li class="{{ ($cursos->currentPage() == $i) ? ' active' : '' }} ">
                            <a href="{{ $cursos->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="{{ ($cursos->currentPage() == $cursos->lastPage()) ? ' disabled' : '' }} ">
                        <a href="{{ $cursos->url($cursos->currentPage()+1) }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          @endif
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
  <script src="{{ URL::asset('js/fe/curso.js') }}"></script>
@stop
