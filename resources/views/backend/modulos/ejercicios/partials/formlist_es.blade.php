<!-- Modal -->
<div class="modal fade" id="modal_ejercicio" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class='modal-header' style='padding:0px'>
        <h5 class="modal-title" style="padding-top:5px;padding-left:10px">
          <strong>
          <span id="minute"></span> : <span id="second"></span>
          </strong>
        </h5>
        <ul class="nav nav-pills ml-auto" >
          <li class="nav-item" v-for="(examen,index) in a_examen">
            <a class="nav-link  show" v-bind:href="'#tab_'+index" data-toggle="tab" v-bind:class="(index==0) ? 'active':''" v-text="index+1"></a>
          </li>
        </ul>
      </div>
      <div class="modal-body" style="height:450px;overflow-y: auto;">
        <div class="row" v-if="preloadmodal">
          <div class="d-block mx-auto" >
            <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
          </div>
        </div>
        <div class="tab-content">
          <!--<p>@{{a_examen}}</p>-->
          <div class="tab-pane show" v-bind:class="(index==0) ? 'active':''" v-bind:id="'tab_'+index" v-for="(examen,index) in a_examen">
            <strong v-text="(index+1)+')'+examen.nombre"></strong>
            <p v-html="examen.descripcion"></p>
            <p v-html="examen.textorellenar"></p>

            <hr>
            <div v-for='(fila,i) in examen.respuestas' v-if="examen.tipo=='abierta'">
              <div class="form-group">
                <textarea rows="3" placeholder="Escribe tu respuesta" class="form-control" v-model="fila.respuesta">
                </textarea>
              </div>
            </div>

            <table class="table no-border" v-if="examen.tipo=='unica'">
              <tbody>
                <tr v-for='(fila,i) in examen.respuestas'>
                  <td>
                    <input type="radio" v-bind:id="fila.id" v-bind:value="fila.id" v-model="examen.idunica">
                  </td>
                  <td>
                    <p v-text="fila.respuesta"></p>
                  </td>
                </tr>
              </tbody>
            </table>

            <table class="table no-border" v-if="examen.tipo=='multiple'">
              <tbody>
                <tr v-for='(fila,i) in examen.respuestas'>
                  <td>
                    <input type="checkbox"  v-model='fila.seleccion'>
                  </td>
                  <td>
                    <p v-text="fila.respuesta"></p>
                  </td>
                </tr>
              </tbody>
            </table>

            <table class="table no-border" v-if="examen.tipo=='relacionar'">
              <tbody>
                <tr v-for='(fila,i) in examen.respuestas'>
                  <td>
                    <p v-text="fila.respuesta"></p>
                  </td>
                  <td>
                    <div class="form-group">
                      <select class='form-control' v-model='fila.relacionar2'>
                        <option value="''"> - </option>
                        <option v-bind:value='select.relacionar' v-text='select.relacionar' v-for='select in examen.respuestas'></option>
                      </select>
                  </div>
                  </td>
                </tr>
              </tbody>
            </table>

            <table class="table no-border" v-if="examen.tipo=='rellenar'">
              <tbody>
                <tr v-for='(fila,i) in examen.respuestas'>
                  <td>
                    <p v-text="fila.respuesta+')'"></p>
                  </td>
                  <td>
                    <input type="text" class="form-control" v-model="fila.relacionar2">
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class='modal-footer'>
        <button type="button" class="btn btn-outline-primary btn-sm float-left" :disabled="loader_finalizar" v-on:click.prevent="finalizar()">
          Finalizar y enviar
          <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_finalizar"></i>
        </button>
      </div>
  </div>
</div>
</div>

<div class="row" v-if="preload">
  <div class="d-block mx-auto" >
    <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
  </div>
</div>

<div class="card" v-if="!preload" v-for="ejercicio in a_ejercicios">
  <div class="card-header no-border">
    <h5 class="card-title">@{{ejercicio.nombre}}</h5>

    <div class='row'>
      <div class="col-md-4 col-sm-6">
        <b>Inicia :</b> @{{ejercicio.fecha_inicio}}
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Duracion :</b> @{{ejercicio.duracion}} minutos
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Estado :</b>
        <small class="badge badge-danger">Pendiente</small>
      </div>
    </div>
  </div>

  <div class="card-body">
    <button type="button" class="btn btn-outline-primary btn-sm float-left" v-on:click.prevent="comenzar(ejercicio.id)">
      Comenzar
    </button>
  </div>
</div>

<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/ejercicios/lista_es.js') }}"></script>
@stop
