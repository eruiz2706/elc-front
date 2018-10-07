@php
$act1=(Request::path() == 'foroc') ? 'active' : '';
$act2=(Request::path() == 'progres') ? 'active' : '';
$act3=(Request::path() == 'calend') ? 'active' : '';
$act4=(Request::path() == 'evaluac') ? 'active' : '';
$act5=(Request::path() == 'result') ? 'active' : '';
@endphp
<div class="modal fade" id="modalchatprofe" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class='modal-header'>
        <div class="input-group">
            <input type="text" name="message" placeholder="Escribe una respuesta" class="form-control">
            <span class="input-group-append">
              <button type="button" class="btn btn-primary">
                Responder
              </button>
            </span>
        </div>
        <!--<span class="text-danger" v-if="e_comentarios.comentario">@{{ e_comentarios.comentario[0] }}</span>-->
      </div>
      <div class="modal-body" style="height:450px;overflow-y: auto;">
        <div class="card-footer card-comments">
                <div class="card-comment">
                  <!-- User image -->
                  <img class="img-circle img-sm" src="{{ URL::asset('rsc/dist/img/user3-128x128.jpg') }}" alt="User Image">

                  <div class="comment-text">
                    <span class="username">
                      Maria Gonzales
                      <span class="text-muted float-right">8:03 PM Today</span>
                    </span><!-- /.username -->
                    It is a long established fact that a reader will be distracted
                    by the readable content of a page when looking at its layout.
                  </div>
                  <!-- /.comment-text -->
                </div>
                <!-- /.card-comment -->
                <div class="card-comment">
                  <!-- User image -->
                  <img class="img-circle img-sm" src="{{ URL::asset('rsc/dist/img/user5-128x128.jpg') }}" alt="User Image">

                  <div class="comment-text">
                    <span class="username">
                      Nora Havisham
                      <span class="text-muted float-right">8:03 PM Today</span>
                    </span><!-- /.username -->
                    The point of using Lorem Ipsum is that it has a more-or-less
                    normal distribution of letters, as opposed to using
                    'Content here, content here', making it look like readable English.
                  </div>
                  <!-- /.comment-text -->
                </div>
                <!-- /.card-comment -->
              </div>
      </div>
    </div>
  </div>
</div>

<div class="col-md-12">
  <div class="card card-primary card-outline">
    <div class="card-header" style='height:85px'>
      <h2>
        @if(Session::get('o_curso') !=null)
          {{Session::get('o_curso')->nombre}}
        @endif
      </h2>
    </div>

    <div class="card-body" style='padding:0px'>
      <ul class="nav nav-pills">
        <li class="nav-item"><a class="nav-link <?=$act1?>" href="{{url('foroc')}}">Foro</a></li>
        <li class="nav-item"><a class="nav-link <?=$act2?>" href="{{url('progres')}}">Lecciones</a></li>
        <li class="nav-item"><a class="nav-link <?=$act4?>" href="{{url('evaluac')}}">Evaluaciones</a></li>
        <li class="nav-item"><a class="nav-link <?=$act3?>" href="{{url('calend')}}">Calendario</a></li>
        <li class="nav-item"><a class="nav-link <?=$act5?>" href="{{url('result')}}">Resultados</a></li>
        <li class="nav-item"><a class="nav-link <?=$act5?>" href="{{url('result')}}">Miembros</a></li>
      </ul>
    </div>
  </div>
</div>