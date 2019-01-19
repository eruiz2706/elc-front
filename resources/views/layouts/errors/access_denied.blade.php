@extends('layouts.adminlte.app')

@section('content')
<div class="col-md-12" style='padding-top:70px;'>
  <div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fa fa-warning"></i> Acceso Denegado!</h5>
    No tienes acceso a esta funcionalidad <a href="{{url('principal')}}">volver a la pagina principal</a>
  </div>
  <!--<div class="error-page">
      <div class="error-content">
          <h3>
            <i class="fa fa-warning text-yellow"></i>
            Acceso Denegado
          </h3>
          <p>
              No tienes acceso a esta funcionalidad <a href="{{url('principal')}}">volver a la pagina principal</a>
          </p>
      </div>
  </div>-->
</div>
@endsection
