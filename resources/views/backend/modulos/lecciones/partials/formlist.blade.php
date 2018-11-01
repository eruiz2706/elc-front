

<div class="row" v-if="preload">
  <div class="d-block mx-auto" >
    <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
  </div>
</div>

<div class="card" v-if="!preload">
  <div class="card-header no-border">
    <h3 class="card-title">Lista de lecciones</h3>

    <div class="card-tools">
      <div class="btn-group">
        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <i class="fa  fa-bars"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right" role="menu" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(45px, 31px, 0px);">
          <a href="#" class="dropdown-item" v-on:click.prevent="redirectCrear()">Nueva leccion</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card" v-if="!preload" v-for="leccion in a_leccion">
  <div class="card-header no-border">
    <h5 class="card-title">@{{leccion.nombre}}</h5>
    <div class="card-tools">
      <div class="btn-group">
        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <i class="fa  fa-bars"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right" role="menu" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(45px, 31px, 0px);">
          <a href="#" class="dropdown-item" v-on:click.prevent="redirectEdit(leccion.id)">Editar</a>
        </div>
      </div>
    </div>

    <div class='row'>
      <div class="col-md-4 col-sm-6">
        <b>Creado :</b> @{{leccion.fecha_creacion}}
      </div>
      <div class="col-md-4 col-sm-6">
        <b>Tiempo de lectura :</b> @{{leccion.tiempolectura}} minutos
      </div>
    </div>
</div>

<!--<div class="card" v-if="!preload">
  <div class="card-header no-border">
    <h3 class="card-title">Lista de lecciones</h3>

    <div class="card-tools">
      <div class="btn-group">
        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <i class="fa  fa-bars"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right" role="menu" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(45px, 31px, 0px);">
          <a href="#" class="dropdown-item" v-on:click.prevent="redirectCrear()">Nueva leccion</a>
        </div>
      </div>
    </div>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-striped table-valign-middle ">
      <thead>
      <tr>
        <th>Nombre</th>
        <th>Tiempo de lectura</th>
        <th>Creado</th>
        <th>Acciones</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="leccion in a_leccion">
        <td>
          @{{leccion.nombre}}
        </td>
        <td>
          @{{leccion.tiempolectura}} minutos
        </td>
        <td>
          @{{leccion.fecha_creacion}}
        </td>
        <td>
          <a href="#" v-on:click.prevent="redirectEdit(leccion.id)" class="text-muted">
            <i class="fa fa-edit"></i> Editar
          </a>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</div>-->

<input type='hidden' name='idcurso' id='idcurso' value="{{$curso->id}}"></input>
<input type='hidden' name='idmodulo' id='idmodulo' value="{{$idmodulo}}"></input>
@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/lecciones/lista.js') }}"></script>
@stop
