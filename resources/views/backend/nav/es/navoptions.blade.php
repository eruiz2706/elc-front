<div class="card">
  <div class="card-header">
    <h3 class="card-title">Cursos Estudiante</h3>

  </div>
  <div class="card-body p-0">
    <ul class="nav nav-pills flex-column">
      @if(Session::get('navcursos') !=null)
        @foreach(Session::get('navcursos') as $navcurso)
          @php ($callout = '')
          @php ($color = '')
          @if(isset($curso->id))
            @if($curso->id==$navcurso->id)
              @php ($callout = 'callout-cours')
              @php ($color = 'color:#007bff')
            @endif
          @endif
          <li class="nav-item {{$callout}}">
            <a href="{{url('cursos/abrir/'.$navcurso->id)}}" class="nav-link" style="{{$color}}">
              {{$navcurso->nombre}}
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
