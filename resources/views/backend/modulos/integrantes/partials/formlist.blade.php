<div class="row" v-if="preload">
  <div class="d-block mx-auto" >
    <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
  </div>
</div>

<div class="card" v-if="!preload">
  <div class="card-body table-responsive p-0">
    <table class="table table-striped table-valign-middle ">
      <thead>
      <tr>
        <th></th>
        <th>Nombre</th>
        <th>Perfil</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="integrante in a_integrantes">
        <td>
          <img v-bind:src="base_url+'/'+integrante.imagen" alt="Product 1" class="img-circle img-size-64 mr-2">
        </td>
        <td>@{{integrante.nombre}}</td>
        <td>
          @{{integrante.perfil}}
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</div>

<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/integrantes/lista.js') }}"></script>
@stop
