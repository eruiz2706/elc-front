@php
$active1=(Request::path() == 'es/calendg') ? 'active' : '';
$active2=(Request::path() == 'es/resultg') ? 'active' : '';
$active3=(Request::path() == 'es/dicciong') ? 'active' : '';
$active4=(Request::path() == 'es/preguntfg') ? 'active' : '';
@endphp

<div class="col-md-12">
  <div class="card">
    <div class="card-header"  style='height:60px'>
      <h2>Resumen</h2>
    </div>

    <div class="card-body"  style='padding:0px'>
      <ul class="nav nav-pills">
        <li class="nav-item"><a class="nav-link <?=$active1?>" href="{{url('es/calendg')}}">Calendario</a></li>
        <li class="nav-item"><a class="nav-link <?=$active2?>" href="{{url('es/resultg')}}">Resultados</a></li>
        <li class="nav-item"><a class="nav-link <?=$active3?>" href="{{url('es/dicciong')}}">Diccionario</a></li>
        <li class="nav-item"><a class="nav-link <?=$active4?>" href="{{url('es/preguntfg')}}">Preguntas frecuentes</a></li>
      </ul>
    </div>
  </div>
</div>
