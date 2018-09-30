<?
$act1=(Request::path() == 'es/foro') ? 'active' : '';
$act2=(Request::path() == 'es/progres') ? 'active' : '';
$act3=(Request::path() == 'es/calend') ? 'active' : '';
$act4=(Request::path() == 'es/evaluac') ? 'active' : '';
$act5=(Request::path() == 'es/result') ? 'active' : '';
?>

<div class="col-md-12">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Programacion Interactiva</h3>

      <div class="card-tools">
        <div class="user-block" style="width:80px;">
         <img class="img-circle img-bordered-sm" src="{{ URL::asset('rsc/dist/img/user1-128x128.jpg') }}" alt="user image">
        </div>
      </div>
    </div>

    <div class="card-body">
      <ul class="nav nav-pills">
        <li class="nav-item"><a class="nav-link <?=$act1?>" href="{{url('es/foro')}}">Foro</a></li>
        <li class="nav-item"><a class="nav-link <?=$act2?>" href="{{url('es/progres')}}">Progreso</a></li>
        <li class="nav-item"><a class="nav-link <?=$act3?>" href="{{url('es/calend')}}">Calendario</a></li>
        <li class="nav-item"><a class="nav-link <?=$act4?>" href="{{url('es/evaluac')}}">Evaluaciones</a></li>
        <li class="nav-item"><a class="nav-link <?=$act5?>" href="{{url('es/result')}}">Resultados</a></li>
      </ul>
    </div>
  </div>
</div>
