@extends('layouts.adminlte.app')

@section('content')
<div class="row">
    <div class="col-md-3">
      @include('backend.nav.nav_user')
      @include('backend.nav.nav_options')
      @include('backend.nav.nav_social')
    </div>

    <div class="col-md-9" style='padding-top:70px;'>
        <usuarios-lista></usuarios-lista>
    </div>
</div>
<input type='hidden' name='id' id='id' value=""></input>
@endsection
