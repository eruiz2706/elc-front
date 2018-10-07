<!-- Main content -->
<div class="invoice p-3 mb-3">
  <!-- title row -->
  <div class="row">
    <div class="col-12">
      <h4>
        <i class="fa fa-calculator"></i>RENOVAR SUSCRIPCION
        <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;" >
          <i class="fa fa-credit-card"></i> Pagar

        </button>
      </h4>

    </div>
    <!-- /.col -->
  </div>

  <div class="row">
    <!-- accepted payments column -->
    <div class="col-6">
      <p class="lead">Metodos de pago:</p>
      <img src="{{ URL::asset('rsc/dist/img/credit/visa.png') }}" alt="Visa">
      <img src="{{ URL::asset('rsc/dist/img/credit/mastercard.png') }}" alt="Mastercard">
      <img src="{{ URL::asset('rsc/dist/img/credit/american-express.png') }}" alt="American Express">
      <img src="{{ URL::asset('rsc/dist/img/credit/paypal2.png') }}" alt="Paypal">
    </div>
    <!-- /.col -->
    <div class="col-6">
      <p class="lead">Vence : 2018-09-01</p>
      <div class="table-responsive">
        <table class="table">
          <tbody>
            <tr>
              <th>Total:</th>
              <td>50000</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->


</div>
<!-- /.invoice -->

<!-- Main content -->
<div class="invoice p-3 mb-3">
  <!-- title row -->
  <div class="row">
    <div class="col-12">
      <h4>
        <i class="fa fa-calculator"></i>MIS FACTURAS
      </h4>
    </div>
    <!-- /.col -->
  </div>

  <!-- Table row -->
  <div class="row">
    <div class="col-12 table-responsive">
      <table class="table table-striped">
        <thead>
        <tr>
          <th>Fecha Pago</th>
          <th>Fecha Vencimiento</th>
          <th>Valor</th>
        </tr>
        </thead>
        <tbody>
        <tr >
          <td></td>
          <td></td>
          <td></td>
        </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->


</div>
<!-- /.invoice -->