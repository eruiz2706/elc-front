
<div class="row" v-if="preload">
  <div class="d-block mx-auto" >
    <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
  </div>
</div>

<div class="row" v-if="!preload">
  <div class="col-sm-6">
    <h5 class="m-0 text-dark">
      <strong>Preguntas </strong>
    </h5>
  </div>
  <div class='col-md-6'>
    <button type="button" class="btn btn-tool float-right" v-on:click.prevent="redirectCrear()">
      <i class="fa fa-plus-circle"  style="font-size: 24px;"></i>
    </button>
    <button type="button" class="btn btn-tool float-right" v-on:click.prevent="redirectVolver()">
      <i class="fa fa-arrow-circle-left" style="font-size: 24px;"></i>
    </button>
  </div>
</div>


<div class="card">
  <div class="card-body p-0">
    <table class="table table-striped table-valign-middle">
      <thead>
      <tr>
        <th>Nombre</th>
        <th>Tipo</th>
        <th>Acciones</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="pregunta in a_preguntas">
        <td>
          @{{pregunta.nombre}}
        </td>
        <td>
          <a href="#" v-on:click.prevent="redirectEdit(pregunta.id)" class="text-muted">
            <i class="fa fa-edit"></i> Editar
          </a>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</div>

<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
<input type='hidden' name='idejerc' id='idejerc' value="{{$idejerc}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/preguntas/lista.js') }}"></script>
@stop
