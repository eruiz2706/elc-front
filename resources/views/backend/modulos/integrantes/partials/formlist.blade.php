<div class="row" v-if="preload">
  <div class="d-block mx-auto" >
    <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
  </div>
</div>

<div class='row'>
  <div class='col-md-6 col-sm-12' v-for="integrante in a_integrantes">
    <div class="card" v-if="!preload" >
      <div class="card-body">
        <div class="post">
          <div class="user-block">
            <img class="img-circle img-bordered" v-bind:src="base_url+'/'+integrante.imagen" alt="user image">
            <span class="username">
              <a>@{{integrante.nombre}}</a>
            </span>
            <span class="description">@{{integrante.perfil}}</span>
            <span class="description">Ultimo ingreso: @{{integrante.fecha_ultimo_ingreso}}</span>
            <span class="description">Tiempo de uso: @{{integrante.tiempouso}} minutos</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--<div class="card" v-if="!preload">
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
</div>-->

<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/integrantes/lista.js') }}"></script>
@stop
