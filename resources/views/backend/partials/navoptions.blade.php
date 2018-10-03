@if(Session::get('rol')=='es')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Cursos</h3>

  </div>
  <div class="card-body p-0">
    <ul class="nav nav-pills flex-column">
      <li class="nav-item">
        <a href="{{url('es/foro')}}" class="nav-link">
          Preparacion Pre-icfes
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('es/foro')}}" class="nav-link">
          Ingles Nivel1
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('es/foro')}}" class="nav-link">
          Ingles Nivel2
        </a>
      </li>
    </ul>
  </div>
  <div class='card-footer'>
    <ul class="nav nav-pills flex-column">
    <li class="nav-item active">
      <a href="{{url('es/cursos')}}" class="nav-link">
        <i class="fa fa-plus-square-o"></i> Ofertas de cursos
      </a>
    </li>
  </ul>
  </div>
  <!-- /.card-body -->
</div>
@endif

@if(Session::get('rol')=='in')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Administracion</h3>

  </div>
  <div class="card-body p-0">
    <ul class="nav nav-pills flex-column">
      <li class="nav-item">
        <a href="{{url('in/cursos/crear')}}" class="nav-link">
          Crear Cursos
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('in/cursos')}}" class="nav-link">
          Listar Cursos
        </a>
      </li>
    </ul>
  </div>
</div>
@endif
