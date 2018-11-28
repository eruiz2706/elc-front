  <nav class="main-header navbar navbar-expand border-bottom bg-primary main-header-fixed">
    <ul class="navbar-nav">
      <li class="nav-item">


            <img id="logo-mainmenu" src="{{ URL::asset('img/app/logo2.png') }}" alt="AdminLTE Logo" class="brand-image ">
            <!--<span class="brand-text font-weight-light">{{ config('app.name') }}</span>-->

        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown" id="vue-notifi">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-bell-o" style='padding-top:7px;font-size:24px'></i>
          <span class="badge badge-warning navbar-badge" id='nav_notifi'></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="height:450px;overflow-y: auto;">
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">

              <div class="media-body">
                <p class="text-sm">
                  Nueva tarea curso:<strong> Analisis y diseño de algoritmos.</strong> fecha de entrega: <strong>2018-10-25</strong>
                </p>
                <p class="text-sm text-muted">
                  <i class="fa fa-clock-o mr-1"></i>
                  2018-10-25
                </p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">

              <div class="media-body">
                <p class="text-sm">
                  Nueva tarea
                  <strong>curso:</strong> Analisis y diseño de algoritmos. <strong>fecha de entrega:</strong> 2018-10-25
                </p>
                <p class="text-sm text-muted">
                  <i class="fa fa-clock-o mr-1"></i>
                  2018-10-25
                </p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">

              <div class="media-body">
                <p class="text-sm">
                  Nueva tarea
                  <strong>curso:</strong> Analisis y diseño de algoritmos. <strong>fecha de entrega:</strong> 2018-10-25
                </p>
                <p class="text-sm text-muted">
                  <i class="fa fa-clock-o mr-1"></i>
                  2018-10-25
                </p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <div class="media">
              <div class="media-body">
                <p class="text-sm float-center">
                    <strong>Ver todas</strong>
                </p>
              </div>
            </div>
          </a>
        </div>
      </li>

      <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <div class="user-block">
              <img class="img-circle img-bordered-sm" src="{{ URL::asset(Auth::user()->imagen) }}" alt="User avatar">
              <i class="fa fa-chevron-down" style="padding-top:10px;padding-left:10px;"></i>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

              <div class="card ">
                  <div class="card-body">
                    <h5 class="widget-user-desc">{{ Auth::user()->nombre}}</h5>
                    <h7 class="widget-user-desc">Ultimo ingreso: {{ Auth::user()->fecha_ultimo_ingreso}}</h7>
                    <h6 class="widget-user-desc">Tiempo de uso: {{Session::get('user_tiempo')}} minutos</h6>
                    <div class="row">
                      <div class="col-sm-6 border-right">
                          <button class="btn btn-block btn-outline-primary btn-sm" onclick="window.location.href='{{url('/perfil')}}'">
                            Perfil
                          </button>
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-6 border-right">
                          <button class="btn btn-block btn-outline-primary btn-sm" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Cerrar Sesion
                          </button>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                          </form>
                      </div>

                    </div>
                  </div>


                </div>
          </div>
        </li>
    </ul>

  </nav>
  <!-- /.navbar -->
