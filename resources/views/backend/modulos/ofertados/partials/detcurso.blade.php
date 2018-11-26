
<div class="card">
  <div class="card-header card-header-cuorse">
    <h2 class="card-title-course" v-text='o_curso.nombre'></h2>
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
          <table class="table no-border">
            <tbody>
            <tr>
                <td>
                    <img v-bind:src="base_url+'/'+o_curso.imagen"  alt="Ample Admin" class="media-object" style="width: 100%;height: auto;border-radius: 4px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
                </td>
            </tr>
            <tr>
              <td>
                <p style='padding:0px'><strong>FECHA INICIO</strong></p>
                <span v-text='o_curso.fecha_inicio'></span>
              </td>
            </tr>
            <tr>
              <td>
                <p><strong>FECHA FINALIZACION</strong></p>
                <span v-text='o_curso.fecha_finalizacion'></span>
              </td>
            </tr>
            <tr>
              <th colspan='2' v-if='!subscrip'>
                <button type="button" class="btn btn-block btn-outline-primary btn-sm" style="margin-right: 5px;" :disabled="loader_suscrip" v-on:click.prevent="suscribirse()" v-if="o_curso.estado=='abierto'">
                  <i class="fa fa-thumbs-o-up"></i> Unirse
                  <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_suscrip"></i>
                </button>

                <button type="button" class="btn btn-block btn-outline-primary btn-sm" style="margin-right: 5px;" disabled v-else>
                  <i class="fa fa-close"></i> Cerrado
                </button>
              </td>
              <th colspan='2' v-else>
                <button type="button" class="btn btn-block btn-outline-primary btn-sm" style="margin-right: 5px;" disabled>
                  <i class="fa fa-thumbs-o-up"></i> Suscrito
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
