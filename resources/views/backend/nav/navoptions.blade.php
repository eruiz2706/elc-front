@if(Session::get('rol')=='ad')

@endif

@if(Session::get('rol')=='in')
  @include('backend.nav.in.navoptions')
@endif

@if(Session::get('rol')=='pr')
  @include('backend.nav.pr.navoptions')
@endif

@if(Session::get('rol')=='es')
  @include('backend.nav.es.navoptions')
@endif

@if(Session::get('rol')=='pa')

@endif
