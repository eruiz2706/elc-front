
<div v-for="(modulo, index) in a_modulos">
<h4>@{{modulo.nombre}}</h4>
<div id="accordion">
  <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
  <div class="card" v-for="(leccion, indexlec) in modulo.lecciones">
    <div class="card-header">
      <h4 class="card-title">
        <a data-toggle="collapse" data-parent="#accordion" v-bind:href="'#'+index" class="collapsed" aria-expanded="false">
          @{{leccion.nombre}}
        </a>
        <small class="badge badge-primary float-right"><i class="fa fa-clock-o"></i> 30 minutos</small>
      </h4>
    </div>
    <div v-bind:id="index" class="panel-collapse in collapse" style="">
      <div class="card-body" v-html="leccion.descripcion">
      </div>
      <div class="card-footer">
          <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="collapse" data-parent="#accordion" v-bind:href="'#'+index" class="collapsed" aria-expanded="false" v-on:click="finalizar()">Finalizar</button>
      </div>
    </div>
  </div>
</div>
</div>

@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/modulos/progreso.js') }}"></script>
@stop
