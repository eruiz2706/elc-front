@extends('layouts.adminlte.app')

@section('banner')
  @include('backend.partials.bannertop')
@endsection

@section('content')

<div class="container">

  <div class="row">
    <div class="col-md-3">
      @include('backend.partials.navuser')

      @include('backend.partials.navoptions')
    </div>

    <div class="col-md-9" style='padding-top:70px;'>
      <div class="row">
        @include('backend.partials.tabcontent_gen') 

      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
@parent

@stop
