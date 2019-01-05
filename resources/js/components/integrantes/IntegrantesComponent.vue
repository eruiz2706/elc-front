<template>
<div>
  <!-- Modal -->
  <div class="modal fade" id="modal_chat" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class='modal-header'>
            Chat directo<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="height:400px;overflow-y: auto;">
          <div class="row" v-if="preloadmodal">
            <div class="d-block mx-auto" >
              <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
            </div>
          </div>
          <div class="direct-chat-messages direct-chat-info" style='overflow:initial'>
                  <!-- Message. Default to the left -->
                  <div class="direct-chat-msg">
                    <div class="direct-chat-info clearfix">
                      <span class="direct-chat-name float-left">Alexander Pierce</span>
                      <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                    </div>
                    <!-- /.direct-chat-info -->
                    <img class="direct-chat-img" src="http://localhost/aulavirtual/public/img/avatar/5bfe03f8561bd2.49151940.png" alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      Is this template really for free? That's unbelievable!
                      asdfads
                      asdfadsasdfa
                      asdfadsasdfasd
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->

                  <!-- Message to the right -->
                  <div class="direct-chat-msg right">
                    <div class="direct-chat-info clearfix">
                      <span class="direct-chat-name float-right">Sarah Bullock</span>
                      <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                    </div>
                    <!-- /.direct-chat-info -->
                    <img class="direct-chat-img" src="http://localhost/aulavirtual/public/img/avatar/5bfe03f8561bd2.49151940.png" alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      You better believe it!
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->
                  <div class="direct-chat-msg right">
                    <div class="direct-chat-info clearfix">
                      <span class="direct-chat-name float-right">Sarah Bullock</span>
                      <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                    </div>
                    <!-- /.direct-chat-info -->
                    <img class="direct-chat-img" src="http://localhost/aulavirtual/public/img/avatar/5bfe03f8561bd2.49151940.png" alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      You better believe it!
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->

                  <div class="direct-chat-msg right">
                    <div class="direct-chat-info clearfix">
                      <span class="direct-chat-name float-right">Sarah Bullock</span>
                      <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                    </div>
                    <!-- /.direct-chat-info -->
                    <img class="direct-chat-img" src="http://localhost/aulavirtual/public/img/avatar/5bfe03f8561bd2.49151940.png" alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      You better believe it!
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->

                  <div class="direct-chat-msg right">
                    <div class="direct-chat-info clearfix">
                      <span class="direct-chat-name float-right">Sarah Bullock</span>
                      <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                    </div>
                    <!-- /.direct-chat-info -->
                    <img class="direct-chat-img" src="http://localhost/aulavirtual/public/img/avatar/5bfe03f8561bd2.49151940.png" alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      You better believe it!
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->

                  <div class="direct-chat-msg right">
                    <div class="direct-chat-info clearfix">
                      <span class="direct-chat-name float-right">Sarah Bullock</span>
                      <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                    </div>
                    <!-- /.direct-chat-info -->
                    <img class="direct-chat-img" src="http://localhost/aulavirtual/public/img/avatar/5bfe03f8561bd2.49151940.png" alt="message user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                      You better believe it!
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->
              </div>
        </div>
        <div class="modal-footer">

          <div class="input-group col-md-12">
            <input type="text" name="message" placeholder="Type Message ..." class="form-control">
            <span class="input-group-append">
              <button type="button" class="btn btn-primary">Send</button>
            </span>
          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="row" v-if="preload">
    <div class="d-block mx-auto" >
      <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
    </div>
  </div>

  <div class='row'>
    <div class='col-md-6 col-sm-12' v-for="integrante in a_integrantes">
      <div class="card" v-if="!preload" >
        <div class="card-body">
          <div class="card-tools">
            <!--<a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
              <span class="badge navbar-badge">
                <i class="fa fa-comments-o" style='font-size:24px' v-on:click.prevent='chatuser()'>
                  <span class="badge badge-danger navbar-badge" style='top:-4px'>3</span>
                </i>
              </span>
            </a>-->
          </div>
          <div class="post">
            <div class="user-block">
              <img class="img-circle img-bordered" v-bind:src="base_url+'/'+integrante.imagen" alt="user image">
              <span class="username">
                <a><span v-text='integrante.nombre'></span></a>
              </span>
              <span class="description" v-text='integrante.perfil'></span>
              <span class="description">Ultimo ingreso: <span v-text='integrante.fecha_ultimo_ingreso'></span></span>
              <span class="description">Tiempo de uso: <span v-text='integrante.tiempouso'></span> minutos</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component integrantes mounted.');
        },created : function(){
          this.base_url=base_url;
          this.idcurso=document.getElementById('idcurso').value;
          this.listado();
        },
        data: function () {
          return {
            idcurso : 0,
            preload:true,
            a_integrantes:[],
            preloadmodal:false,
          }
        },
        methods : {
          listado:function(){
            var url =base_url+'/integrantes/lista';
            this.preload=true;
            axios.post(url,{idcurso:this.idcurso}).then(response =>{
                this.preload=false;
                this.a_integrantes=response.data.integrantes;
            }).catch(error =>{
                this.preload=false;
                if(error.response.data.errors){
                }
                if(error.response.data.error){
                  toastr.error(error.response.data.error,'',{
                      "timeOut": "3500"
                  });
                }
            });
          },
          chatuser:function(id){
            $('#modal_chat').modal('show');
            /*var url =this.base_url+'/progreso/progmod';
            this.preloadmodal=true;
            axios.post(url,{idcurso:this.idcurso,idmodulo:id}).then(response =>{
                this.preloadmodal=false;
                this.a_progmod=response.data.progmod;
                console.log(response.data);
            }).catch(error =>{
                this.preloadmodal=false;
                this.a_progmod=[];
                if(error.response.data.errors){
                }
                if(error.response.data.error){
                  toastr.error(error.response.data.error,'',{
                      "timeOut": "3500"
                  });
                }

            });*/
          }
        }
    }
</script>
