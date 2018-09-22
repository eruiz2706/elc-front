@extends('layouts.app')

@section('content')
<div class="login-box" id="vue">
    <div class="login-logo">
        <a href="../../index2.html"><b>{{ config('app.name') }}</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
        <!--<p class="login-box-msg">Registrate</p>-->
        <h4>Registrate</h4>

      <hr>
        <form method="post" v-on:submit.prevent="create">
            @csrf

              <div class="form-check-inline">
                <label class="form-check-label" for="radio1">
                  <input type="radio" class="form-check-input" id="radio1" name="optradio" value="estudiante" v-model="row.rol">Estudiante
                </label>
              </div>
              <div class="form-check-inline">
                <label class="form-check-label" for="radio2">
                  <input type="radio" class="form-check-input" id="radio2" name="optradio" value="profesor" v-model="row.rol">Profesor
                </label>
              </div>
              <div class="form-check-inline">
                <label class="form-check-label" for="radio3">
                  <input type="radio" class="form-check-input" id="radio3" name="optradio" value="instituto" v-model="row.rol">Institucion
                </label>
              </div>
              <div class="form-check-inline">
                <label class="form-check-label" for="radio4">
                  <input type="radio" class="form-check-input" id="radio4" name="optradio" value="pariente" v-model="row.rol">Padre de familia
                </label>
              </div>
              <p></p>

            <div class="input-group mb-3">
              <input id="email" name="email" type="email" class="form-control" placeholder="Correo electronico" value=""   v-model="row.email">
              <div class="input-group-append">
                  <span class="fa fa-envelope input-group-text"></span>
              </div>
            </div>
            <label v-if="errors.email">@{{ errors.email[0] }}</label>

            <div class="input-group mb-3">
              <input id="password" name="password" type="password" class="form-control" placeholder="Contraseña"  v-model="row.password">
              <div class="input-group-append">
                <span class="fa fa-lock input-group-text"></span>
              </div>
            </div>
            <label v-if="errors.password">@{{ errors.password[0] }}</label>

            <div class="input-group mb-3">
              <input id="repassword" name="repassword" type="password" class="form-control" placeholder="Confirmar contraseña"  v-model="row.repassword">
              <div class="input-group-append">
                  <span class="fa fa-lock input-group-text"></span>
              </div>
            </div>
            <label v-if="errors.repassword">@{{ errors.repassword[0] }}</label>

            <div class="row">
            <!-- /.col -->
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block btn-flat" :disabled="loader_create">
                  Registrate
                  <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_create"></i>
                </button>
            </div>
            <!-- /.col -->
            </div>
        </form>
        <p class="mb-1">
            <a href="{{ url('login') }}">Ya tienes una cuenta click aqui</a>
        </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->
@endsection

@section('scripts')
  @parent
  <script src="{{ URL::asset('js/be/registro.js') }}"></script>
@stop
