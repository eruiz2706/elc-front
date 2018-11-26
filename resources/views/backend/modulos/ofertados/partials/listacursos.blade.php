<div class="row">
  <div class='col-md-12'>
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
          <select class="form-control">
            <option>Seleccione el estado</option>
            <option>Abierto</option>
            <option>Cerrado</option>
          </select>
        </div>
    </div>
  </div>

  <div class="col-sm-6 col-md-4" v-for="curso in cursos">
    <div class="card" >
      <a href="#" v-on:click.prevent="detcurso(curso.id)">
      <img class="card-img-top" v-bind:src="base_url+'/'+curso.imagen" alt="@{{curso.nombre}}">
      </a>
      <div class="card-body">
        <h5 class="card-title" v-text='curso.nombre'></h5>
        <p class="card-text" v-text='curso.nombestado'></p>
      </div>
    </div>
  </div>
</div>

@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/ofertados/listacursos.js') }}"></script>
@stop
