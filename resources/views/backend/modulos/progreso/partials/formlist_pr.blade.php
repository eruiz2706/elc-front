<!-- Modal -->
<div class="modal fade" id="modal_progmod" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class='modal-header'>
          Progreso modulo<button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" style="height:350px;overflow-y: auto;">
        <div class="row" v-if="preloadmodal">
          <div class="d-block mx-auto" >
            <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
          </div>
        </div>

        <table class="table  table-valign-middle" v-if="!preloadmodal">
          <thead>
            <tr>
              <th>Estudiante</th>
              <th>Estado</th>
              <th>Lecciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="progmod in a_progmod">
                <td>
                  <img v-bind:src="base_url+'/'+progmod.imagen"  class="img-circle img-size-32 mr-2">
                  <span v-text='progmod.nombre'></span>
                </td>
                <td>
                    <small class="badge badge-success" v-if="estadoporcent(progmod.cantleccuser,progmod.cantlecc)"> Completo <span v-text='progmod.cantleccuser'></span>/<span v-text='progmod.cantlecc'></span></small>
                    <small class="badge badge-danger" v-if="!estadoporcent(progmod.cantleccuser,progmod.cantlecc)"> Incompleto <span v-text='progmod.cantleccuser'></span>/<span v-text='progmod.cantlecc'></span></small>
                </td>
                <td>
                  <div class="progress">
                    <div class="progress-bar bg-primary" v-bind:style="'width:'+porcent(progmod.cantleccuser,progmod.cantlecc)+'%'">Progreso <span v-text='porcent(progmod.cantleccuser,progmod.cantlecc)'></span>%</div>
                  </div>
                </td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>


<div class="card" v-for="(progreso,index) in a_progreso">
  <div class="card-header no-border">
    <h3 class="card-title" >
      <div class="progress-group">
          Modulo <span v-text='progreso.numero'></span> : <span v-text='progreso.nombre'></span>
          <span class="float-right">
            <span v-text='progreso.cant_leccuser'></span>/<b><span v-text='progreso.cant_user'></span></b>
            <button type="button" class="btn btn-tool" data-toggle="modal" v-on:click.prevent="progresomodulo(progreso.id)">
              <i class="fa fa-eye" style='font-size:20px'></i>
            </button>
          </span>

          <div class="progress">
            <div class="progress-bar bg-primary" v-bind:style="'width:'+porcent(progreso.cant_leccuser,progreso.cant_user)+'%'">Progreso modulo <span v-text='porcent(progreso.cant_leccuser,progreso.cant_user)'></span>%</div>
          </div>
        </div>
    </h3>


  </div>
  <div class="card-body">
      <div class="card" v-for="leccion in progreso.lecciones">
        <div class="card-header" style="padding:.2rem 1.25rem">
          <h5 class="card-title" style="font-size:1rem">
            <a data-toggle="collapse" v-bind:href="'#'+progreso.id+'-'+leccion.id" class="collapsed" aria-expanded="false">
            Leccion <span v-text='leccion.numero'></span> : <span v-text='leccion.nombre'></span>
            </a>
            <small class="badge badge-primary float-right">
              <i class="fa fa-clock-o"></i> <span v-text='leccion.tiempolectura'></span> minutos
            </small>
          </h5>
        </div>
        <div v-bind:id="progreso.id+'-'+leccion.id" class="panel-collapse in collapse" style="">
          <div class="card-body" v-html="leccion.descripcion">
          </div>
          <div class="card-footer">
            <a class="btn btn-outline-primary btn-sm" data-toggle="collapse" v-bind:href="'#'+progreso.id+'-'+leccion.id" class="collapsed" aria-expanded="false">
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
<script src="{{ URL::asset('js/be/modulos/progreso/lista_pr.js') }}"></script>
@stop
