

<div class="row" v-if="preload">
  <div class="d-block mx-auto" >
    <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
  </div>
</div>

<div class="card">
  <div class="card-header no-border">
    <h3 class="card-title">Lista de modulos</h3>

    <div class='card-tools'>
      <button type="button" class="btn float-right btn-primary btn-sm" v-on:click.prevent="crear()">Crear modulo</button>
    </div>
  </div>
  <div class="card-body p-0">
    <table class="table table-striped table-valign-middle">
      <thead>
      <tr>
        <th>Nombre</th>
        <th>Opciones</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="modulo in a_modulos">
        <td>
          @{{modulo.nombre}}
        </td>
        <td>
          <a href="#" class="text-muted">
            <i class="fa fa-edit"></i> Editar
          </a>
          <a href="#" v-bind:href="base_url+'/modulos/abrir/'+modulo.id" class="text-muted">
            <i class="fa fa-folder-open-o"></i> Lecciones
          </a>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</div>


@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/modulos/lista.js') }}"></script>
@stop
