<div class="card">
  <div class="card-header">
    <h3 class="card-title">Cursos Estudiante</h3>

  </div>
  <div class="card-body p-0">
    <ul class="nav nav-pills flex-column">
      @if(Session::get('navcursos') !=null)
        @foreach(Session::get('navcursos') as $curso)
          @php ($callout = '')
          @if(isset(Session::get('o_curso')->id))
            @if(Session::get('o_curso')->id==$curso->id)
              @php ($callout = 'callout-cours')
            @endif
          @endif
          <li class="nav-item {{$callout}}">
            <a href="{{url('cursos/abrir/'.$curso->id)}}" class="nav-link">
              {{$curso->nombre}}
            </a>
          </li>
        @endforeach
      @else
      <li class="nav-item">
        <a class="nav-link">
          No tienes cursos
        </a>
      </li>
      @endif
    </ul>
  </div>
  <div class="card-footer">
    <ul class="nav nav-pills flex-column">
      <li class="nav-item">
        <a href="{{url('ofertados')}}" class="nav-link">
          <i class="fa fa-plus-square-o"></i> Ofertas  de cursos
        </a>
      </li>
    </ul>
  </div>

</div>
