@extends('layouts.adminlte.app')

@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-3">
        @include('backend.nav.in.nav_user')

        @include('backend.nav.in.navoptions')
      </div>
      <div class="col-md-9" style='padding-top:70px;'>
        @include('backend.modulos.cursos.partials.formcrear')
      </div>
    </div>

</div>
@endsection

@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/cursos/crear.js') }}"></script>
<script>
  $('#summernote').summernote({
    height: 350
  });
</script>
@stop
