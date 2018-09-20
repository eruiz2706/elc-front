<div class="callout callout-info">
  <div class="row">
    <div class="col-md-6">
                  <img class="img-fluid" src="{{ URL::asset('rsc/dist/img/photo1.png') }}" alt="Photo">
                  <button type="button" class="btn btn-block btn-outline-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Cargar Imagen</button>
    </div>

    <div class="col-md-6">
          <p class="lead">Datos Personales</p>

          <div class="table-responsive">
            <table class="table">
              <tbody><tr>
                <th style="width:50%">Nombre:</th>
                <td>@{{user.name}}</td>
              </tr>
              <tr>
                <th>Telefono</th>
                <td></td>
              </tr>
              <tr>
                <th>Direccion</th>
                <td></td>
              </tr>
              <tr>
                <th>Email</th>
                <td>@{{user.email}}</td>
              </tr>
              <tr>
                <th><button type="button" class="btn btn-block btn-outline-primary btn-sm">Editar</button></th>
                <td></td>
              </tr>
            </tbody></table>
          </div>
    </div>
  </div>
</div>
