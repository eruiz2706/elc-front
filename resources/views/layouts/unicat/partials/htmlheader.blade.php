<title>ELC</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="Unicat project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
<link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('img/app/favicon/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('img/app/favicon/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('img/app/favicon/favicon-16x16.png') }}">
<link rel="manifest" href="{{ URL::asset('img/app/favicon/site.webmanifest') }}">
<link rel="mask-icon" href="{{ URL::asset('img/app/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/styles/bootstrap4/bootstrap.min.css') }}">
<link href="{{ URL::asset('rfend/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('rfend/plugins/OwlCarousel2-2.2.1/animate.css') }}">
<!-- toast -->
<link rel="stylesheet" href="{{ URL::asset('plugins/toastr/toastr.min.css') }}">
<!-- swheetalert -->
<link rel="stylesheet" href="{{ URL::asset('plugins/sweetalert/sweetalert.css') }}">
<style>
@media only screen and (min-width: 1024px) {
  .course_image img{
    height: 200px;
  }
}

/*permitir agregar botton adicional superior*/
.top_bar_login{
  display: -webkit-box;
}
.login_button{
  margin-left: 10px;
}
</style>
