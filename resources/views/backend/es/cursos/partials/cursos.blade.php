<div class="row">
  <div class='col-md-12'>

  </div>

  <div class="col-sm-6 col-md-4" v-for="curso in cursos">
    <div class="card" >
      <a href="#" v-on:click.prevent="detcurso(curso.id)">
      <img class="card-img-top" src="{{ URL::asset('rsc/dist/img/photo1.png') }}" alt="@{{curso.nombre}}">
      </a>
      <div class="card-body">
        <h5 class="card-title">@{{curso.nombre}} </h5>
        <!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
      </div>
    </div>
  </div>
</div>
