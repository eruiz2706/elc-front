<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name') }} | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('img/app/favicon/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('img/app/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('img/app/favicon/favicon-16x16.png') }}">
  <link rel="manifest" href="{{ URL::asset('img/app/favicon/site.webmanifest') }}">
  <link rel="mask-icon" href="{{ URL::asset('img/app/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="{{ URL::asset('plugins/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('plugins/ionicons/css/ionicons.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/social/social.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('plugins/select2/select2.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('plugins/toastr/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('plugins/sweetalert/sweetalert.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('plugins/fullcalendar/fullcalendar.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('plugins/fullcalendar/fullcalendar.print.css') }}" media="print">
  <link rel="stylesheet" href="{{ URL::asset('rsc/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('rsc/css/loader-1.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('rsc/css/style.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('rsc/css/courses.css') }}">
</head>
  