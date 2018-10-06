<div class="card">
  <div class="card-header">
    <h3 class="card-title">Cursos Profesor</h3>

  </div>
  <div class="card-body p-0">
    <ul class="nav nav-pills flex-column">
      @if(Session::get('navcursos') !=null)
        @foreach(Session::get('navcursos') as $curso)
          <li class="nav-item">
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
</div>
