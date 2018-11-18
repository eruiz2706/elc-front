
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
      <li class="nav-item"><a class="nav-link @if(isset($tab_edit)) active @endif" href="{{url('cursos/v_editar/'.$curso->id)}}">Datos Basicos</a></li>
      <li class="nav-item"><a class="nav-link @if(isset($tab_conf)) active @endif" href="{{url('cursos/v_config/'.$curso->id)}}">Datos Avanzados</a></li>
      <li class="nav-item"><a class="nav-link @if(isset($tab_mod)) active @endif" href="{{url('modulos/'.$curso->id)}}">Modulos</a></li>
      <li class="nav-item"><a class="nav-link @if(isset($tab_lecc)) active @endif" href="{{url('lecciones/'.$curso->id)}}">Lecciones</a></li>
      <li class="nav-item"><a class="nav-link @if(isset($tab_integ)) active @endif" href="{{url('integrantes/'.$curso->id)}}">Integrantes</a></li>
    </ul>
  </div>
</div>
