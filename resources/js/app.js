
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');

//window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('perfil-usu', require('./components/perfil/PerfilUsuarioComponent'));
Vue.component('perfil-pagos', require('./components/perfil/PerfilPagosComponent'));
Vue.component('foro-general', require('./components/foro/ForoGeneralComponent'));
Vue.component('foro-curso', require('./components/foro/ForoCursoComponent'));
Vue.component('progreso-es', require('./components/progreso/ProgresoEstudianteComponent'));
Vue.component('progreso-pr', require('./components/progreso/ProgresoProfesorComponent'));
Vue.component('integrantes', require('./components/integrantes/IntegrantesComponent'));
Vue.component('calendario', require('./components/calendario/CalendarioComponent'));
Vue.component('tareas-lista', require('./components/tareas/TareasListaComponent'));
Vue.component('ofertados-lista', require('./components/ofertados/OfertadosListaComponent'));
Vue.component('ofertados-detalle', require('./components/ofertados/OfertadosDetalleComponent'));
Vue.component('cursos-lista', require('./components/cursos/CursosListaComponent'));
Vue.component('cursos-crear', require('./components/cursos/CursosCrearComponent'));
Vue.component('cursos-edit', require('./components/cursos/CursosEditComponent'));
Vue.component('cursos-config', require('./components/cursos/CursosConfigComponent'));
Vue.component('modulos-lista', require('./components/modulos/ModulosListaComponent'));
Vue.component('modulos-crear', require('./components/modulos/ModulosCrearComponent'));
Vue.component('modulos-edit', require('./components/modulos/ModulosEditComponent'));
Vue.component('lecciones-lista', require('./components/lecciones/LeccionesListaComponent'));
Vue.component('lecciones-crear', require('./components/lecciones/LeccionesCrearComponent'));
Vue.component('lecciones-edit', require('./components/lecciones/LeccionesEditComponent'));
Vue.component('tareas-lista', require('./components/tareas/TareasListaComponent'));
Vue.component('tareas-crear', require('./components/tareas/TareasCrearComponent'));
Vue.component('tareas-edit', require('./components/tareas/TareasEditComponent'));
Vue.component('tareas-lista-entrega', require('./components/tareas/TareasListaEntregaComponent'));
Vue.component('tareas-lista-es', require('./components/tareas/TareasListaEstudianteComponent'));
Vue.component('tareas-entrega-es', require('./components/tareas/TareasEntregaEstudianteComponent'));
Vue.component('examenes-lista', require('./components/examenes/ExamenesListaComponent'));
Vue.component('examenes-crear', require('./components/examenes/ExamenesCrearComponent'));
Vue.component('examenes-edit', require('./components/examenes/ExamenesEditComponent'));
Vue.component('examenes-lista-entrega', require('./components/examenes/ExamenesListaEntregaComponent'));
Vue.component('examenes-lista-es', require('./components/examenes/ExamenesListaEstudianteComponent'));
Vue.component('preguntas-lista', require('./components/preguntas/PreguntasListaComponent'));
Vue.component('preguntas-crear', require('./components/preguntas/PreguntasCrearComponent'));
Vue.component('preguntas-edit', require('./components/preguntas/PreguntasEditComponent'));
Vue.component('resultados', require('./components/resultados/ResultadosComponent'));
Vue.component('resultados-es', require('./components/resultados/ResultadosEstudianteComponent'));
Vue.component('usuarios-lista', require('./components/usuarios/UsuariosListaComponent'));
Vue.component('reproductor', require('./components/herramientas/ReproductoComponent'));
Vue.component('pronunciacion', require('./components/herramientas/PronunciacionComponent'));
Vue.component('diccionario', require('./components/herramientas/DiccionarioComponent'));

console.log("utl noddtifi=>"+url_servinotifi);
var socket = io(url_servinotifi,{ 'forceNew': true,'secure':true});

const app = new Vue({
    el: '#v-app',
    mounted:function(){
      this.$root.$on('setMenu', function (id) {
        this.setMenuContent(id);
      });
      this.$root.$on('setReload', function () {
        this.config();
        this.notificaciones();
        this.messages();
      });
      this.$root.$on('notifi_cli',function(data){
        socket.emit('notifi_cli',{
          'notifi_tk':data
        });
      });
      this.$root.$on('private_message_cli',function(data){
        socket.emit('private_message_cli',data);
      })
      this.$root.$on('notifi_message_cli',function(data){
        if(data.receptor==ident_tk){
          this.messages();
        }
      })
      this.manualuso();
    },
    ready: function(){
    },
    created : function(){
      this.config();
      this.notificaciones();
      this.messages();
    },
    data : {
      menu_content:'',
      tab_content:'',
      user:{},
      nav_user:[],
      nav_cursos:[],
      nav_options:[],
      a_notifi:[],
      preload_notifi:false,
      conexion_user:[],
      chk_manual:false,
      loader_manual:false,
      a_messages:[],
      preload_messages:false,
    },
    computed : {

    },
    methods : {
      isSelectCurso : function(idcurso){
          var id=document.getElementById('idcurso');
          if(id){
              return (idcurso==id.value) ? 'callout-cours' : '';
          }
          return '';

      },
      isSelectCurso2 : function(idcurso){
          var id=document.getElementById('idcurso');
          if(id){
              return (idcurso==id.value) ? 'color:#007bff' : '';
          }
          return '';

      },
      setRedirect:function(ruta){
        window.location.href=base_url+'/'+ruta;
      },
      setMenuContent:function(menuconten){
        this.menu_content=menuconten;
        this.notificaciones();
        this.messages();
      },
      config:function(){
        var url =base_url+'/principal/config';
        this.preload=true;
        axios.post(url,{}).then(response =>{
          this.user=response.data.user;
          this.nav_user=response.data.nav_user;
          this.nav_cursos=response.data.nav_cursos;
          this.nav_options=response.data.nav_options;
        }).catch(error =>{
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "3500"
              });
            }
        });
      },
      conexion:function(){
        var url =base_url+'/principal/conexion';
        axios.post(url,{}).then(response =>{
          this.conexion_user=response.data.conexion_user;
        }).catch(error =>{
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "3500"
              });
            }
        });
      },
      notificaciones:function(){
        var url =base_url+'/notificaciones/conteo';
        axios.post(url,{}).then(response =>{
          var conteo=response.data.conteo;
          var nav_notifi = document.getElementById('nav_notifi');
          if(conteo>0){
             nav_notifi.innerHTML =conteo;
          }else{
            nav_notifi.innerHTML ='';
          }
       }).catch(error =>{
            if(error.response.data.errors){
              this.e_tarea=error.response.data.errors;
            }
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "2500"
              });
            }
        });
      },
      listanotificaciones:function(){
        var url =base_url+'/notificaciones/lista';
        this.preload_notifi=true;
        axios.post(url,{}).then(response =>{
          this.a_notifi=response.data.notificaciones;
          this.preload_notifi=false;
          document.getElementById('nav_notifi').innerHTML='';
        }).catch(error =>{
            this.preload_notifi=false;
            if(error.response.data.errors){
              this.e_tarea=error.response.data.errors;
            }
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "2500"
              });
            }
        });
      },
      messages:function(){
        var url =base_url+'/mensajes/conteo';
        axios.post(url,{}).then(response =>{
          var conteo=response.data.conteo;
          var nav_messages = document.getElementById('nav_messages');
          if(conteo>0){
             nav_messages.innerHTML =conteo;
          }else{
            nav_messages.innerHTML ='';
          }
       }).catch(error =>{
            if(error.response.data.errors){
              this.e_tarea=error.response.data.errors;
            }
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "2500"
              });
            }
        });
      },
      listamessages:function(){
        var url =base_url+'/mensajes/lista';
        this.preload_messages=true;
        axios.post(url,{}).then(response =>{
          this.a_messages=response.data.mensajes;
          this.preload_messages=false;
          document.getElementById('nav_messages').innerHTML='';
        }).catch(error =>{
            this.preload_messages=false;
            if(error.response.data.errors){

            }
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "2500"
              });
            }
        });
      },
      manualuso:function(){
        var url =base_url+'/principal/abrirmanual';
        axios.post(url,{chk_manual:this.chk_manual}).then(response =>{
          if(response.data.usermanual==false){
              $('#modal_manual').modal('show');
          }
        }).catch(error =>{

        });

      },
      updateManual:function(){
        $('#modal_manual').modal('hide');
        var url =base_url+'/principal/cerrarmanual';
        this.loader_manual=true;
        axios.post(url,{chk_manual:this.chk_manual}).then(response =>{
          this.loader_manual=false;
        }).catch(error =>{
          if(error.response.data.errors){
            this.e_tarea=error.response.data.errors;
          }
          if(error.response.data.error){
            toastr.error(error.response.data.error,'',{
                "timeOut": "2500"
            });
          }
        });
      },
      private_message_serve:function(data){
        this.$root.$emit('private_message_serve',data);
      }
    }
});

socket.on('notifi_serve', function(data) {
 if (typeof data['notifi_tk'] != 'undefined') {
    var notifi_tk=data['notifi_tk'];
    for(var i = 0; i < notifi_tk.length;i++){
      if(notifi_tk[i]==ident_tk){
        /*toastr.info('Tienes notificaciones nuevas','',{
            "timeOut": "3500"
        });*/
        app.notificaciones();
      }
    }
 }
});

socket.on('private_message_serve', function(data) {
  app.private_message_serve(data);
});
