@extends('layouts.unicat.app')

@section('htmlheader')
@parent
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/styles/responsive.css') }}">
@stop

@section('content')
<!-- Home -->
<div class="home">
<div class="counter">
  <div class="counter_background" style="background-image:url({{ URL::asset('rfend/images/home_slider_2.png') }})"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="counter_content">
          <h2 class="counter_title"></h2>
          <div class="counter_text">
            
          </div>

          <!-- Milestones -->

          <div class="milestones d-flex flex-md-row flex-column align-items-center justify-content-between">
          </div>
        </div>

      </div>
    </div>

    <div class="counter_form" id="counter_form_login">
      <div class="row ">
        <div class="col ">
          <form class="counter_form_content d-flex flex-column align-items-center justify-content-center" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="counter_form_title">{{ trans('frontend.log_in') }}</div>

            <input type="email" class="counter_input"  id="email" name="email"  autocomplete="off" placeholder="{{ trans('frontend.email') }}" >
            @if ($errors->has('email'))
                <span class="text-danger">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif

            <input type="password" class="counter_input" id="password" name="password" autocomplete="off" placeholder="{{ trans('frontend.pass') }}" >
            @if ($errors->has('password'))
                <span class="text-danger">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif

            <p class='mb-1'>-------- OR --------</p>  
            <div class="social-auth-links text-center ">
              <div class='row'>
              <div class='col-md-6 col-sm-6'>
                <div class='form-group'>
                <a href="{{ url('/redirect/facebook') }}" class="btn  btn-primary">
                  <i class="fa fa-facebook mr-2"></i> Facebook
                </a>
                </div>
              </div>
              <div class='col-md-6 col-sm-6'>
                <div class='form-group'>
                <a href="{{ url('/redirect/google') }}" class="btn  btn-danger">
                  <i class="fa fa-google mr-2"></i> Google
                </a>
                </div>
              </div>
              </div>
            </div>

            <button type="submit" class="counter_form_button mb-1">
              {{ trans('frontend.enter') }}
            </button>

            <hr style='border:.4px solid grey;width:70%'> 
            <button  sytle='cursor:pointer' class="btn btn-success mb-2" v-on:click.prevent='openregister();'>
              {{ trans('frontend.sign_up') }}
            </button>
            <a href="#" class="text-left float-left " v-on:click.prevent='openrecover()'>{{ trans('frontend.forget_pass') }}</a>
          </form>
        </div>
      </div>
    </div>

    <div class="counter_form" id="counter_form_register">
      <div class="row ">
        <div class="col ">
          <form class="counter_form_content d-flex flex-column align-items-center justify-content-center" method="post" v-on:submit.prevent="crear()">
            <div class="counter_form_title">
              {{ trans('frontend.create_account') }}
            </div>
            
            <input type="text" class="counter_input" name='nombre' placeholder="{{ trans('frontend.page_register.form_name') }}" autocomplete="off"  v-model="o_user.nombre">
            <label v-if="errores.nombre" class="text-danger">@{{ errores.nombre[0] }}</label>

            <input type="text" class="counter_input" name='email' placeholder="{{ trans('frontend.page_register.form_email') }}" autocomplete="off"  v-model="o_user.email">
            <label v-if="errores.email" class="text-danger">@{{ errores.email[0] }}</label>
            <select name="counter_select" id="counter_select" class="counter_input counter_options"  v-model="o_user.rol">
              <option value=''>{{ trans('frontend.page_register.tittle_type') }}</option>
              <option value='es'>{{ trans('frontend.page_register.type_es') }}</option>
              <option value='pr'>{{ trans('frontend.page_register.type_pr') }}</option>
              <option value='pa'>{{ trans('frontend.page_register.type_pa') }}</option>
            </select>
            <label v-if="errores.rol" class="text-danger">@{{ errores.rol[0] }}</label>

            <p>---------- OR ----------</p>
            <div class="social-auth-links text-center mt-2">
              <div class='row'>
              <div class='col-md-6'>
                <div class="form-group">
                  <a href="#" class="btn  btn-primary" v-on:click.prevent="crearRedes('facebook')">
                    <i class="fa fa-facebook mr-2"></i> Facebook
                  </a>
                </div>
              </div>
              <div class='col-md-6'>
                <div class="form-group">
                  <a href="#" class="btn  btn-danger" v-on:click.prevent="crearRedes('google')">
                    <i class="fa fa-google mr-2"></i> Google
                  </a>
                </div>
              </div>
              </div>
            </div>

            <button type="submit" class="counter_form_button"  :disabled="loader_crear">
              {{ trans('frontend.sign_up') }}
              <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader" v-if="loader_crear"></i>
            </button>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>
</div>
<!-- Features -->

<div class="features">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="section_title_container text-center">
          <h2 class="section_title">{{ trans('frontend.page_home.welcome') }}</h2>
          <div class="section_subtitle">
            <p>{{ trans('frontend.page_home.welcome_descrip') }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="row features_row">
      <!-- Features Item -->
      <div class="col-lg-3 feature_col">
        <div class="feature text-center trans_400">
          <div class="feature_icon"><img src="{{ URL::asset('rfend/images/icon_1.png') }}" alt=""></div>
          <h3 class="feature_title">{{ trans('frontend.page_home.feature1') }}</h3>
          <div class="feature_text"><p>{{ trans('frontend.page_home.feature1_descrip') }}</p></div>
        </div>
      </div>

      <!-- Features Item -->
      <div class="col-lg-3 feature_col">
        <div class="feature text-center trans_400">
          <div class="feature_icon"><img src="{{ URL::asset('rfend/images/icon_2.png') }}" alt=""></div>
          <h3 class="feature_title">{{ trans('frontend.page_home.feature2') }}</h3>
          <div class="feature_text"><p>{{ trans('frontend.page_home.feature2_descrip') }}</p></div>
        </div>
      </div>

      <!-- Features Item -->
      <div class="col-lg-3 feature_col">
        <div class="feature text-center trans_400">
          <div class="feature_icon"><img src="{{ URL::asset('rfend/images/icon_3.png') }}" alt=""></div>
          <h3 class="feature_title">{{ trans('frontend.page_home.feature3') }}</h3>
          <div class="feature_text"><p>{{ trans('frontend.page_home.feature3_descrip') }}</p></div>
        </div>
      </div>

      <!-- Features Item -->
      <div class="col-lg-3 feature_col ">
        <div class="feature text-center trans_400">
          <div class="feature_icon"><img src="{{ URL::asset('rfend/images/icon_4.png') }}" alt=""></div>
          <h3 class="feature_title ">{{ trans('frontend.page_home.feature4') }}</h3>
          <div class="feature_text"><p>{{ trans('frontend.page_home.feature4_descrip') }}</p></div>
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
          <h2 class="section_title">{{ trans('frontend.page_home.course') }}</h2>
          <div class="section_subtitle"><p>{{ trans('frontend.page_home.course_descrip') }}</p></div>
        </div>
      </div>
    </div>


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
            <!--<div class="course_price ml-auto">{{$curso->nomestado}}</div>-->
          </div>
          <div class="course_footer">
            <div class="course_footer_content d-flex flex-row align-items-center justify-content-start">
              <div class="course_info">
                <i class="fa fa-bank" aria-hidden="true"></i>
                <span>{{ trans('frontend.page_courses.'.$curso->slug) }}</span>
              </div>
              <div class="course_price ml-auto">
                @if($curso->valor>0)
                  ${{$curso->valor}}
                @else
                {{ trans('frontend.page_courses.free') }}
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="row">
      <div class="col">
        <div class="courses_button trans_200"><a href="{{url('/cursosd')}}">{{ trans('frontend.page_home.button_course') }}</a></div>
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

