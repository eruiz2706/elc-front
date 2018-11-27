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
              <a><span v-text='integrante.nombre'></span></a>
            </span>
            <span class="description" v-text='integrante.perfil'></span>
            <span class="description">Ultimo ingreso: <span v-text='integrante.fecha_ultimo_ingreso'></span></span>
            <span class="description">Tiempo de uso: <span v-text='integrante.tiempouso'></span> minutos</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/integrantes/lista.js') }}"></script>
@stop
