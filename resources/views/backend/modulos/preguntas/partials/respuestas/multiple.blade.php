<div class="card">
  <div class="card-header no-border">
    <h3 class="card-title">
      Respuesta Multiple
      <!--@{{a_resp_multiple}}-->
    </h3>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-striped table-valign-middle">
      <thead>
      <tr>
        <th>#</th>
        <th>Verdadera</th>
        <th>Respuesta</th>
        <th>Puntaje</th>
        <th>
          <button type="button" class="btn btn-outline-primary btn-sm float-left" v-on:click.prevent='addRespMultiple()'>
            <i class="fa fa-plus" ></i>
          </button>
        </th>
      </tr>
      </thead>
      <tbody>
        <tr v-for='(fila,index) in a_resp_multiple'>
          <td>
            @{{index}}
          </td>
          <td>
            <input type="checkbox"  v-model='fila.option'>
          </td>
          <td>
            <textarea class="form-control" rows="2" v-model='fila.respuesta'></textarea>
          </td>
          <td>
            <input type="number" class="form-control" name='puntaje'  v-model='fila.puntaje'>
          </td>
          <td>
            <button type="button" class="btn btn-outline-danger btn-sm float-left" v-if="fila.delete" v-on:click.prevent='removeRespMultiple(index)'>
              <i class="fa fa-remove" ></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
