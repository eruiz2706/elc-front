@if(Session::get('rol')=='ad')

@endif

@if(Session::get('rol')=='in')
  @include('backend.nav.in.nav_user')
@endif

@if(Session::get('rol')=='pr')
  @include('backend.nav.pr.nav_user')
@endif

@if(Session::get('rol')=='es')
  @include('backend.nav.es.nav_user')
@endif

@if(Session::get('rol')=='pa')

@endif
