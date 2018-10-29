<div class="card">
  <div class="card-header no-border">
    <h3 class="card-title">
      Respuesta Rellenar
      <!--@{{a_resp_rellenar}}-->
      <!--@{{resp_rellenar}}-->
    </h3>
  </div>
  <div class="card-body table-responsive p-0">
    <div class="form-group">
      <label>Parar marcar los puntos de separacion utilize [palabra]</label>
      <textarea class="form-control" rows="4" placeholder="Escribe el texto" v-model='resp_rellenar' @keyup="obtenerRellenar()" ></textarea>
    </div>

    <table class="table table-striped table-valign-middle">
      <thead>
      <tr>
        <th>Respuesta</th>
        <th>Puntaje</th>
      </tr>
      </thead>
      <tbody>
        <tr v-for='(fila,index) in a_resp_rellenar'>
          <td>
            <input type="text" class="form-control" name='respuesta' readonly  v-model='fila.respuesta'>
          </td>
          <td>
            <input type="number" class="form-control" name='puntaje'  v-model='fila.puntaje'>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
