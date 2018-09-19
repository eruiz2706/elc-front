<?php

/*
color navbar
navbar-dark bg-primary =>azul
navbar-dark bg-info => verde azulado
navbar-dark bg-success => verde
navbar-dark bg-danger => rojo
navbar-light bg-warning => amarillo
navbar-light bg-white => blanco
navbar-light bg-gray-light => gris

color brank
bg-primary => azul
bg-info => verde azulado
bg-success => verde
bg-danger => rojo
bg-white => blanco
bg-gray-light => gris
*/

$colornavbar        ="navbar-light bg-primary";
$colorbranknavbar   ="bg-primary";
?>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand border-bottom {{$colornavbar}} main-header-fixed">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
          <a id="brandnavbar" href="index3.html" class="brand-link {{$colorbranknavbar}}">

            <img id="logo-mainmenu" src="{{ URL::asset('rsc/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                  style="opacity: .8">
            <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
          </a>
        </li>
        <!--<li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>-->
    </ul>

    <!-- SEARCH FORM -->
    <!--<form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>-->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-comments-o"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fa fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fa fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>

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
            {{ Auth::user()->name }}<i class="fa fa-chevron-down" style="padding-left:15px;"></i>

          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

              <div class="card card-widget widget-user">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header bg-info-active">
                    <h3 class="widget-user-username">{{ Auth::user()->name }}</h3>
                    <!--<h6 class="widget-user-desc">Desarrollador Web</h6>-->
                  </div>
                  <div class="widget-user-image">
                  <img class="img-circle elevation-2" src="{{URL::asset('img/avatar/'.Auth::user()->id.'.jpg')}}" onerror="this.src='{{URL::asset('img/app/user.png')}}'" alt="User Avatar">
                  </div>
                  <div class="card-footer">
                    <div class="row">
                      <div class="col-sm-6 border-right">
                          <button class="btn btn-block btn-outline-primary">
                            Perfil
                          </button>
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-6 border-right">
                          <button class="btn btn-block btn-outline-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Cerrar Sesion
                          </button>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                          </form>
                      </div>

                    </div>
                    <!-- /.row -->
                  </div>
                </div>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <div class="user-block">
             <img class="img-circle img-bordered-sm" src="{{ URL::asset('rsc/dist/img/user1-128x128.jpg') }}" alt="user image">
            </div>
          </a>
        </li>

    </ul>

  </nav>
  <!-- /.navbar -->
