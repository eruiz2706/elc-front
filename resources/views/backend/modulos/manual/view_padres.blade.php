@extends('layouts.adminlte.app')

@section('content')
<div class="row">
    <div class="col-md-3">
      @include('backend.nav.nav_user')
      @include('backend.nav.nav_options')
      @include('backend.nav.nav_social')

    </div>
    <div class="col-md-9" style='padding-top:70px;'>
      <div class="card card-primary card-outline">
        <div class="card-header card-header-cuorse">
          <h2 class="card-title-course">
            Manual de usuario
          </h2>
        </div>
        <div class="card-body">
        <p class="MsoNormal" style="text-align:justify"><span lang="ES-CO" style="font-size:12.0pt;line-height:107%">Bienvenidos a <b style="mso-bidi-font-weight:
normal">ELCOLP</b>, la innovadora plataforma virtual orientada a brindar
soluciones, avances y mejoras a los procesos de enseñanza y aprendizaje. Esta
plataforma aloja y habilita perfiles para todos: estudiantes, profesores y
padres de familia. <o:p></o:p></span></p><p class="MsoNormal" style="text-align:justify"><b style="mso-bidi-font-weight:
normal"><span lang="ES-CO" style="font-size:12.0pt;line-height:107%">ELCOLP</span></b><span lang="ES-CO" style="font-size:12.0pt;line-height:107%"> constituye un recurso
único que facilitará y dará un plus a la educación de hoy, especialmente, a la
manera como los docentes enseñan y los estudiantes aprenden, incorporando el
enfoque tecnológico como aspecto facilitador de conducción de procesos
educativos. En general, nuestros usuarios podrán tener una excelente
experiencia a través del acceso a: <o:p></o:p></span></p><p class="MsoListParagraphCxSpFirst" style="margin-left:18.0pt;mso-add-space:
auto;text-align:justify;text-indent:-18.0pt;mso-list:l0 level1 lfo1"><!--[if !supportLists]--><span lang="ES-CO" style="font-size:12.0pt;line-height:107%;font-family:Symbol;
mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol;mso-ansi-language:
ES-CO"><span style="mso-list:Ignore">·<span style="font:7.0pt &quot;Times New Roman&quot;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><!--[endif]--><span lang="ES-CO" style="font-size:12.0pt;
line-height:107%;mso-ansi-language:ES-CO">Salas de chat (grupales
personalizadas y globales)<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="margin-left:18.0pt;mso-add-space:
auto;text-align:justify;text-indent:-18.0pt;mso-list:l0 level1 lfo1"><!--[if !supportLists]--><span lang="ES-CO" style="font-size:12.0pt;line-height:107%;font-family:Symbol;
mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol;mso-ansi-language:
ES-CO"><span style="mso-list:Ignore">·<span style="font:7.0pt &quot;Times New Roman&quot;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><!--[endif]--><span lang="ES-CO" style="font-size:12.0pt;
line-height:107%;mso-ansi-language:ES-CO">Teaching tools<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="margin-left:18.0pt;mso-add-space:
auto;text-align:justify;text-indent:-18.0pt;mso-list:l0 level1 lfo1"><!--[if !supportLists]--><span lang="ES-CO" style="font-size:12.0pt;line-height:107%;font-family:Symbol;
mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol;mso-ansi-language:
ES-CO"><span style="mso-list:Ignore">·<span style="font:7.0pt &quot;Times New Roman&quot;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><!--[endif]--><span lang="ES-CO" style="font-size:12.0pt;
line-height:107%;mso-ansi-language:ES-CO">QNA<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="margin-left:18.0pt;mso-add-space:
auto;text-align:justify;text-indent:-18.0pt;mso-list:l0 level1 lfo1"><!--[if !supportLists]--><span lang="ES-CO" style="font-size:12.0pt;line-height:107%;font-family:Symbol;
mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol;mso-ansi-language:
ES-CO"><span style="mso-list:Ignore">·<span style="font:7.0pt &quot;Times New Roman&quot;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><!--[endif]--><span lang="ES-CO" style="font-size:12.0pt;
line-height:107%;mso-ansi-language:ES-CO">Herramientas de aprendizaje independiente
<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="margin-left:18.0pt;mso-add-space:
auto;text-align:justify;text-indent:-18.0pt;mso-list:l0 level1 lfo1"><!--[if !supportLists]--><span lang="ES-CO" style="font-size:12.0pt;line-height:107%;font-family:Symbol;
mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol;mso-ansi-language:
ES-CO"><span style="mso-list:Ignore">·<span style="font:7.0pt &quot;Times New Roman&quot;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><!--[endif]--><span lang="ES-CO" style="font-size:12.0pt;
line-height:107%;mso-ansi-language:ES-CO">Frases y vocabulario más usado <o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="margin-left:18.0pt;mso-add-space:
auto;text-align:justify;text-indent:-18.0pt;mso-list:l0 level1 lfo1"><!--[if !supportLists]--><span lang="ES-CO" style="font-size:12.0pt;line-height:107%;font-family:Symbol;
mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol;mso-ansi-language:
ES-CO"><span style="mso-list:Ignore">·<span style="font:7.0pt &quot;Times New Roman&quot;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><!--[endif]--><span lang="ES-CO" style="font-size:12.0pt;
line-height:107%;mso-ansi-language:ES-CO">Diccionarios <o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="margin-left:18.0pt;mso-add-space:
auto;text-align:justify;text-indent:-18.0pt;mso-list:l0 level1 lfo1"><!--[if !supportLists]--><span lang="ES-CO" style="font-size:12.0pt;line-height:107%;font-family:Symbol;
mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol;mso-ansi-language:
ES-CO"><span style="mso-list:Ignore">·<span style="font:7.0pt &quot;Times New Roman&quot;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><!--[endif]--><span lang="ES-CO" style="font-size:12.0pt;
line-height:107%;mso-ansi-language:ES-CO">Pronunciation buddy <o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="margin-left:18.0pt;mso-add-space:
auto;text-align:justify;text-indent:-18.0pt;mso-list:l0 level1 lfo1"><!--[if !supportLists]--><span lang="ES-CO" style="font-size:12.0pt;line-height:107%;font-family:Symbol;
mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol;mso-ansi-language:
ES-CO"><span style="mso-list:Ignore">·<span style="font:7.0pt &quot;Times New Roman&quot;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><!--[endif]--><span lang="ES-CO" style="font-size:12.0pt;
line-height:107%;mso-ansi-language:ES-CO">Sección preguntas y respuestas <o:p></o:p></span></p><p class="MsoListParagraphCxSpLast" style="margin-left:18.0pt;mso-add-space:auto;
text-align:justify;text-indent:-18.0pt;mso-list:l0 level1 lfo1"><!--[if !supportLists]--><span lang="ES-CO" style="font-size:12.0pt;line-height:107%;font-family:Symbol;
mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol;mso-ansi-language:
ES-CO"><span style="mso-list:Ignore">·<span style="font:7.0pt &quot;Times New Roman&quot;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><!--[endif]--><span lang="ES-CO" style="font-size:12.0pt;
line-height:107%;mso-ansi-language:ES-CO">Chats grupales y globales<o:p></o:p></span></p>
<p class="MsoNormal" style="text-align:justify"><span lang="ES-CO" style="font-size:12.0pt;line-height:107%">Y lo mejor de todo es que las
instituciones educativas tendrán la posibilidad de supervisar el trabajo
realizado por sus estudiantes y docentes. <o:p></o:p></span></p>
        </div>
      </div>

    </div>

</div>
@endsection
