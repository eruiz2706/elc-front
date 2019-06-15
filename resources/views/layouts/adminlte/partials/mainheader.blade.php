<nav class="main-header navbar navbar-expand border-bottom bg-primary main-header-fixed">
    <ul class="navbar-nav">
      <li class="nav-item">
          <a href="{{ url('/principal') }}">
            <img id="logo-mainmenu" src="{{ URL::asset('img/app/logo2.png') }}" alt="AdminLTE Logo" class="brand-image ">
            <!--<span class="brand-text font-weight-light">{{ config('app.name') }}</span>-->
          </a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        @if(Auth::user()->slugrol=='es' || Auth::user()->slugrol=='pr')
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-comments-o" style='padding-top:7px;font-size:24px' v-on:click.prevent='listamessages()'></i>
          <span class="badge badge-warning navbar-badge" id='nav_messages'></span>
        </a>
        @endif
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="height:250px;overflow-y: auto;">
          <div class="row" v-if="preload_messages">
            <div class="d-block mx-auto" >
              <i class="fa fa-circle-o-notch fa-spin" style="font-size:40px"></i>
            </div>
          </div>
          <div v-for='messages in a_messages' v-if="!preload_messages">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img v-bind:src="base_url+'/'+messages.imagen" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    <span v-text="messages.nombre"></span>
                    <span class="float-right text-sm text-warning" v-if="messages.pendiente==1"><i class="fa fa-star"></i></span>
                  </h3>
                  <p class="text-sm" v-text='messages.descrip'></p>
                  <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i><span v-text="messages.fecha"></span></p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
          </div>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-bell-o" style='padding-top:7px;font-size:24px' v-on:click.prevent='listanotificaciones()'></i>
          <span class="badge badge-warning navbar-badge" id='nav_notifi'></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="height:250px;overflow-y: auto;">
          <div class="row" v-if="preload_notifi">
            <div class="d-block mx-auto" >
              <i class="fa fa-circle-o-notch fa-spin" style="font-size:40px"></i>
            </div>
          </div>
          <div v-for='notifi in a_notifi' v-if="!preload_notifi">
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item" >
              <div class="media">

                <div class="media-body">
                  <p class="text-sm" v-html='notifi.descripcion'>
                  </p>
                  <p class="text-sm text-muted">
                    <i class="fa fa-clock-o mr-1"></i>
                    <span v-text='notifi.fecha_creacion'></span>
                  </p>
                </div>
              </div>
            </a>
          </div>
        </div>
      </li>

      <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <div class="user-block" v-on:click.prevent='conexion();'>
              <img class="img-circle img-bordered-sm" src="{{ URL::asset(Auth::user()->imagen) }}" alt="User avatar">
              <i class="fa fa-chevron-down" style="padding-top:10px;padding-left:10px;" v-on:click.prevent='conexion();'></i>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

              <div class="card ">
                  <div class="card-body">
                    <h6 class="widget-user-desc" v-text='conexion_user.nombre'></h6>
                    <h6 class="widget-user-desc" v-text='conexion_user.ultimo_ingreso'></h6>
                    <h6 class="widget-user-desc" v-text='conexion_user.tiempo_uso'></h6>
                    <div class="row mt-3">
                      <div class="col-sm-6 border-right">
                          <button class="btn btn-block btn-outline-primary btn-sm" onclick="window.location.href='{{url('/perfil')}}'">
                            {{trans('backend.profile')}}
                          </button>
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-6 border-right">
                          <button class="btn btn-block btn-outline-primary btn-sm" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{trans('backend.sign_off')}}
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
