
<div class="card" v-if="nav_options.titulo !=''">
  <div class="card-header">
    <h3 class="card-title" v-text='nav_options.titulo'></h3>
  </div>
  <div class="card-body p-0">
    <ul class="nav nav-pills flex-column">
      <li class="nav-item" v-for='nav in nav_options.content'>
        <a href="#" class="nav-link" v-on:click.prevent="setRedirect(nav.url)">
          <span v-text='nav.nombre'></span>
        </a>
      </li>
    </ul>
  </div>
</div>

<div class="card" v-if="nav_cursos.titulo !=''">
  <div class="card-header">
    <h3 class="card-title" v-text='nav_cursos.titulo'></h3>
  </div>
  <div class="card-body p-0">
    <ul class="nav nav-pills flex-column">
      <li class="nav-item" v-for='nav in nav_cursos.content' v-bind:class='isSelectCurso(nav.id)'>
        <a href="#" class="nav-link" style="line-height:16px;" v-bind:style="isSelectCurso2(nav.id)" v-on:click.prevent="setRedirect('cursos/gestion/'+nav.id)">
          <span v-text='nav.nombre'></span>
        </a>
      </li>
    </ul>
  </div>
</div>
