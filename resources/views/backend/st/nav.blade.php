<!-- Profile Image -->
<div class="card card-primary card-outline">
  <div class="card-body box-profile">
    <div class="text-center">
      <img class="profile-user-img img-fluid img-circle"
           src="{{ URL::asset('rsc/dist/img/user1-128x128.jpg') }}"
           alt="User profile picture">
    </div>

    <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

    <p class="text-muted text-center">Software Engineer</p>

    <ul class="list-group list-group-unbordered mb-3">

      <li class="list-group-item">
        <a class="float-left" href="{{url('st/inicio')}}"><ion-icon name="arrow-forward">
          <b>Inicio</b>
        </a>
      </li>
      <li class="list-group-item" >
        <a class="float-left" href="{{url('st/perfil')}}"><ion-icon name="arrow-forward">
          <b>Perfil</b>
        </a>
      </li>
      <li class="list-group-item">
        <a class="float-left" href="{{url('st/sala')}}"><ion-icon name="arrow-forward">
          <b>Sala de estudio</b>
        </a>
      </li>
    </ul>

  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
