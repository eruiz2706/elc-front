<?
$act1=(Request::path() == 'es/calendg') ? 'active' : '';
$act2=(Request::path() == 'es/resultg') ? 'active' : '';
$act3=(Request::path() == 'es/dicciong') ? 'active' : '';
$act4=(Request::path() == 'es/preguntfg') ? 'active' : '';
?>

<div class="col-md-12">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Resumen</h3>

      <div class="card-tools">
        <div class="user-block" style="width:80px;">
         <img class="img-circle img-bordered-sm" src="{{ URL::asset('rsc/dist/img/user1-128x128.jpg') }}" alt="user image">
        </div>
      </div>
    </div>

    <div class="card-body">
      <ul class="nav nav-pills">
        <li class="nav-item"><a class="nav-link <?=$act1?>" href="{{url('es/calendg')}}">Calendario</a></li>
        <li class="nav-item"><a class="nav-link <?=$act2?>" href="{{url('es/resultg')}}">Resultados</a></li>
        <li class="nav-item"><a class="nav-link <?=$act3?>" href="{{url('es/dicciong')}}">Diccionario</a></li>
        <li class="nav-item"><a class="nav-link <?=$act4?>" href="{{url('es/preguntfg')}}">Preguntas frecuentes</a></li>
      </ul>
    </div>
  </div>
</div>
