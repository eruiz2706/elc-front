
<div class="card card-primary card-outline">
  <div class="card-header card-header-cuorse">
    <h2 class="card-title-course">
      @if(isset($curso))
        {{$curso->nombre}}
      @endif
    </h2>
  </div>

  <div class="card-body" style='padding:0px'>
    <ul class="nav nav-pills">
      <li class="nav-item"><a class="nav-link @if(isset($tab_conf)) active @endif" href="{{url('cursos/v_config/'.$curso->id)}}">Configuracion</a></li>
      <li class="nav-item"><a class="nav-link @if(isset($tab_mod)) active @endif" href="{{url('modulos/'.$curso->id)}}">Modulos</a></li>
      <!--<li class="nav-item"><a class="nav-link @if(isset($tab_tar)) active @endif" href="{{url('tareas/'.$curso->id)}}">Tareas</a></li>-->
      <!--<li class="nav-item"><a class="nav-link @if(isset($tab_ejer)) active @endif" href="{{url('ejercicios/'.$curso->id)}}">Examenes</a></li>-->
      <li class="nav-item"><a class="nav-link @if(isset($tab_integ)) active @endif" href="{{url('integrantes/'.$curso->id)}}">Integrantes</a></li>
    </ul>
  </div>
</div>
