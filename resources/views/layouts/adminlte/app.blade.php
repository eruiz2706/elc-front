<!DOCTYPE html>
<html>
    @section('htmlheader')
        @include('layouts.adminlte.partials.htmlheader')
    @show

<body class="hold-transition sidebar-collapse">
<div >
    <div  id="loader-body" class="loader-wrapper loader1">
        <div class="loader"></div>
    </div>

    <div class="wrapper" id="v-app">
    @include('layouts.adminlte.partials.mainheader')

    <div class="img-bannerhome" style="background-image: url('{{ URL::asset('rfend/images/counter_background.jpg') }}');"></div>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="vue">


        <!-- Content Header (Page header) -->
        <div class="content-header" style="top:100px">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@yield('tittlecontent')</h1>
                    </div><!-- /.col -->

                    <div class="col-sm-6">
                        @yield('breadcrumb')
                    </div>

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="modal fade" id="modal_manual" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class='modal-header'>
                      Uso de la plataforma<button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body" style="height:400px;overflow-y: auto;">
                    <p><span style="background-color: transparent; font-size: 11pt; font-family: Calibri; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">Welcome to </span><span style="background-color: transparent; font-size: 11pt; font-family: Calibri; color: rgb(0, 0, 0); font-weight: 700; font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">ELCOLP</span><span style="background-color: transparent; font-size: 11pt; font-family: Calibri; color: rgb(0, 0, 0); font-variant-numeric: normal; font-variant-east-asian: normal; vertical-align: baseline; white-space: pre-wrap;">, the English Learning Center Online Learning Platform, an invaluable new resource for managing your English classes. The ELC provides carefully-designed and engaging online content for students to journey through, developing confidence, knowledge, and skills as they progress to higher levels. </span><br></p><p dir="ltr" style="line-height:1.295;margin-top:0pt;margin-bottom:8pt;"><span style="font-size:11pt;font-family:Calibri;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Here you will find a wealth of resources, including a wide array of vocabulary-building games and activities, listening and reading exercises, and handy pedagogical aids. Freely access tools to create your own online tests and to upload evaluations and supplementary assignments. We provide exclusive access to online dictionaries and research tools, mock-exams and test guides, and a pronunciation buddy with audio samples included.</span></p><p dir="ltr" style="line-height:1.295;margin-top:0pt;margin-bottom:8pt;"><span style="font-size:11pt;font-family:Calibri;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">ELCOLP</span><span style="font-size:11pt;font-family:Calibri;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;"> is an interactive social platform. Communicate privately or publicly with students, colleagues, and the ELC using our chat rooms, forums, and direct messaging service. With </span><span style="font-size:11pt;font-family:Calibri;color:#000000;background-color:transparent;font-weight:700;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">ELCOLP</span><span style="font-size:11pt;font-family:Calibri;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">, you can be in touch with your class and keep track of student assignments and submissions on the device of your choosing. The ELC’s online learning platform makes it easy to assign and check extra tasks and homework and to track and review student progress at a glance. </span></p><p dir="ltr" style="line-height:1.295;margin-top:0pt;margin-bottom:8pt;"><span style="font-size:11pt;font-family:Calibri;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">For any questions you might have about the English language, language education, and the platform itself, the ELC’s resource team will be here to help. </span></p><p dir="ltr" style="line-height:1.295;margin-top:0pt;margin-bottom:8pt;"><span style="font-size:11pt;font-family:Calibri;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Let’s get started!</span></p><p dir="ltr" style="line-height:1.295;margin-top:0pt;margin-bottom:8pt;"><span style="font-size:11pt;font-family:Calibri;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Summary of platform features:</span></p><ul style="margin-top:0pt;margin-bottom:0pt;"><li dir="ltr" style="list-style-type:disc;font-size:11pt;font-family:'Noto Sans Symbols';color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;"><p dir="ltr" style="line-height:1.295;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Course modules</span></p></li><li dir="ltr" style="list-style-type:disc;font-size:11pt;font-family:'Noto Sans Symbols';color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;"><p dir="ltr" style="line-height:1.295;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Independent Learning Tools (ILT)</span></p></li><li dir="ltr" style="list-style-type:disc;font-size:11pt;font-family:'Noto Sans Symbols';color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;"><p dir="ltr" style="line-height:1.295;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Teaching aids</span></p></li><li dir="ltr" style="list-style-type:disc;font-size:11pt;font-family:'Noto Sans Symbols';color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;"><p dir="ltr" style="line-height:1.295;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Mock exams and test guides</span></p></li><li dir="ltr" style="list-style-type:disc;font-size:11pt;font-family:'Noto Sans Symbols';color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;"><p dir="ltr" style="line-height:1.295;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Access to online dictionaries</span></p></li><li dir="ltr" style="list-style-type:disc;font-size:11pt;font-family:'Noto Sans Symbols';color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;"><p dir="ltr" style="line-height:1.295;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Pronunciation buddy</span></p></li><li dir="ltr" style="list-style-type:disc;font-size:11pt;font-family:'Noto Sans Symbols';color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;"><p dir="ltr" style="line-height:1.295;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Interaction with native English speakers</span></p></li><li dir="ltr" style="list-style-type:disc;font-size:11pt;font-family:'Noto Sans Symbols';color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;"><p dir="ltr" style="line-height:1.295;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Q&amp;A: Ask the ELC</span></p></li><li dir="ltr" style="list-style-type:disc;font-size:11pt;font-family:'Noto Sans Symbols';color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;"><p dir="ltr" style="line-height:1.295;margin-top:0pt;margin-bottom:0pt;"><span style="font-size:11pt;font-family:Calibri;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Online forums</span></p></li><li dir="ltr" style="list-style-type:disc;font-size:11pt;font-family:'Noto Sans Symbols';color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;"><p dir="ltr" style="line-height:1.295;margin-top:0pt;margin-bottom:8pt;"><span style="font-size:11pt;font-family:Calibri;color:#000000;background-color:transparent;font-weight:400;font-style:normal;font-variant:normal;text-decoration:none;vertical-align:baseline;white-space:pre;white-space:pre-wrap;">Chat rooms and messaging</span></p></li></ul><p><br></p>
                  </div>

                  <div class='modal-footer'>
                    <input type="checkbox" v-model='chk_manual' class="fantasma"/>No mostrar mas
                    <button type="button" class="btn btn-outline-primary btn-sm float-left" :disabled="loader_manual" v-on:click.prevent='updateManual()'>
                      Cerrar
                      <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_manual"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <div class="container-fluid" >
                @yield('content')
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('layouts.adminlte.partials.footer')

  </div>
  <!-- ./wrapper -->
  @section('scripts')
      @include('layouts.adminlte.partials.scripts')
  @show
</div>
</body>
</html>
