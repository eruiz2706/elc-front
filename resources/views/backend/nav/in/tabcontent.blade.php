@php
$act1=(Request::path() == 'foroc') ? 'active' : '';
$act2=(Request::path() == 'lecc') ? 'active' : '';
$act3=(Request::path() == 'tareas') ? 'active' : '';
$act4=(Request::path() == 'evaluac') ? 'active' : '';
$act5=(Request::path() == 'miembros') ? 'active' : '';
@endphp

<div class="row">
<div class="col-md-12">
  <div class="card card-primary card-outline">
    <div class="card-header" style='height:85px'>
      <h2>Titulo content</h2>
    </div>

    <div class="card-body" style='padding:0px'>
      <ul class="nav nav-pills">
        <li class="nav-item"><a class="nav-link <?=$act1?>" href="{{url('foroc')}}">Foro</a></li>
        <li class="nav-item"><a class="nav-link <?=$act2?>" href="{{url('lecc')}}">Lecciones</a></li>
        <li class="nav-item"><a class="nav-link <?=$act3?>" href="{{url('tareas')}}">Tareas</a></li>
        <li class="nav-item"><a class="nav-link <?=$act4?>" href="{{url('evaluac')}}">Evaluaciones</a></li>
        <li class="nav-item"><a class="nav-link <?=$act5?>" href="{{url('miembros')}}">Miembros</a></li>
      </ul>
    </div>
  </div>
</div>
</div>
