@extends('layouts.app')

@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html"><b>{{ config('app.name') }}</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
        <p class="login-box-msg">Iniciar Sesion</p>

        <div class="social-auth-links text-center">
          <div class='row'>
          <div class='col-md-6'>
          <a href="#" class="btn btn-block btn-primary">
            <i class="fa fa-facebook mr-2"></i>
            Facebook
          </a>
        </div>
          <div class='col-md-6'>
          <a href="#" class="btn btn-block btn-danger">
            <i class="fa fa-google mr-2"></i>
            Google
          </a>
        </div></div>
      </div>

      <hr>
        <form method="POST" action="{{ route('login') }}">
            @csrf
              <div class="input-group mb-3">
              <input id="email" name="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="email" value="{{ old('email') }}"  required autofocus>
              <div class="input-group-append">
                  <span class="fa fa-envelope input-group-text"></span>
              </div>
              @if ($errors->has('email'))
                  <span class="invalid-feedback">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif
            </div>

            <div class="input-group mb-3">
            <input id="password" name="password" type="password{{ $errors->has('password') ? ' is-invalid' : '' }}" class="form-control" placeholder="password" required>
            <div class="input-group-append">
                <span class="fa fa-lock input-group-text"></span>
            </div>
            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
          </div>
            <div class="row">
            <div class="col-8">
                <!--<div class="checkbox icheck">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{__('login.remember')}}
                </label>
              </div>-->
            </div>

            <!-- /.col -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Acceder</button>
            </div>
            <!-- /.col -->
            </div>
        </form>

        <!--<div class="social-auth-links text-center mb-3">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-primary">
            <i class="fa fa-facebook mr-2"></i>Iniciar Sesiòn con Facebook
            </a>
            <a href="#" class="btn btn-block btn-danger">
            <i class="fa fa-google-plus mr-2"></i>Iniciar Sesiòn con Google++
            </a>
        </div>-->
        <!-- /.social-auth-links -->

        <p class="mb-1">
            <a href="{{ route('password.request') }}">Olvidaste tu contraseña?</a>
        </p>
        <p class="mb-0">
            <a href="{{ url('registerusu') }}" class="text-center">Registrate</a>
        </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

@endsection
