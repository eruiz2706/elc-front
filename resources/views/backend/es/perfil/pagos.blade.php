<!-- Main content -->
<div class="invoice p-3 mb-3">
  <!-- title row -->
  <div class="row">
    <div class="col-12">
      <h4>
        <i class="fa fa-calculator"></i>RENOVAR SUSCRIPCION
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

      <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
        plugg
        dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
      </p>

    </div>
    <!-- /.col -->
    <div class="col-6">
      <p class="lead">Vence : @{{user.fecha_vencimiento}}</p>
      <div class="table-responsive">
        <table class="table">
          <tbody>
            <tr>
              <th>Total:</th>
              <td>$@{{vrlsuscrip}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- this row will not appear when printing -->
  <div class="row no-print">
    <div class="col-12">
      <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;" :disabled="loader_pagar" v-on:click="pagar">
        <i class="fa fa-credit-card"></i> Pagar
        <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_pagar"></i>
      </button>
    </div>
  </div>
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
        <tr v-for="pago in pagos">
          <td>@{{pago.fecha_creacion}}</td>
          <td>@{{pago.fecha_vencimiento}}</td>
          <td>$@{{pago.valor}}</td>
        </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->


</div>
<!-- /.invoice -->
