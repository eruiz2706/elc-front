@extends('layouts.adminlte.app')

@section('content')
<div class="row">
    <div class="col-md-3">
      @include('backend.nav.nav_user')
      @include('backend.nav.nav_options')
      @include('backend.nav.nav_social')
    </div>

    <div class="col-md-9" style='padding-top:70px;'>
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fa fa-ban"></i>Error de confirmaciòn de pago</h5>
        No se pudo realizar la confirmacion del pago
      </div>
    </div>
</div>
<input type='hidden' name='id' id='id' value=""></input>
@endsection
