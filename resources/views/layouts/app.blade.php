<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- toast -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/toastr/toastr.min.css') }}">
    <!-- swheetalert -->
    <link rel="stylesheet" href="{{ URL::asset('plugins/sweetalert/sweetalert.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('rsc//dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- preload -->
    <link rel="stylesheet" href="{{ URL::asset('css/loader-1.css') }}">
</head>
<!--<body>-->

<body class="hold-transition login-page">
    <div  id="loader-1" class="loader-wrapper">
            <div id="loader"></div>
    </div>

    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container"  >
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!--<li class=" dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Inicio<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="#">Dropdown 1</a></li>
                            <li><a class="nav-link" href="#">Dropdown 2</a></li>
                            <li><a class="nav-link" href="#">Dropdown 3</a></li>
                        </ul>
                    </li>-->

                    <li><a class="nav-link" href="{{ route('login') }}">Inicio</a></li>
                    <li><a class="nav-link" href="{{ route('login') }}">Sobre Nosotros</a></li>
                    <li><a class="nav-link" href="{{ route('login') }}">Contacto</a></li>

                    <!-- Authentication Links -->
                    <li><a class="nav-link" href="{{ route('login') }}">Acceder</a></li>
                    <li><a class="nav-link" href="{{url('registro')}}">Registrate</a></li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')



<!-- jQuery -->
<script src="{{ URL::asset('rsc/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ URL::asset('rsc/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- toast -->
<script src="{{ URL::asset('plugins/toastr/toastr.js') }}"></script>
<!-- swheetalert -->
<script src="{{ URL::asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
<!-- vue -->
<script src="{{ URL::asset('js/vue.js') }}"></script>
<script src="{{ URL::asset('js/axios.js') }}"></script>
@section('scripts')
@show

<script>
    window.onload = function() {
        loaders = document.getElementsByClassName('loader-wrapper');
        loaders[0].style.display = "none";
    };
</script>
</body>
</html>
