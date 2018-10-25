@extends('layouts.adminlte.app')

@section('content')
<div class="col-md-12" style='padding-top:70px;'>
  <div class="error-page">
      <!--<h2 class="headline text-info">404</h2>-->
      <div class="error-content">
          <h3>
            <i class="fa fa-warning text-yellow"></i>
            Ups!
          </h3>
          <p>
            La página que estás buscando no existe <a href="{{url('principal')}}">volver a la pagina principal</a>
          </p>
      </div>
  </div>
</div>
@endsection
