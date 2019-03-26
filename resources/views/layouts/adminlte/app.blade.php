<!DOCTYPE html>
<html  lang="{{ app()->getLocale() }}">
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
                  <p class="MsoNormal" style="text-align:justify"><span lang="ES-CO" style="font-size:12.0pt;line-height:107%;font-family:Cambria;mso-ansi-language:
ES-CO">Le damos la bienvenida a <b style="mso-bidi-font-weight:normal">ELCOLP</b>,
una plataforma moderna, completa y dotada de valiosos recursos de aprendizaje
de alta calidad. A través de esta, usted tendrá acceso a contenido único en el
mundo. <b style="mso-bidi-font-weight:normal">ELCOLP</b> es una plataforma
interactiva y muy similar a una red social que le brinda una navegación
dinámica y sencilla. Por lo tanto, usted podrá acceder desde diferentes
dispositivos móviles como Smartphones, Tablets, Ipads, etc.<o:p></o:p></span></p><p class="MsoNormal" style="text-align:justify"><b style="mso-bidi-font-weight:
normal"><span lang="ES-CO" style="font-size:12.0pt;line-height:107%;font-family:
Cambria;mso-ansi-language:ES-CO">ELCOLP </span></b><span lang="ES-CO" style="font-size:12.0pt;line-height:107%;font-family:Cambria;mso-ansi-language:
ES-CO">le ofrece una amplia gama de funciones y actividades prácticas para
mejorar ostensiblemente sus conocimientos en inglés, ya sea, bajo la
supervisión de su docente, o mediante su aprendizaje autónomo e independiente.
A partir de este momento, usted podrá disfrutar de los siguientes beneficios:<o:p></o:p></span></p><p class="MsoListParagraphCxSpFirst" style="text-align:justify;text-indent:-18.0pt;
mso-list:l0 level1 lfo1"><!--[if !supportLists]--><span lang="ES-CO" style="font-size:12.0pt;line-height:107%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;mso-ansi-language:ES-CO"><span style="mso-list:Ignore">·<span style="font:7.0pt &quot;Times New Roman&quot;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><!--[endif]--><span lang="ES-CO" style="font-size:12.0pt;
line-height:107%;font-family:Cambria;mso-ansi-language:ES-CO">Cursos completos<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="text-align:justify;text-indent:-18.0pt;
mso-list:l0 level1 lfo1"><!--[if !supportLists]--><span lang="ES-CO" style="font-size:12.0pt;line-height:107%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;mso-ansi-language:ES-CO"><span style="mso-list:Ignore">·<span style="font:7.0pt &quot;Times New Roman&quot;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><!--[endif]--><span lang="ES-CO" style="font-size:12.0pt;
line-height:107%;font-family:Cambria;mso-ansi-language:ES-CO">Prueba de nivel
de inglés (Opcional)<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="text-align:justify;text-indent:-18.0pt;
mso-list:l0 level1 lfo1"><!--[if !supportLists]--><span lang="ES-CO" style="font-size:12.0pt;line-height:107%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;mso-ansi-language:ES-CO"><span style="mso-list:Ignore">·<span style="font:7.0pt &quot;Times New Roman&quot;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><!--[endif]--><span lang="ES-CO" style="font-size:12.0pt;
line-height:107%;font-family:Cambria;mso-ansi-language:ES-CO">Chats grupales y
globales<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="text-align:justify;text-indent:-18.0pt;
mso-list:l0 level1 lfo1"><!--[if !supportLists]--><span lang="ES-CO" style="font-size:12.0pt;line-height:107%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;mso-ansi-language:ES-CO"><span style="mso-list:Ignore">·<span style="font:7.0pt &quot;Times New Roman&quot;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><!--[endif]--><span lang="ES-CO" style="font-size:12.0pt;
line-height:107%;font-family:Cambria;mso-ansi-language:ES-CO">Herramientas de
aprendizaje independiente<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="text-align:justify;text-indent:-18.0pt;
mso-list:l0 level1 lfo1"><!--[if !supportLists]--><span lang="ES-CO" style="font-size:12.0pt;line-height:107%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;mso-ansi-language:ES-CO"><span style="mso-list:Ignore">·<span style="font:7.0pt &quot;Times New Roman&quot;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><!--[endif]--><span lang="ES-CO" style="font-size:12.0pt;
line-height:107%;font-family:Cambria;mso-ansi-language:ES-CO">Pronunciador
(Practica)<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="text-align:justify;text-indent:-18.0pt;
mso-list:l0 level1 lfo1"><!--[if !supportLists]--><span lang="ES-CO" style="font-size:12.0pt;line-height:107%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;mso-ansi-language:ES-CO"><span style="mso-list:Ignore">·<span style="font:7.0pt &quot;Times New Roman&quot;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><!--[endif]--><span lang="ES-CO" style="font-size:12.0pt;
line-height:107%;font-family:Cambria;mso-ansi-language:ES-CO">Diccionario en
línea con pronunciación<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="text-align:justify;text-indent:-18.0pt;
mso-list:l0 level1 lfo1"><!--[if !supportLists]--><span lang="ES-CO" style="font-size:12.0pt;line-height:107%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;mso-ansi-language:ES-CO"><span style="mso-list:Ignore">·<span style="font:7.0pt &quot;Times New Roman&quot;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><!--[endif]--><span lang="ES-CO" style="font-size:12.0pt;
line-height:107%;font-family:Cambria;mso-ansi-language:ES-CO">Sección de
preguntas y respuestas<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="text-align:justify;text-indent:-18.0pt;
mso-list:l0 level1 lfo1"><!--[if !supportLists]--><span lang="ES-CO" style="font-size:12.0pt;line-height:107%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;mso-ansi-language:ES-CO"><span style="mso-list:Ignore">·<span style="font:7.0pt &quot;Times New Roman&quot;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><!--[endif]--><span lang="ES-CO" style="font-size:12.0pt;
line-height:107%;font-family:Cambria;mso-ansi-language:ES-CO">Interacción con
hablantes nativos, docentes y compañeros de clase<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="text-align:justify;text-indent:-18.0pt;
mso-list:l0 level1 lfo1"><!--[if !supportLists]--><span lang="ES-CO" style="font-size:12.0pt;line-height:107%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;mso-ansi-language:ES-CO"><span style="mso-list:Ignore">·<span style="font:7.0pt &quot;Times New Roman&quot;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><!--[endif]--><span lang="ES-CO" style="font-size:12.0pt;
line-height:107%;font-family:Cambria;mso-ansi-language:ES-CO">Exámenes de
diagnóstico<o:p></o:p></span></p><p class="MsoListParagraphCxSpLast" style="text-align:justify;text-indent:-18.0pt;
mso-list:l0 level1 lfo1"><!--[if !supportLists]--><span lang="ES-CO" style="font-size:12.0pt;line-height:107%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;mso-ansi-language:ES-CO"><span style="mso-list:Ignore">·<span style="font:7.0pt &quot;Times New Roman&quot;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><!--[endif]--><span lang="ES-CO" style="font-size:12.0pt;
line-height:107%;font-family:Cambria;mso-ansi-language:ES-CO">Foros virtuales<o:p></o:p></span></p><p class="MsoNormal" style="text-align:justify"><span lang="ES-CO" style="font-size:12.0pt;line-height:107%;font-family:Cambria;mso-ansi-language:
ES-CO">Le agradecemos de antemano su decisión de aprender con nosotros y
estaremos disponibles para usted. Si tiene consultas, no dude en contactarnos.
Estamos para servirle. <o:p></o:p></span></p><p class="MsoNormal" style="text-align:justify">
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
