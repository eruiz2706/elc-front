<div class="card">
  <div class="card-header no-border">
    <h3 class="card-title">
      Respuesta Unica
      <!--@{{a_resp_unica}}-->
      <!--@{{radio_unica}}-->
    </h3>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-striped table-valign-middle">
      <thead>
      <tr>
        <th>Verdadera</th>
        <th>Respuesta</th>
        <th>Puntaje</th>
        <th>
          <button type="button" class="btn btn-outline-primary btn-sm float-left" v-on:click.prevent='addRespUnica()'>
            <i class="fa fa-plus" ></i>
          </button>
        </th>
      </tr>
      </thead>
      <tbody>
        <tr v-for='(fila,index) in a_resp_unica'>
          <td>&nbsp;&nbsp;
              <input type="radio" class="form-check-input float-center" v-bind:id="fila.id" v-bind:value="fila.id" v-model='radio_unica'>
          </td>
          <td>
            <textarea class="form-control" rows="2" v-model='fila.respuesta'></textarea>
          </td>
          <td>
            <input type="number" class="form-control" name='puntaje'  v-model='fila.puntaje'>
          </td>
          <td>
            <button type="button" class="btn btn-outline-danger btn-sm float-left" v-if="fila.delete" v-on:click.prevent='removeRespUnica(index)'>
              <i class="fa fa-remove" ></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
