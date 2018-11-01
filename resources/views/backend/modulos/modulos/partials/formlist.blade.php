
<div class="row" v-if="preload">
  <div class="d-block mx-auto" >
    <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
  </div>
</div>

<div class="card" v-if="!preload">
  <div class="card-header no-border">
    <h3 class="card-title">Lista de modulos</h3>

    <div class="card-tools">
      <div class="btn-group">
        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <i class="fa  fa-bars"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right" role="menu" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(45px, 31px, 0px);">
          <a href="#" class="dropdown-item" v-on:click.prevent="redirectCrear()">Nuevo modulo</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card" v-if="!preload" v-for="modulo in a_modulos">
  <div class="card-header no-border">
    <h5 class="card-title">@{{modulo.nombre}}</h5>
    <div class="card-tools">
      <div class="btn-group">
        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <i class="fa  fa-bars"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right" role="menu" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(45px, 31px, 0px);">
          <a href="#" class="dropdown-item" v-on:click.prevent="redirectEdit(modulo.id)">Editar</a>
          <a href="#" class="dropdown-item" v-on:click.prevent="redirectLecciones(modulo.id)">Abrir lecciones</a>
        </div>
      </div>
    </div>

    <div class='row'>
      <div class="col-md-4 col-sm-6">
        <b>Creado :</b> @{{modulo.fecha_creacion}}
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Lecciones :</b> @{{modulo.numlec}}
      </div>
    </div>
</div>

<!--<div class="card" v-if="!preload">
  <div class="card-header no-border">
    <h3 class="card-title">Lista de modulos</h3>

    <div class="card-tools">
      <div class="btn-group">
        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <i class="fa  fa-bars"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right" role="menu" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(45px, 31px, 0px);">
          <a href="#" class="dropdown-item" v-on:click.prevent="redirectCrear()">Nuevo modulo</a>
        </div>
      </div>
    </div>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-striped table-valign-middle ">
      <thead>
      <tr>
        <th>Nombre</th>
        <th>Creado</th>
        <th>Acciones</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="modulo in a_modulos">
        <td>
          @{{modulo.nombre}}
        </td>
        <td>
          @{{modulo.fecha_creacion}}
        </td>
        <td>
          <a href="#" v-on:click.prevent="redirectEdit(modulo.id)" class="text-muted">
            <i class="fa fa-edit"></i> Editar
          </a>
          <a href="#" v-on:click.prevent="redirectLecciones(modulo.id)" class="text-muted">
            <i class="fa fa-folder-open-o"></i> Lecciones
          </a>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</div>-->

<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/modulos/lista.js') }}"></script>
@stop
