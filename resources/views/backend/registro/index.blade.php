@extends('layouts.app')

@section('content')
<div class="login-box" id="vue">
    <div class="login-logo">
        <a href="{{url('/')}}"><b>{{ config('app.name') }}</b></a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
        <!--<p class="login-box-msg">Registrate</p>-->
        <h4>{{$titulo}}</h4>
        <hr>
        <form method="post" v-on:submit.prevent="crear()">
            @csrf
            <div class="input-group mb-3">
              <input id="nombre" name="nombre" type="nombre" class="form-control" placeholder="Nombre completo" value=""   v-model="o_user.nombre">
              <div class="input-group-append">
                  <span class="fa fa-tags input-group-text"></span>
              </div>
            </div>
            <label v-if="errores.email">@{{ errores.nombre[0] }}</label>

            <div class="input-group mb-3">
              <input id="email" name="email" type="email" class="form-control" placeholder="Correo electronico" value=""   v-model="o_user.email">
              <div class="input-group-append">
                  <span class="fa fa-envelope input-group-text"></span>
              </div>
            </div>
            <label v-if="errores.email">@{{ errores.email[0] }}</label>

            <div class="input-group mb-3">
              <input id="password" name="password" type="password" class="form-control" placeholder="Contraseña"  v-model="o_user.password">
              <div class="input-group-append">
                <span class="fa fa-lock input-group-text"></span>
              </div>
            </div>
            <label v-if="errores.password">@{{ errores.password[0] }}</label>

            <div class="input-group mb-3">
              <input id="repassword" name="repassword" type="password" class="form-control" placeholder="Confirmar contraseña"  v-model="o_user.repassword">
              <div class="input-group-append">
                  <span class="fa fa-lock input-group-text"></span>
              </div>
            </div>
            <label v-if="errores.repassword">@{{ errores.repassword[0] }}</label>

            <div class="row">
              <div class="col-12">
                  <button type="submit" class="btn btn-primary btn-block btn-flat" :disabled="loader_crear">
                    Registrate
                    <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_crear"></i>
                  </button>
              </div>
            </div>
            <input id="rol" name="rol" type="hidden" class="form-control" value="{{$rol}}">
        </form>
        <p class="mb-1">
            <a href="{{ url('login') }}">Ya tienes una cuenta ?</a>
        </p>
        </div>
    </div>
</div>
@endsection

@section('scripts')
  @parent
  <script src="{{ URL::asset('js/be/registro.js') }}"></script>
@stop
