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
                <li><div class="question">{{ trans('frontend.question') }}</div></li>
                <li>
                  <i class="fa fa-phone" aria-hidden="true"></i>
                  <div>001-1234-88888</div>
                </li>
                <li>
                  <i class="fa fa-envelope-o" aria-hidden="true"></i>
                  <div>aulavirtual@gmail.com</div>
                </li>
              </ul>
              <div class="top_bar_login ml-auto">
                <div class="login_button">
                  <a href="{{url('/login')}}">{{ trans('frontend.nav.login') }}</a>
                </div>
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
              <a href="#">
              <!--<div class="logo_text">Aula Virtu<span>al</span></div>-->
                <img id="logo-mainmenu" src="{{ URL::asset('img/app/logo.png') }}" style="width:150px">
              </a>
            </div>
            <nav class="main_nav_contaner ml-auto">
              <ul class="main_nav">
                <li class="active"><a href="{{url('/')}}">{{ trans('frontend.nav.home') }}</a></li>
                <li><a href="{{url('/cursosd')}}">{{ trans('frontend.nav.courses') }}</a></li>
                <li><a href="{{url('/acercade')}}">{{ trans('frontend.nav.about') }}</a></li>
                <li><a href="{{url('/contacto')}}">{{ trans('frontend.nav.contact') }}</a></li>
                <li><a href="#" data-toggle="modal" data-target="#exampleModal">{{ trans('frontend.nav.lang') }}</a></li>
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
      <li class="menu_mm"><a href="{{url('/login')}}">{{ trans('frontend.nav.login') }}</a></li>
    </ul>
  </nav>
</div>
