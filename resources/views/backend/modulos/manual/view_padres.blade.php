@extends('layouts.adminlte.app')

@section('content')
<div class="row">
    <div class="col-md-3">
      @include('backend.nav.nav_user')
      @include('backend.nav.nav_options')
      @include('backend.nav.nav_social')
    </div>
    <div class="col-md-9" style='padding-top:70px;'>

        <div class="card card-primary card-outline">
          <div class="card-header card-header-cuorse">
            <h2 class="card-title-course">
              Alexander restrepo
            </h2>
            <div class="card-tools">
              <div style="width:50px;display:inline">
                <img class="profile-user-img img-circle img-bordered-sm img-fluid" src="http://localhost/aulavirtual/public/img/avatar/5bfe03f8561bd2.49151940.png" style='cursor:pointer'>
              </div>
            </div>
          </div>
          <div class="card-body" style='padding:0px'>
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='' || menu_content=='foro-curso') ? 'active' : ''" v-on:click.prevent="setMenuContent('foro-curso')">Analisis diseño de algoritmos</a></li>
              <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='progreso-pr') ? 'active' : ''" v-on:click.prevent="setMenuContent('progreso-pr')">Ingles nivel 2</a></li>
              <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='progreso-pr') ? 'active' : ''" v-on:click.prevent="setMenuContent('progreso-pr')">Ingles nivel 3</a></li>
              <li class="nav-item"><a class="nav-link" href="#" v-bind:class="(menu_content=='progreso-pr') ? 'active' : ''" v-on:click.prevent="setMenuContent('progreso-pr')">Ingles nivel 4</a></li>

            </ul>
          </div>
        </div>

        <div class="card">
              <div class="card-header">
                <h3 class="card-title">Striped Full Width Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <tbody><tr>
                    <th style="width: 10px">#</th>
                    <th>Task</th>
                    <th>Progress</th>
                    <th style="width: 40px">Label</th>
                  </tr>
                  <tr>
                    <td>1.</td>
                    <td>Update software</td>
                    <td>
                      <div class="progress progress-xs">
                        <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                      </div>
                    </td>
                    <td><span class="badge bg-danger">55%</span></td>
                  </tr>
                  <tr>
                    <td>2.</td>
                    <td>Clean database</td>
                    <td>
                      <div class="progress progress-xs">
                        <div class="progress-bar bg-warning" style="width: 70%"></div>
                      </div>
                    </td>
                    <td><span class="badge bg-warning">70%</span></td>
                  </tr>
                  <tr>
                    <td>3.</td>
                    <td>Cron job running</td>
                    <td>
                      <div class="progress progress-xs progress-striped active">
                        <div class="progress-bar bg-primary" style="width: 30%"></div>
                      </div>
                    </td>
                    <td><span class="badge bg-primary">30%</span></td>
                  </tr>
                  <tr>
                    <td>4.</td>
                    <td>Fix and squish bugs</td>
                    <td>
                      <div class="progress progress-xs progress-striped active">
                        <div class="progress-bar bg-success" style="width: 90%"></div>
                      </div>
                    </td>
                    <td><span class="badge bg-success">90%</span></td>
                  </tr>
                </tbody></table>
              </div>
              <!-- /.card-body -->
            </div>

    </div>
</div>
@endsection
