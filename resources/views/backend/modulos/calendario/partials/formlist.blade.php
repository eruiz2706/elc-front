<div class="row" v-if="preload">
  <div class="d-block mx-auto" >
    <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
  </div>
</div>

<div class="callout callout-info">
  <i class="icon fa fa-info"></i> 
  Las siguientes etiquetas corresponden al tipo de actividad
  <span class="badge badge-info">Tareas</span>
  <span class="badge badge-success">Evaluaciones</span>
</div>

<div class="card card-primary">
  <div class="card-body p-0">
    <div id="calendar"></div>
  </div>
</div>

<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/calendario/lista.js') }}"></script>
@stop
