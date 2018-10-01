@php
$act1=(Request::path() == 'es/foro') ? 'active' : '';
$act2=(Request::path() == 'es/progres') ? 'active' : '';
$act3=(Request::path() == 'es/calend') ? 'active' : '';
$act4=(Request::path() == 'es/evaluac') ? 'active' : '';
$act5=(Request::path() == 'es/result') ? 'active' : '';
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
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Preparacion Pre-icfes</h3>

      <div class="card-tools">
        <div class="user-block" style="width:80px;">
         <img class="img-circle img-bordered-sm" src="{{ URL::asset('rsc/dist/img/user1-128x128.jpg') }}" style='cursor:pointer' alt="user image" onclick="$('#modalchatprofe').modal('show');">
        </div>
      </div>
    </div>

    <div class="card-body">
      <ul class="nav nav-pills">
        <li class="nav-item"><a class="nav-link <?=$act1?>" href="{{url('es/foro')}}">Foro</a></li>
        <li class="nav-item"><a class="nav-link <?=$act2?>" href="{{url('es/progres')}}">Progreso</a></li>
        <li class="nav-item"><a class="nav-link <?=$act3?>" href="{{url('es/calend')}}">Calendario</a></li>
        <li class="nav-item"><a class="nav-link <?=$act4?>" href="{{url('es/evaluac')}}">Evaluaciones</a></li>
        <li class="nav-item"><a class="nav-link <?=$act5?>" href="{{url('es/result')}}">Resultados</a></li>
      </ul>
    </div>
  </div>
</div>
