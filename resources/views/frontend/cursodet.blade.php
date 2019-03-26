@extends('layouts.unicat.app')

@section('htmlheader')
@parent
<link href="{{ URL::asset('rfend/plugins/colorbox/colorbox.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/styles/course.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/styles/course_responsive.css') }}">
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
              <li><a href="{{url('/cursosd')}}">{{ trans('frontend.nav.courses') }}</a></li>
              <li>{{ trans('frontend.nav.coursesdet') }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="course">
		<div class="container">
			<div class="row">

				<!-- Course -->
				<div class="col-lg-8">

					<div class="course_container">
						<div class="course_title" v-text='o_curso.nombre'></div>

						<!-- Course Image -->
						<div class="course_image">
              <img v-if="o_curso.urlvideo ==''" v-bind:src="base_url+'/'+o_curso.imagen" alt="" style='width:100%;height:400px'>
              <iframe v-if="o_curso.urlvideo !=''" class="img-fluid" style='width:100%;height:400px' frameborder="0" allowfullscreen allow="autoplay; encrypted-media"
                  v-bind:src="o_curso.urlvideo">
                </iframe>
            </div>

						<!-- Course Tabs -->
						<div class="course_tabs_container">
							<div class="tabs d-flex flex-row align-items-center justify-content-start">
								<div class="tab active">{{ trans('frontend.page_coursedet.study_plan') }}</div>
							</div>
							<div class="tab_panels">

								<!-- Description -->
								<div class="tab_panel active">
									<div class="tab_panel_content" v-html="o_curso.plan_estudio">
                  </div>
                </div>

							</div>
						</div>
					</div>
				</div>

				<!-- Course Sidebar -->
				<div class="col-lg-4">
					<div class="sidebar">

            <!-- Feature -->
            <div class="sidebar_section">
            <!--<div class="sidebar_section_title">Teacher</div>-->
              <div class="sidebar_teacher">
                <div class="teacher_title_container d-flex flex-row align-items-center justify-content-start">
                  <div class="teacher_image"><img v-bind:src="base_url+'/'+o_curso.imgusucrea" alt=""></div>
                  <div class="teacher_title">
                    <div class="teacher_name"><a href="#"><span v-text='o_curso.usercrea'></span></div>
                    <!--<div class="teacher_position">Marketing & Management</div>-->
                  </div>
                </div>
              </div>
            </div>

						<!-- Feature -->
						<div class="sidebar_section">
							<div class="sidebar_section_title">{{ trans('frontend.page_coursedet.feature') }}</div>
							<div class="sidebar_feature">
								<div class="course_price" v-text="traduction[o_curso.slug]"></div>
                <!-- Features -->
								<div class="feature_list">

									<!-- Feature -->
                  <div class="feature d-flex flex-row align-items-center justify-content-start">
										<div class="feature_title"><i class="fa fa-clock-o" aria-hidden="true"></i><span>{{ trans('frontend.page_coursedet.start_date') }}</span></div>
										<div class="feature_text ml-auto" v-text='o_curso.fecha_inicio'></div>
									</div>

                  <!-- Feature -->
									<div class="feature d-flex flex-row align-items-center justify-content-start">
										<div class="feature_title"><i class="fa fa-clock-o" aria-hidden="true"></i><span>{{ trans('frontend.page_coursedet.end_date') }}</span></div>
										<div class="feature_text ml-auto" v-text='o_curso.fecha_finalizacion'></div>
									</div>
                </div>
                <BR>
                <div class="row">
                <div class="col-md-12">
                <a href="{{url('login')}}" class="btn  btn-primary">
                  {{ trans('frontend.nav.login') }}
                </a>
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

  <input type='hidden' name='id' id='id' value="{{$id}}"></input>
@endsection

@section('scripts')
@parent
<script src="{{ URL::asset('js/fe/cursodet.js') }}"></script>
@stop
