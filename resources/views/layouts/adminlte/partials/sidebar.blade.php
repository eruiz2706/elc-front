 
 
 
 <!-- Main Sidebar Container -->
 {{--dd($menus)--}}
 {{--die()--}}

 <aside class="main-sidebar elevation-4 sidebar-light-info">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link bg-info">
      <img src="{{ URL::asset('rsc/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
      <span class="brand-text font-weight-light">Seguimiento V1.0</span>
    </a>
  

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img class="img-circle elevation-2" src="{{URL::asset('img/avatar/'.Auth::user()->id.'.jpg')}}" onerror="this.src='{{URL::asset('img/app/user.png')}}'" alt="User Avatar">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-header">{{ __('menuback.title')}}</li>
          
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            @foreach ($menus as $key => $item)
              
               @if ($item['parent'] != 0)
                   @break
               @endif

               @if ($item['submenu'] == [])
                <?$active1=Request::path() == str_replace('/','',$item['url']) ? 'active' : '';?>

                <li class="nav-item">
                  <a href="{{$item['url']}}" class="nav-link {{$active1}}">
                    <i class="nav-icon {{$item['icono']}}"></i>
                    <p>
                        {{ __($item['name']) }}
                    </p>
                  </a>
                </li>
              @else
                <li class="nav-item has-treeview">
                  <?$active2='';?>
                  @foreach ($item['submenu'] as $submenu)
                    <? if(Request::path() == str_replace('/','',$submenu['url'])){$active2='active';}?>
                  @endforeach

                  <a href="{{$item['url']}}" class="nav-link {{$active2}}">
                    <i class="nav-icon {{$item['icono']}}"></i>
                    <p>
                      {{__($item['name'])}}
                      <i class="fa fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    @foreach ($item['submenu'] as $submenu)
                        @if ($submenu['submenu'] == [])
                          <?$active3=Request::path() == str_replace('/','',$submenu['url']) ? 'active' : '';?>
                          <li class="nav-item">
                            <a href="{{$submenu['url']}}" class="nav-link {{$active3}}">
                              <i class="nav-icon {{$submenu['icono']}}"></i>
                              <p>{{ __($submenu['name']) }}</p>
                            </a>
                          </li>
                        @else
                            {{--por si voy a agregar otro menu anidado--}}
                        @endif
                    @endforeach
                  </ul>
                </li>
                @endif
           @endforeach

          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form2').submit();">
              <i class="nav-icon fa fa-sign-in"></i>
              <p>{{ __('menuback.logout') }}</p>
            </a>

            <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>