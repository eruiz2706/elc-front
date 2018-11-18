<div class="card">
  <div class="card-body table-responsive p-0">
    <table class="table table-striped table-valign-middle">
      <thead>
      <tr>
        <th>Posibles respuestas</th>
        <th>Corresponde a</th>
        <th>Puntaje</th>
        <th>
          <button type="button" class="btn btn-outline-primary btn-sm float-left" v-on:click.prevent='addRespRelacionar()'>
            <i class="fa fa-plus" ></i>
          </button>
        </th>
      </tr>
      </thead>
      <tbody>
        <tr v-for='(fila,index) in a_resp_relacionar'>
          <td>
            <textarea class="form-control" rows="2" cols="50" v-model='fila.respuesta'></textarea>
          </td>
          <td>
            <textarea class="form-control" rows="2" cols="50" v-model='fila.relacionar'></textarea>
          </td>
          <td>
            <input type="number" class="form-control" name='puntaje'  v-model='fila.puntaje'>
          </td>
          <td>
            <button type="button" class="btn btn-outline-danger btn-sm float-left" v-if="fila.delete" v-on:click.prevent='removeRespRelacionar(index)'>
              <i class="fa fa-remove" ></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
