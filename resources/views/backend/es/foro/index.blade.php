{{--@extends('layouts.app')--}}

@extends('layouts.adminlte.app')

@section('banner')
<div class="img-bannerhome" style="background-image: url('{{ URL::asset('img/app/slide.jpg') }}');">
</div>
@endsection

@section('content')

<div class="container">

  <div class="row">
    <div class="col-md-3">
      @include('backend.nav.index')

      @include('backend.es.navcursos')
    </div>

    <div class="col-md-9" style='padding-top:70px;'>
      <div class="row">
            @include('backend.es.navtabgrupo')

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
</div>
@endsection

@section('scripts')
@parent

@stop
