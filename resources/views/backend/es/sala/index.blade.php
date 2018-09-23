{{--@extends('layouts.app')--}}

@extends('layouts.adminlte.app')

@section('banner')
<div class="img-bannerhome" style="background-image: url('{{ URL::asset('rsc/dist/img/banner.jpg') }}');">
  <!--<div class="inner-bannerhome">
      <h1>IMAGE SAMPLE</h1>
      <h2>The Quick Brown Fox jumps Over the lazy dog</h2>
      <a class="btn" href="#">CLICK HERE</a>
  </div>-->
</div>
@endsection

@section('content')

<div class="container">

  <div class="row">
    <div class="col-md-3">
      @include('backend.es.nav')

      @include('backend.es.navcursos')
    </div>

    <div class="col-md-9" style='padding-top:70px;'>
      <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Curso Programacion interactiva</h3>

                <div class="card-tools">
                  <div class="user-block" style="width:80px;">
                   <img class="img-circle img-bordered-sm" src="{{ URL::asset('rsc/dist/img/user1-128x128.jpg') }}" alt="user image">
                  </div>
                </div>
              </div>

              <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#discussion" data-toggle="tab">Foro</a></li>
                    <li class="nav-item"><a class="nav-link" href="#progress" data-toggle="tab">Progreso</a></li>
                    <li class="nav-item"><a class="nav-link" href="#calendar" data-toggle="tab">Calendario</a></li>
                    <li class="nav-item"><a class="nav-link" href="#homework" data-toggle="tab">Evaluaciones</a></li>
                    <li class="nav-item"><a class="nav-link" href="#results" data-toggle="tab">Resultados</a></li>
                    <li class="nav-item"><a class="nav-link" href="#test" data-toggle="tab">Tutor</a></li>
                  </ul>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="card card-widget">
              <div class="card-header">
                <div class="user-block">
                  <img class="img-circle" src="{{ URL::asset('rsc/dist/img/user1-128x128.jpg') }}" alt="User Image">
                  <span class="username"><a href="#">Jonathan Burke Jr.</a></span>
                  <span class="description">Shared publicly - 7:30 PM Today</span>
                </div>
                <!-- /.user-block -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- post text -->
                <p>Far far away, behind the word mountains, far from the
                  countries Vokalia and Consonantia, there live the blind
                  texts. Separated they live in Bookmarksgrove right at</p>

                <p>the coast of the Semantics, a large language ocean.
                  A small river named Duden flows by their place and supplies
                  it with the necessary regelialia. It is a paradisematic
                  country, in which roasted parts of sentences fly into
                  your mouth.</p>

                  <span class="float-right text-muted">2 comentarios</span>
              </div>
              <!-- /.card-body -->
              <div class="card-footer card-comments">
                <div class="card-comment">
                  <!-- User image -->
                  <img class="img-circle img-sm" src="{{ URL::asset('rsc/dist/img/user3-128x128.jpg') }}" alt="User Image">

                  <div class="comment-text">
                    <span class="username">
                      Maria Gonzales
                      <span class="text-muted float-right">8:03 PM Today</span>
                    </span><!-- /.username -->
                    It is a long established fact that a reader will be distracted
                    by the readable content of a page when looking at its layout.
                  </div>
                  <!-- /.comment-text -->
                </div>
                <!-- /.card-comment -->
                <div class="card-comment">
                  <!-- User image -->
                  <img class="img-circle img-sm" src="{{ URL::asset('rsc/dist/img/user5-128x128.jpg') }}" alt="User Image">

                  <div class="comment-text">
                    <span class="username">
                      Nora Havisham
                      <span class="text-muted float-right">8:03 PM Today</span>
                    </span><!-- /.username -->
                    The point of using Lorem Ipsum is that it has a more-or-less
                    normal distribution of letters, as opposed to using
                    'Content here, content here', making it look like readable English.
                  </div>
                  <!-- /.comment-text -->
                </div>
                <!-- /.card-comment -->
              </div>
              <!-- /.card-footer -->
              <div class="card-footer">
                <form action="#" method="post">
                  <div class="img-push">
                    <input type="text" class="form-control form-control-sm" placeholder="Escribe una respuesta">
                  </div>
                </form>
              </div>
              <!-- /.card-footer -->
            </div>
          </div>

          <div class="col-md-12">
            <div class="card card-widget">
              <div class="card-header">
                <div class="user-block">
                  <img class="img-circle" src="{{ URL::asset('rsc/dist/img/user1-128x128.jpg') }}" alt="User Image">
                  <span class="username"><a href="#">Jonathan Burke Jr.</a></span>
                  <span class="description">Shared publicly - 7:30 PM Today</span>
                </div>
                <!-- /.user-block -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- post text -->
                <p>Far far away, behind the word mountains, far from the
                  countries Vokalia and Consonantia, there live the blind
                  texts. Separated they live in Bookmarksgrove right at</p>

                <p>the coast of the Semantics, a large language ocean.
                  A small river named Duden flows by their place and supplies
                  it with the necessary regelialia. It is a paradisematic
                  country, in which roasted parts of sentences fly into
                  your mouth.</p>

                  <span class="float-right text-muted">2 comentarios</span>
              </div>
              <!-- /.card-body -->
              <div class="card-footer card-comments">
                <div class="card-comment">
                  <!-- User image -->
                  <img class="img-circle img-sm" src="{{ URL::asset('rsc/dist/img/user3-128x128.jpg') }}" alt="User Image">

                  <div class="comment-text">
                    <span class="username">
                      Maria Gonzales
                      <span class="text-muted float-right">8:03 PM Today</span>
                    </span><!-- /.username -->
                    It is a long established fact that a reader will be distracted
                    by the readable content of a page when looking at its layout.
                  </div>
                  <!-- /.comment-text -->
                </div>
                <!-- /.card-comment -->
                <div class="card-comment">
                  <!-- User image -->
                  <img class="img-circle img-sm" src="{{ URL::asset('rsc/dist/img/user5-128x128.jpg') }}" alt="User Image">

                  <div class="comment-text">
                    <span class="username">
                      Nora Havisham
                      <span class="text-muted float-right">8:03 PM Today</span>
                    </span><!-- /.username -->
                    The point of using Lorem Ipsum is that it has a more-or-less
                    normal distribution of letters, as opposed to using
                    'Content here, content here', making it look like readable English.
                  </div>
                  <!-- /.comment-text -->
                </div>
                <!-- /.card-comment -->
              </div>
              <!-- /.card-footer -->
              <div class="card-footer">
                <form action="#" method="post">
                  <div class="img-push">
                    <input type="text" class="form-control form-control-sm" placeholder="Escribe una respuesta">
                  </div>
                </form>
              </div>
              <!-- /.card-footer -->
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
@parent

@stop
