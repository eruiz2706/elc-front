  <nav class="main-header navbar navbar-expand border-bottom bg-primary main-header-fixed">
    <ul class="navbar-nav">
      <li class="nav-item">


            <img id="logo-mainmenu" src="{{ URL::asset('img/app/logo2.png') }}" alt="AdminLTE Logo" class="brand-image ">
            <!--<span class="brand-text font-weight-light">{{ config('app.name') }}</span>-->

        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-bell-o"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>

          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>

      <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <div class="user-block">
              <img class="img-circle img-bordered-sm" src="{{ URL::asset(Auth::user()->imagen) }}" alt="User avatar">
              <i class="fa fa-chevron-down" style="padding-left:15px;"></i>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

              <div class="card ">
                  <div class="card-body">
                    <h5 class="widget-user-desc">{{ Auth::user()->nombre}}</h5>
                    <h6 class="widget-user-desc">Ultimo ingreso : 2018-05-26</h6>
                    <h6 class="widget-user-desc">Tiempo de uso : 2 horas</h6>
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
