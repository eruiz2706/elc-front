<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" >

@section('htmlheader')
    @include('layouts.unicat.partials.htmlheader')
@show

<body>

<div class="super_container" id="vue">

	<!-- Header -->
  <head>
  @include('layouts.unicat.partials.mainheader')
  </head>
  <!-- Contect -->
  @yield('content')

	<!-- Footer -->
  @include('layouts.unicat.partials.footer')
</div>

@section('scripts')
    @include('layouts.unicat.partials.scripts')
@show

</body>
</html>
