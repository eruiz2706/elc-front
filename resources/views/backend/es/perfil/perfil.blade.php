<!--<div class="callout callout-success">-->
<div class="callout">
  <div class="row">
    <div class='col-md-12'>
      <h4>
        <i class="fa fa-user"></i>DATOS PERSONALES
      </h4>
    </div>
    <div class="col-md-3">
                  <img class="img-fluid" src="{{ URL::asset('rsc/dist/img/photo1.png') }}" alt="Photo">
                  <button type="button" class="btn btn-block btn-outline-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Cargar Imagen</button>
    </div>

    <div class="col-md-9">
          <div class="table-responsive">
            <table class="table">
              <tbody><tr>
                <th>Nombre:</th>
                <td>@{{user.nombre}}</td>
              </tr>
              <tr>
                <th>Telefono</th>
                <td>657-03-49</td>
              </tr>
              <tr>
                <th>Ciudad</th>
                <td>Cali valle del cauca</td>
              </tr>
              <tr>
                <th>Direccion</th>
                <td>Carrera 10#14-88</td>
              </tr>
              <tr>
                <th>Email</th>
                <td>@{{user.email}}</td>
              </tr>
              <tr>
                <th>Facebook</th>
                <td></td>
              </tr>
              <tr>
                <th>Linkedin</th>
                <td></td>
              </tr>
              <tr>
                <th>Biografia</th>
                <td>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has </td>
              </tr>
              <tr>
                <th><button type="button" class="btn btn-block btn-outline-primary btn-sm">Editar</button></th>
                <td><button type="button" class="btn btn-outline-primary btn-sm float-right">Cambiar Contraseña</button></td>
              </tr>
            </tbody></table>
          </div>
    </div>
  </div>
</div>
