
<div class="card" v-for="(progreso,index) in a_progreso">
  <div class="card-header no-border">
    <h3 class="card-title" >
      <div class="progress-group">
          Modulo <span v-text='progreso.numero'></span> : <span v-text='progreso.nombre'></span>
          <span class="float-right">
            <span v-text='progreso.cantlec_leidas'></span>/<b><span v-text='progreso.cantlec'></span></b>
          </span>
          <div class="progress">
            <div class="progress-bar bg-primary" v-bind:style="'width:'+porcent(progreso.cantlec_leidas,progreso.cantlec)+'%'">Progreso modulo <span v-text='porcent(progreso.cantlec_leidas,progreso.cantlec)'></span>%</div>
          </div>
        </div>
    </h3>


  </div>
  <div class="card-body">
      <div class="card" v-for="leccion in progreso.lecciones">
        <div class="card-header" style="padding:.2rem 1.25rem">
          <h5 class="card-title" style="font-size:1rem">
            <a data-toggle="collapse" v-bind:href="'#'+progreso.id+'-'+leccion.id" class="collapsed" aria-expanded="false" v-if="leccion.leido">
            Leccion <span v-text='leccion.numero'></span> : <span v-text='leccion.nombre'></span> <i class="fa fa-check" v-if="leccion.leido"></i>
            </a>
            <small class="badge badge-primary float-right" v-if="leccion.leido">
              <i class="fa fa-clock-o"></i> <span v-text='leccion.tiempolectura'></span> minutos
            </small>

            <a data-toggle="collapse" v-bind:href="'#'+progreso.id+'-'+leccion.id" class="collapsed" aria-expanded="false" style='color:grey' v-if="!leccion.leido">
              Leccion <span v-text='leccion.numero'></span> : <span v-text='leccion.nombre'></span> <i class="fa fa-check" v-if="leccion.leido"></i>
            </a>
            <small class="badge badge-default float-right" v-if="!leccion.leido">
              <i class="fa fa-clock-o"></i> <span v-text='leccion.tiempolectura'></span> minutos
            </small>
          </h5>
        </div>
        <div v-bind:id="progreso.id+'-'+leccion.id" class="panel-collapse in collapse" style="">
          <div class="card-body" v-html="leccion.descripcion">
          </div>
          <div class="card-footer">
            <a class="btn btn-outline-primary btn-sm" data-toggle="collapse" v-bind:href="'#'+progreso.id+'-'+leccion.id" class="collapsed" aria-expanded="false" v-on:click.prevent="leccionLeida(progreso.id,leccion.id,leccion.leido)">
              Finalizar
            </a>

          </div>
        </div>
      </div>
  </div>
</div>



<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/progreso/lista.js') }}"></script>
@stop
