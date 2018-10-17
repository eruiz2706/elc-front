<div class="row" v-if="preload">
  <div class="d-block mx-auto" >
    <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
  </div>
</div>

<div class="card">
  <div class="card-header no-border">
    <h3 class="card-title">Lista Cursos</h3>
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
      <tr v-for="curso in a_curso">
        <td>
          <img src="{{ URL::asset('rsc/dist/img/default-150x150.png') }}" alt="Product 1" class="img-circle img-size-32 mr-2">
          @{{curso.nombre}}
        </td>
        <td>
          <a href="#" class="text-muted" v-bind:href="base_url+'/cursos/v_editar/'+curso.id">
            <i class="fa fa-edit"></i> Editar
          </a><br>
          <a href="#" v-bind:href="base_url+'/cursos/abrir/'+curso.id" class="text-muted">
            <i class="fa fa-folder-open-o"></i> Abrir
          </a>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</div>
