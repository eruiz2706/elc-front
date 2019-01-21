<template>
<div>
  <!-- Modal -->
  <div class="modal fade" id="modal_chat" ref="ref_modal_chat">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class='modal-header'>
            Chat directo<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="height:300px;overflow-y: auto;" ref="content_chat">
          <div class="row" v-if="preloadmodal">
            <div class="d-block mx-auto" >
              <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
            </div>
          </div>
          <div class="direct-chat-messages direct-chat-info" style='overflow:initial' >
                  <!-- Message. Default to the left -->
                  <div class="direct-chat-msg" v-bind:class="(id_userchat==chat.remitente) ? '':'right'" v-for="chat in chat_mensajes" >
                    <div class="direct-chat-info clearfix" v-if="id_userchat==chat.remitente">
                      <span class="direct-chat-name float-left" v-text='chat.nomremitente'></span>
                      <span class="direct-chat-timestamp float-right" v-text='chat.fecha_creacion'></span>
                    </div>

                    <div class="direct-chat-info clearfix" v-else>
                      <span class="direct-chat-name float-right" v-text='chat.nomremitente'></span>
                      <span class="direct-chat-timestamp float-left" v-text='chat.fecha_creacion'></span>
                    </div>

                    <!-- /.direct-chat-info -->
                    <img class="direct-chat-img" v-bind:src="base_url+'/'+chat.imgremitente" alt="">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text" v-html = "chat.mensaje">

                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->
            </div>
        </div>
        <div class="modal-footer">

          <div class="input-group col-md-12">
            <input type="text" class="form-control" v-model="mensaje_chat">
            <span class="input-group-append">
              <button type="button" class="btn btn-primary" :disabled="loader_responder"  v-on:click.prevent='responderchat()'>
                Responder
                <i style='font-size:20px' class="fa fa-spinner fa-spin fa-loader"  v-if="loader_responder"></i>
              </button>
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
          <div class="card-tools" v-if="rol_user=='es' || rol_user=='pr'">
            <a class="nav-link"  href="#" aria-expanded="true">
              <span class="badge navbar-badge">
                <i class="fa fa-comments-o" style='font-size:24px' v-on:click.prevent='chatuser(integrante.iduser)'>
                  <span class="badge badge-danger navbar-badge" style='top:-4px'><span v-if='integrante.mensajeschat>0' v-text='integrante.mensajeschat'></span></span>
                </i>
              </span>
            </a>
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
            let vm = this;
            this.$root.$on('private_message_serve',function(data){
              //console.log(data.chat_id+"=="+vm.idchat+'lleog');
              if(data.chat_id==vm.idchat){
                  vm.leidochat(data);
              }else{
                this.$root.$emit('private_message_cli',response.data.chat_enviado);
              }
            });

            //se activa una vez se cierre el modal
            $(this.$refs.ref_modal_chat).on("hidden.bs.modal",this.resetUserchat);
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
            chat_mensajes:[],
            idchat:0,
            id_userchat:0,
            loader_responder:false,
            mensaje_chat:'',
            rol_user:''
          }
        },
        methods : {
          resetUserchat:function(){
            this.chat_mensajes=[];
            this.idchat=0;
            this.id_userchat=0;
          },
          listado:function(){
            var url =base_url+'/integrantes/lista';
            this.preload=true;
            axios.post(url,{idcurso:this.idcurso}).then(response =>{
                this.preload=false;
                this.a_integrantes=response.data.integrantes;
                this.rol_user=response.data.slugrol;
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
          chatuser:function(iduser){
            $('#modal_chat').modal('show');
            var url =this.base_url+'/chatprivado/open';
            this.preloadmodal=true;
            this.chat_mensajes=[];
            this.id_userchat=iduser;
            axios.post(url,{iduser:iduser}).then(response =>{
                this.preloadmodal=false;
                this.chat_mensajes=response.data.chat_mensajes;
                this.$nextTick(() => {
                  this.$refs.content_chat.scrollTop = this.$refs.content_chat.scrollHeight;
                });
                this.idchat=response.data.idchat

            }).catch(error =>{
                this.preloadmodal=false;
                if(error.response.data.errors){
                }
                if(error.response.data.error){
                  toastr.error(error.response.data.error,'',{
                      "timeOut": "3500"
                  });
                }

            });
          },
          responderchat:function(){
            var url =this.base_url+'/chatprivado/responder';
            this.loader_responder=true;
            axios.post(url,{idchat:this.idchat,mensaje_chat:this.mensaje_chat,idcurso:this.idcurso}).then(response =>{
                this.chat_mensajes.push(response.data.chat_enviado);
                this.$nextTick(() => {
                  this.$refs.content_chat.scrollTop = this.$refs.content_chat.scrollHeight;
                });

                this.loader_responder=false;
                this.mensaje_chat='';
                this.$root.$emit('private_message_cli',response.data.chat_enviado);
            }).catch(error =>{
                this.loader_responder=false;
            });
          },
          leidochat:function(data){
              var url =this.base_url+'/chatprivado/leido';
              axios.post(url,{idchat:data.chat_id,remitente:data.remitente}).then(response =>{
                  this.chat_mensajes.push(data);
                  this.$nextTick(() => {
                    this.$refs.content_chat.scrollTop = this.$refs.content_chat.scrollHeight;
                  });
              }).catch(error =>{

              });
          }
        }
    }
</script>
