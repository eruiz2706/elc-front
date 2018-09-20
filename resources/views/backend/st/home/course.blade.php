<div class="row">
  <div class="col-sm-6 col-md-4" v-for="course in courses">
    <div class="card" >
      <img class="card-img-top" src="{{ URL::asset('rsc/dist/img/photo1.png') }}" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">@{{course.name}}</h5>
        <!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
        <a href="#" class="btn btn-primary">Registrate</a>
      </div>
    </div>
  </div>
</div>
