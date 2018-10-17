@extends('layouts.adminlte.app')

@section('content')
<div class="row">
    <div class="col-md-3">
      @include('backend.nav.ad.nav_user')

      @include('backend.nav.ad.navoptions')
    </div>

    <div class="col-md-9"  style='padding-top:70px;' >
      <div class="row" v-if="preload">
        <div class="d-block mx-auto" >
          <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
        </div>
      </div>
      <div class="row">
          <div class="col-md-12">
            @include('backend.modulos.perfil.partials.perfil')
          </div>
      </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/perfil/index.js') }}"></script>
@stop
