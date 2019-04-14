<!DOCTYPE html>
<html  lang="{{ app()->getLocale() }}">
    @section('htmlheader')
        @include('layouts.adminlte.partials.htmlheader')
    @show

<body class="hold-transition sidebar-collapse">
<div >
    <div  id="loader-body" class="loader-wrapper loader1">
        <div class="loader"></div>
    </div>

    <div class="wrapper" id="v-app">
    @include('layouts.adminlte.partials.mainheader')

    <div class="img-bannerhome" style="background-image: url('{{ URL::asset('rfend/images/counter_background.jpg') }}');"></div>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="vue">


        <!-- Content Header (Page header) -->
        <div class="content-header" style="top:100px">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@yield('tittlecontent')</h1>
                    </div><!-- /.col -->

                    <div class="col-sm-6">
                        @yield('breadcrumb')
                    </div>

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="modal fade" id="modal_bienvenida" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class='modal-header'>
                      <strong>Mensaje de bienvenida</strong><button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body" style="height:400px;overflow-y: auto;">
                  @include('backend.modulos.bienvenida.bienvenida')
                  </div>
                  <div class='modal-footer'>
                    <input type="checkbox" v-model='chk_manual' class="fantasma"/>No mostrar mas
                    <button type="button" class="btn btn-outline-primary btn-sm float-left" :disabled="loader_manual" v-on:click.prevent='updateMensajeBienvenida()'>
                      Cerrar
                      <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_manual"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <div class="container-fluid" >
                @yield('content')
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('layouts.adminlte.partials.footer')

  </div>
  <!-- ./wrapper -->
  @section('scripts')
      @include('layouts.adminlte.partials.scripts')
  @show
</div>
</body>
</html>
