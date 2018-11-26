<!--@{{a_resp_rellenar}}
@{{resp_rellenar}}-->
<div class="card">
  <div class="card-body table-responsive p-0">
    <div class="form-group">
      <strong style='padding:5px'>Parar marcar los puntos de separacion utilize [palabra]</strong>
      <textarea class="form-control" rows="4" placeholder="Escribe el texto" v-model='resp_rellenar' @keyup="obtenerRellenar()" ></textarea>
    </div>

    <table class="table table-striped table-valign-middle">
      <thead>
      <tr>
        <th>Opcion</th>
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
            <input type="text" class="form-control" name='relacionar'  v-model='fila.relacionar'>
          </td>
          <td>
            <input type="number" class="form-control" name='puntaje'  v-model='fila.puntaje'>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
