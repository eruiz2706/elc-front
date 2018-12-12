<div class="card" v-if="nav_cursos.titulo !=''">
  <div class="card-header">
    <h3 class="card-title" v-text='nav_cursos.titulo'></h3>
  </div>
  <div class="card-body p-0">
    <ul class="nav nav-pills flex-column">
      <li class="nav-item" v-for='nav in nav_cursos.content' v-bind:class='isSelectCurso(nav.id)'>
        <a href="#" class="nav-link" v-bind:style="isSelectCurso2(nav.id)" v-on:click.prevent="setRedirect('cursos/gestion/'+nav.id)">
          <span v-text='nav.nombre'></span>
        </a>
      </li>
    </ul>
  </div>
</div>


@if(Session::get('rol')=='pa')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Parientes</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body p-0">
    <ul class="users-list clearfix">
      <li>
        <a href="{{url('/principalpa')}}">
        <img src="http://localhost/aulavirtual/public/img/avatar/5bfe03f8561bd2.49151940.png" alt="User Image">
        </a>
        <a class="users-list-name" href="{{url('/principalpa')}}">Alexander Pierce</a>
      </li>
      <li>
        <a href="{{url('/principalpa')}}">
        <img src="http://localhost/aulavirtual/public/img/avatar/5bfe03f8561bd2.49151940.png" alt="User Image">
        </a>
        <a class="users-list-name" href="{{url('/principalpa')}}">Alexander Pierce</a>
      </li>
    </ul>
    <!-- /.users-list -->
  </div>
</div>
@endif
