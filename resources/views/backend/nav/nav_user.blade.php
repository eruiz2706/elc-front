<!-- Profile Image -->
<div class="card card-primary card-outline">
  <div class="card-body box-profile">
    <div class="text-center">
      <a href="#" v-on:click.prevent="setRedirect('perfil')">
        <img class="profile-user-img img-fluid img-circle"
             v-bind:src="base_url+'/'+user.imagen"
             alt="User avatar">
      </a>
    </div>

    <h3 class="profile-username text-center">
      <a href="#" style='color:#6c757d!important' v-on:click.prevent="setRedirect('perfil')">
        <span v-text='user.nombre'></span>
      </a>
    </h3>
    <p class="text-muted text-center" style="margin-top:-10px">
      <a href="#" style='color:#6c757d!important' v-on:click.prevent="setRedirect('perfil')">AJ132550</a>
    </p>

    <ul class="nav nav-pills flex-column">
        <li class="nav-item active" v-for='nav in nav_user'>
          <a href="#" class="nav-link" v-on:click.prevent="setRedirect(nav.url)">
            <i v-bind:class='nav.icono'></i> <span v-text='nav.nombre'><span>
          </a>
        </li>
    </ul>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
