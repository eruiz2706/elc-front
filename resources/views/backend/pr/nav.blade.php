<!-- Profile Image -->
<div class="card card-primary card-outline">
  <div class="card-body box-profile">
    <div class="text-center">
      <img class="profile-user-img img-fluid img-circle"
           src="{{ URL::asset('rsc/dist/img/user1-128x128.jpg') }}"
           alt="User profile picture">
    </div>

    <h3 class="profile-username text-center">{{ Auth::user()->nombre}}</h3>
    <p class="text-muted text-center">AJ132550</p>

    <ul class="nav nav-pills flex-column">
        <li class="nav-item active">
          <a href="{{url('es/inicio')}}" class="nav-link">
            <i class="fa fa-inbox"></i> Inicio
          </a>
        </li>
        <li class="nav-item">
          <a href="{{url('es/perfil')}}" class="nav-link">
            <i class="fa fa-envelope-o"></i> Perfil
          </a>
        </li>
    </ul>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Gestion de cursos</h3>

  </div>
  <div class="card-body p-0">
    <ul class="nav nav-pills flex-column">
      <li class="nav-item">
        <a href="{{url('es/forog')}}" class="nav-link">
          <i class="fa fa-file-text-o"></i> Asignar estudiante a curso
        </a>
      </li>
    </ul>
  </div>
  <!-- /.card-body -->
</div>
