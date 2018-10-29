<div class="col-md-12">
  <div class="card">
    <div class="card-header card-header-cuorse">
      <h2 class="card-title-course">
        @if(isset($curso))
          {{$curso->nombre}}
        @endif
      </h2>
    </div>

    <div class="card-body" style='padding:0px'>
      <ul class="nav nav-pills">
        <li class="nav-item"><a class="nav-link @if(isset($tab_foro)) active @endif" href="{{url('foroc/'.$curso->id)}}">Foro</a></li>
        <li class="nav-item"><a class="nav-link @if(isset($tab_prog)) active @endif" href="{{url('progreso/'.$curso->id)}}">Progreso</a></li>
        <li class="nav-item"><a class="nav-link @if(isset($tab_tar)) active @endif" href="{{url('tareas/'.$curso->id)}}">Tareas</a></li>
        <li class="nav-item"><a class="nav-link @if(isset($tab_ejer)) active @endif" href="{{url('ejercicios/'.$curso->id)}}">Examenes</a></li>
        <li class="nav-item"><a class="nav-link @if(isset($tab_calen)) active @endif" href="{{url('calendario/'.$curso->id)}}">Calendario</a></li>
        <li class="nav-item"><a class="nav-link @if(isset($tab_integ)) active @endif" href="{{url('integrantes/'.$curso->id)}}">Integrantes</a></li>
      </ul>
    </div>
  </div>
</div>
