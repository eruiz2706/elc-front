<div class="row">
  <div class='col-md-12'>
    <div class="card">
          <!-- /.card-header -->
              <div class="card-body">
                <div class='row'>
                  <div class='col-md-6'>
                  <div class="form-group">
                    <select class="form-control">
                      <option>Buscar por categoria</option>
                      <option>option 2</option>
                      <option>option 3</option>
                      <option>option 4</option>
                      <option>option 5</option>
                    </select>
                  </div>
                  </div>
                  <div class='col-md-6'>
                  <div class="form-group">
                    <select class="form-control">
                      <option>Buscar por estado</option>
                      <option>option 2</option>
                      <option>option 3</option>
                      <option>option 4</option>
                      <option>option 5</option>
                    </select>
                  </div>
                  </div>
              </div>
              <button type="button" class="btn btn-primary btn-sm float-right" style="margin-right: 5px;">Buscar</button>
              </div>
            </div>
  </div>

  <div class="col-sm-6 col-md-4" v-for="curso in cursos">
    <div class="card" >
      <a href="#" v-on:click.prevent="detcurso(curso.id)">
      <img class="card-img-top" src="{{ URL::asset('rfend/images/course_4.jpg') }}" alt="@{{curso.nombre}}">
      </a>
      <div class="card-body">
        <h5 class="card-title">@{{curso.nombre}} </h5>
        <!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>-->
      </div>
    </div>
  </div>
</div>

@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/ofertados/listacursos.js') }}"></script>
@stop
