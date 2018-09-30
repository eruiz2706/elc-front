<header class="header">

  <!-- Top Bar -->
  <div class="top_bar">
    <div class="top_bar_container">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
              <ul class="top_bar_contact_list">
                <li><div class="question">Tienes alguna pregunta?</div></li>
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
                  <a href="{{url('/login')}}">Acceder o Registrarse</a>
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
                <li class="active"><a href="{{url('/')}}">Inicio</a></li>
                <li><a href="{{url('/cursos')}}">Cursos</a></li>
                <li><a href="{{url('/acercade')}}">Sobre nosotros</a></li>
                <li><a href="{{url('/contacto')}}">Contacto</a></li>
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
      <li class="menu_mm"><a href="{{url('/')}}">Inicio</a></li>
      <li class="menu_mm"><a href="{{url('/cursos')}}">Cursos</a></li>
      <li class="menu_mm"><a href="{{url('/acercade')}}">Sobre nosotros</a></li>
      <li class="menu_mm"><a href="{{url('/contacto')}}">Contacto</a></li>
      <li class="menu_mm"><a href="{{url('/login')}}">Acceder o Registrarse</a></li>
    </ul>
  </nav>
</div>
