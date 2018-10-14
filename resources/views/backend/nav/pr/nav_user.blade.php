<!-- Profile Image -->
<div class="card card-primary card-outline">
  <div class="card-body box-profile">
    <div class="text-center">
      <a href="{{url('/perfil')}}">
        <img class="profile-user-img img-fluid img-circle img-bordered-info"
             src="{{ URL::asset(Auth::user()->imagen) }}"
             alt="User avatar">
      </a>
    </div>

    <h3 class="profile-username text-center">
      <a href="{{url('/perfil')}}" style='color:#6c757d!important'>{{ Auth::user()->nombre}}</a>
    </h3>
    <p class="text-muted text-center" style="margin-top:-10px">
      <a href="{{url('/perfil')}}" style='color:#6c757d!important'>AJ132550</a>
    </p>

    <ul class="nav nav-pills flex-column">
        <li class="nav-item active">
          <a href="{{url('principal')}}" class="nav-link">
            <i class="fa fa-inbox"></i> Ultimas noticias
          </a>
        </li>
    </ul>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
