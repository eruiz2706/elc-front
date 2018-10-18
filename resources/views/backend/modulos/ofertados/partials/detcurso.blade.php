
<div class="card">
  <div class="card-header card-header-cuorse">
    <h2 class="card-title-course">
      @{{o_curso.nombre}}
    </h2>
  </div>

  <div class="card-body" >
    <div class="row">
      <!-- accepted payments column -->
      <div class="col-md-8">
        <iframe class="img-fluid" style='width:100%;height:400px' frameborder="0" allowfullscreen allow="autoplay; encrypted-media"
          v-bind:src="o_curso.urlvideo">
        </iframe>
        <!--<img src="{{ URL::asset('rsc/dist/img/photo1.png') }}" alt="Photo" class="img-fluid">-->
      </div>
      <!-- /.col -->
      <div class="col-md-4">
        <div class="table-responsive">
          <table class="table">
            <tbody>
            <tr>
                <td>
                    <img src="{{ URL::asset('rsc/dist/img/photo3.jpg') }}" alt="Ample Admin" class="media-object" style="width: 150px;height: auto;border-radius: 4px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
                </td>
            </tr>
            <tr>
              <th>FECHA INICIO</th>
            </tr>
            <tr>
              <td>@{{o_curso.fecha_inicio}}</td>
            </tr>
            <tr>
              <th>FECHA FINALIZACION</th>
            </tr>
            <tr>
              <td>@{{o_curso.fecha_finalizacion}}</td>
            </tr>
            <tr>
              <th colspan='2'>
                <button type="button" class="btn btn-block btn-outline-primary btn-sm" style="margin-right: 5px;" :disabled="loader_suscrip" v-on:click.prevent="suscribirse()">
                <i class="fa fa-thumbs-o-up"></i> Unirse
                <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_suscrip"></i>
                </button>
              </td>
            </tr>
          </tbody></table>
        </div>
      </div>
      <!-- /.col -->
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <h3 class="card-title">
      Plan de Estudio
    </h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body" v-html="o_curso.plan_estudio">
  </div>
  <!-- /.card-body -->
</div>
<input type='hidden' name='id' id='id' value="{{$idcurso}}"></input>
</div>

@section('scripts')
@parent
<script src="{{ URL::asset('js/be/modulos/ofertados/detcurso.js') }}"></script>
@stop
