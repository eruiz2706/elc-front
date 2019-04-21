<div class="modal fade" id="modal_recover" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="counter_form_title" style='margin:0px;margin-top:3px'>{{ trans('frontend.recover_pass') }}</div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row fill_height">
            <div class="col fill_height">
              <form class="counter_form_content d-flex flex-column align-items-center justify-content-center" method="post" v-on:submit.prevent="recover()">
                <input type="text" class="counter_input" name='recov_email' placeholder="{{ trans('frontend.page_register.form_email') }}" autocomplete="off" v-model="o_recover.email">
                <label v-if="errores_recover.email" class="text-danger">@{{ errores_recover.email[0] }}</label>

                <button type="submit" class="counter_form_button"  :disabled="loader_recover">
                  {{ trans('frontend.send') }}
                  <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader" v-if="loader_recover"></i>
                </button>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

@yield('mainheader')

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ trans('frontend.select_lang') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="shopping_cart">
          <a href="{{ url('lang', ['es']) }}">{{ trans('frontend.lang.es') }}</a> <i class="fa fa-flag" aria-hidden="true"></i>
        </div>
        <div class="shopping_cart">
          <a href="{{ url('lang', ['en']) }}">{{ trans('frontend.lang.en') }}</a> <i class="fa fa-flag" aria-hidden="true"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<header class="header">
  <!-- Top Bar -->
  <div class="top_bar">
    <div class="top_bar_container">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
              <ul class="top_bar_contact_list">
                <li>
                  <i class="fa fa-envelope-o" aria-hidden="true"></i>
                  <div>{{ trans('frontend.elcolp_email') }}</div>
                </li>
                <li>
                  <i class="fa fa-phone" aria-hidden="true"></i>
                  <div>{{ trans('frontend.elcolp_phone') }}</div>
                </li>
              </ul>
              <div class="top_bar_login ml-auto">
                <form id="form_login_head" class="d-flex flex-row justify-content-left " method="POST" action="{{ route('login') }}">
                @csrf

                <div class='container_input_login'>
                <input type="email" class="counter_input_login {{ $errors->has('email') ? 'error_input' : ''  }}"  id="email" name="email"  autocomplete="off" placeholder="{{ trans('frontend.email') }}" >
                @if ($errors->has('email'))<br>
                <span class="text-validate">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
                </div>
              
                <div class='container_input_login'>
                <input type="password" class="counter_input_login {{ $errors->has('password') ? 'error_input' : ''  }}" id="password" name="password" autocomplete="off" placeholder="{{ trans('frontend.pass') }}" >
                <br><a href="#" class="text-left float-left" style='margin-left:5px;width:170px' v-on:click.prevent='openrecover()'>{{ trans('frontend.forget_pass') }}</a>
                </div>

            <button type="submit" class="counter_form_button_login">
              {{ trans('frontend.enter') }}
            </button>

            <hr class='hr-vertical'>
            <a href="{{ url('/redirect/facebook') }}" class="btn  btn-primary social_login_facebook">
              <i class="fa fa-facebook mr-2"></i>
            </a>
            
            <a href="{{ url('/redirect/google') }}" class="btn  btn-danger social_login_google">
              <i class="fa fa-google mr-2"></i>
            </a>
            
            </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Header Content -->
  <div class="header_container">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="header_content d-flex flex-row align-items-center justify-content-start">
            <div class="logo_container">
              <a href="{{url('/')}}">
              <!--<div class="logo_text">Aula Virtu<span>al</span></div>-->
                <img id="logo-mainmenu" src="{{ URL::asset('img/app/logo.png') }}" style="width:150px">
              </a>
            </div>
            <nav class="main_nav_contaner ml-auto">
              <ul class="main_nav">
                <li class="@if(isset($link_inic)) active @endif"><a href="{{url('/')}}">{{ trans('frontend.nav.home') }}</a></li>
                <li class="@if(isset($link_curs)) active @endif"><a href="{{url('/cursosd')}}">{{ trans('frontend.nav.courses') }}</a></li>
                <li class="@if(isset($link_acerca)) active @endif"><a href="{{url('/acercade')}}">{{ trans('frontend.nav.about') }}</a></li>
                <li class="@if(isset($link_contac)) active @endif"><a href="{{url('/contacto')}}">{{ trans('frontend.nav.contact') }}</a></li>
                <li class=""><a href="#" data-toggle="modal" data-target="#exampleModal">{{ trans('frontend.nav.lang') }}</a></li>
              </ul>
              <div class="hamburger menu_mm">
                <i class="fa fa-bars menu_mm" aria-hidden="true"></i>
              </div>
            </nav>

          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- Menu -->

<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
  <div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
  <nav class="menu_nav">
    <ul class="menu_mm">
      <li class="menu_mm"><a href="{{url('/')}}">{{ trans('frontend.nav.home') }}</a></li>
      <li class="menu_mm"><a href="{{url('/cursosd')}}">{{ trans('frontend.nav.courses') }}</a></li>
      <li class="menu_mm"><a href="{{url('/acercade')}}">{{ trans('frontend.nav.about') }}</a></li>
      <li class="menu_mm"><a href="{{url('/contacto')}}">{{ trans('frontend.nav.contact') }}</a></li>
      <li><a href="#" data-toggle="modal" data-target="#exampleModal">{{ trans('frontend.nav.lang') }}</a></li>
      <!--<li class="menu_mm"><a href="{{url('/login')}}">{{ trans('frontend.nav.login') }}</a></li>-->
    </ul>
  </nav>
</div>
