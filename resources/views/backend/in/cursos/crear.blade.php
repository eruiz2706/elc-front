@extends('layouts.adminlte.app')
@section('htmlheader')
    @parent
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.css" rel="stylesheet">
@stop

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
        @include('backend.in.cursos.partials.formcrear')
      </div>

  </div>

</div>
@endsection

@section('scripts')
@parent
<script>
  $('#summernote').summernote({
    height: 350
  });
</script>
@stop
