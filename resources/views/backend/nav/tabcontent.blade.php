@if(Session::get('rol')=='ad')

@endif

@if(Session::get('rol')=='in')
  @include('backend.nav.in.tabcontent')
@endif

@if(Session::get('rol')=='pr')
  @include('backend.nav.pr.tabcontent')
@endif

@if(Session::get('rol')=='es')
  @include('backend.nav.es.tabcontent')
@endif

@if(Session::get('rol')=='pa')

@endif
