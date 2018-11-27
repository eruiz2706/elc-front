<!-- Modal -->
<div class="modal fade" id="modal_revision" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class='modal-header'>
          Revision<button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" style="height:450px;overflow-y: auto;">
        <div class="row" v-if="preloadmodal">
          <div class="d-block mx-auto" >
            <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
          </div>
        </div>

        <div v-for='revision in a_revision'>
          <strong v-text="revision.nombre"></strong>
          <p v-html="revision.descripcion"></p>
          <p text="revision.respuesta"></p>
          <div class="form-group">
            <p v-text='revision.nombre'></p>
          </div>
          <hr>
        </div>


      </div>

      <div class='modal-footer'>
        <button type="button" class="btn btn-outline-primary btn-sm float-left" :disabled="loader_revision" v-on:click.prevent='updrevision()'>
          Enviar revision
          <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_revision"></i>
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

<div class="row" v-if="!preload">
  <div class="col-sm-6">
    <h5 class="m-0 text-dark">
      <strong>Entrega: </strong><span v-text="o_ejercicio.nombre"></span>
      <button type="button" class="btn btn-tool" v-on:click.prevent="redirectVolver()">
        <i class="fa fa-arrow-circle-left"  style="font-size: 24px;"></i>
      </button>
    </h5>
  </div>
</div>

<div class="card" v-if="!preload" v-for="ejercicio in a_ejercicios">
  <div class="card-header no-border">
    <h5 class="card-title" style='cursor:pointer'  v-text='ejercicio.nombre'></h5>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" v-on:click.prevent="openRevisar(ejercicio.ident)">
        <i class="fa  fa-eye" style="font-size: 20px;"></i>
      </button>
    </div>

    <div class='row'>
      <div class="col-md-4 col-sm-6">
        <b>Estado :</b>
        <small v-bind:class="'badge badge-'+ejercicio.status"><span v-text='ejercicio.nombestado'></span></small>
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Calificacion :</b> <span v-text='ejercicio.notaes'></span>/<span v-text='ejercicio.calificacion'></span>
      </div>
    </div>
</div>
</div>

<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
<input type='hidden' name='id' id='id' value="{{$id}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/ejercicios/listaent.js') }}"></script>
@stop
