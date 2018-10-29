<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name') }} | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ URL::asset('rsc/plugins/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ URL::asset('rsc/plugins/select2/select2.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ URL::asset('rsc/dist/css/adminlte.min.css') }}">
  <!-- personalizacion Theme style -->
  <link rel="stylesheet" href="{{ URL::asset('rsc/dist/css/style.css') }}">
  <!-- toast -->
  <link rel="stylesheet" href="{{ URL::asset('plugins/toastr/toastr.min.css') }}">
  <!-- swheetalert -->
  <link rel="stylesheet" href="{{ URL::asset('plugins/sweetalert/sweetalert.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- preload -->
  <link rel="stylesheet" href="{{ URL::asset('css/loader-1.css') }}">
  <!-- fullCalendar 2.2.5 -->
    <link rel="stylesheet" href="{{ URL::asset('rsc/plugins/fullcalendar/fullcalendar.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('rsc/plugins/fullcalendar/fullcalendar.print.css') }}" media="print">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.css" rel="stylesheet">
</head>
