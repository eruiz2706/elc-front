@extends('layouts.adminlte.app')

@section('content')
<div class="row">
    <div class="col-md-3">
      @include('backend.nav.nav_user')
      @include('backend.nav.nav_options')
      @include('backend.nav.nav_social')
    </div>

    <div class="col-md-9"  style='padding-top:70px;' >
      <div class="row">
          <div class="col-md-12">
            <perfil-usu></perfil-usu>
          </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <perfil-pagos></perfil-pagos>
        </div>
        <div class="col-md-12">
          <!-- USERS LIST -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Parientes</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool"><i style='font-size:22px' class="fa fa-plus-circle"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <ul class="users-list clearfix">
                <li>
                  <img src="dist/img/user1-128x128.jpg" alt="User Image">
                  <a class="users-list-name" href="#" style='white-space:normal;text-overflow:inherit'>Alexander Pierce</a>
                  <span class="users-list-date">Today</span>
                </li>
                <li>
                  <img src="dist/img/user8-128x128.jpg" alt="User Image">
                  <a class="users-list-name" href="#">Norman</a>
                  <span class="users-list-date">Yesterday</span>
                </li>
                <li>
                  <img src="dist/img/user7-128x128.jpg" alt="User Image">
                  <a class="users-list-name" href="#">Jane</a>
                  <span class="users-list-date">12 Jan</span>
                </li>
                <li>
                  <img src="dist/img/user6-128x128.jpg" alt="User Image">
                  <a class="users-list-name" href="#">John</a>
                  <span class="users-list-date">12 Jan</span>
                </li>
                <li>
                  <img src="dist/img/user2-160x160.jpg" alt="User Image">
                  <a class="users-list-name" href="#">Alexander</a>
                  <span class="users-list-date">13 Jan</span>
                </li>
                <li>
                  <img src="dist/img/user5-128x128.jpg" alt="User Image">
                  <a class="users-list-name" href="#">Sarah</a>
                  <span class="users-list-date">14 Jan</span>
                </li>
                <li>
                  <img src="dist/img/user4-128x128.jpg" alt="User Image">
                  <a class="users-list-name" href="#">Nora</a>
                  <span class="users-list-date">15 Jan</span>
                </li>
                <li>
                  <img src="dist/img/user3-128x128.jpg" alt="User Image">
                  <a class="users-list-name" href="#">Nadia</a>
                  <span class="users-list-date">15 Jan</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
