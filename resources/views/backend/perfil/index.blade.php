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

        @if(Session::get('rol')=='es')
          @include('backend.es.navcursos')
        @endif
      </div>

      <div class="col-md-9"  style='padding-top:70px;' >
        <div class="row" v-if="preload">
          <div class="d-block mx-auto" >
            <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12">
              @include('backend.perfil.partials.perfil')

              @if(Session::get('rol')=='es')
                @include('backend.perfil.partials.pagos')
              @endif
            </div>
        </div>
      </div>
  </div>
</div>
@endsection

@section('scripts')
@parent
<script src="{{ URL::asset('js/be/perfil/index.js') }}"></script>
@stop
