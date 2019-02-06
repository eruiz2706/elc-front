/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports) {

/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file.
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

module.exports = function normalizeComponent (
  rawScriptExports,
  compiledTemplate,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier /* server only */
) {
  var esModule
  var scriptExports = rawScriptExports = rawScriptExports || {}

  // ES6 modules interop
  var type = typeof rawScriptExports.default
  if (type === 'object' || type === 'function') {
    esModule = rawScriptExports
    scriptExports = rawScriptExports.default
  }

  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (compiledTemplate) {
    options.render = compiledTemplate.render
    options.staticRenderFns = compiledTemplate.staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = injectStyles
  }

  if (hook) {
    var functional = options.functional
    var existing = functional
      ? options.render
      : options.beforeCreate

    if (!functional) {
      // inject component registration as beforeCreate hook
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    } else {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return existing(h, context)
      }
    }
  }

  return {
    esModule: esModule,
    exports: scriptExports,
    options: options
  }
}


/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(28)
/* template */
var __vue_template__ = __webpack_require__(29)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/tareas/TareasListaComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-29c203ee", Component.options)
  } else {
    hotAPI.reload("data-v-29c203ee", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(3);


/***/ }),
/* 3 */
/***/ (function(module, exports, __webpack_require__) {


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

Vue.component('perfil-usu', __webpack_require__(4));
Vue.component('perfil-pagos', __webpack_require__(7));
Vue.component('foro-general', __webpack_require__(10));
Vue.component('foro-curso', __webpack_require__(13));
Vue.component('progreso-es', __webpack_require__(16));
Vue.component('progreso-pr', __webpack_require__(19));
Vue.component('integrantes', __webpack_require__(22));
Vue.component('calendario', __webpack_require__(25));
Vue.component('tareas-lista', __webpack_require__(1));
Vue.component('ofertados-lista', __webpack_require__(30));
Vue.component('ofertados-detalle', __webpack_require__(33));
Vue.component('cursos-lista', __webpack_require__(36));
Vue.component('cursos-crear', __webpack_require__(39));
Vue.component('cursos-edit', __webpack_require__(42));
Vue.component('cursos-config', __webpack_require__(45));
Vue.component('modulos-lista', __webpack_require__(48));
Vue.component('modulos-crear', __webpack_require__(51));
Vue.component('modulos-edit', __webpack_require__(54));
Vue.component('lecciones-lista', __webpack_require__(57));
Vue.component('lecciones-crear', __webpack_require__(60));
Vue.component('lecciones-edit', __webpack_require__(63));
Vue.component('tareas-lista', __webpack_require__(1));
Vue.component('tareas-crear', __webpack_require__(66));
Vue.component('tareas-edit', __webpack_require__(69));
Vue.component('tareas-lista-entrega', __webpack_require__(72));
Vue.component('tareas-lista-es', __webpack_require__(75));
Vue.component('tareas-entrega-es', __webpack_require__(78));
Vue.component('examenes-lista', __webpack_require__(81));
Vue.component('examenes-crear', __webpack_require__(84));
Vue.component('examenes-edit', __webpack_require__(87));
Vue.component('examenes-lista-entrega', __webpack_require__(90));
Vue.component('examenes-lista-es', __webpack_require__(93));
Vue.component('preguntas-lista', __webpack_require__(96));
Vue.component('preguntas-crear', __webpack_require__(99));
Vue.component('preguntas-edit', __webpack_require__(102));
Vue.component('resultados', __webpack_require__(105));
Vue.component('resultados-es', __webpack_require__(108));
Vue.component('usuarios-lista', __webpack_require__(111));
Vue.component('reproductor', __webpack_require__(114));
Vue.component('pronunciacion', __webpack_require__(117));
Vue.component('diccionario', __webpack_require__(120));

console.log("utl noddtifi=>" + url_servinotifi);
var socket = io(url_servinotifi, { 'forceNew': true, 'secure': true });

var app = new Vue({
  el: '#v-app',
  mounted: function mounted() {
    this.$root.$on('setMenu', function (id) {
      this.setMenuContent(id);
    });
    this.$root.$on('setReload', function () {
      this.config();
      this.notificaciones();
      this.messages();
    });
    this.$root.$on('notifi_cli', function (data) {
      socket.emit('notifi_cli', {
        'notifi_tk': data
      });
    });
    this.$root.$on('private_message_cli', function (data) {
      socket.emit('private_message_cli', data);
    });
    this.$root.$on('notifi_message_cli', function (data) {
      if (data.receptor == ident_tk) {
        this.messages();
      }
    });
    this.manualuso();
  },
  ready: function ready() {},
  created: function created() {
    this.config();
    this.notificaciones();
    this.messages();
  },
  data: {
    menu_content: '',
    tab_content: '',
    user: {},
    nav_user: [],
    nav_cursos: [],
    nav_options: [],
    a_notifi: [],
    preload_notifi: false,
    conexion_user: [],
    chk_manual: false,
    loader_manual: false,
    a_messages: [],
    preload_messages: false
  },
  computed: {},
  methods: {
    isSelectCurso: function isSelectCurso(idcurso) {
      var id = document.getElementById('idcurso');
      if (id) {
        return idcurso == id.value ? 'callout-cours' : '';
      }
      return '';
    },
    isSelectCurso2: function isSelectCurso2(idcurso) {
      var id = document.getElementById('idcurso');
      if (id) {
        return idcurso == id.value ? 'color:#007bff' : '';
      }
      return '';
    },
    setRedirect: function setRedirect(ruta) {
      window.location.href = base_url + '/' + ruta;
    },
    setMenuContent: function setMenuContent(menuconten) {
      this.menu_content = menuconten;
      this.notificaciones();
      this.messages();
    },
    config: function config() {
      var _this = this;

      var url = base_url + '/principal/config';
      this.preload = true;
      axios.post(url, {}).then(function (response) {
        _this.user = response.data.user;
        _this.nav_user = response.data.nav_user;
        _this.nav_cursos = response.data.nav_cursos;
        _this.nav_options = response.data.nav_options;
      }).catch(function (error) {
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
      });
    },
    conexion: function conexion() {
      var _this2 = this;

      var url = base_url + '/principal/conexion';
      axios.post(url, {}).then(function (response) {
        _this2.conexion_user = response.data.conexion_user;
      }).catch(function (error) {
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
      });
    },
    notificaciones: function notificaciones() {
      var _this3 = this;

      var url = base_url + '/notificaciones/conteo';
      axios.post(url, {}).then(function (response) {
        var conteo = response.data.conteo;
        var nav_notifi = document.getElementById('nav_notifi');
        if (conteo > 0) {
          nav_notifi.innerHTML = conteo;
        } else {
          nav_notifi.innerHTML = '';
        }
      }).catch(function (error) {
        if (error.response.data.errors) {
          _this3.e_tarea = error.response.data.errors;
        }
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "2500"
          });
        }
      });
    },
    listanotificaciones: function listanotificaciones() {
      var _this4 = this;

      var url = base_url + '/notificaciones/lista';
      this.preload_notifi = true;
      axios.post(url, {}).then(function (response) {
        _this4.a_notifi = response.data.notificaciones;
        _this4.preload_notifi = false;
        document.getElementById('nav_notifi').innerHTML = '';
      }).catch(function (error) {
        _this4.preload_notifi = false;
        if (error.response.data.errors) {
          _this4.e_tarea = error.response.data.errors;
        }
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "2500"
          });
        }
      });
    },
    messages: function messages() {
      var _this5 = this;

      var url = base_url + '/mensajes/conteo';
      axios.post(url, {}).then(function (response) {
        var conteo = response.data.conteo;
        var nav_messages = document.getElementById('nav_messages');
        if (conteo > 0) {
          nav_messages.innerHTML = conteo;
        } else {
          nav_messages.innerHTML = '';
        }
      }).catch(function (error) {
        if (error.response.data.errors) {
          _this5.e_tarea = error.response.data.errors;
        }
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "2500"
          });
        }
      });
    },
    listamessages: function listamessages() {
      var _this6 = this;

      var url = base_url + '/mensajes/lista';
      this.preload_messages = true;
      axios.post(url, {}).then(function (response) {
        _this6.a_messages = response.data.mensajes;
        _this6.preload_messages = false;
        document.getElementById('nav_messages').innerHTML = '';
      }).catch(function (error) {
        _this6.preload_messages = false;
        if (error.response.data.errors) {}
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "2500"
          });
        }
      });
    },
    manualuso: function manualuso() {
      var url = base_url + '/principal/abrirmanual';
      axios.post(url, { chk_manual: this.chk_manual }).then(function (response) {
        if (response.data.usermanual == false) {
          $('#modal_manual').modal('show');
        }
      }).catch(function (error) {});
    },
    updateManual: function updateManual() {
      var _this7 = this;

      $('#modal_manual').modal('hide');
      var url = base_url + '/principal/cerrarmanual';
      this.loader_manual = true;
      axios.post(url, { chk_manual: this.chk_manual }).then(function (response) {
        _this7.loader_manual = false;
      }).catch(function (error) {
        if (error.response.data.errors) {
          _this7.e_tarea = error.response.data.errors;
        }
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "2500"
          });
        }
      });
    },
    private_message_serve: function private_message_serve(data) {
      this.$root.$emit('private_message_serve', data);
    }
  }
});

socket.on('notifi_serve', function (data) {
  if (typeof data['notifi_tk'] != 'undefined') {
    var notifi_tk = data['notifi_tk'];
    for (var i = 0; i < notifi_tk.length; i++) {
      if (notifi_tk[i] == ident_tk) {
        /*toastr.info('Tienes notificaciones nuevas','',{
            "timeOut": "3500"
        });*/
        app.notificaciones();
      }
    }
  }
});

socket.on('private_message_serve', function (data) {
  app.private_message_serve(data);
});

/***/ }),
/* 4 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(5)
/* template */
var __vue_template__ = __webpack_require__(6)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/perfil/PerfilUsuarioComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-e2d0543a", Component.options)
  } else {
    hotAPI.reload("data-v-e2d0543a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 5 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {
    console.log('Component perfil usuario mounted.');
    /*function para previsualizar la imagen */
    jQuery(function () {
      jQuery("input[type=file]").change(function () {
        readURL(this);
      });
      var readURL = function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            jQuery('#logo-user').attr('src', e.target.result);
          };
          reader.readAsDataURL(input.files[0]);
        }
      };
    });
  },
  created: function created() {
    this.base_url = base_url;
    this.getData();
  },
  data: function data() {
    return {
      preload: false,
      o_userbase: { 'nombre': '', 'telefono': '', 'ciudad': '', 'direccion': '', 'email': '', 'facebook': '', 'linkedin': '', 'biografia': '' },
      o_user: { 'nombre': '', 'telefono': '', 'ciudad': '', 'direccion': '', 'email': '', 'facebook': '', 'linkedin': '', 'biografia': '' },

      loader_img: false,

      loader_cambiocl: false,
      o_cambiocl: { 'password': '', 'repassword': '' },
      e_cambiocl: [],

      modo_edit: false,
      loader_act: false
    };
  },
  methods: {
    actualizarImg: function actualizarImg() {
      var _this = this;

      var inst = this;
      this.loader_img = true;
      var imagen = $('#file_avatar')[0].files[0];
      var formData = new FormData();
      formData.append('avatar', imagen);
      var url = this.base_url + '/perfil/actimg';
      axios.post(url, formData, { avatar: imagen }).then(function (response) {
        _this.loader_img = false;
        swal({
          title: response.data.message,
          text: response.data.message2,
          type: "success"
        }, function () {
          location.reload(true);
        });
      }).catch(function (error) {
        _this.loader_img = false;
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "2500"
          });
        }
      });
    },
    modalcambiocl: function modalcambiocl() {
      this.o_cambiocl = { 'password': '', 'repassword': '' };
      $('#modalcambiocl').modal('show');
    },
    cambiocl: function cambiocl() {
      var _this2 = this;

      this.loader_cambiocl = true;
      var url = this.base_url + '/perfil/cambiocl';
      axios.post(url, this.o_cambiocl).then(function (response) {
        _this2.loader_cambiocl = false;
        _this2.e_cambiocl = [];
        $('#modalcambiocl').modal('hide');
        swal({
          title: response.data.message,
          text: response.data.message2,
          type: "success"
        });
      }).catch(function (error) {
        _this2.loader_cambiocl = false;
        if (error.response.data.errors) {
          _this2.e_cambiocl = error.response.data.errors;
        }
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "2500"
          });
        }
      });
    },
    getData: function getData() {
      var _this3 = this;

      this.preload = true;
      var url = this.base_url + '/perfil/data';
      axios.post(url, {}).then(function (response) {
        _this3.preload = false;
        _this3.o_user = response.data.user;
        _this3.o_userbase = response.data.user;
      }).catch(function (error) {
        _this3.preload = false;
        console.log(error.response.data);
      });
    },
    editar: function editar() {
      this.modo_edit = true;
    },
    cancelar: function cancelar() {
      this.o_user = this.o_userbase;
      this.modo_edit = false;
    },
    actualizar: function actualizar() {
      var _this4 = this;

      this.loader_act = true;
      var url = this.base_url + '/perfil/act';
      axios.post(url, this.o_user).then(function (response) {
        _this4.loader_act = false;
        _this4.modo_edit = false;
        swal({
          title: response.data.message,
          text: response.data.message2,
          type: "success"
        });
      }).catch(function (error) {
        _this4.loader_act = false;
        if (error.response.data.errors) {
          //
        }
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "2500"
          });
        }
        console.log(error.response.data);
      });
    }
  }
});

/***/ }),
/* 6 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c(
      "div",
      {
        staticClass: "modal fade",
        attrs: {
          id: "modalcambiocl",
          tabindex: "-1",
          role: "dialog",
          "aria-hidden": "true"
        }
      },
      [
        _c(
          "div",
          { staticClass: "modal-dialog", attrs: { role: "document" } },
          [
            _c("div", { staticClass: "modal-content" }, [
              _vm._m(0),
              _vm._v(" "),
              _c(
                "form",
                {
                  attrs: { method: "post" },
                  on: {
                    submit: function($event) {
                      $event.preventDefault()
                      _vm.cambiocl()
                    }
                  }
                },
                [
                  _c("div", { staticClass: "modal-body" }, [
                    _c("div", { staticClass: "col-md-12" }, [
                      _c("div", { staticClass: "form-group" }, [
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.o_cambiocl.password,
                              expression: "o_cambiocl.password"
                            }
                          ],
                          staticClass: "form-control",
                          class: [_vm.e_cambiocl.password ? "is-invalid" : ""],
                          attrs: {
                            type: "password",
                            placeholder: "Nueva contraseña"
                          },
                          domProps: { value: _vm.o_cambiocl.password },
                          on: {
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.$set(
                                _vm.o_cambiocl,
                                "password",
                                $event.target.value
                              )
                            }
                          }
                        }),
                        _vm._v(" "),
                        _vm.e_cambiocl.password
                          ? _c("span", {
                              staticClass: "text-danger",
                              domProps: {
                                textContent: _vm._s(_vm.e_cambiocl.password[0])
                              }
                            })
                          : _vm._e()
                      ])
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-md-12" }, [
                      _c("div", { staticClass: "form-group" }, [
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.o_cambiocl.repassword,
                              expression: "o_cambiocl.repassword"
                            }
                          ],
                          staticClass: "form-control",
                          class: [
                            _vm.e_cambiocl.repassword ? "is-invalid" : ""
                          ],
                          attrs: {
                            type: "password",
                            placeholder: "Confirmar contraseña"
                          },
                          domProps: { value: _vm.o_cambiocl.repassword },
                          on: {
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.$set(
                                _vm.o_cambiocl,
                                "repassword",
                                $event.target.value
                              )
                            }
                          }
                        }),
                        _vm._v(" "),
                        _vm.e_cambiocl.repassword
                          ? _c("span", {
                              staticClass: "text-danger",
                              domProps: {
                                textContent: _vm._s(
                                  _vm.e_cambiocl.repassword[0]
                                )
                              }
                            })
                          : _vm._e()
                      ])
                    ])
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "modal-footer" }, [
                    _c(
                      "button",
                      {
                        staticClass: "btn btn-primary",
                        attrs: { type: "submit", disabled: _vm.loader_cambiocl }
                      },
                      [
                        _vm._v("\n          Actualizar\n          "),
                        _vm.loader_cambiocl
                          ? _c("i", {
                              staticClass: "fa fa-spinner fa-spin fa-loader",
                              staticStyle: { "font-size": "20px" }
                            })
                          : _vm._e()
                      ]
                    )
                  ])
                ]
              )
            ])
          ]
        )
      ]
    ),
    _vm._v(" "),
    _c("div", { staticClass: "callout" }, [
      _c("div", { staticClass: "row" }, [
        _c("div", { staticClass: "col-md-8" }, [
          _c("div", { staticClass: "table-responsive" }, [
            _c("table", { staticClass: "table" }, [
              _c("tbody", [
                _c("tr", [
                  _c(
                    "td",
                    {
                      staticStyle: { "padding-top": "1px" },
                      attrs: { colspan: "2" }
                    },
                    [
                      _vm._m(1),
                      _vm._v(" "),
                      !_vm.modo_edit
                        ? _c("span", {
                            domProps: { textContent: _vm._s(_vm.o_user.nombre) }
                          })
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.modo_edit
                        ? _c("div", { staticClass: "col-md-12" }, [
                            _c("div", { staticClass: "form-group" }, [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: _vm.o_user.nombre,
                                    expression: "o_user.nombre"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: { type: "text" },
                                domProps: { value: _vm.o_user.nombre },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      _vm.o_user,
                                      "nombre",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ])
                          ])
                        : _vm._e()
                    ]
                  )
                ]),
                _vm._v(" "),
                _c("tr", [
                  _c(
                    "td",
                    {
                      staticStyle: { "padding-top": "1px" },
                      attrs: { colspan: "2" }
                    },
                    [
                      _vm._m(2),
                      _vm._v(" "),
                      _c("span", [_vm._v("************")]),
                      _vm._v(" "),
                      _c("i", {
                        staticClass: "fa  fa-pencil",
                        staticStyle: { cursor: "pointer" },
                        on: {
                          click: function($event) {
                            $event.preventDefault()
                            _vm.modalcambiocl()
                          }
                        }
                      })
                    ]
                  )
                ]),
                _vm._v(" "),
                _c("tr", [
                  _c(
                    "td",
                    {
                      staticStyle: { "padding-top": "1px" },
                      attrs: { colspan: "2" }
                    },
                    [
                      _vm._m(3),
                      _vm._v(" "),
                      _c("span", {
                        domProps: { textContent: _vm._s(_vm.o_user.email) }
                      })
                    ]
                  )
                ]),
                _vm._v(" "),
                _c("tr", [
                  _c(
                    "td",
                    {
                      staticStyle: { "padding-top": "1px" },
                      attrs: { colspan: "2" }
                    },
                    [
                      _vm._m(4),
                      _vm._v(" "),
                      !_vm.modo_edit
                        ? _c("span", {
                            domProps: {
                              textContent: _vm._s(_vm.o_user.telefono)
                            }
                          })
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.modo_edit
                        ? _c("div", { staticClass: "col-md-12" }, [
                            _c("div", { staticClass: "form-group" }, [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: _vm.o_user.telefono,
                                    expression: "o_user.telefono"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: { type: "text" },
                                domProps: { value: _vm.o_user.telefono },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      _vm.o_user,
                                      "telefono",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ])
                          ])
                        : _vm._e()
                    ]
                  )
                ]),
                _vm._v(" "),
                _c("tr", [
                  _c(
                    "td",
                    {
                      staticStyle: { "padding-top": "1px" },
                      attrs: { colspan: "2" }
                    },
                    [
                      _vm._m(5),
                      _vm._v(" "),
                      !_vm.modo_edit
                        ? _c("span", {
                            domProps: { textContent: _vm._s(_vm.o_user.ciudad) }
                          })
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.modo_edit
                        ? _c("div", { staticClass: "col-md-12" }, [
                            _c("div", { staticClass: "form-group" }, [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: _vm.o_user.ciudad,
                                    expression: "o_user.ciudad"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: { type: "text" },
                                domProps: { value: _vm.o_user.ciudad },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      _vm.o_user,
                                      "ciudad",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ])
                          ])
                        : _vm._e()
                    ]
                  )
                ]),
                _vm._v(" "),
                _c("tr", [
                  _c(
                    "td",
                    {
                      staticStyle: { "padding-top": "1px" },
                      attrs: { colspan: "2" }
                    },
                    [
                      _vm._m(6),
                      _vm._v(" "),
                      !_vm.modo_edit
                        ? _c("span", {
                            domProps: {
                              textContent: _vm._s(_vm.o_user.direccion)
                            }
                          })
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.modo_edit
                        ? _c("div", { staticClass: "col-md-12" }, [
                            _c("div", { staticClass: "form-group" }, [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: _vm.o_user.direccion,
                                    expression: "o_user.direccion"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: { type: "text" },
                                domProps: { value: _vm.o_user.direccion },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      _vm.o_user,
                                      "direccion",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ])
                          ])
                        : _vm._e()
                    ]
                  )
                ]),
                _vm._v(" "),
                _c("tr", [
                  _c(
                    "td",
                    {
                      staticStyle: { "padding-top": "1px" },
                      attrs: { colspan: "2" }
                    },
                    [
                      _vm._m(7),
                      _vm._v(" "),
                      !_vm.modo_edit
                        ? _c("span", {
                            domProps: {
                              textContent: _vm._s(_vm.o_user.facebook)
                            }
                          })
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.modo_edit
                        ? _c("div", { staticClass: "col-md-12" }, [
                            _c("div", { staticClass: "form-group" }, [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: _vm.o_user.facebook,
                                    expression: "o_user.facebook"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: { type: "text" },
                                domProps: { value: _vm.o_user.facebook },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      _vm.o_user,
                                      "facebook",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ])
                          ])
                        : _vm._e()
                    ]
                  )
                ]),
                _vm._v(" "),
                _c("tr", [
                  _c(
                    "td",
                    {
                      staticStyle: { "padding-top": "1px" },
                      attrs: { colspan: "2" }
                    },
                    [
                      _vm._m(8),
                      _vm._v(" "),
                      !_vm.modo_edit
                        ? _c("span", {
                            domProps: {
                              textContent: _vm._s(_vm.o_user.linkedin)
                            }
                          })
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.modo_edit
                        ? _c("div", { staticClass: "col-md-12" }, [
                            _c("div", { staticClass: "form-group" }, [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: _vm.o_user.linkedin,
                                    expression: "o_user.linkedin"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: { type: "text" },
                                domProps: { value: _vm.o_user.linkedin },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      _vm.o_user,
                                      "linkedin",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ])
                          ])
                        : _vm._e()
                    ]
                  )
                ]),
                _vm._v(" "),
                _c("tr", [
                  _c(
                    "td",
                    {
                      staticStyle: { "padding-top": "1px" },
                      attrs: { colspan: "2" }
                    },
                    [
                      _vm._m(9),
                      _vm._v(" "),
                      !_vm.modo_edit
                        ? _c("span", {
                            domProps: {
                              textContent: _vm._s(_vm.o_user.biografia)
                            }
                          })
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.modo_edit
                        ? _c("div", { staticClass: "col-md-12" }, [
                            _c("div", { staticClass: "form-group" }, [
                              _c("textarea", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: _vm.o_user.biografia,
                                    expression: "o_user.biografia"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: { rows: "3" },
                                domProps: { value: _vm.o_user.biografia },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      _vm.o_user,
                                      "biografia",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ])
                          ])
                        : _vm._e()
                    ]
                  )
                ]),
                _vm._v(" "),
                _c("tr", [
                  _c("th", [
                    !_vm.modo_edit
                      ? _c(
                          "button",
                          {
                            staticClass: "btn btn-outline-primary btn-sm",
                            attrs: { type: "button" },
                            on: {
                              click: function($event) {
                                $event.preventDefault()
                                _vm.editar()
                              }
                            }
                          },
                          [_vm._v("Editar")]
                        )
                      : _vm._e(),
                    _vm._v(" "),
                    _vm.modo_edit
                      ? _c(
                          "button",
                          {
                            staticClass: "btn btn-outline-primary btn-sm",
                            attrs: { type: "button", disabled: _vm.loader_act },
                            on: {
                              click: function($event) {
                                $event.preventDefault()
                                _vm.actualizar()
                              }
                            }
                          },
                          [
                            _vm._v(
                              "\n                    Actualizar\n                    "
                            ),
                            _vm.loader_act
                              ? _c("i", {
                                  staticClass:
                                    "fa fa-spinner fa-spin fa-loader",
                                  staticStyle: { "font-size": "20px" }
                                })
                              : _vm._e()
                          ]
                        )
                      : _vm._e(),
                    _vm._v(" "),
                    _vm.modo_edit
                      ? _c(
                          "button",
                          {
                            staticClass: "btn btn-outline-primary btn-sm",
                            attrs: { type: "button" },
                            on: {
                              click: function($event) {
                                $event.preventDefault()
                                _vm.cancelar()
                              }
                            }
                          },
                          [_vm._v("Cancelar")]
                        )
                      : _vm._e()
                  ])
                ])
              ])
            ])
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "col-md-4" }, [
          _c("div", { staticClass: "media" }, [
            _c("div", { staticClass: "media-left" }, [
              _c("a", { staticClass: "ad-click-event", attrs: { href: "#" } }, [
                _c("img", {
                  staticClass: "media-object",
                  staticStyle: {
                    width: "150px",
                    height: "150px",
                    "border-radius": "4px",
                    "box-shadow": "0 1px 3px rgba(0,0,0,.15)"
                  },
                  attrs: {
                    id: "logo-user",
                    src: _vm.base_url + "/" + _vm.o_user.imagen
                  }
                })
              ])
            ])
          ]),
          _vm._v(" "),
          _c(
            "form",
            {
              attrs: {
                method: "post",
                enctype: "multipart/form-data",
                id: "uploadForm"
              },
              on: {
                submit: function($event) {
                  $event.preventDefault()
                  _vm.actualizarImg()
                }
              }
            },
            [
              _c("input", {
                staticClass: "form-control-file border",
                attrs: { type: "file", id: "file_avatar" }
              }),
              _vm._v(" "),
              _c(
                "button",
                {
                  staticClass: "btn btn-block btn-outline-primary btn-sm",
                  attrs: { type: "submit", disabled: _vm.loader_img }
                },
                [
                  _vm._v("\n          Cargar Imagen\n          "),
                  _vm.loader_img
                    ? _c("i", {
                        staticClass: "fa fa-spinner fa-spin fa-loader",
                        staticStyle: { "font-size": "20px" }
                      })
                    : _vm._e()
                ]
              )
            ]
          )
        ])
      ])
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "modal-header" }, [
      _c("h5", { staticClass: "modal-title" }, [_vm._v("Cambiar contraseña")]),
      _vm._v(" "),
      _c(
        "button",
        {
          staticClass: "close",
          attrs: {
            type: "button",
            "data-dismiss": "modal",
            "aria-label": "Close"
          }
        },
        [_c("span", { attrs: { "aria-hidden": "true" } }, [_vm._v("×")])]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", { staticStyle: { margin: "0px" } }, [
      _c("strong", [_vm._v("Nombre:")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", { staticStyle: { margin: "0px" } }, [
      _c("strong", [_vm._v("Contraseña:")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", { staticStyle: { margin: "0px" } }, [
      _c("strong", [_vm._v("Email:")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", { staticStyle: { margin: "0px" } }, [
      _c("strong", [_vm._v("Telefono:")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", { staticStyle: { margin: "0px" } }, [
      _c("strong", [_vm._v("Ciudad:")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", { staticStyle: { margin: "0px" } }, [
      _c("strong", [_vm._v("Direccion:")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", { staticStyle: { margin: "0px" } }, [
      _c("strong", [_vm._v("Facebook:")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", { staticStyle: { margin: "0px" } }, [
      _c("strong", [_vm._v("Linkedin:")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", { staticStyle: { margin: "0px" } }, [
      _c("strong", [_vm._v("Biografia:")])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-e2d0543a", module.exports)
  }
}

/***/ }),
/* 7 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(8)
/* template */
var __vue_template__ = __webpack_require__(9)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/perfil/PerfilPagosComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-f72b6ad2", Component.options)
  } else {
    hotAPI.reload("data-v-f72b6ad2", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 8 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {},
  created: function created() {
    this.base_url = base_url;
    this.getData();
  },
  data: function data() {
    return {
      preload: false,
      a_pagos: []
    };
  },
  methods: {
    getData: function getData() {
      var _this = this;

      this.preload = true;
      var url = this.base_url + '/perfil/pagos';
      axios.post(url, {}).then(function (response) {
        _this.preload = false;
        _this.a_pagos = response.data.pagos;
      }).catch(function (error) {
        _this.preload = false;
      });
    }
  }
});

/***/ }),
/* 9 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _vm.preload ? _c("div", { staticClass: "row" }, [_vm._m(0)]) : _vm._e(),
    _vm._v(" "),
    !_vm.preload
      ? _c("div", { staticClass: "card" }, [
          _vm._m(1),
          _vm._v(" "),
          _c("div", { staticClass: "card-body table-responsive p-0" }, [
            _c("table", { staticClass: "table table-hover" }, [
              _c(
                "tbody",
                [
                  _vm._m(2),
                  _vm._v(" "),
                  _vm._l(_vm.a_pagos, function(pago) {
                    return _c("tr", [
                      _c("td", {
                        domProps: { textContent: _vm._s(pago.reference_code) }
                      }),
                      _vm._v(" "),
                      _c("td", {
                        domProps: { textContent: _vm._s(pago.nombre_curso) }
                      }),
                      _vm._v(" "),
                      _c("td", {
                        domProps: { textContent: _vm._s(pago.valor) }
                      }),
                      _vm._v(" "),
                      _c("td", {
                        domProps: { textContent: _vm._s(pago.fecha_creacion) }
                      })
                    ])
                  })
                ],
                2
              )
            ])
          ])
        ])
      : _vm._e()
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "card-header" }, [
      _c("h3", { staticClass: "card-title" }, [_vm._v("Pagos realizados")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("tr", [
      _c("th", [_vm._v("Id")]),
      _vm._v(" "),
      _c("th", [_vm._v("Curso")]),
      _vm._v(" "),
      _c("th", [_vm._v("Valor")]),
      _vm._v(" "),
      _c("th", [_vm._v("Fecha de Pago")])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-f72b6ad2", module.exports)
  }
}

/***/ }),
/* 10 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(11)
/* template */
var __vue_template__ = __webpack_require__(12)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/foro/ForoGeneralComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-ae84442e", Component.options)
  } else {
    hotAPI.reload("data-v-ae84442e", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 11 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    mounted: function mounted() {
        console.log('Component foro mounted.');
        $('#summernote').summernote({
            callbacks: {
                onImageUpload: function onImageUpload(image) {
                    var sizeKB = image[0]['size'] / 1000;
                    var tmp_pr = 0;
                    if (sizeKB > 1100) {
                        tmp_pr = 1;
                        swal({
                            title: "Seleccione una imagen menor o igual a 1mb",
                            text: '',
                            type: "info"
                        });
                    }
                    if (image[0]['type'] != 'image/jpeg' && image[0]['type'] != 'image/png') {
                        tmp_pr = 1;
                        swal({
                            title: "La imagen debe ser formato png o jpg",
                            text: '',
                            type: "info"
                        });
                    }
                    if (tmp_pr == 0) {
                        var file = image[0];
                        var reader = new FileReader();
                        reader.onloadend = function () {
                            var image = $('<img>').attr('src', reader.result);
                            $('#summernote').summernote("insertNode", image[0]);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            },
            placeholder: 'Escribe tu comentario aqui',
            toolbar: [['groupName', ['picture', 'link', 'video']]],
            image: [],
            height: 150
        });
    },
    created: function created() {
        this.base_url = base_url;
        this.getData();
    },
    data: function data() {
        return {
            base_url: '',
            preload: false,
            a_foros: [],
            loader_publicar: false,
            o_publicar: { 'comentario': '' },
            e_publicar: [],
            o_comentario: { 'indexforo': -1, 'idforo': '', 'comentario': '' },
            preload_coment: false,
            a_comentarios: [],
            loader_responder: false,
            e_comentarios: []
        };
    },
    methods: {
        border: function border(role) {
            var clase = '';
            if (role == 'ad') clase = 'img-bordered-danger';
            if (role == 'in') clase = 'img-bordered-success';
            if (role == 'pr') clase = 'img-bordered-info';
            if (role == 'pa') clase = 'img-bordered-warning';
            return clase;
        },
        getData: function getData() {
            var _this = this;

            this.preload = true;
            var url = 'foro/data';
            axios.post(url, {}).then(function (response) {
                _this.preload = false;
                _this.a_foros = response.data.foros;
            }).catch(function (error) {
                _this.preload = false;
                console.log(error.response.data);
            });
        },
        publicacion: function publicacion() {
            var _this2 = this;

            this.loader_publicar = true;
            var url = 'foro/publicar';
            this.o_publicar.comentario = $('#summernote').summernote('code');
            axios.post(url, this.o_publicar).then(function (response) {
                _this2.getData();
                _this2.o_publicar = { 'comentario': '' };
                $('#summernote').summernote('code', '');
                _this2.loader_publicar = false;
                _this2.e_publicar = [];
                console.log(response.data.foros);
            }).catch(function (error) {
                _this2.loader_publicar = false;
                if (error.response.data.errors) {
                    _this2.e_publicar = error.response.data.errors;
                }
                if (error.response.data.error) {
                    toastr.error(error.response.data.error, '', {
                        "timeOut": "2500"
                    });
                }
                console.log(error.response.data);
            });
        },
        openComentarios: function openComentarios(idforo, indexforo) {

            $('#modalcomentforo').modal('show');
            this.a_comentarios = [];
            this.o_comentario.idforo = idforo;
            this.o_comentario.comentario = '';
            this.o_comentario.indexforo = indexforo;
            this.verComentarios();
        },
        cerrarComentarios: function cerrarComentarios() {
            $('#modalcomentforo').modal('hide');
        },
        verComentarios: function verComentarios() {
            var _this3 = this;

            this.preload_coment = true;
            var url = 'foro/datacoment';
            axios.post(url, { idforo: this.o_comentario.idforo }).then(function (response) {
                _this3.preload_coment = false;
                _this3.a_comentarios = response.data.comentarios;
            }).catch(function (error) {
                _this3.preload_coment = false;
            });
        },
        agregarComentario: function agregarComentario() {
            var _this4 = this;

            this.loader_responder = true;
            this.e_comentarios = [];
            var url = 'foro/comentar';
            axios.post(url, this.o_comentario).then(function (response) {
                _this4.loader_responder = false;
                _this4.o_comentario.comentario = '';
                _this4.a_foros[_this4.o_comentario.indexforo].comentarios = response.data.contcoment;
                _this4.verComentarios();
            }).catch(function (error) {
                _this4.loader_responder = false;
                if (error.response.data.errors) {
                    _this4.e_comentarios = error.response.data.errors;
                }
                if (error.response.data.error) {
                    toastr.error(error.response.data.error, '', {
                        "timeOut": "2500"
                    });
                }
                console.log(error.response.data);
            });
        }
    }
});

/***/ }),
/* 12 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c(
        "div",
        {
          staticClass: "modal fade",
          attrs: {
            id: "modalcomentforo",
            tabindex: "-1",
            role: "dialog",
            "aria-hidden": "true"
          }
        },
        [
          _c(
            "div",
            { staticClass: "modal-dialog", attrs: { role: "document" } },
            [
              _c("div", { staticClass: "modal-content" }, [
                _c("div", { staticClass: "modal-header" }, [
                  _c("div", { staticClass: "input-group" }, [
                    _c("input", {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.o_comentario.comentario,
                          expression: "o_comentario.comentario"
                        }
                      ],
                      staticClass: "form-control",
                      class: [_vm.e_comentarios.comentario ? "is-invalid" : ""],
                      attrs: {
                        type: "text",
                        name: "message",
                        placeholder: "Escribe una respuesta"
                      },
                      domProps: { value: _vm.o_comentario.comentario },
                      on: {
                        input: function($event) {
                          if ($event.target.composing) {
                            return
                          }
                          _vm.$set(
                            _vm.o_comentario,
                            "comentario",
                            $event.target.value
                          )
                        }
                      }
                    }),
                    _vm._v(" "),
                    _c("span", { staticClass: "input-group-append" }, [
                      _c(
                        "button",
                        {
                          staticClass: "btn btn-outline-primary btn-sm",
                          attrs: {
                            type: "button",
                            disabled: _vm.loader_responder
                          },
                          on: {
                            click: function($event) {
                              $event.preventDefault()
                              _vm.agregarComentario()
                            }
                          }
                        },
                        [
                          _vm._v(
                            "\n                Responder\n                "
                          ),
                          _vm.loader_responder
                            ? _c("i", {
                                staticClass: "fa fa-spinner fa-spin fa-loader",
                                staticStyle: { "font-size": "20px" }
                              })
                            : _vm._e()
                        ]
                      )
                    ])
                  ])
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  {
                    staticClass: "modal-body",
                    staticStyle: { height: "300px", "overflow-y": "auto" }
                  },
                  [
                    _c(
                      "div",
                      { staticClass: "card-footer card-comments" },
                      [
                        _vm.preload_coment
                          ? _c("div", { staticClass: "col-md-12" }, [_vm._m(0)])
                          : _vm._e(),
                        _vm._v(" "),
                        _vm._l(_vm.a_comentarios, function(comentario) {
                          return _c("div", { staticClass: "card-comment" }, [
                            _c("img", {
                              staticClass: "user-img-foro img-circle img-sm",
                              class: _vm.border(comentario.role),
                              attrs: {
                                src: _vm.base_url + "/" + comentario.imagen,
                                alt: "User Image"
                              }
                            }),
                            _vm._v(" "),
                            _c("div", { staticClass: "comment-text" }, [
                              _c("span", { staticClass: "username" }, [
                                _c("span", {
                                  domProps: {
                                    textContent: _vm._s(comentario.nombre)
                                  }
                                }),
                                _vm._v(" "),
                                _c("span", {
                                  staticClass: "text-muted float-right",
                                  domProps: {
                                    textContent: _vm._s(
                                      comentario.fecha_creacion
                                    )
                                  }
                                })
                              ]),
                              _vm._v(" "),
                              _c("p", {
                                domProps: {
                                  innerHTML: _vm._s(comentario.descripcion)
                                }
                              })
                            ])
                          ])
                        })
                      ],
                      2
                    )
                  ]
                ),
                _vm._v(" "),
                _c("div", { staticClass: "modal-footer" }, [
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-default float-right btn-sm",
                      attrs: { type: "button" },
                      on: {
                        click: function($event) {
                          $event.preventDefault()
                          _vm.cerrarComentarios()
                        }
                      }
                    },
                    [_c("i", { staticClass: "fa fa-close" }), _vm._v(" Cerrar")]
                  )
                ])
              ])
            ]
          )
        ]
      ),
      _vm._v(" "),
      _c("div", { staticClass: "card" }, [
        _vm._m(1),
        _vm._v(" "),
        _c("div", { staticClass: "card-body" }, [
          _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col-md-12" }, [
              _c("div", { staticClass: "form-group" }, [
                _c("div", { attrs: { id: "summernote" } }),
                _vm._v(" "),
                _vm.e_publicar.comentario
                  ? _c("span", {
                      staticClass: "text-danger",
                      domProps: {
                        textContent: _vm._s(_vm.e_publicar.comentario[0])
                      }
                    })
                  : _vm._e()
              ])
            ])
          ]),
          _vm._v(" "),
          _c(
            "button",
            {
              staticClass: "btn btn-outline-primary btn-sm float-right",
              attrs: { type: "button", disabled: _vm.loader_publicar },
              on: {
                click: function($event) {
                  $event.preventDefault()
                  _vm.publicacion()
                }
              }
            },
            [
              _vm._v("\n      Publicar\n      "),
              _vm.loader_publicar
                ? _c("i", {
                    staticClass: "fa fa-spinner fa-spin fa-loader",
                    staticStyle: { "font-size": "20px" }
                  })
                : _vm._e()
            ]
          )
        ])
      ]),
      _vm._v(" "),
      _vm.preload
        ? _c("div", { staticClass: "col-md-12" }, [_vm._m(2)])
        : _vm._e(),
      _vm._v(" "),
      _vm._l(_vm.a_foros, function(foro, indexforo) {
        return _c("div", { staticClass: "card card-widget" }, [
          _c("div", { staticClass: "card-header" }, [
            _c("div", { staticClass: "user-block" }, [
              _c("img", {
                staticClass: "user-img-foro img-circle",
                class: _vm.border(foro.role),
                attrs: {
                  src: _vm.base_url + "/" + foro.imagenuser,
                  alt: "User Image"
                }
              }),
              _vm._v(" "),
              _c("span", {
                staticClass: "username",
                domProps: { textContent: _vm._s(foro.nombreuser) }
              }),
              _vm._v(" "),
              _c("span", {
                staticClass: "description",
                domProps: { textContent: _vm._s(foro.fecha_creacion) }
              })
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "card-body" }, [
            _c("p", { domProps: { innerHTML: _vm._s(foro.descripcion) } }),
            _vm._v(" "),
            _c("span", { staticClass: "float-right text-muted" }, [
              _c(
                "a",
                {
                  attrs: { href: "#" },
                  on: {
                    click: function($event) {
                      $event.preventDefault()
                      _vm.openComentarios(foro.id, indexforo)
                    }
                  }
                },
                [
                  _c("span", {
                    domProps: { textContent: _vm._s(foro.comentarios) }
                  }),
                  _vm._v(" comentarios\n      ")
                ]
              )
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "card-footer" }, [
            _c("div", { staticClass: "img-push" }, [
              _c("input", {
                staticClass: "form-control form-control-sm",
                attrs: { type: "text", placeholder: "Escribe una respuesta" },
                on: {
                  click: function($event) {
                    _vm.openComentarios(foro.id, indexforo)
                  }
                }
              })
            ])
          ])
        ])
      })
    ],
    2
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "card-header card-header-cuorse" }, [
      _c("h2", { staticClass: "card-title-course" }, [
        _vm._v("Ultimas noticias")
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-ae84442e", module.exports)
  }
}

/***/ }),
/* 13 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(14)
/* template */
var __vue_template__ = __webpack_require__(15)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/foro/ForoCursoComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-b510dc96", Component.options)
  } else {
    hotAPI.reload("data-v-b510dc96", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 14 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    mounted: function mounted() {
        console.log('Component foro curso mounted.');
        $('#summernote').summernote({
            callbacks: {
                onImageUpload: function onImageUpload(image) {
                    var sizeKB = image[0]['size'] / 1000;
                    var tmp_pr = 0;
                    if (sizeKB > 1100) {
                        tmp_pr = 1;
                        swal({
                            title: "Seleccione una imagen menor o igual a 1mb",
                            text: '',
                            type: "info"
                        });
                    }
                    if (image[0]['type'] != 'image/jpeg' && image[0]['type'] != 'image/png') {
                        tmp_pr = 1;
                        swal({
                            title: "La imagen debe ser formato png o jpg",
                            text: '',
                            type: "info"
                        });
                    }
                    if (tmp_pr == 0) {
                        var file = image[0];
                        var reader = new FileReader();
                        reader.onloadend = function () {
                            var image = $('<img>').attr('src', reader.result);
                            $('#summernote').summernote("insertNode", image[0]);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            },
            placeholder: 'Escribe tu comentario aqui',
            toolbar: [['groupName', ['picture', 'link', 'video']]],
            image: [],
            height: 150
        });
    },
    created: function created() {
        this.base_url = base_url;
        this.idcurso = document.getElementById('idcurso').value;
        this.getData();
    },
    data: function data() {
        return {
            preload: false,
            a_foros: [],
            loader_publicar: false,
            o_publicar: { 'comentario': '' },
            e_publicar: [],
            o_comentario: { 'indexforo': -1, 'idforo': '', 'comentario': '' },
            preload_coment: false,
            a_comentarios: [],
            loader_responder: false,
            e_comentarios: []
        };
    },
    methods: {
        border: function border(role) {
            var clase = '';
            if (role == 'ad') clase = 'img-bordered-danger';
            if (role == 'in') clase = 'img-bordered-success';
            if (role == 'pr') clase = 'img-bordered-info';
            if (role == 'pa') clase = 'img-bordered-warning';
            return clase;
        },
        getData: function getData() {
            var _this = this;

            this.preload = true;
            var url = this.base_url + '/foroc/data';
            console.log(url);
            axios.post(url, { idcurso: this.idcurso }).then(function (response) {
                _this.preload = false;
                _this.a_foros = response.data.foros;
            }).catch(function (error) {
                _this.preload = false;
                console.log(error.response.data);
            });
        },
        publicacion: function publicacion() {
            var _this2 = this;

            this.loader_publicar = true;
            this.o_publicar.comentario = $('#summernote').summernote('code');
            this.o_publicar.idcurso = this.idcurso;
            var url = this.base_url + '/foroc/publicar';
            axios.post(url, this.o_publicar).then(function (response) {
                //this.a_foros.unshift({'nombreuser':'cargfasdf'});
                _this2.getData();
                _this2.o_publicar = { 'comentario': '' };
                $('#summernote').summernote('code', '');
                _this2.loader_publicar = false;
                _this2.e_publicar = [];
                console.log(response.data.foros);
            }).catch(function (error) {
                _this2.loader_publicar = false;
                if (error.response.data.errors) {
                    _this2.e_publicar = error.response.data.errors;
                }
                if (error.response.data.error) {
                    toastr.error(error.response.data.error, '', {
                        "timeOut": "2500"
                    });
                }
                console.log(error.response.data);
            });
        },
        openComentarios: function openComentarios(idforo, indexforo) {

            $('#modalcomentforo').modal('show');
            this.a_comentarios = [];
            this.o_comentario.idforo = idforo;
            this.o_comentario.comentario = '';
            this.o_comentario.indexforo = indexforo;
            this.verComentarios();
        },
        cerrarComentarios: function cerrarComentarios() {
            $('#modalcomentforo').modal('hide');
        },
        verComentarios: function verComentarios() {
            var _this3 = this;

            this.preload_coment = true;
            var url = this.base_url + '/foroc/datacoment';
            axios.post(url, { idforo: this.o_comentario.idforo }).then(function (response) {
                _this3.preload_coment = false;
                _this3.a_comentarios = response.data.comentarios;
            }).catch(function (error) {
                _this3.preload_coment = false;
            });
        },
        agregarComentario: function agregarComentario() {
            var _this4 = this;

            this.loader_responder = true;
            this.e_comentarios = [];
            var url = base_url + '/foroc/comentar';
            axios.post(url, this.o_comentario).then(function (response) {
                _this4.loader_responder = false;
                _this4.o_comentario.comentario = '';
                _this4.a_foros[_this4.o_comentario.indexforo].comentarios = response.data.contcoment;
                _this4.verComentarios();
            }).catch(function (error) {
                _this4.loader_responder = false;
                if (error.response.data.errors) {
                    _this4.e_comentarios = error.response.data.errors;
                }
                if (error.response.data.error) {
                    toastr.error(error.response.data.error, '', {
                        "timeOut": "2500"
                    });
                }
                console.log(error.response.data);
            });
        }
    }, beforeUpdate: function beforeUpdate() {
        console.log('Empiezanuevo renderizado de component');
    }
});

/***/ }),
/* 15 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c(
      "div",
      {
        staticClass: "modal fade",
        attrs: {
          id: "modalcomentforo",
          tabindex: "-1",
          role: "dialog",
          "aria-hidden": "true"
        }
      },
      [
        _c(
          "div",
          { staticClass: "modal-dialog", attrs: { role: "document" } },
          [
            _c("div", { staticClass: "modal-content" }, [
              _c("div", { staticClass: "modal-header" }, [
                _c("div", { staticClass: "input-group" }, [
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.o_comentario.comentario,
                        expression: "o_comentario.comentario"
                      }
                    ],
                    staticClass: "form-control",
                    class: [_vm.e_comentarios.comentario ? "is-invalid" : ""],
                    attrs: {
                      type: "text",
                      name: "message",
                      placeholder: "Escribe una respuesta"
                    },
                    domProps: { value: _vm.o_comentario.comentario },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(
                          _vm.o_comentario,
                          "comentario",
                          $event.target.value
                        )
                      }
                    }
                  }),
                  _vm._v(" "),
                  _c("span", { staticClass: "input-group-append" }, [
                    _c(
                      "button",
                      {
                        staticClass: "btn btn-outline-primary btn-sm",
                        attrs: {
                          type: "button",
                          disabled: _vm.loader_responder
                        },
                        on: {
                          click: function($event) {
                            $event.preventDefault()
                            _vm.agregarComentario()
                          }
                        }
                      },
                      [
                        _vm._v(
                          "\n                  Responder\n                  "
                        ),
                        _vm.loader_responder
                          ? _c("i", {
                              staticClass: "fa fa-spinner fa-spin fa-loader",
                              staticStyle: { "font-size": "20px" }
                            })
                          : _vm._e()
                      ]
                    )
                  ])
                ])
              ]),
              _vm._v(" "),
              _c(
                "div",
                {
                  staticClass: "modal-body",
                  staticStyle: { height: "300px", "overflow-y": "auto" }
                },
                [
                  _c(
                    "div",
                    { staticClass: "card-footer card-comments" },
                    [
                      _vm.preload_coment
                        ? _c("div", { staticClass: "col-md-12" }, [_vm._m(0)])
                        : _vm._e(),
                      _vm._v(" "),
                      _vm._l(_vm.a_comentarios, function(comentario) {
                        return _c("div", { staticClass: "card-comment" }, [
                          _c("img", {
                            staticClass: "user-img-foro  img-circle img-sm",
                            class: _vm.border(comentario.role),
                            attrs: {
                              src: _vm.base_url + "/" + comentario.imagen,
                              alt: "User Image"
                            }
                          }),
                          _vm._v(" "),
                          _c("div", { staticClass: "comment-text" }, [
                            _c("span", { staticClass: "username" }, [
                              _c("span", {
                                domProps: {
                                  textContent: _vm._s(comentario.nombre)
                                }
                              }),
                              _vm._v(" "),
                              _c("span", {
                                staticClass: "text-muted float-right",
                                domProps: {
                                  textContent: _vm._s(comentario.fecha_creacion)
                                }
                              })
                            ]),
                            _vm._v(" "),
                            _c("p", {
                              domProps: {
                                innerHTML: _vm._s(comentario.descripcion)
                              }
                            })
                          ])
                        ])
                      })
                    ],
                    2
                  )
                ]
              ),
              _vm._v(" "),
              _c("div", { staticClass: "modal-footer" }, [
                _c(
                  "button",
                  {
                    staticClass: "btn btn-default float-right btn-sm",
                    attrs: { type: "button" },
                    on: {
                      click: function($event) {
                        $event.preventDefault()
                        _vm.cerrarComentarios()
                      }
                    }
                  },
                  [_c("i", { staticClass: "fa fa-close" }), _vm._v(" Cerrar")]
                )
              ])
            ])
          ]
        )
      ]
    ),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "row" },
      [
        _c("div", { staticClass: "col-md-12" }, [
          _c("div", { staticClass: "card " }, [
            _c("div", { staticClass: "card-body" }, [
              _c("div", { staticClass: "row" }, [
                _c("div", { staticClass: "col-md-12" }, [
                  _c("div", { staticClass: "form-group" }, [
                    _c("div", { attrs: { id: "summernote" } }),
                    _vm._v(" "),
                    _vm.e_publicar.comentario
                      ? _c("span", {
                          staticClass: "text-danger",
                          domProps: {
                            textContent: _vm._s(_vm.e_publicar.comentario[0])
                          }
                        })
                      : _vm._e()
                  ])
                ])
              ]),
              _vm._v(" "),
              _c(
                "button",
                {
                  staticClass: "btn btn-outline-primary btn-sm float-right",
                  attrs: { type: "button", disabled: _vm.loader_publicar },
                  on: {
                    click: function($event) {
                      $event.preventDefault()
                      _vm.publicacion()
                    }
                  }
                },
                [
                  _vm._v("\n                Publicar\n                "),
                  _vm.loader_publicar
                    ? _c("i", {
                        staticClass: "fa fa-spinner fa-spin fa-loader",
                        staticStyle: { "font-size": "20px" }
                      })
                    : _vm._e()
                ]
              )
            ])
          ])
        ]),
        _vm._v(" "),
        _vm.preload
          ? _c("div", { staticClass: "col-md-12" }, [_vm._m(1)])
          : _vm._e(),
        _vm._v(" "),
        _vm._l(_vm.a_foros, function(foro, indexforo) {
          return _c("div", { staticClass: "col-md-12" }, [
            _c("div", { staticClass: "card card-widget" }, [
              _c("div", { staticClass: "card-header" }, [
                _c("div", { staticClass: "user-block" }, [
                  _c("img", {
                    staticClass: "user-img-foro img-circle",
                    class: _vm.border(foro.role),
                    attrs: {
                      src: _vm.base_url + "/" + foro.imagenuser,
                      alt: "User Image"
                    }
                  }),
                  _vm._v(" "),
                  _c("span", {
                    staticClass: "username",
                    domProps: { textContent: _vm._s(foro.nombreuser) }
                  }),
                  _vm._v(" "),
                  _c("span", {
                    staticClass: "description",
                    domProps: { textContent: _vm._s(foro.fecha_creacion) }
                  })
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "card-body" }, [
                _c("p", { domProps: { innerHTML: _vm._s(foro.descripcion) } }),
                _vm._v(" "),
                _c("span", { staticClass: "float-right text-muted" }, [
                  _c(
                    "a",
                    {
                      attrs: { href: "#" },
                      on: {
                        click: function($event) {
                          $event.preventDefault()
                          _vm.openComentarios(foro.id, indexforo)
                        }
                      }
                    },
                    [
                      _c("span", {
                        domProps: { textContent: _vm._s(foro.comentarios) }
                      }),
                      _vm._v(" comentarios\n            ")
                    ]
                  )
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "card-footer" }, [
                _c("div", { staticClass: "img-push" }, [
                  _c("input", {
                    staticClass: "form-control form-control-sm",
                    attrs: {
                      type: "text",
                      placeholder: "Escribe una respuesta"
                    },
                    on: {
                      click: function($event) {
                        _vm.openComentarios(foro.id, indexforo)
                      }
                    }
                  })
                ])
              ])
            ])
          ])
        })
      ],
      2
    )
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-b510dc96", module.exports)
  }
}

/***/ }),
/* 16 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(17)
/* template */
var __vue_template__ = __webpack_require__(18)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/progreso/ProgresoEstudianteComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-4074ec27", Component.options)
  } else {
    hotAPI.reload("data-v-4074ec27", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 17 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {
    console.log('Component pregreso mounted.');
  },
  created: function created() {
    this.base_url = base_url;
    this.idcurso = document.getElementById('idcurso').value;
    this.listado();
  },
  data: function data() {
    return {
      id: 0,
      preload: false,
      a_progreso: []
    };
  },
  methods: {
    listado: function listado() {
      var _this = this;

      var url = this.base_url + '/progreso/lista';
      this.preload = true;
      axios.post(url, { idcurso: this.idcurso }).then(function (response) {
        _this.preload = false;
        _this.a_progreso = response.data.progreso;
      }).catch(function (error) {
        _this.preload = false;
        _this.a_progreso = [];
        if (error.response.data.errors) {}
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
      });
    },
    leccionLeida: function leccionLeida(idmodulo, idleccion, leido) {
      var _this2 = this;

      if (leido == false) {
        var url = this.base_url + '/progreso/guardar';
        axios.post(url, { idmodulo: idmodulo, id: idleccion }).then(function (response) {
          _this2.listado();
          swal({
            title: response.data.message,
            text: response.data.message2,
            type: "success"
          });
        }).catch(function (error) {
          if (error.response.data.errors) {
            _this2.e_curso = error.response.data.errors;
          }
          if (error.response.data.error) {
            toastr.error(error.response.data.error, '', {
              "timeOut": "3500"
            });
          }
        });
      }
    },
    porcent: function porcent(numerador, denominador) {

      if (denominador == 0) {
        return 0;
      } else {
        return numerador / denominador * 100;
      }
    }
  }
});

/***/ }),
/* 18 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _vm.preload ? _c("div", { staticClass: "row" }, [_vm._m(0)]) : _vm._e(),
      _vm._v(" "),
      _vm._l(_vm.a_progreso, function(progreso, index) {
        return _c("div", { staticClass: "card" }, [
          _c("div", { staticClass: "card-header no-border" }, [
            _c("h3", { staticClass: "card-title" }, [
              _c("div", { staticClass: "progress-group" }, [
                _vm._v("\n            Modulo "),
                _c("span", {
                  domProps: { textContent: _vm._s(progreso.numero) }
                }),
                _vm._v(" : "),
                _c("span", {
                  domProps: { textContent: _vm._s(progreso.nombre) }
                }),
                _vm._v(" "),
                _c("span", { staticClass: "float-right" }, [
                  _c("span", {
                    domProps: { textContent: _vm._s(progreso.cantlec_leidas) }
                  }),
                  _vm._v("/"),
                  _c("b", [
                    _c("span", {
                      domProps: { textContent: _vm._s(progreso.cantlec) }
                    })
                  ])
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "progress" }, [
                  _c(
                    "div",
                    {
                      staticClass: "progress-bar bg-primary",
                      style:
                        "width:" +
                        _vm.porcent(progreso.cantlec_leidas, progreso.cantlec) +
                        "%"
                    },
                    [
                      _vm._v("Progreso modulo "),
                      _c("span", {
                        domProps: {
                          textContent: _vm._s(
                            _vm.porcent(
                              progreso.cantlec_leidas,
                              progreso.cantlec
                            )
                          )
                        }
                      }),
                      _vm._v("%")
                    ]
                  )
                ])
              ])
            ])
          ]),
          _vm._v(" "),
          _c(
            "div",
            { staticClass: "card-body" },
            _vm._l(progreso.lecciones, function(leccion) {
              return _c("div", { staticClass: "card" }, [
                _c(
                  "div",
                  {
                    staticClass: "card-header",
                    staticStyle: { padding: ".2rem 1.25rem" }
                  },
                  [
                    _c(
                      "h5",
                      {
                        staticClass: "card-title",
                        staticStyle: { "font-size": "1rem" }
                      },
                      [
                        leccion.leido
                          ? _c(
                              "a",
                              {
                                staticClass: "collapsed",
                                attrs: {
                                  "data-toggle": "collapse",
                                  href: "#" + progreso.id + "-" + leccion.id,
                                  "aria-expanded": "false"
                                }
                              },
                              [
                                _vm._v("\n              Leccion "),
                                _c("span", {
                                  domProps: {
                                    textContent: _vm._s(leccion.numero)
                                  }
                                }),
                                _vm._v(" : "),
                                _c("span", {
                                  domProps: {
                                    textContent: _vm._s(leccion.nombre)
                                  }
                                }),
                                _vm._v(" "),
                                leccion.leido
                                  ? _c("i", { staticClass: "fa fa-check" })
                                  : _vm._e()
                              ]
                            )
                          : _vm._e(),
                        _vm._v(" "),
                        leccion.leido
                          ? _c(
                              "small",
                              {
                                staticClass: "badge badge-primary float-right"
                              },
                              [
                                _c("i", { staticClass: "fa fa-clock-o" }),
                                _vm._v(" "),
                                _c("span", {
                                  domProps: {
                                    textContent: _vm._s(leccion.tiempolectura)
                                  }
                                }),
                                _vm._v(" minutos\n              ")
                              ]
                            )
                          : _vm._e(),
                        _vm._v(" "),
                        !leccion.leido
                          ? _c(
                              "a",
                              {
                                staticClass: "collapsed",
                                staticStyle: { color: "grey" },
                                attrs: {
                                  "data-toggle": "collapse",
                                  href: "#" + progreso.id + "-" + leccion.id,
                                  "aria-expanded": "false"
                                }
                              },
                              [
                                _vm._v("\n                Leccion "),
                                _c("span", {
                                  domProps: {
                                    textContent: _vm._s(leccion.numero)
                                  }
                                }),
                                _vm._v(" : "),
                                _c("span", {
                                  domProps: {
                                    textContent: _vm._s(leccion.nombre)
                                  }
                                }),
                                _vm._v(" "),
                                leccion.leido
                                  ? _c("i", { staticClass: "fa fa-check" })
                                  : _vm._e()
                              ]
                            )
                          : _vm._e(),
                        _vm._v(" "),
                        !leccion.leido
                          ? _c(
                              "small",
                              {
                                staticClass: "badge badge-default float-right"
                              },
                              [
                                _c("i", { staticClass: "fa fa-clock-o" }),
                                _vm._v(" "),
                                _c("span", {
                                  domProps: {
                                    textContent: _vm._s(leccion.tiempolectura)
                                  }
                                }),
                                _vm._v(" minutos\n              ")
                              ]
                            )
                          : _vm._e()
                      ]
                    )
                  ]
                ),
                _vm._v(" "),
                _c(
                  "div",
                  {
                    staticClass: "panel-collapse in collapse",
                    attrs: { id: progreso.id + "-" + leccion.id }
                  },
                  [
                    _c("div", {
                      staticClass: "card-body",
                      domProps: { innerHTML: _vm._s(leccion.descripcion) }
                    }),
                    _vm._v(" "),
                    _c("div", { staticClass: "card-footer" }, [
                      _c(
                        "a",
                        {
                          staticClass:
                            "btn btn-outline-primary btn-sm collapsed",
                          attrs: {
                            "data-toggle": "collapse",
                            href: "#" + progreso.id + "-" + leccion.id,
                            "aria-expanded": "false"
                          },
                          on: {
                            click: function($event) {
                              $event.preventDefault()
                              _vm.leccionLeida(
                                progreso.id,
                                leccion.id,
                                leccion.leido
                              )
                            }
                          }
                        },
                        [_vm._v("\n                Finalizar\n              ")]
                      )
                    ])
                  ]
                )
              ])
            })
          )
        ])
      })
    ],
    2
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-4074ec27", module.exports)
  }
}

/***/ }),
/* 19 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(20)
/* template */
var __vue_template__ = __webpack_require__(21)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/progreso/ProgresoProfesorComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-227aec0f", Component.options)
  } else {
    hotAPI.reload("data-v-227aec0f", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 20 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {
    console.log('Component pregreso mounted.');
  },
  created: function created() {
    this.base_url = base_url;
    this.idcurso = document.getElementById('idcurso').value;
    this.listado();
  },
  data: function data() {
    return {
      id: 0,
      preload: false,
      preloadmodal: false,
      a_progreso: [],
      a_progmod: []
    };
  },
  methods: {
    dartoque: function dartoque(id, idmodulo) {
      var _this = this;

      var url = this.base_url + '/progreso/toque';
      axios.post(url, { idcurso: this.idcurso, id: id, idmodulo: idmodulo }).then(function (response) {
        var inst = _this;
        _this.$root.$emit('notifi_cli', response.data.notifi_tk);
        swal({
          title: response.data.message,
          text: response.data.message2,
          type: "success"
        });
      }).catch(function (error) {
        if (error.response.data.errors) {
          _this.e_tarea = error.response.data.errors;
        }
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "2500"
          });
        }
      });
    },
    listado: function listado() {
      var _this2 = this;

      var url = this.base_url + '/progreso/lista_pr';
      this.preload = true;
      axios.post(url, { idcurso: this.idcurso }).then(function (response) {
        _this2.preload = false;
        _this2.a_progreso = response.data.progreso;
      }).catch(function (error) {
        _this2.preload = false;
        _this2.a_progreso = [];
        if (error.response.data.errors) {}
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
      });
    },
    porcent: function porcent(numerador, denominador) {

      if (denominador == 0) {
        return 0;
      } else {
        return numerador / denominador * 100;
      }
    },
    estadoporcent: function estadoporcent(numerador, denominador) {

      if (denominador == 0) {
        return false;
      } else {
        var porcen = numerador / denominador * 100;
        if (porcen < 100) return false;
        return true;
      }
    },
    progresomodulo: function progresomodulo(id) {
      var _this3 = this;

      $('#modal_progmod').modal('show');
      var url = this.base_url + '/progreso/progmod';
      this.preloadmodal = true;
      axios.post(url, { idcurso: this.idcurso, idmodulo: id }).then(function (response) {
        _this3.preloadmodal = false;
        _this3.a_progmod = response.data.progmod;
        console.log(response.data);
      }).catch(function (error) {
        _this3.preloadmodal = false;
        _this3.a_progmod = [];
        if (error.response.data.errors) {}
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
      });
    }
  }
});

/***/ }),
/* 21 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c(
        "div",
        {
          staticClass: "modal fade",
          attrs: {
            id: "modal_progmod",
            tabindex: "-1",
            role: "dialog",
            "aria-hidden": "true"
          }
        },
        [
          _c(
            "div",
            {
              staticClass: "modal-dialog modal-lg",
              attrs: { role: "document" }
            },
            [
              _c("div", { staticClass: "modal-content" }, [
                _vm._m(0),
                _vm._v(" "),
                _c(
                  "div",
                  {
                    staticClass: "modal-body",
                    staticStyle: { height: "350px", "overflow-y": "auto" }
                  },
                  [
                    _vm.preloadmodal
                      ? _c("div", { staticClass: "row" }, [_vm._m(1)])
                      : _vm._e(),
                    _vm._v(" "),
                    !_vm.preloadmodal
                      ? _c(
                          "table",
                          { staticClass: "table  table-valign-middle" },
                          [
                            _vm._m(2),
                            _vm._v(" "),
                            _c(
                              "tbody",
                              _vm._l(_vm.a_progmod, function(progmod) {
                                return _c("tr", [
                                  _c("td", [
                                    _c(
                                      "a",
                                      {
                                        attrs: { href: "#" },
                                        on: {
                                          click: function($event) {
                                            $event.preventDefault()
                                            _vm.dartoque(
                                              progmod.id,
                                              progmod.idmodulo
                                            )
                                          }
                                        }
                                      },
                                      [
                                        _c("i", {
                                          staticClass: "fa fa-hand-lizard-o"
                                        })
                                      ]
                                    )
                                  ]),
                                  _vm._v(" "),
                                  _c("td", [
                                    _c("img", {
                                      staticClass:
                                        "img-circle img-size-32 mr-2",
                                      attrs: {
                                        src: _vm.base_url + "/" + progmod.imagen
                                      }
                                    }),
                                    _vm._v(" "),
                                    _c("span", {
                                      domProps: {
                                        textContent: _vm._s(progmod.nombre)
                                      }
                                    })
                                  ]),
                                  _vm._v(" "),
                                  _c("td", [
                                    _vm.estadoporcent(
                                      progmod.cantleccuser,
                                      progmod.cantlecc
                                    )
                                      ? _c(
                                          "small",
                                          {
                                            staticClass: "badge badge-success"
                                          },
                                          [
                                            _vm._v(" Completo "),
                                            _c("span", {
                                              domProps: {
                                                textContent: _vm._s(
                                                  progmod.cantleccuser
                                                )
                                              }
                                            }),
                                            _vm._v("/"),
                                            _c("span", {
                                              domProps: {
                                                textContent: _vm._s(
                                                  progmod.cantlecc
                                                )
                                              }
                                            })
                                          ]
                                        )
                                      : _vm._e(),
                                    _vm._v(" "),
                                    !_vm.estadoporcent(
                                      progmod.cantleccuser,
                                      progmod.cantlecc
                                    )
                                      ? _c(
                                          "small",
                                          { staticClass: "badge badge-danger" },
                                          [
                                            _vm._v(" Incompleto "),
                                            _c("span", {
                                              domProps: {
                                                textContent: _vm._s(
                                                  progmod.cantleccuser
                                                )
                                              }
                                            }),
                                            _vm._v("/"),
                                            _c("span", {
                                              domProps: {
                                                textContent: _vm._s(
                                                  progmod.cantlecc
                                                )
                                              }
                                            })
                                          ]
                                        )
                                      : _vm._e()
                                  ]),
                                  _vm._v(" "),
                                  _c("td", [
                                    _c("div", { staticClass: "progress" }, [
                                      _c(
                                        "div",
                                        {
                                          staticClass:
                                            "progress-bar bg-primary",
                                          style:
                                            "width:" +
                                            _vm.porcent(
                                              progmod.cantleccuser,
                                              progmod.cantlecc
                                            ) +
                                            "%"
                                        },
                                        [
                                          _vm._v("Progreso "),
                                          _c("span", {
                                            domProps: {
                                              textContent: _vm._s(
                                                _vm.porcent(
                                                  progmod.cantleccuser,
                                                  progmod.cantlecc
                                                )
                                              )
                                            }
                                          }),
                                          _vm._v("%")
                                        ]
                                      )
                                    ])
                                  ])
                                ])
                              })
                            )
                          ]
                        )
                      : _vm._e()
                  ]
                )
              ])
            ]
          )
        ]
      ),
      _vm._v(" "),
      _vm.preload ? _c("div", { staticClass: "row" }, [_vm._m(3)]) : _vm._e(),
      _vm._v(" "),
      _vm._l(_vm.a_progreso, function(progreso, index) {
        return _c("div", { staticClass: "card" }, [
          _c("div", { staticClass: "card-header no-border" }, [
            _c("h3", { staticClass: "card-title" }, [
              _c("div", { staticClass: "progress-group" }, [
                _vm._v("\n            Modulo "),
                _c("span", {
                  domProps: { textContent: _vm._s(progreso.numero) }
                }),
                _vm._v(" : "),
                _c("span", {
                  domProps: { textContent: _vm._s(progreso.nombre) }
                }),
                _vm._v(" "),
                _c("span", { staticClass: "float-right" }, [
                  _c("span", {
                    domProps: { textContent: _vm._s(progreso.cant_leccuser) }
                  }),
                  _vm._v("/"),
                  _c("b", [
                    _c("span", {
                      domProps: { textContent: _vm._s(progreso.cant_user) }
                    })
                  ]),
                  _vm._v(" "),
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-tool",
                      attrs: { type: "button", "data-toggle": "modal" },
                      on: {
                        click: function($event) {
                          $event.preventDefault()
                          _vm.progresomodulo(progreso.id)
                        }
                      }
                    },
                    [
                      _c("i", {
                        staticClass: "fa fa-eye",
                        staticStyle: { "font-size": "20px" }
                      })
                    ]
                  )
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "progress" }, [
                  _c(
                    "div",
                    {
                      staticClass: "progress-bar bg-primary",
                      style:
                        "width:" +
                        _vm.porcent(
                          progreso.cant_leccuser,
                          progreso.cant_user
                        ) +
                        "%"
                    },
                    [
                      _vm._v("Progreso modulo "),
                      _c("span", {
                        domProps: {
                          textContent: _vm._s(
                            _vm.porcent(
                              progreso.cant_leccuser,
                              progreso.cant_user
                            )
                          )
                        }
                      }),
                      _vm._v("%")
                    ]
                  )
                ])
              ])
            ])
          ]),
          _vm._v(" "),
          _c(
            "div",
            { staticClass: "card-body" },
            _vm._l(progreso.lecciones, function(leccion) {
              return _c("div", { staticClass: "card" }, [
                _c(
                  "div",
                  {
                    staticClass: "card-header",
                    staticStyle: { padding: ".2rem 1.25rem" }
                  },
                  [
                    _c(
                      "h5",
                      {
                        staticClass: "card-title",
                        staticStyle: { "font-size": "1rem" }
                      },
                      [
                        _c(
                          "a",
                          {
                            staticClass: "collapsed",
                            attrs: {
                              "data-toggle": "collapse",
                              href: "#" + progreso.id + "-" + leccion.id,
                              "aria-expanded": "false"
                            }
                          },
                          [
                            _vm._v("\n              Leccion "),
                            _c("span", {
                              domProps: { textContent: _vm._s(leccion.numero) }
                            }),
                            _vm._v(" : "),
                            _c("span", {
                              domProps: { textContent: _vm._s(leccion.nombre) }
                            })
                          ]
                        ),
                        _vm._v(" "),
                        _c(
                          "small",
                          { staticClass: "badge badge-primary float-right" },
                          [
                            _c("i", { staticClass: "fa fa-clock-o" }),
                            _vm._v(" "),
                            _c("span", {
                              domProps: {
                                textContent: _vm._s(leccion.tiempolectura)
                              }
                            }),
                            _vm._v(" minutos\n              ")
                          ]
                        )
                      ]
                    )
                  ]
                ),
                _vm._v(" "),
                _c(
                  "div",
                  {
                    staticClass: "panel-collapse in collapse",
                    attrs: { id: progreso.id + "-" + leccion.id }
                  },
                  [
                    _c("div", {
                      staticClass: "card-body",
                      domProps: { innerHTML: _vm._s(leccion.descripcion) }
                    }),
                    _vm._v(" "),
                    _c("div", { staticClass: "card-footer" }, [
                      _c(
                        "a",
                        {
                          staticClass:
                            "btn btn-outline-primary btn-sm collapsed",
                          attrs: {
                            "data-toggle": "collapse",
                            href: "#" + progreso.id + "-" + leccion.id,
                            "aria-expanded": "false"
                          }
                        },
                        [_vm._v("\n                Finalizar\n              ")]
                      )
                    ])
                  ]
                )
              ])
            })
          )
        ])
      })
    ],
    2
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "modal-header" }, [
      _vm._v("\n            Progreso modulo"),
      _c(
        "button",
        {
          staticClass: "close",
          attrs: { type: "button", "data-dismiss": "modal" }
        },
        [_vm._v("×")]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [
      _c("tr", [
        _c("th", [_vm._v("Dar un toque")]),
        _vm._v(" "),
        _c("th", [_vm._v("Estudiante")]),
        _vm._v(" "),
        _c("th", [_vm._v("Estado")]),
        _vm._v(" "),
        _c("th", [_vm._v("Lecciones")])
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-227aec0f", module.exports)
  }
}

/***/ }),
/* 22 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(23)
/* template */
var __vue_template__ = __webpack_require__(24)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/integrantes/IntegrantesComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-6ce7d4e2", Component.options)
  } else {
    hotAPI.reload("data-v-6ce7d4e2", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 23 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {
    console.log('Component integrantes mounted.');
    var vm = this;
    this.$root.$on('private_message_serve', function (data) {
      //console.log(data.chat_id+"=="+vm.idchat+'lleog');
      if (data.chat_id == vm.idchat) {
        vm.leidochat(data);
      } else {
        this.$root.$emit('notifi_message_cli', data);
      }
    });

    //se activa una vez se cierre el modal
    $(this.$refs.ref_modal_chat).on("hidden.bs.modal", this.resetUserchat);
  },
  created: function created() {
    this.base_url = base_url;
    this.idcurso = document.getElementById('idcurso').value;
    this.listado();
  },
  data: function data() {
    return {
      idcurso: 0,
      preload: true,
      a_integrantes: [],
      preloadmodal: false,
      chat_mensajes: [],
      idchat: 0,
      id_userchat: 0, //usuario al que se envia el mensaje
      loader_responder: false,
      mensaje_chat: '',
      rol_user: ''
    };
  },
  methods: {
    resetUserchat: function resetUserchat() {
      this.chat_mensajes = [];
      this.idchat = 0;
      this.id_userchat = 0;
    },
    listado: function listado() {
      var _this = this;

      var url = base_url + '/integrantes/lista';
      this.preload = true;
      axios.post(url, { idcurso: this.idcurso }).then(function (response) {
        _this.preload = false;
        _this.a_integrantes = response.data.integrantes;
        _this.rol_user = response.data.slugrol;
      }).catch(function (error) {
        _this.preload = false;
        if (error.response.data.errors) {}
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
      });
    },
    chatuser: function chatuser(iduser) {
      var _this2 = this;

      $('#modal_chat').modal('show');
      var url = this.base_url + '/chatprivado/open';
      this.preloadmodal = true;
      this.chat_mensajes = [];
      this.id_userchat = iduser;
      axios.post(url, { iduser: iduser }).then(function (response) {
        _this2.preloadmodal = false;
        _this2.chat_mensajes = response.data.chat_mensajes;
        _this2.$nextTick(function () {
          _this2.$refs.content_chat.scrollTop = _this2.$refs.content_chat.scrollHeight;
        });
        _this2.idchat = response.data.idchat;
      }).catch(function (error) {
        _this2.preloadmodal = false;
        if (error.response.data.errors) {}
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
      });
    },
    responderchat: function responderchat() {
      var _this3 = this;

      var url = this.base_url + '/chatprivado/responder';
      this.loader_responder = true;
      axios.post(url, { idchat: this.idchat, mensaje_chat: this.mensaje_chat, idcurso: this.idcurso, iduser: this.id_userchat }).then(function (response) {
        _this3.chat_mensajes.push(response.data.chat_enviado);
        _this3.$nextTick(function () {
          _this3.$refs.content_chat.scrollTop = _this3.$refs.content_chat.scrollHeight;
        });

        _this3.loader_responder = false;
        _this3.mensaje_chat = '';
        _this3.$root.$emit('private_message_cli', response.data.chat_enviado);
      }).catch(function (error) {
        _this3.loader_responder = false;
      });
    },
    leidochat: function leidochat(data) {
      var _this4 = this;

      var url = this.base_url + '/chatprivado/leido';
      axios.post(url, { idchat: data.chat_id, remitente: data.remitente }).then(function (response) {
        _this4.chat_mensajes.push(data);
        _this4.$nextTick(function () {
          _this4.$refs.content_chat.scrollTop = _this4.$refs.content_chat.scrollHeight;
        });
      }).catch(function (error) {});
    }
  }
});

/***/ }),
/* 24 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c(
      "div",
      {
        ref: "ref_modal_chat",
        staticClass: "modal fade",
        attrs: { id: "modal_chat" }
      },
      [
        _c(
          "div",
          { staticClass: "modal-dialog modal-lg", attrs: { role: "document" } },
          [
            _c("div", { staticClass: "modal-content" }, [
              _vm._m(0),
              _vm._v(" "),
              _c(
                "div",
                {
                  ref: "content_chat",
                  staticClass: "modal-body",
                  staticStyle: { height: "300px", "overflow-y": "auto" }
                },
                [
                  _vm.preloadmodal
                    ? _c("div", { staticClass: "row" }, [_vm._m(1)])
                    : _vm._e(),
                  _vm._v(" "),
                  _c(
                    "div",
                    {
                      staticClass: "direct-chat-messages direct-chat-info",
                      staticStyle: { overflow: "initial" }
                    },
                    _vm._l(_vm.chat_mensajes, function(chat) {
                      return _c(
                        "div",
                        {
                          staticClass: "direct-chat-msg",
                          class:
                            _vm.id_userchat == chat.remitente ? "" : "right"
                        },
                        [
                          _vm.id_userchat == chat.remitente
                            ? _c(
                                "div",
                                { staticClass: "direct-chat-info clearfix" },
                                [
                                  _c("span", {
                                    staticClass: "direct-chat-name float-left",
                                    domProps: {
                                      textContent: _vm._s(chat.nomremitente)
                                    }
                                  }),
                                  _vm._v(" "),
                                  _c("span", {
                                    staticClass:
                                      "direct-chat-timestamp float-right",
                                    domProps: {
                                      textContent: _vm._s(chat.fecha_creacion)
                                    }
                                  })
                                ]
                              )
                            : _c(
                                "div",
                                { staticClass: "direct-chat-info clearfix" },
                                [
                                  _c("span", {
                                    staticClass: "direct-chat-name float-right",
                                    domProps: {
                                      textContent: _vm._s(chat.nomremitente)
                                    }
                                  }),
                                  _vm._v(" "),
                                  _c("span", {
                                    staticClass:
                                      "direct-chat-timestamp float-left",
                                    domProps: {
                                      textContent: _vm._s(chat.fecha_creacion)
                                    }
                                  })
                                ]
                              ),
                          _vm._v(" "),
                          _c("img", {
                            staticClass: "direct-chat-img",
                            attrs: {
                              src: _vm.base_url + "/" + chat.imgremitente,
                              alt: ""
                            }
                          }),
                          _vm._v(" "),
                          _c("div", {
                            staticClass: "direct-chat-text",
                            domProps: { innerHTML: _vm._s(chat.mensaje) }
                          })
                        ]
                      )
                    })
                  )
                ]
              ),
              _vm._v(" "),
              _c("div", { staticClass: "modal-footer" }, [
                _c("div", { staticClass: "input-group col-md-12" }, [
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.mensaje_chat,
                        expression: "mensaje_chat"
                      }
                    ],
                    staticClass: "form-control",
                    attrs: { type: "text" },
                    domProps: { value: _vm.mensaje_chat },
                    on: {
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.mensaje_chat = $event.target.value
                      }
                    }
                  }),
                  _vm._v(" "),
                  _c("span", { staticClass: "input-group-append" }, [
                    _c(
                      "button",
                      {
                        staticClass: "btn btn-primary",
                        attrs: {
                          type: "button",
                          disabled: _vm.loader_responder
                        },
                        on: {
                          click: function($event) {
                            $event.preventDefault()
                            _vm.responderchat()
                          }
                        }
                      },
                      [
                        _vm._v("\n                Responder\n                "),
                        _vm.loader_responder
                          ? _c("i", {
                              staticClass: "fa fa-spinner fa-spin fa-loader",
                              staticStyle: { "font-size": "20px" }
                            })
                          : _vm._e()
                      ]
                    )
                  ])
                ])
              ])
            ])
          ]
        )
      ]
    ),
    _vm._v(" "),
    _vm.preload ? _c("div", { staticClass: "row" }, [_vm._m(2)]) : _vm._e(),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "row" },
      _vm._l(_vm.a_integrantes, function(integrante) {
        return _c("div", { staticClass: "col-md-6 col-sm-12" }, [
          !_vm.preload
            ? _c("div", { staticClass: "card" }, [
                _c("div", { staticClass: "card-body" }, [
                  _vm.rol_user == "es" || _vm.rol_user == "pr"
                    ? _c("div", { staticClass: "card-tools" }, [
                        _c(
                          "a",
                          {
                            staticClass: "nav-link",
                            attrs: { href: "#", "aria-expanded": "true" }
                          },
                          [
                            _c("span", { staticClass: "badge navbar-badge" }, [
                              _c(
                                "i",
                                {
                                  staticClass: "fa fa-comments-o",
                                  staticStyle: { "font-size": "24px" },
                                  on: {
                                    click: function($event) {
                                      $event.preventDefault()
                                      _vm.chatuser(integrante.iduser)
                                    }
                                  }
                                },
                                [
                                  _c(
                                    "span",
                                    {
                                      staticClass:
                                        "badge badge-danger navbar-badge",
                                      staticStyle: { top: "-4px" }
                                    },
                                    [
                                      integrante.mensajeschat > 0
                                        ? _c("span", {
                                            domProps: {
                                              textContent: _vm._s(
                                                integrante.mensajeschat
                                              )
                                            }
                                          })
                                        : _vm._e()
                                    ]
                                  )
                                ]
                              )
                            ])
                          ]
                        )
                      ])
                    : _vm._e(),
                  _vm._v(" "),
                  _c("div", { staticClass: "post" }, [
                    _c("div", { staticClass: "user-block" }, [
                      _c("img", {
                        staticClass: "img-circle img-bordered",
                        attrs: {
                          src: _vm.base_url + "/" + integrante.imagen,
                          alt: "user image"
                        }
                      }),
                      _vm._v(" "),
                      _c("span", { staticClass: "username" }, [
                        _c("a", [
                          _c("span", {
                            domProps: { textContent: _vm._s(integrante.nombre) }
                          })
                        ])
                      ]),
                      _vm._v(" "),
                      _c("span", {
                        staticClass: "description",
                        domProps: { textContent: _vm._s(integrante.perfil) }
                      }),
                      _vm._v(" "),
                      _c("span", { staticClass: "description" }, [
                        _vm._v("Ultimo ingreso: "),
                        _c("span", {
                          domProps: {
                            textContent: _vm._s(integrante.fecha_ultimo_ingreso)
                          }
                        })
                      ]),
                      _vm._v(" "),
                      _c("span", { staticClass: "description" }, [
                        _vm._v("Tiempo de uso: "),
                        _c("span", {
                          domProps: {
                            textContent: _vm._s(integrante.tiempouso)
                          }
                        }),
                        _vm._v(" minutos")
                      ])
                    ])
                  ])
                ])
              ])
            : _vm._e()
        ])
      })
    )
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "modal-header" }, [
      _vm._v("\n            Chat directo"),
      _c(
        "button",
        {
          staticClass: "close",
          attrs: { type: "button", "data-dismiss": "modal" }
        },
        [_vm._v("×")]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-6ce7d4e2", module.exports)
  }
}

/***/ }),
/* 25 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(26)
/* template */
var __vue_template__ = __webpack_require__(27)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/calendario/CalendarioComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-37edae8e", Component.options)
  } else {
    hotAPI.reload("data-v-37edae8e", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 26 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {
    console.log('Component calendario mounted.');
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    $('#calendar').fullCalendar({
      monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
      dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
      dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
      header: {
        left: 'prev,next today',
        center: 'title'
        //right : 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'Hoy',
        month: 'Mes',
        week: 'Semana',
        day: 'Dia'
      },
      editable: false,
      droppable: false
      //events    : a_eventos
    });
  },
  created: function created() {
    this.base_url = base_url;
    this.idcurso = document.getElementById('idcurso').value;
    this.listado();
  },
  data: function data() {
    return {
      id: 0,
      preload: false,
      a_eventos: []
    };
  },
  methods: {
    listado: function listado() {
      var _this = this;

      var url = this.base_url + '/calendario/lista';
      this.preload = true;
      axios.post(url, { idcurso: this.idcurso }).then(function (response) {
        _this.preload = false;
        _this.a_eventos = response.data.eventos;
        _this.addEventos();
      }).catch(function (error) {
        _this.preload = false;
      });
    },
    addEventos: function addEventos() {
      var i;
      for (i = 0; i < this.a_eventos.length; i++) {
        var evento = this.a_eventos[i];
        var color = '';
        if (evento.tipo == 'tarea') {
          color = "#17a2b8";
        }
        if (evento.tipo == 'ejercicio') {
          color = "#28a745";
        }

        $('#calendar').fullCalendar('renderEvent', {
          title: evento.titulo,
          start: new Date(evento.anio, evento.mes - 1, evento.dia),
          end: new Date(evento.anio, evento.mes - 1, evento.dia),
          backgroundColor: color,
          borderColor: color,
          allDay: true
        });
      }
    }
  }
});

/***/ }),
/* 27 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _vm.preload ? _c("div", { staticClass: "row" }, [_vm._m(0)]) : _vm._e(),
    _vm._v(" "),
    _vm._m(1),
    _vm._v(" "),
    _vm._m(2)
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "callout callout-info" }, [
      _c("i", { staticClass: "icon fa fa-info" }),
      _vm._v(
        "\n    Las siguientes etiquetas corresponden al tipo de actividad\n    "
      ),
      _c("span", { staticClass: "badge badge-info" }, [_vm._v("Tareas")]),
      _vm._v(" "),
      _c("span", { staticClass: "badge badge-success" }, [
        _vm._v("Evaluaciones")
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "card card-primary" }, [
      _c("div", { staticClass: "card-body p-0" }, [
        _c("div", { attrs: { id: "calendar" } })
      ])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-37edae8e", module.exports)
  }
}

/***/ }),
/* 28 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {},
  created: function created() {
    this.base_url = base_url;
    this.idcurso = document.getElementById('idcurso').value;
    this.listado();
  },
  data: function data() {
    return {
      idcurso: 0,
      preload: true,
      a_tareas: [],
      cantUser: 0
    };
  },
  methods: {
    listado: function listado() {
      var _this = this;

      var url = this.base_url + '/tareas/lista';
      this.preload = true;
      axios.post(url, { idcurso: this.idcurso }).then(function (response) {
        _this.preload = false;
        _this.a_tareas = response.data.tareas;
        _this.cantUser = response.data.cantUser;
      }).catch(function (error) {
        _this.preload = false;
        _this.modulos = [];
        if (error.response.data.errors) {}
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
      });
    },
    redirectCrear: function redirectCrear() {
      this.$root.$emit('setMenu', 'tareas-crear');
    },
    redirectEdit: function redirectEdit(id) {
      document.getElementById('id').value = id;
      this.$root.$emit('setMenu', 'tareas-edit');
    },
    redirectEnt: function redirectEnt(id) {
      document.getElementById('id').value = id;
      this.$root.$emit('setMenu', 'tareas-lista-entrega');
    }
  }
});

/***/ }),
/* 29 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _vm.preload ? _c("div", { staticClass: "row" }, [_vm._m(0)]) : _vm._e(),
      _vm._v(" "),
      !_vm.preload
        ? _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col-sm-6" }, [
              _c("h5", { staticClass: "m-0 text-dark" }, [
                _c("strong", [_vm._v("Lista de tareas")]),
                _vm._v(" "),
                _c(
                  "button",
                  {
                    staticClass: "btn btn-tool",
                    attrs: { type: "button" },
                    on: {
                      click: function($event) {
                        $event.preventDefault()
                        _vm.redirectCrear()
                      }
                    }
                  },
                  [
                    _c("i", {
                      staticClass: "fa fa-plus-circle",
                      staticStyle: { "font-size": "24px" }
                    })
                  ]
                )
              ])
            ])
          ])
        : _vm._e(),
      _vm._v(" "),
      _vm._l(_vm.a_tareas, function(tarea) {
        return !_vm.preload
          ? _c("div", { staticClass: "card" }, [
              _c("div", { staticClass: "card-header no-border" }, [
                _c("h5", {
                  staticClass: "card-title",
                  staticStyle: { cursor: "pointer" },
                  domProps: { textContent: _vm._s(tarea.nombre) },
                  on: {
                    click: function($event) {
                      $event.preventDefault()
                      _vm.redirectEdit(tarea.id)
                    }
                  }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "card-tools" }, [
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-tool",
                      attrs: { type: "button" },
                      on: {
                        click: function($event) {
                          $event.preventDefault()
                          _vm.redirectEdit(tarea.id)
                        }
                      }
                    },
                    [
                      _c("i", {
                        staticClass: "fa  fa-pencil",
                        staticStyle: { "font-size": "20px" }
                      })
                    ]
                  )
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "row" }, [
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("b", [_vm._v("Creado :")]),
                    _vm._v(" "),
                    _c("span", {
                      domProps: { textContent: _vm._s(tarea.fecha_creacion) }
                    })
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("b", [_vm._v("Vence :")]),
                    _vm._v(" "),
                    _c("span", {
                      domProps: { textContent: _vm._s(tarea.fecha_vencimiento) }
                    })
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("b", [_vm._v("Califacion Sobre :")]),
                    _vm._v(" "),
                    _c("span", {
                      domProps: { textContent: _vm._s(tarea.calificacion) }
                    })
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("i", {
                      staticClass: "fa fa-list-alt",
                      staticStyle: { cursor: "pointer" },
                      on: {
                        click: function($event) {
                          $event.preventDefault()
                          _vm.redirectEnt(tarea.id)
                        }
                      }
                    }),
                    _vm._v(" "),
                    _c("b", [_vm._v("Entregas :")]),
                    _vm._v(" "),
                    _c("span", {
                      domProps: { textContent: _vm._s(tarea.cant_respuest) }
                    }),
                    _vm._v("/"),
                    _c("span", {
                      domProps: { textContent: _vm._s(_vm.cantUser) }
                    })
                  ])
                ])
              ])
            ])
          : _vm._e()
      })
    ],
    2
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-29c203ee", module.exports)
  }
}

/***/ }),
/* 30 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(31)
/* template */
var __vue_template__ = __webpack_require__(32)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/ofertados/OfertadosListaComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-6195d41e", Component.options)
  } else {
    hotAPI.reload("data-v-6195d41e", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 31 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {
    console.log('Component ofertados mounted.');
  },
  created: function created() {
    this.base_url = base_url;
    this.getBusqueda();
  },
  data: function data() {
    return {
      cursos: [],
      errores: [],
      preload: false,
      select_bsq: ''
    };
  },
  methods: {
    getBusqueda: function getBusqueda() {
      var _this = this;

      this.preload = true;
      var url = base_url + '/ofertados/busq';
      axios.post(url, { select_bsq: this.select_bsq }).then(function (response) {
        _this.cursos = response.data.cursos;
        _this.preload = false;
      }).catch(function (error) {
        _this.preload = false;
      });
    },
    detcurso: function detcurso(id) {
      document.getElementById('id').value = id;
      this.$root.$emit('setMenu', 'ofertados_det');
    }
  }
});

/***/ }),
/* 32 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c(
      "div",
      { staticClass: "row" },
      [
        _c("div", { staticClass: "col-md-12" }, [
          _c("div", { staticClass: "card" }, [
            _c("div", { staticClass: "card-body" }, [
              _c(
                "select",
                {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.select_bsq,
                      expression: "select_bsq"
                    }
                  ],
                  staticClass: "form-control",
                  on: {
                    change: [
                      function($event) {
                        var $$selectedVal = Array.prototype.filter
                          .call($event.target.options, function(o) {
                            return o.selected
                          })
                          .map(function(o) {
                            var val = "_value" in o ? o._value : o.value
                            return val
                          })
                        _vm.select_bsq = $event.target.multiple
                          ? $$selectedVal
                          : $$selectedVal[0]
                      },
                      function($event) {
                        _vm.getBusqueda()
                      }
                    ]
                  }
                },
                [
                  _c("option", { attrs: { value: "" } }, [
                    _vm._v("Seleccione el estado")
                  ]),
                  _vm._v(" "),
                  _c("option", { attrs: { value: "abierto" } }, [
                    _vm._v("Abierto")
                  ]),
                  _vm._v(" "),
                  _c("option", { attrs: { value: "encurso" } }, [
                    _vm._v("En curso")
                  ]),
                  _vm._v(" "),
                  _c("option", { attrs: { value: "finalizado" } }, [
                    _vm._v("Finalizado")
                  ])
                ]
              )
            ])
          ])
        ]),
        _vm._v(" "),
        _vm._l(_vm.cursos, function(curso) {
          return _c("div", { staticClass: "col-lg-4 " }, [
            _c("div", { staticClass: "course" }, [
              _c("div", { staticClass: "course_image" }, [
                _c(
                  "a",
                  {
                    attrs: { href: "#" },
                    on: {
                      click: function($event) {
                        $event.preventDefault()
                        _vm.detcurso(curso.id)
                      }
                    }
                  },
                  [
                    _c("img", {
                      staticClass: "card-img-top",
                      attrs: { src: _vm.base_url + "/" + curso.imagen }
                    })
                  ]
                )
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "course_body" }, [
                _c("h6", {
                  staticClass: "course_title",
                  domProps: { textContent: _vm._s(curso.nombre) }
                })
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "course_footer" }, [
                _c(
                  "div",
                  {
                    staticClass:
                      "course_footer_content d-flex flex-row align-items-center justify-content-start"
                  },
                  [
                    _c("div", { staticClass: "course_info" }, [
                      _c("i", {
                        staticClass: "fa fa-bank",
                        attrs: { "aria-hidden": "true" }
                      }),
                      _vm._v(" "),
                      _c("span", {
                        domProps: { textContent: _vm._s(curso.nombestado) }
                      })
                    ]),
                    _vm._v(" "),
                    _c("div", {
                      staticClass: "course_price ml-auto",
                      domProps: {
                        textContent: _vm._s(
                          curso.valor > 0 ? "$" + curso.valor : "Gratis"
                        )
                      }
                    })
                  ]
                )
              ])
            ])
          ])
        })
      ],
      2
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-6195d41e", module.exports)
  }
}

/***/ }),
/* 33 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(34)
/* template */
var __vue_template__ = __webpack_require__(35)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/ofertados/OfertadosDetalleComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-c3a078ac", Component.options)
  } else {
    hotAPI.reload("data-v-c3a078ac", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 34 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {
    console.log('Component ofertados mounted.');
  },
  created: function created() {
    this.base_url = base_url;
    this.id_curso = document.getElementById('id').value;
    this.getCurso();
  },
  data: function data() {
    return {
      loader_suscrip: false,
      id_curso: 0,
      o_curso: {},
      preload: false,
      subscrip: false,
      webcheckout: {}
    };
  },
  methods: {
    getCurso: function getCurso() {
      var _this = this;

      this.preload = true;
      var url = base_url + '/ofertados/vercurso';
      axios.post(url, { id: this.id_curso }).then(function (response) {
        _this.o_curso = response.data.curso;
        _this.subscrip = response.data.subscrip;
        _this.webcheckout = response.data.webcheckout;
        _this.preload = false;
      }).catch(function (error) {
        _this.preload = false;
        console.log(error.response.data);
      });
    },
    suscribirse: function suscribirse() {
      var inst = this;
      swal({
        title: "Seguro deseas suscribirte",
        text: "",
        type: "info",
        showCancelButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "Aceptar",
        closeOnConfirm: true
      }, function () {
        inst.enviarSuscripcion();
      });
    },
    enviarSuscripcion: function enviarSuscripcion() {
      var _this2 = this;

      this.loader_suscrip = true;
      var inst = this;
      var url = base_url + '/ofertados/suscrip';
      axios.post(url, { idcurso: this.id_curso }).then(function (response) {
        _this2.loader_suscrip = false;
        swal({
          title: response.data.message,
          text: response.data.message2,
          type: "success"
        }, function () {
          inst.$root.$emit('setReload');
          inst.redirectVolver();
        });
      }).catch(function (error) {
        _this2.loader_suscrip = false;
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "2500"
          });
        }
      });
    },
    redirectVolver: function redirectVolver() {
      document.getElementById('id').value = '';
      this.$root.$emit('setMenu', 'ofertados');
    },
    iracurso: function iracurso() {
      var url = base_url + '/cursos/gestion/' + this.id_curso;
      window.location.href = url;
    }
  }
});

/***/ }),
/* 35 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c("div", { staticClass: "card" }, [
      _c("div", { staticClass: "card-header card-header-cuorse" }, [
        _c("h2", { staticClass: "card-title-course" }, [
          _c("span", { domProps: { textContent: _vm._s(_vm.o_curso.nombre) } }),
          _vm._v(" "),
          _c(
            "button",
            {
              staticClass: "btn btn-tool",
              attrs: { type: "button" },
              on: {
                click: function($event) {
                  $event.preventDefault()
                  _vm.redirectVolver()
                }
              }
            },
            [
              _c("i", {
                staticClass: "fa fa-arrow-circle-left",
                staticStyle: { "font-size": "24px" }
              })
            ]
          )
        ])
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "card-body" }, [
        _c("div", { staticClass: "row" }, [
          _c("div", { staticClass: "col-md-8" }, [
            _c("iframe", {
              staticClass: "img-fluid",
              staticStyle: { width: "100%", height: "400px" },
              attrs: {
                frameborder: "0",
                allowfullscreen: "",
                allow: "autoplay; encrypted-media",
                src: _vm.o_curso.urlvideo
              }
            })
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-4" }, [
            _c("div", { staticClass: "table-responsive" }, [
              _c("table", { staticClass: "table no-border" }, [
                _c("tbody", [
                  _c("tr", [
                    _c("td", [
                      _c("img", {
                        staticClass: "media-object",
                        staticStyle: {
                          width: "100%",
                          height: "auto",
                          "border-radius": "4px",
                          "box-shadow": "0 1px 3px rgba(0,0,0,.15)"
                        },
                        attrs: {
                          src: _vm.base_url + "/" + _vm.o_curso.imagen,
                          alt: "Ample Admin"
                        }
                      })
                    ])
                  ]),
                  _vm._v(" "),
                  _c("tr", [
                    _c("td", [
                      _c("p", [
                        _c("strong", [_vm._v("FECHA INICIO")]),
                        _vm._v(" "),
                        _c("br"),
                        _c("span", {
                          domProps: {
                            textContent: _vm._s(_vm.o_curso.fecha_inicio)
                          }
                        })
                      ]),
                      _vm._v(" "),
                      _c("p", [
                        _c("strong", [_vm._v("FECHA FINALIZACION")]),
                        _vm._v(" "),
                        _c("br"),
                        _c("span", {
                          domProps: {
                            textContent: _vm._s(_vm.o_curso.fecha_finalizacion)
                          }
                        })
                      ]),
                      _vm._v(" "),
                      _c("p", [
                        _c("strong", [_vm._v("VALOR")]),
                        _vm._v(" "),
                        _c("br"),
                        _c("span", {
                          domProps: {
                            textContent: _vm._s(
                              _vm.o_curso.valor > 0
                                ? "$" + _vm.o_curso.valor
                                : "Gratis"
                            )
                          }
                        })
                      ])
                    ])
                  ]),
                  _vm._v(" "),
                  _c("tr", [
                    !_vm.subscrip
                      ? _c("th", { attrs: { colspan: "2" } }, [
                          _vm.o_curso.estado != "finalizado" &&
                          _vm.o_curso.valor == 0
                            ? _c(
                                "button",
                                {
                                  staticClass:
                                    "btn btn-block btn-outline-primary btn-sm",
                                  staticStyle: { "margin-right": "5px" },
                                  attrs: {
                                    type: "button",
                                    disabled: _vm.loader_suscrip
                                  },
                                  on: {
                                    click: function($event) {
                                      $event.preventDefault()
                                      _vm.suscribirse()
                                    }
                                  }
                                },
                                [
                                  _c("i", { staticClass: "fa fa-thumbs-o-up" }),
                                  _vm._v(" Gratis\n                    "),
                                  _vm.loader_suscrip
                                    ? _c("i", {
                                        staticClass:
                                          "fa fa-spinner fa-spin fa-loader",
                                        staticStyle: { "font-size": "20px" }
                                      })
                                    : _vm._e()
                                ]
                              )
                            : _vm._e(),
                          _vm._v(" "),
                          _vm.o_curso.estado != "finalizado" &&
                          _vm.o_curso.valor > 0
                            ? _c(
                                "form",
                                {
                                  attrs: {
                                    method: "post",
                                    action: _vm.webcheckout.action
                                  }
                                },
                                [
                                  _c("input", {
                                    attrs: {
                                      name: "merchantId",
                                      type: "hidden"
                                    },
                                    domProps: {
                                      value: _vm.webcheckout.merchantId
                                    }
                                  }),
                                  _vm._v(" "),
                                  _c("input", {
                                    attrs: {
                                      name: "accountId",
                                      type: "hidden"
                                    },
                                    domProps: {
                                      value: _vm.webcheckout.accountId
                                    }
                                  }),
                                  _vm._v(" "),
                                  _c("input", {
                                    attrs: {
                                      name: "description",
                                      type: "hidden"
                                    },
                                    domProps: {
                                      value: _vm.webcheckout.description
                                    }
                                  }),
                                  _vm._v(" "),
                                  _c("input", {
                                    attrs: {
                                      name: "referenceCode",
                                      type: "hidden"
                                    },
                                    domProps: {
                                      value: _vm.webcheckout.referenceCode
                                    }
                                  }),
                                  _vm._v(" "),
                                  _c("input", {
                                    attrs: { name: "amount", type: "hidden" },
                                    domProps: { value: _vm.webcheckout.amount }
                                  }),
                                  _vm._v(" "),
                                  _c("input", {
                                    attrs: { name: "tax", type: "hidden" },
                                    domProps: { value: _vm.webcheckout.tax }
                                  }),
                                  _vm._v(" "),
                                  _c("input", {
                                    attrs: {
                                      name: "taxReturnBase",
                                      type: "hidden"
                                    },
                                    domProps: {
                                      value: _vm.webcheckout.taxReturnBase
                                    }
                                  }),
                                  _vm._v(" "),
                                  _c("input", {
                                    attrs: { name: "currency", type: "hidden" },
                                    domProps: {
                                      value: _vm.webcheckout.currency
                                    }
                                  }),
                                  _vm._v(" "),
                                  _c("input", {
                                    attrs: {
                                      name: "signature",
                                      type: "hidden"
                                    },
                                    domProps: {
                                      value: _vm.webcheckout.signature
                                    }
                                  }),
                                  _vm._v(" "),
                                  _c("input", {
                                    attrs: { name: "test", type: "hidden" },
                                    domProps: { value: _vm.webcheckout.test }
                                  }),
                                  _vm._v(" "),
                                  _c("input", {
                                    attrs: {
                                      name: "buyerEmail",
                                      type: "hidden"
                                    },
                                    domProps: {
                                      value: _vm.webcheckout.buyerEmail
                                    }
                                  }),
                                  _vm._v(" "),
                                  _c("input", {
                                    attrs: {
                                      name: "responseUrl",
                                      type: "hidden"
                                    },
                                    domProps: {
                                      value: _vm.webcheckout.responseUrl
                                    }
                                  }),
                                  _vm._v(" "),
                                  _c("input", {
                                    attrs: {
                                      name: "confirmationUrl",
                                      type: "hidden"
                                    },
                                    domProps: {
                                      value: _vm.webcheckout.responseUrl
                                    }
                                  }),
                                  _vm._v(" "),
                                  _vm._m(0)
                                ]
                              )
                            : _vm._e()
                        ])
                      : _c("th", { attrs: { colspan: "2" } }, [
                          _c(
                            "button",
                            {
                              staticClass:
                                "btn btn-block btn-outline-primary btn-sm",
                              staticStyle: { "margin-right": "5px" },
                              attrs: { type: "button" },
                              on: {
                                click: function($event) {
                                  $event.preventDefault()
                                  _vm.iracurso()
                                }
                              }
                            },
                            [
                              _c("i", { staticClass: "fa fa-thumbs-o-up" }),
                              _vm._v(" Suscrito\n                  ")
                            ]
                          )
                        ])
                  ])
                ])
              ])
            ])
          ])
        ])
      ])
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "card" }, [
      _vm._m(1),
      _vm._v(" "),
      _c("div", {
        staticClass: "card-body",
        domProps: { innerHTML: _vm._s(_vm.o_curso.plan_estudio) }
      })
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "button",
      {
        staticClass: "btn btn-block btn-outline-primary btn-sm",
        attrs: { name: "Submit", type: "submit" }
      },
      [
        _c("i", { staticClass: "fa fa-credit-card" }),
        _vm._v(" Comprar\n                     ")
      ]
    )
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "card-header" }, [
      _c("h3", { staticClass: "card-title" }, [
        _vm._v("\n        Plan de Estudio\n      ")
      ])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-c3a078ac", module.exports)
  }
}

/***/ }),
/* 36 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(37)
/* template */
var __vue_template__ = __webpack_require__(38)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/cursos/CursosListaComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-e6b7d764", Component.options)
  } else {
    hotAPI.reload("data-v-e6b7d764", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 37 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {},
  created: function created() {
    this.base_url = base_url;
    this.listado();
  },
  data: function data() {
    return {
      preload: false,
      a_cursos: []
    };
  },
  methods: {
    listado: function listado() {
      var _this = this;

      var url = this.base_url + '/cursos/lista';
      this.preload = true;
      axios.post(url, {}).then(function (response) {
        _this.preload = false;
        _this.a_cursos = response.data.cursos;
      }).catch(function (error) {
        _this.preload = false;
        _this.a_cursos = [];
        if (error.response.data.errors) {}
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "2500"
          });
        }
      });
    },
    redirectCrear: function redirectCrear() {
      this.$root.$emit('setMenu', 'cursos-crear');
    },
    redirectAbrir: function redirectAbrir(id) {
      window.location.href = this.base_url + '/cursos/config/' + id;
    }
  }
});

/***/ }),
/* 38 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _vm.preload ? _c("div", { staticClass: "row" }, [_vm._m(0)]) : _vm._e(),
      _vm._v(" "),
      !_vm.preload
        ? _c("div", { staticClass: "card" }, [
            _c("div", { staticClass: "card-header card-header-cuorse" }, [
              _c("h2", { staticClass: "card-title-course" }, [
                _vm._v("\n        Lista de cursos\n        "),
                _c(
                  "button",
                  {
                    staticClass: "btn btn-tool",
                    attrs: { type: "button" },
                    on: {
                      click: function($event) {
                        $event.preventDefault()
                        _vm.redirectCrear("cursos-crear")
                      }
                    }
                  },
                  [
                    _c("i", {
                      staticClass: "fa fa-plus-circle",
                      staticStyle: { "font-size": "24px" }
                    })
                  ]
                )
              ])
            ])
          ])
        : _vm._e(),
      _vm._v(" "),
      _vm._l(_vm.a_cursos, function(curso) {
        return !_vm.preload
          ? _c("div", { staticClass: "card" }, [
              _c("div", { staticClass: "card-header no-border" }, [
                _c("div", { staticClass: "card-tools float-left" }, [
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-tool",
                      attrs: { type: "button" },
                      on: {
                        click: function($event) {
                          $event.preventDefault()
                          _vm.redirectAbrir(curso.id)
                        }
                      }
                    },
                    [
                      _vm._v("\n              Ingresar "),
                      _c("i", {
                        staticClass: "fa fa-folder-open",
                        staticStyle: { "font-size": "20px" }
                      })
                    ]
                  )
                ]),
                _vm._v(" "),
                _c("h5", {
                  staticClass: "card-title",
                  staticStyle: { cursor: "pointer" },
                  domProps: { textContent: _vm._s(curso.nombre) },
                  on: {
                    click: function($event) {
                      $event.preventDefault()
                      _vm.redirectAbrir(curso.id)
                    }
                  }
                }),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "row" },
                  [
                    _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                      _c("b", [_vm._v("Creado :")]),
                      _vm._v(" "),
                      _c("span", {
                        domProps: { textContent: _vm._s(curso.fecha_creacion) }
                      })
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                      _c("b", [_vm._v("Inicia :")]),
                      _vm._v(" "),
                      _c("span", {
                        domProps: { textContent: _vm._s(curso.fecha_inicio) }
                      })
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                      _c("b", [_vm._v("Finaliza :")]),
                      _vm._v(" "),
                      _c("span", {
                        domProps: {
                          textContent: _vm._s(curso.fecha_finalizacion)
                        }
                      })
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                      _c("b", [_vm._v("Limite notas :")]),
                      _vm._v(" "),
                      _c("span", {
                        domProps: { textContent: _vm._s(curso.fecha_limite) }
                      })
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                      _c("b", [_vm._v("Visibilidad :")]),
                      _vm._v(" "),
                      curso.visibilidad
                        ? _c("span", { staticClass: "badge bg-success" }, [
                            _vm._v("Publico")
                          ])
                        : _c("span", { staticClass: "badge bg-danger" }, [
                            _vm._v("Privado")
                          ])
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                      _c("b", [_vm._v("Valor :")]),
                      _vm._v(" "),
                      _c("span", {
                        domProps: { textContent: _vm._s(curso.valor) }
                      })
                    ]),
                    _vm._v(" "),
                    _vm._l(curso.profesores, function(profesor) {
                      return _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                        _c("b", [_vm._v("Profesor :")]),
                        _vm._v(" "),
                        _c("span", {
                          domProps: { textContent: _vm._s(profesor.email) }
                        })
                      ])
                    })
                  ],
                  2
                )
              ])
            ])
          : _vm._e()
      })
    ],
    2
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-e6b7d764", module.exports)
  }
}

/***/ }),
/* 39 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(40)
/* template */
var __vue_template__ = __webpack_require__(41)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/cursos/CursosCrearComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-77f34dca", Component.options)
  } else {
    hotAPI.reload("data-v-77f34dca", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 40 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {},
  created: function created() {
    this.base_url = base_url;
  },
  data: function data() {
    return {
      o_basecurso: { 'nombre': '', 'fecha_inicio': '', 'fecha_finalizacion': '', 'fecha_limite': '', 'valor': 0, 'duracion': '', 'urlvideo': '', 'visibilidad': false, 'inscripcion': true, 'profesor': '', 'profesor2': '' },
      o_curso: { 'nombre': '', 'fecha_inicio': '', 'fecha_finalizacion': '', 'fecha_limite': '', 'valor': 0, 'duracion': '', 'urlvideo': '', 'visibilidad': false, 'inscripcion': true, 'profesor': '', 'profesor2': '' },
      e_curso: [],
      loader_guardar: false
    };
  },
  methods: {
    guardar: function guardar() {
      var _this = this;

      this.loader_guardar = true;
      var url = base_url + '/cursos/guardar';
      var inst = this;
      axios.post(url, this.o_curso).then(function (response) {
        _this.loader_guardar = false;
        _this.e_curso = [];
        _this.o_curso = _this.o_basecurso;
        swal({
          title: response.data.message,
          text: response.data.message2,
          type: "success"
        }, function () {
          inst.$root.$emit('setMenu', 'cursos');
        });
      }).catch(function (error) {
        _this.loader_guardar = false;
        if (error.response.data.errors) {
          _this.e_curso = error.response.data.errors;
        }
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
      });
    },
    redirectVolver: function redirectVolver() {
      this.$root.$emit('setMenu', 'cursos');
    }
  }
});

/***/ }),
/* 41 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c("div", { staticClass: "col-md-12" }, [
      _c("div", { staticClass: "card " }, [
        _c("div", { staticClass: "card-header card-header-cuorse" }, [
          _c("h2", { staticClass: "card-title-course" }, [
            _vm._v("\n          Nuevo curso\n          "),
            _c(
              "button",
              {
                staticClass: "btn btn-tool",
                attrs: { type: "button" },
                on: {
                  click: function($event) {
                    $event.preventDefault()
                    _vm.redirectVolver()
                  }
                }
              },
              [
                _c("i", {
                  staticClass: "fa fa-arrow-circle-left",
                  staticStyle: { "font-size": "24px" }
                })
              ]
            )
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "card-body" }, [
          _vm._m(0),
          _vm._v(" "),
          _c("div", { staticClass: "form-group" }, [
            _vm._m(1),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.o_curso.nombre,
                  expression: "o_curso.nombre"
                }
              ],
              staticClass: "form-control",
              class: [_vm.e_curso.nombre ? "is-invalid" : ""],
              attrs: { type: "text", name: "nombre" },
              domProps: { value: _vm.o_curso.nombre },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.o_curso, "nombre", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _vm.e_curso.nombre
              ? _c("span", {
                  staticClass: "text-danger",
                  domProps: { textContent: _vm._s(_vm.e_curso.nombre[0]) }
                })
              : _vm._e()
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "form-group" }, [
            _vm._m(2),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.o_curso.fecha_inicio,
                  expression: "o_curso.fecha_inicio"
                }
              ],
              staticClass: "form-control",
              class: [_vm.e_curso.fecha_inicio ? "is-invalid" : ""],
              attrs: { type: "date", name: "fecha_inicio" },
              domProps: { value: _vm.o_curso.fecha_inicio },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.o_curso, "fecha_inicio", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _vm.e_curso.fecha_inicio
              ? _c("span", {
                  staticClass: "text-danger",
                  domProps: { textContent: _vm._s(_vm.e_curso.fecha_inicio[0]) }
                })
              : _vm._e()
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "form-group" }, [
            _c("label", [_vm._v("Fecha de Finalizacion")]),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.o_curso.fecha_finalizacion,
                  expression: "o_curso.fecha_finalizacion"
                }
              ],
              staticClass: "form-control",
              class: [_vm.e_curso.fecha_finalizacion ? "is-invalid" : ""],
              attrs: { type: "date", name: "fecha_finalizacion" },
              domProps: { value: _vm.o_curso.fecha_finalizacion },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(
                    _vm.o_curso,
                    "fecha_finalizacion",
                    $event.target.value
                  )
                }
              }
            }),
            _vm._v(" "),
            _vm.e_curso.fecha_finalizacion
              ? _c("span", {
                  staticClass: "text-danger",
                  domProps: {
                    textContent: _vm._s(_vm.e_curso.fecha_finalizacion[0])
                  }
                })
              : _vm._e()
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "form-group" }, [
            _c("label", [_vm._v("Fecha limite ver notas ")]),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.o_curso.fecha_limite,
                  expression: "o_curso.fecha_limite"
                }
              ],
              staticClass: "form-control",
              class: [_vm.e_curso.fecha_limite ? "is-invalid" : ""],
              attrs: { type: "date", name: "fecha_limite" },
              domProps: { value: _vm.o_curso.fecha_limite },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.o_curso, "fecha_limite", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _vm.e_curso.fecha_limite
              ? _c("span", {
                  staticClass: "text-danger",
                  domProps: { textContent: _vm._s(_vm.e_curso.fecha_limite[0]) }
                })
              : _vm._e()
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "form-group" }, [
            _c("label", [_vm._v("Valor")]),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.o_curso.valor,
                  expression: "o_curso.valor"
                }
              ],
              staticClass: "form-control",
              class: [_vm.e_curso.fecha_limite ? "is-invalid" : ""],
              attrs: { type: "number", name: "fecha_limite", min: "0" },
              domProps: { value: _vm.o_curso.valor },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.o_curso, "valor", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _vm.e_curso.valor
              ? _c("span", {
                  staticClass: "text-danger",
                  domProps: { textContent: _vm._s(_vm.e_curso.valor[0]) }
                })
              : _vm._e()
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "form-group" }, [
            _c("label", [_vm._v("Profesor(email)")]),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.o_curso.profesor,
                  expression: "o_curso.profesor"
                }
              ],
              staticClass: "form-control",
              class: [_vm.e_curso.profesor ? "is-invalid" : ""],
              attrs: { type: "text", name: "profesor" },
              domProps: { value: _vm.o_curso.profesor },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.o_curso, "profesor", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _vm.e_curso.profesor
              ? _c("span", {
                  staticClass: "text-danger",
                  domProps: { textContent: _vm._s(_vm.e_curso.profesor[0]) }
                })
              : _vm._e()
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "form-group" }, [
            _c("label", [_vm._v("Profesor2(email)")]),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.o_curso.profesor2,
                  expression: "o_curso.profesor2"
                }
              ],
              staticClass: "form-control",
              class: [_vm.e_curso.profesor2 ? "is-invalid" : ""],
              attrs: { type: "text", name: "profesor2" },
              domProps: { value: _vm.o_curso.profesor2 },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.o_curso, "profesor2", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _vm.e_curso.profesor2
              ? _c("span", {
                  staticClass: "text-danger",
                  domProps: { textContent: _vm._s(_vm.e_curso.profesor2[0]) }
                })
              : _vm._e()
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "form-group" }, [
            _c("label", [_vm._v("Acceso al curso")]),
            _vm._v(" "),
            _c("div", { staticClass: "form-check" }, [
              _c("label", { staticClass: "form-check-label" }, [
                _c("input", {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.o_curso.visibilidad,
                      expression: "o_curso.visibilidad"
                    }
                  ],
                  staticClass: "form-check-input",
                  attrs: {
                    type: "radio",
                    checked: "",
                    name: "accesradio",
                    value: "true"
                  },
                  domProps: {
                    checked: _vm._q(_vm.o_curso.visibilidad, "true")
                  },
                  on: {
                    change: function($event) {
                      _vm.$set(_vm.o_curso, "visibilidad", "true")
                    }
                  }
                }),
                _vm._v("Publico\n            ")
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "form-check" }, [
              _c("label", { staticClass: "form-check-label" }, [
                _c("input", {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.o_curso.visibilidad,
                      expression: "o_curso.visibilidad"
                    }
                  ],
                  staticClass: "form-check-input",
                  attrs: { type: "radio", name: "accesradio", value: "false" },
                  domProps: {
                    checked: _vm._q(_vm.o_curso.visibilidad, "false")
                  },
                  on: {
                    change: function($event) {
                      _vm.$set(_vm.o_curso, "visibilidad", "false")
                    }
                  }
                }),
                _vm._v("Privado\n            ")
              ])
            ])
          ]),
          _vm._v(" "),
          _c(
            "button",
            {
              staticClass: "btn btn-outline-primary btn-sm float-left",
              attrs: { type: "button", disabled: _vm.loader_guardar },
              on: {
                click: function($event) {
                  $event.preventDefault()
                  _vm.guardar()
                }
              }
            },
            [
              _vm._v("\n          Crear curso\n          "),
              _vm.loader_guardar
                ? _c("i", {
                    staticClass: "fa fa-spinner fa-spin fa-loader",
                    staticStyle: { "font-size": "20px" }
                  })
                : _vm._e()
            ]
          )
        ])
      ])
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "callout callout-info" }, [
      _c("p", [
        _c("i", { staticClass: "fa fa-fw fa-info" }),
        _vm._v("Los campos marcados en "),
        _c("code", [_vm._v("*")]),
        _vm._v(" son obligatorios\n          ")
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", [_vm._v("Titulo "), _c("code", [_vm._v("*")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", [_vm._v("Fecha de Inicio "), _c("code", [_vm._v("*")])])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-77f34dca", module.exports)
  }
}

/***/ }),
/* 42 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(43)
/* template */
var __vue_template__ = __webpack_require__(44)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/cursos/CursosEditComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-1e8909af", Component.options)
  } else {
    hotAPI.reload("data-v-1e8909af", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 43 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    mounted: function mounted() {},
    created: function created() {
        this.base_url = base_url;
        this.id_curso = document.getElementById('idcurso').value;
        this.getCurso();
    },
    data: function data() {
        return {
            preload: true,
            id_curso: 0,
            o_curso: {},
            e_curso: [],
            loader_actualizar: false
        };
    },
    methods: {
        getCurso: function getCurso() {
            var _this = this;

            this.preload = true;
            var url = this.base_url + '/cursos/editar';
            axios.post(url, { id: this.id_curso }).then(function (response) {
                _this.o_curso = response.data.curso;
                _this.o_curso.profesor = response.data.profesor;
                _this.o_curso.profesor2 = response.data.profesor2;
                _this.preload = false;
            }).catch(function (error) {
                _this.preload = false;
            });
        },
        actualizar: function actualizar() {
            var _this2 = this;

            this.loader_actualizar = true;
            var url = this.base_url + '/cursos/actualizar';
            this.o_curso.id = this.id_curso;
            var inst = this;
            axios.post(url, this.o_curso).then(function (response) {
                _this2.loader_actualizar = false;
                _this2.e_curso = [];
                swal({
                    title: response.data.message,
                    text: response.data.message2,
                    type: "success"
                }, function () {
                    inst.getCurso();
                });
            }).catch(function (error) {
                _this2.loader_actualizar = false;
                if (error.response.data.errors) {
                    _this2.e_curso = error.response.data.errors;
                }
                if (error.response.data.error) {
                    toastr.error(error.response.data.error, '', {
                        "timeOut": "3500"
                    });
                }
            });
        }
    }
});

/***/ }),
/* 44 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _vm.preload ? _c("div", { staticClass: "row" }, [_vm._m(0)]) : _vm._e(),
    _vm._v(" "),
    !_vm.preload
      ? _c("div", { staticClass: "col-md-12" }, [
          _c("div", { staticClass: "card card-outline" }, [
            _c("div", { staticClass: "card-body" }, [
              _vm._m(1),
              _vm._v(" "),
              _c("div", { staticClass: "form-group" }, [
                _vm._m(2),
                _vm._v(" "),
                _c("input", {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.o_curso.nombre,
                      expression: "o_curso.nombre"
                    }
                  ],
                  staticClass: "form-control",
                  class: [_vm.e_curso.nombre ? "is-invalid" : ""],
                  attrs: { type: "text", name: "nombre" },
                  domProps: { value: _vm.o_curso.nombre },
                  on: {
                    input: function($event) {
                      if ($event.target.composing) {
                        return
                      }
                      _vm.$set(_vm.o_curso, "nombre", $event.target.value)
                    }
                  }
                }),
                _vm._v(" "),
                _vm.e_curso.nombre
                  ? _c("span", {
                      staticClass: "text-danger",
                      domProps: { textContent: _vm._s(_vm.e_curso.nombre[0]) }
                    })
                  : _vm._e()
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "form-group" }, [
                _vm._m(3),
                _vm._v(" "),
                _c("input", {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.o_curso.fecha_inicio,
                      expression: "o_curso.fecha_inicio"
                    }
                  ],
                  staticClass: "form-control",
                  class: [_vm.e_curso.fecha_inicio ? "is-invalid" : ""],
                  attrs: { type: "date", name: "fecha_inicio" },
                  domProps: { value: _vm.o_curso.fecha_inicio },
                  on: {
                    input: function($event) {
                      if ($event.target.composing) {
                        return
                      }
                      _vm.$set(_vm.o_curso, "fecha_inicio", $event.target.value)
                    }
                  }
                }),
                _vm._v(" "),
                _vm.e_curso.fecha_inicio
                  ? _c("span", {
                      staticClass: "text-danger",
                      domProps: {
                        textContent: _vm._s(_vm.e_curso.fecha_inicio[0])
                      }
                    })
                  : _vm._e()
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "form-group" }, [
                _c("label", [_vm._v("Fecha de Finalizacion")]),
                _vm._v(" "),
                _c("input", {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.o_curso.fecha_finalizacion,
                      expression: "o_curso.fecha_finalizacion"
                    }
                  ],
                  staticClass: "form-control",
                  class: [_vm.e_curso.fecha_finalizacion ? "is-invalid" : ""],
                  attrs: { type: "date", name: "fecha_finalizacion" },
                  domProps: { value: _vm.o_curso.fecha_finalizacion },
                  on: {
                    input: function($event) {
                      if ($event.target.composing) {
                        return
                      }
                      _vm.$set(
                        _vm.o_curso,
                        "fecha_finalizacion",
                        $event.target.value
                      )
                    }
                  }
                }),
                _vm._v(" "),
                _vm.e_curso.fecha_finalizacion
                  ? _c("span", {
                      staticClass: "text-danger",
                      domProps: {
                        textContent: _vm._s(_vm.e_curso.fecha_finalizacion[0])
                      }
                    })
                  : _vm._e()
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "form-group" }, [
                _c("label", [_vm._v("Fecha limite ver notas")]),
                _vm._v(" "),
                _c("input", {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.o_curso.fecha_limite,
                      expression: "o_curso.fecha_limite"
                    }
                  ],
                  staticClass: "form-control",
                  class: [_vm.e_curso.fecha_limite ? "is-invalid" : ""],
                  attrs: { type: "date", name: "fecha_limite" },
                  domProps: { value: _vm.o_curso.fecha_limite },
                  on: {
                    input: function($event) {
                      if ($event.target.composing) {
                        return
                      }
                      _vm.$set(_vm.o_curso, "fecha_limite", $event.target.value)
                    }
                  }
                }),
                _vm._v(" "),
                _vm.e_curso.fecha_limite
                  ? _c("span", {
                      staticClass: "text-danger",
                      domProps: {
                        textContent: _vm._s(_vm.e_curso.fecha_limite[0])
                      }
                    })
                  : _vm._e()
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "form-group" }, [
                _c("label", [_vm._v("Valor")]),
                _vm._v(" "),
                _c("input", {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.o_curso.valor,
                      expression: "o_curso.valor"
                    }
                  ],
                  staticClass: "form-control",
                  class: [_vm.e_curso.fecha_limite ? "is-invalid" : ""],
                  attrs: { type: "number", min: "0", name: "fecha_limite" },
                  domProps: { value: _vm.o_curso.valor },
                  on: {
                    input: function($event) {
                      if ($event.target.composing) {
                        return
                      }
                      _vm.$set(_vm.o_curso, "valor", $event.target.value)
                    }
                  }
                }),
                _vm._v(" "),
                _vm.e_curso.valor
                  ? _c("span", {
                      staticClass: "text-danger",
                      domProps: { textContent: _vm._s(_vm.e_curso.valor[0]) }
                    })
                  : _vm._e()
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "form-group" }, [
                _c("label", [_vm._v("Profesor(email)")]),
                _vm._v(" "),
                _c("input", {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.o_curso.profesor,
                      expression: "o_curso.profesor"
                    }
                  ],
                  staticClass: "form-control",
                  class: [_vm.e_curso.profesor ? "is-invalid" : ""],
                  attrs: { type: "text", name: "profesor" },
                  domProps: { value: _vm.o_curso.profesor },
                  on: {
                    input: function($event) {
                      if ($event.target.composing) {
                        return
                      }
                      _vm.$set(_vm.o_curso, "profesor", $event.target.value)
                    }
                  }
                }),
                _vm._v(" "),
                _vm.e_curso.profesor
                  ? _c("span", {
                      staticClass: "text-danger",
                      domProps: { textContent: _vm._s(_vm.e_curso.profesor[0]) }
                    })
                  : _vm._e()
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "form-group" }, [
                _c("label", [_vm._v("Profesor2(email)")]),
                _vm._v(" "),
                _c("input", {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.o_curso.profesor2,
                      expression: "o_curso.profesor2"
                    }
                  ],
                  staticClass: "form-control",
                  class: [_vm.e_curso.profesor2 ? "is-invalid" : ""],
                  attrs: { type: "text", name: "profesor2" },
                  domProps: { value: _vm.o_curso.profesor2 },
                  on: {
                    input: function($event) {
                      if ($event.target.composing) {
                        return
                      }
                      _vm.$set(_vm.o_curso, "profesor2", $event.target.value)
                    }
                  }
                }),
                _vm._v(" "),
                _vm.e_curso.profesor2
                  ? _c("span", {
                      staticClass: "text-danger",
                      domProps: {
                        textContent: _vm._s(_vm.e_curso.profesor2[0])
                      }
                    })
                  : _vm._e()
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "form-group" }, [
                _c("label", [_vm._v("Acceso al curso")]),
                _vm._v(" "),
                _c("div", { staticClass: "form-check" }, [
                  _c("label", { staticClass: "form-check-label" }, [
                    _c("input", {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.o_curso.visibilidad,
                          expression: "o_curso.visibilidad"
                        }
                      ],
                      staticClass: "form-check-input",
                      attrs: {
                        type: "radio",
                        checked: "",
                        name: "accesradio",
                        value: "true"
                      },
                      domProps: {
                        checked: _vm._q(_vm.o_curso.visibilidad, "true")
                      },
                      on: {
                        change: function($event) {
                          _vm.$set(_vm.o_curso, "visibilidad", "true")
                        }
                      }
                    }),
                    _vm._v("Publico\n            ")
                  ])
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "form-check" }, [
                  _c("label", { staticClass: "form-check-label" }, [
                    _c("input", {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.o_curso.visibilidad,
                          expression: "o_curso.visibilidad"
                        }
                      ],
                      staticClass: "form-check-input",
                      attrs: {
                        type: "radio",
                        name: "accesradio",
                        value: "false"
                      },
                      domProps: {
                        checked: _vm._q(_vm.o_curso.visibilidad, "false")
                      },
                      on: {
                        change: function($event) {
                          _vm.$set(_vm.o_curso, "visibilidad", "false")
                        }
                      }
                    }),
                    _vm._v("Privado\n            ")
                  ])
                ])
              ]),
              _vm._v(" "),
              _c(
                "button",
                {
                  staticClass: "btn btn-outline-primary btn-sm float-left",
                  attrs: { type: "button", disabled: _vm.loader_actualizar },
                  on: {
                    click: function($event) {
                      $event.preventDefault()
                      _vm.actualizar()
                    }
                  }
                },
                [
                  _vm._v("\n          Actualizar\n          "),
                  _vm.loader_actualizar
                    ? _c("i", {
                        staticClass: "fa fa-spinner fa-spin fa-loader",
                        staticStyle: { "font-size": "20px" }
                      })
                    : _vm._e()
                ]
              )
            ])
          ])
        ])
      : _vm._e()
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "callout callout-info" }, [
      _c("p", [
        _c("i", { staticClass: "fa fa-fw fa-info" }),
        _vm._v("Los campos marcados en "),
        _c("code", [_vm._v("*")]),
        _vm._v(" son obligatorios\n        \t")
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", [_vm._v("Titulo "), _c("code", [_vm._v("*")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", [_vm._v("Fecha de Inicio "), _c("code", [_vm._v("*")])])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-1e8909af", module.exports)
  }
}

/***/ }),
/* 45 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(46)
/* template */
var __vue_template__ = __webpack_require__(47)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/cursos/CursosConfigComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-9fccc312", Component.options)
  } else {
    hotAPI.reload("data-v-9fccc312", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 46 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {
    jQuery(function () {
      jQuery("input[type=file]").change(function () {
        readURL(this);
      });
      var readURL = function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            jQuery('#logo-curso').attr('src', e.target.result);
          };
          reader.readAsDataURL(input.files[0]);
        }
      };
    });

    $('#summernote').summernote({
      callbacks: {
        onImageUpload: function onImageUpload(image) {
          var sizeKB = image[0]['size'] / 1000;
          var tmp_pr = 0;
          if (sizeKB > 1100) {
            tmp_pr = 1;
            swal({
              title: "Seleccione una imagen menor o igual a 1mb",
              text: '',
              type: "info"
            });
          }
          if (image[0]['type'] != 'image/jpeg' && image[0]['type'] != 'image/png') {
            tmp_pr = 1;
            swal({
              title: "La imagen debe ser formato png o jpg",
              text: '',
              type: "info"
            });
          }
          if (tmp_pr == 0) {
            var file = image[0];
            var reader = new FileReader();
            reader.onloadend = function () {
              var image = $('<img>').attr('src', reader.result);
              $('#summernote').summernote("insertNode", image[0]);
            };
            reader.readAsDataURL(file);
          }
        }
      },
      toolbar: [['font', ['fontname']], ['para', ['ul', 'ol', 'paragraph', 'strikethrough']], ['style', ['bold', 'italic', 'underline', 'clear']], ['fontsize', ['fontsize']], ['color', ['color']], ['height', ['height']], ['groupName', ['picture', 'link', 'video', 'table', 'hr', 'fullscreen']]],
      height: 350
    });
  },
  created: function created() {
    this.base_url = base_url;
    this.id = document.getElementById('idcurso').value;
    this.getConfig();
  },
  data: function data() {
    return {
      id: 0,
      o_curso: { 'urlvideo': '', 'plan_estudio': '' },
      loader_updplan: false,
      loader_updvideo: false,
      loader_updlogo: false
    };
  },
  methods: {
    replaceurlYoutube: function replaceurlYoutube(dirurl) {
      if (typeof dirurl !== 'undefined') {
        var cadena = dirurl + "";
        return cadena.replace("watch?v=", "embed/");
      }
      return "";
    },
    getConfig: function getConfig() {
      var _this = this;

      this.preload = true;
      var url = this.base_url + '/cursos/e_config';
      axios.post(url, { id: this.id }).then(function (response) {
        _this.o_curso = response.data.curso;
        $('#summernote').summernote('code', _this.o_curso.plan_estudio);
        _this.preload = false;
      }).catch(function (error) {
        _this.preload = false;
      });
    },
    upd_planestudio: function upd_planestudio() {
      var _this2 = this;

      this.loader_updplan = true;
      var url = this.base_url + '/cursos/u_configplan/' + this.id;
      var inst = this;
      axios.post(url, {
        plan_estudio: $('#summernote').summernote('code')
      }).then(function (response) {
        _this2.loader_updplan = false;
        swal({
          title: response.data.message,
          text: response.data.message2,
          type: "success"
        }, function () {
          inst.getConfig();
        });
      }).catch(function (error) {
        _this2.loader_updplan = false;
        if (error.response.data.errors) {
          _this2.e_curso = error.response.data.errors;
        }
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "2500"
          });
        }
      });
    },
    upd_urlvideo: function upd_urlvideo() {
      var _this3 = this;

      this.loader_updvideo = true;
      var url = this.base_url + '/cursos/u_configvideo/' + this.id;
      var inst = this;
      axios.post(url, {
        urlvideo: this.o_curso.urlvideo
      }).then(function (response) {
        _this3.loader_updvideo = false;
        swal({
          title: response.data.message,
          text: response.data.message2,
          type: "success"
        }, function () {
          inst.getConfig();
        });
      }).catch(function (error) {
        _this3.loader_updvideo = false;
        if (error.response.data.errors) {
          _this3.e_curso = error.response.data.errors;
        }
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "2500"
          });
        }
      });
    },
    upd_urllogo: function upd_urllogo() {
      var _this4 = this;

      this.loader_updlogo = true;
      var imagen = $('#file_avatar')[0].files[0];
      var formData = new FormData();
      formData.append('avatar', imagen);
      var url = this.base_url + '/cursos/u_configlogo/' + this.id;
      var inst = this;
      axios.post(url, formData, { avatar: imagen }).then(function (response) {
        _this4.loader_updlogo = false;
        swal({
          title: response.data.message,
          text: response.data.message2,
          type: "success"
        }, function () {
          inst.getConfig();
        });
      }).catch(function (error) {
        _this4.loader_updlogo = false;
        if (error.response.data.errors) {
          _this4.e_curso = error.response.data.errors;
        }
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "2500"
          });
        }
      });
    }
  }
});

/***/ }),
/* 47 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c("div", { staticClass: "row" }, [
      _c("div", { staticClass: "col-md-6 col-sm-12" }, [
        _c("div", { staticClass: "card" }, [
          _vm._m(0),
          _vm._v(" "),
          _c("div", { staticClass: "card-body" }, [
            _c("div", { staticClass: "form-group" }, [
              _c("label", [_vm._v("Url Youtube")]),
              _vm._v(" "),
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.o_curso.urlvideo,
                    expression: "o_curso.urlvideo"
                  }
                ],
                staticClass: "form-control",
                attrs: { type: "text", name: "urlvideo" },
                domProps: { value: _vm.o_curso.urlvideo },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.$set(_vm.o_curso, "urlvideo", $event.target.value)
                  }
                }
              })
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "col-md-12" }, [
              _c("iframe", {
                staticClass: "img-fluid",
                staticStyle: { width: "100%", height: "223px" },
                attrs: {
                  frameborder: "0",
                  allowfullscreen: "",
                  allow: "autoplay; encrypted-media",
                  src: _vm.replaceurlYoutube(_vm.o_curso.urlvideo)
                }
              })
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "card-footer" }, [
            _c(
              "button",
              {
                staticClass: "btn btn-outline-primary btn-sm",
                attrs: { type: "button", disabled: _vm.loader_updvideo },
                on: {
                  click: function($event) {
                    _vm.upd_urlvideo()
                  }
                }
              },
              [
                _vm._v("\n        Actualizar\n        "),
                _vm.loader_updvideo
                  ? _c("i", {
                      staticClass: "fa fa-spinner fa-spin fa-loader",
                      staticStyle: { "font-size": "20px" }
                    })
                  : _vm._e()
              ]
            )
          ])
        ])
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "col-md-6 col-sm-12" }, [
        _c("div", { staticClass: "card" }, [
          _vm._m(1),
          _vm._v(" "),
          _c("div", { staticClass: "card-body mb-2" }, [
            _vm._m(2),
            _vm._v(" "),
            _c("div", { staticClass: "col-md-12" }, [
              _c("img", {
                staticClass: "img-fluid",
                staticStyle: { width: "345px", height: "223px" },
                attrs: {
                  id: "logo-curso",
                  src: _vm.base_url + "/" + _vm.o_curso.imagen
                }
              })
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "card-footer" }, [
            _c(
              "button",
              {
                staticClass: "btn btn-outline-primary btn-sm",
                attrs: { type: "button", disabled: _vm.loader_updlogo },
                on: {
                  click: function($event) {
                    _vm.upd_urllogo()
                  }
                }
              },
              [
                _vm._v("\n        Actualizar\n        "),
                _vm.loader_updlogo
                  ? _c("i", {
                      staticClass: "fa fa-spinner fa-spin fa-loader",
                      staticStyle: { "font-size": "20px" }
                    })
                  : _vm._e()
              ]
            )
          ])
        ])
      ])
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "card" }, [
      _vm._m(3),
      _vm._v(" "),
      _vm._m(4),
      _vm._v(" "),
      _c("div", { staticClass: "card-footer" }, [
        _c(
          "button",
          {
            staticClass: "btn btn-outline-primary btn-sm",
            attrs: { type: "button", disabled: _vm.loader_updplan },
            on: {
              click: function($event) {
                _vm.upd_planestudio()
              }
            }
          },
          [
            _vm._v("\n        Actualizar\n        "),
            _vm.loader_updplan
              ? _c("i", {
                  staticClass: "fa fa-spinner fa-spin fa-loader",
                  staticStyle: { "font-size": "20px" }
                })
              : _vm._e()
          ]
        )
      ])
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "card-header" }, [
      _c("h4", { staticClass: "card-title" }, [
        _vm._v("\n        Video\n      ")
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "card-header" }, [
      _c("h4", { staticClass: "card-title" }, [
        _vm._v("\n        Logo\n      ")
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "form-group" }, [
      _c("label", { attrs: { for: "exampleInputFile" } }, [
        _vm._v("Logo (Dimensiones 750*425)")
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "input-group" }, [
        _c("input", {
          staticClass: "form-control-file border",
          attrs: { type: "file", id: "file_avatar" }
        })
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "card-header" }, [
      _c("h4", { staticClass: "card-title" }, [
        _vm._v("\n        Plan de estudio\n      ")
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "card-body" }, [
      _c("div", { staticClass: "form-group" }, [
        _c("div", { attrs: { id: "summernote" } })
      ])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-9fccc312", module.exports)
  }
}

/***/ }),
/* 48 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(49)
/* template */
var __vue_template__ = __webpack_require__(50)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/modulos/ModulosListaComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-26596bac", Component.options)
  } else {
    hotAPI.reload("data-v-26596bac", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 49 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {},
  created: function created() {
    this.base_url = base_url;
    this.idcurso = document.getElementById('idcurso').value;
    this.listado();
  },
  data: function data() {
    return {
      id: 0,
      preload: false,
      a_modulos: []
    };
  },
  methods: {
    listado: function listado() {
      var _this = this;

      var url = this.base_url + '/modulos/lista';
      this.preload = true;
      axios.post(url, { idcurso: this.idcurso }).then(function (response) {
        _this.preload = false;
        _this.a_modulos = response.data.modulos;
      }).catch(function (error) {
        _this.preload = false;
        _this.a_modulos = [];
        if (error.response.data.errors) {}
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
      });
    },
    redirectCrear: function redirectCrear() {
      this.$root.$emit('setMenu', 'modulos-crear');
    },
    redirectEdit: function redirectEdit(id) {
      document.getElementById('id').value = id;
      this.$root.$emit('setMenu', 'modulos-edit');
    }
  }
});

/***/ }),
/* 50 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _vm.preload ? _c("div", { staticClass: "row" }, [_vm._m(0)]) : _vm._e(),
      _vm._v(" "),
      !_vm.preload
        ? _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col-md-12 col-sm-12" }, [
              _c("h5", { staticClass: "m-0 text-dark" }, [
                _c("strong", [_vm._v("Lista de modulos")]),
                _vm._v(" "),
                _c(
                  "button",
                  {
                    staticClass: "btn btn-tool",
                    attrs: { type: "button" },
                    on: {
                      click: function($event) {
                        $event.preventDefault()
                        _vm.redirectCrear()
                      }
                    }
                  },
                  [
                    _c("i", {
                      staticClass: "fa fa-plus-circle",
                      staticStyle: { "font-size": "24px" }
                    })
                  ]
                )
              ])
            ])
          ])
        : _vm._e(),
      _vm._v(" "),
      _vm._l(_vm.a_modulos, function(modulo) {
        return _c("div", { staticClass: "card" }, [
          _c("div", { staticClass: "card-header no-border" }, [
            _c(
              "h5",
              {
                staticClass: "card-title",
                staticStyle: { cursor: "pointer" },
                on: {
                  click: function($event) {
                    $event.preventDefault()
                    _vm.redirectEdit(modulo.id)
                  }
                }
              },
              [
                _vm._v("Modulo "),
                _c("span", { domProps: { textContent: _vm._s(modulo.numero) } })
              ]
            ),
            _vm._v(" "),
            _c("div", { staticClass: "card-tools" }, [
              _c("div", { staticClass: "btn-group" }, [
                _c(
                  "button",
                  {
                    staticClass: "btn btn-tool",
                    attrs: { type: "button" },
                    on: {
                      click: function($event) {
                        $event.preventDefault()
                        _vm.redirectEdit(modulo.id)
                      }
                    }
                  },
                  [
                    _c("i", {
                      staticClass: "fa  fa-pencil",
                      staticStyle: { "font-size": "20px" }
                    })
                  ]
                )
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "row" }, [
              _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                _c("b", [_vm._v("Titulo :")]),
                _vm._v(" "),
                _c("span", { domProps: { textContent: _vm._s(modulo.nombre) } })
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                _c("b", [_vm._v("Creado :")]),
                _vm._v(" "),
                _c("span", {
                  domProps: { textContent: _vm._s(modulo.fecha_creacion) }
                })
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                _c("b", [_vm._v("Lecciones :")]),
                _vm._v(" "),
                _c("span", { domProps: { textContent: _vm._s(modulo.numlec) } })
              ])
            ])
          ])
        ])
      })
    ],
    2
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-26596bac", module.exports)
  }
}

/***/ }),
/* 51 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(52)
/* template */
var __vue_template__ = __webpack_require__(53)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/modulos/ModulosCrearComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-4fbaf8b4", Component.options)
  } else {
    hotAPI.reload("data-v-4fbaf8b4", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 52 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {},
  created: function created() {
    this.base_url = base_url;
    this.idcurso = document.getElementById('idcurso').value;
  },
  data: function data() {
    return {
      idcurso: 0,
      o_basemodulo: { 'nombre': '' },
      o_modulo: { 'nombre': '' },
      e_modulo: [],
      loader_guardar: false
    };
  },
  methods: {
    guardar: function guardar() {
      var _this = this;

      this.loader_guardar = true;
      this.o_modulo.idcurso = this.idcurso;
      var url = this.base_url + '/modulos/guardar';
      axios.post(url, this.o_modulo).then(function (response) {
        _this.loader_guardar = false;
        _this.e_modulo = [];
        _this.o_modulo = _this.o_basemodulo;
        var inst = _this;
        swal({
          title: response.data.message,
          text: response.data.message2,
          type: "success"
        }, function () {
          document.getElementById('id').value = '';
          inst.$root.$emit('setMenu', 'modulos-lista');
        });
      }).catch(function (error) {
        _this.loader_guardar = false;
        if (error.response.data.errors) {
          _this.e_modulo = error.response.data.errors;
        }
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "2500"
          });
        }
      });
    },
    redirectVolver: function redirectVolver() {
      document.getElementById('id').value = '';
      this.$root.$emit('setMenu', 'modulos-lista');
    }
  }
});

/***/ }),
/* 53 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c("div", { staticClass: "row" }, [
      _c("div", { staticClass: "col-md-12 col-sm-12" }, [
        _c("h5", { staticClass: "m-0 text-dark" }, [
          _c("strong", [_vm._v("Nuevo modulo")]),
          _vm._v(" "),
          _c(
            "button",
            {
              staticClass: "btn btn-tool",
              attrs: { type: "button" },
              on: {
                click: function($event) {
                  $event.preventDefault()
                  _vm.redirectVolver()
                }
              }
            },
            [
              _c("i", {
                staticClass: "fa fa-arrow-circle-left",
                staticStyle: { "font-size": "24px" }
              })
            ]
          )
        ])
      ])
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "card" }, [
      _c("div", { staticClass: "card-body" }, [
        _vm._m(0),
        _vm._v(" "),
        _c("div", { staticClass: "row" }, [
          _c("div", { staticClass: "form-group col-md-2 col-sm-4" }, [
            _vm._m(1),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.o_modulo.numero,
                  expression: "o_modulo.numero"
                }
              ],
              staticClass: "form-control",
              class: [_vm.e_modulo.numero ? "is-invalid" : ""],
              attrs: { type: "number", min: "0", step: "0.01", name: "numero" },
              domProps: { value: _vm.o_modulo.numero },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.o_modulo, "numero", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _vm.e_modulo.numero
              ? _c("span", {
                  staticClass: "text-danger",
                  domProps: { textContent: _vm._s(_vm.e_modulo.numero[0]) }
                })
              : _vm._e()
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "form-group col-md-10 col-sm-12" }, [
            _vm._m(2),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.o_modulo.nombre,
                  expression: "o_modulo.nombre"
                }
              ],
              staticClass: "form-control",
              class: [_vm.e_modulo.nombre ? "is-invalid" : ""],
              attrs: { type: "text", name: "nombre" },
              domProps: { value: _vm.o_modulo.nombre },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.o_modulo, "nombre", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _vm.e_modulo.nombre
              ? _c("span", {
                  staticClass: "text-danger",
                  domProps: { textContent: _vm._s(_vm.e_modulo.nombre[0]) }
                })
              : _vm._e()
          ])
        ]),
        _vm._v(" "),
        _c(
          "button",
          {
            staticClass: "btn btn-outline-primary btn-sm float-left",
            attrs: { type: "button", disabled: _vm.loader_guardar },
            on: {
              click: function($event) {
                $event.preventDefault()
                _vm.guardar()
              }
            }
          },
          [
            _vm._v("\n        Crear modulo\n        "),
            _vm.loader_guardar
              ? _c("i", {
                  staticClass: "fa fa-spinner fa-spin fa-loader",
                  staticStyle: { "font-size": "20px" }
                })
              : _vm._e()
          ]
        )
      ])
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "callout callout-info" }, [
      _c("p", [
        _c("i", { staticClass: "fa fa-fw fa-info" }),
        _vm._v("Los campos marcados en "),
        _c("code", [_vm._v("*")]),
        _vm._v(" son obligatorios\n      \t")
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", [_vm._v("Numero "), _c("code", [_vm._v("*")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", [_vm._v("Titulo "), _c("code", [_vm._v("*")])])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-4fbaf8b4", module.exports)
  }
}

/***/ }),
/* 54 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(55)
/* template */
var __vue_template__ = __webpack_require__(56)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/modulos/ModulosEditComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-4aeda853", Component.options)
  } else {
    hotAPI.reload("data-v-4aeda853", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 55 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {},
  created: function created() {
    this.base_url = base_url;
    this.idcurso = document.getElementById('idcurso').value;
    this.id = document.getElementById('id').value;
    this.getModulo();
  },
  data: function data() {
    return {
      loader_actualizar: false,
      id: 0,
      idcurso: 0,
      o_modulo: {},
      e_modulo: [],
      preload: true
    };
  },
  methods: {
    getModulo: function getModulo() {
      var _this = this;

      this.preload = true;
      var url = this.base_url + '/modulos/editar';
      axios.post(url, { id: this.id }).then(function (response) {
        _this.o_modulo = response.data.modulo;
        _this.preload = false;
      }).catch(function (error) {
        _this.preload = false;
      });
    },
    actualizar: function actualizar() {
      var _this2 = this;

      this.loader_actualizar = true;
      var url = this.base_url + '/modulos/actualizar';
      this.o_modulo.id = this.id;
      var inst = this;
      axios.post(url, this.o_modulo).then(function (response) {
        _this2.loader_actualizar = false;
        _this2.e_modulo = [];
        swal({
          title: response.data.message,
          text: response.data.message2,
          type: "success"
        }, function () {
          document.getElementById('id').value = '';
          inst.$root.$emit('setMenu', 'modulos-lista');
        });
      }).catch(function (error) {
        _this2.loader_actualizar = false;
        if (error.response.data.errors) {
          _this2.e_modulo = error.response.data.errors;
        }
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
      });
    },
    redirectVolver: function redirectVolver() {
      document.getElementById('id').value = '';
      this.$root.$emit('setMenu', 'modulos-lista');
    }
  }
});

/***/ }),
/* 56 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _vm.preload ? _c("div", { staticClass: "row" }, [_vm._m(0)]) : _vm._e(),
    _vm._v(" "),
    !_vm.preload
      ? _c("div", { staticClass: "row" }, [
          _c("div", { staticClass: "col-md-12 col-sm-12" }, [
            _c("h5", { staticClass: "m-0 text-dark" }, [
              _c("strong", [_vm._v("Actualizar modulo")]),
              _vm._v(" "),
              _c(
                "button",
                {
                  staticClass: "btn btn-tool",
                  attrs: { type: "button" },
                  on: {
                    click: function($event) {
                      $event.preventDefault()
                      _vm.redirectVolver()
                    }
                  }
                },
                [
                  _c("i", {
                    staticClass: "fa fa-arrow-circle-left",
                    staticStyle: { "font-size": "24px" }
                  })
                ]
              )
            ])
          ])
        ])
      : _vm._e(),
    _vm._v(" "),
    !_vm.preload
      ? _c("div", { staticClass: "card" }, [
          _c("div", { staticClass: "card-body" }, [
            _vm._m(1),
            _vm._v(" "),
            _c("div", { staticClass: "row" }, [
              _c("div", { staticClass: "form-group col-md-2 col-sm-4" }, [
                _vm._m(2),
                _vm._v(" "),
                _c("input", {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.o_modulo.numero,
                      expression: "o_modulo.numero"
                    }
                  ],
                  staticClass: "form-control",
                  class: [_vm.e_modulo.numero ? "is-invalid" : ""],
                  attrs: {
                    type: "number",
                    min: "0",
                    step: "0.01",
                    name: "numero"
                  },
                  domProps: { value: _vm.o_modulo.numero },
                  on: {
                    input: function($event) {
                      if ($event.target.composing) {
                        return
                      }
                      _vm.$set(_vm.o_modulo, "numero", $event.target.value)
                    }
                  }
                }),
                _vm._v(" "),
                _vm.e_modulo.numero
                  ? _c("span", {
                      staticClass: "text-danger",
                      domProps: { textContent: _vm._s(_vm.e_modulo.numero[0]) }
                    })
                  : _vm._e()
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "form-group col-md-10 col-sm-12" }, [
                _vm._m(3),
                _vm._v(" "),
                _c("input", {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.o_modulo.nombre,
                      expression: "o_modulo.nombre"
                    }
                  ],
                  staticClass: "form-control",
                  class: [_vm.e_modulo.nombre ? "is-invalid" : ""],
                  attrs: { type: "text", name: "nombre" },
                  domProps: { value: _vm.o_modulo.nombre },
                  on: {
                    input: function($event) {
                      if ($event.target.composing) {
                        return
                      }
                      _vm.$set(_vm.o_modulo, "nombre", $event.target.value)
                    }
                  }
                }),
                _vm._v(" "),
                _vm.e_modulo.nombre
                  ? _c("span", {
                      staticClass: "text-danger",
                      domProps: { textContent: _vm._s(_vm.e_modulo.nombre[0]) }
                    })
                  : _vm._e()
              ])
            ]),
            _vm._v(" "),
            _c(
              "button",
              {
                staticClass: "btn btn-outline-primary btn-sm float-left",
                attrs: { type: "button", disabled: _vm.loader_actualizar },
                on: {
                  click: function($event) {
                    $event.preventDefault()
                    _vm.actualizar()
                  }
                }
              },
              [
                _vm._v("\n        Actualizar\n        "),
                _vm.loader_actualizar
                  ? _c("i", {
                      staticClass: "fa fa-spinner fa-spin fa-loader",
                      staticStyle: { "font-size": "20px" }
                    })
                  : _vm._e()
              ]
            )
          ])
        ])
      : _vm._e()
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "callout callout-info" }, [
      _c("p", [
        _c("i", { staticClass: "fa fa-fw fa-info" }),
        _vm._v("Los campos marcados en "),
        _c("code", [_vm._v("*")]),
        _vm._v(" son obligatorios\n      \t")
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", [_vm._v("Numero "), _c("code", [_vm._v("*")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", [_vm._v("Titulo "), _c("code", [_vm._v("*")])])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-4aeda853", module.exports)
  }
}

/***/ }),
/* 57 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(58)
/* template */
var __vue_template__ = __webpack_require__(59)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/lecciones/LeccionesListaComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-471a042a", Component.options)
  } else {
    hotAPI.reload("data-v-471a042a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 58 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {},
  created: function created() {
    this.base_url = base_url;
    this.idcurso = document.getElementById('idcurso').value;
    this.listado();
  },
  data: function data() {
    return {
      id: 0,
      preload: true,
      a_leccion: [],
      select_mod: [],
      idmodulo: 0
    };
  },
  methods: {
    listado: function listado() {
      var _this = this;

      var url = this.base_url + '/lecciones/lista';
      this.preload = true;
      axios.post(url, { idcurso: this.idcurso }).then(function (response) {
        _this.preload = false;
        _this.select_mod = response.data.select_mod;
        _this.a_leccion = response.data.lecciones;
      }).catch(function (error) {
        _this.preload = false;
        _this.a_leccion = [];
        if (error.response.data.errors) {}
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
      });
    },
    redirectCrear: function redirectCrear() {
      this.$root.$emit('setMenu', 'lecciones-crear');
    },
    redirectEdit: function redirectEdit(id) {
      document.getElementById('id').value = id;
      this.$root.$emit('setMenu', 'lecciones-edit');
    },
    busqueda_modulo: function busqueda_modulo() {
      var _this2 = this;

      var url = this.base_url + '/lecciones/listamod';
      this.preload = true;
      axios.post(url, { idmodulo: this.idmodulo }).then(function (response) {
        _this2.preload = false;
        _this2.a_leccion = response.data.lecciones;
      }).catch(function (error) {
        _this2.preload = false;
        _this2.a_leccion = [];
        if (error.response.data.errors) {}
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
      });
    }
  }
});

/***/ }),
/* 59 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _vm.preload ? _c("div", { staticClass: "row" }, [_vm._m(0)]) : _vm._e(),
      _vm._v(" "),
      !_vm.preload
        ? _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col-md-12 col-sm-12" }, [
              _c("h5", { staticClass: "m-0 text-dark" }, [
                _c("strong", [_vm._v("Lista de lecciones")]),
                _vm._v(" "),
                _c(
                  "button",
                  {
                    staticClass: "btn btn-tool",
                    attrs: { type: "button" },
                    on: {
                      click: function($event) {
                        $event.preventDefault()
                        _vm.redirectCrear()
                      }
                    }
                  },
                  [
                    _c("i", {
                      staticClass: "fa fa-plus-circle",
                      staticStyle: { "font-size": "24px" }
                    })
                  ]
                )
              ])
            ])
          ])
        : _vm._e(),
      _vm._v(" "),
      !_vm.preload
        ? _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col-md-12" }, [
              _c("div", { staticClass: "form-group" }, [
                _c(
                  "select",
                  {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.idmodulo,
                        expression: "idmodulo"
                      }
                    ],
                    staticClass: "form-control",
                    attrs: { name: "select_mod" },
                    on: {
                      change: [
                        function($event) {
                          var $$selectedVal = Array.prototype.filter
                            .call($event.target.options, function(o) {
                              return o.selected
                            })
                            .map(function(o) {
                              var val = "_value" in o ? o._value : o.value
                              return val
                            })
                          _vm.idmodulo = $event.target.multiple
                            ? $$selectedVal
                            : $$selectedVal[0]
                        },
                        _vm.busqueda_modulo
                      ]
                    }
                  },
                  [
                    _c("option", { domProps: { value: 0 } }, [
                      _vm._v("Seleccione un modulo")
                    ]),
                    _vm._v(" "),
                    _vm._l(_vm.select_mod, function(s_mod) {
                      return _c("option", {
                        domProps: {
                          value: s_mod.id,
                          textContent: _vm._s(s_mod.nombre)
                        }
                      })
                    })
                  ],
                  2
                )
              ])
            ])
          ])
        : _vm._e(),
      _vm._v(" "),
      _vm._l(_vm.a_leccion, function(leccion) {
        return !_vm.preload
          ? _c("div", { staticClass: "card" }, [
              _c("div", { staticClass: "card-header no-border" }, [
                _c(
                  "h5",
                  {
                    staticClass: "card-title",
                    staticStyle: { cursor: "pointer" },
                    on: {
                      click: function($event) {
                        $event.preventDefault()
                        _vm.redirectEdit(leccion.id)
                      }
                    }
                  },
                  [
                    _vm._v("Leccion "),
                    _c("span", {
                      domProps: { textContent: _vm._s(leccion.numero) }
                    })
                  ]
                ),
                _vm._v(" "),
                _c("div", { staticClass: "card-tools" }, [
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-tool",
                      attrs: { type: "button" },
                      on: {
                        click: function($event) {
                          $event.preventDefault()
                          _vm.redirectEdit(leccion.id)
                        }
                      }
                    },
                    [
                      _c("i", {
                        staticClass: "fa  fa-pencil",
                        staticStyle: { "font-size": "20px" }
                      })
                    ]
                  )
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "row" }, [
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("b", [_vm._v("Titulo :")]),
                    _vm._v(" "),
                    _c("span", {
                      domProps: { textContent: _vm._s(leccion.nombre) }
                    })
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("b", [_vm._v("Creado :")]),
                    _vm._v(" "),
                    _c("span", {
                      domProps: { textContent: _vm._s(leccion.fecha_creacion) }
                    })
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("b", [_vm._v("Tiempo de lectura :")]),
                    _vm._v(" "),
                    _c("span", {
                      domProps: { textContent: _vm._s(leccion.tiempolectura) }
                    }),
                    _vm._v(" minutos\n        ")
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("b", [_vm._v("Modulo :")]),
                    _vm._v(" "),
                    _c("span", {
                      domProps: { textContent: _vm._s(leccion.nommod) }
                    })
                  ])
                ])
              ])
            ])
          : _vm._e()
      })
    ],
    2
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-471a042a", module.exports)
  }
}

/***/ }),
/* 60 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(61)
/* template */
var __vue_template__ = __webpack_require__(62)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/lecciones/LeccionesCrearComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-32693da6", Component.options)
  } else {
    hotAPI.reload("data-v-32693da6", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 61 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {
    $('#summernote').summernote({
      callbacks: {
        onImageUpload: function onImageUpload(image) {
          var sizeKB = image[0]['size'] / 1000;
          var tmp_pr = 0;
          if (sizeKB > 1100) {
            tmp_pr = 1;
            swal({
              title: "Seleccione una imagen menor o igual a 1mb",
              text: '',
              type: "info"
            });
          }
          if (image[0]['type'] != 'image/jpeg' && image[0]['type'] != 'image/png') {
            tmp_pr = 1;
            swal({
              title: "La imagen debe ser formato png o jpg",
              text: '',
              type: "info"
            });
          }
          if (tmp_pr == 0) {
            var file = image[0];
            var reader = new FileReader();
            reader.onloadend = function () {
              var image = $('<img>').attr('src', reader.result);
              $('#summernote').summernote("insertNode", image[0]);
            };
            reader.readAsDataURL(file);
          }
        }
      },
      toolbar: [['font', ['fontname']], ['para', ['ul', 'ol', 'paragraph', 'strikethrough']], ['style', ['bold', 'italic', 'underline', 'clear']], ['fontsize', ['fontsize']], ['color', ['color']], ['height', ['height']], ['groupName', ['picture', 'link', 'video', 'table', 'hr', 'fullscreen']]],
      height: 350
    });
  },
  created: function created() {
    this.base_url = base_url;
    this.idcurso = document.getElementById('idcurso').value;
    this.list_select();
  },
  data: function data() {
    return {
      idcurso: 0,
      preload: true,
      o_baseleccion: { 'modulo': '', 'nombre': '', 'descripcion': '', 'tiempolectura': 0 },
      o_leccion: { 'modulo': '', 'nombre': '', 'descripcion': '', 'tiempolectura': 0 },
      e_leccion: [],
      loader_guardar: false,
      select_mod: []
    };
  },
  methods: {
    list_select: function list_select() {
      var _this = this;

      var url = this.base_url + '/lecciones/select_mod';
      this.preload = true;
      axios.post(url, { idcurso: this.idcurso }).then(function (response) {
        _this.preload = false;
        _this.select_mod = response.data.select_mod;
        _this.a_leccion = response.data.lecciones;
      }).catch(function (error) {
        _this.preload = false;
        _this.a_leccion = [];
        if (error.response.data.errors) {}
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
      });
    },
    guardar: function guardar() {
      var _this2 = this;

      this.loader_guardar = true;
      this.o_leccion.descripcion = $('#summernote').summernote('code');
      var url = this.base_url + '/lecciones/guardar';
      var inst = this;
      axios.post(url, this.o_leccion).then(function (response) {
        _this2.loader_guardar = false;
        _this2.o_leccion = _this2.o_baseleccion;
        swal({
          title: response.data.message,
          text: response.data.message2,
          type: "success"
        }, function () {
          document.getElementById('id').value = '';
          inst.$root.$emit('setMenu', 'lecciones-lista');
        });
      }).catch(function (error) {
        _this2.loader_guardar = false;
        if (error.response.data.errors) {
          _this2.e_leccion = error.response.data.errors;
        }
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
      });
    },
    redirectVolver: function redirectVolver() {
      this.$root.$emit('setMenu', 'lecciones-lista');
    }
  }
});

/***/ }),
/* 62 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c(
      "div",
      {
        directives: [
          {
            name: "show",
            rawName: "v-show",
            value: _vm.preload,
            expression: "preload"
          }
        ],
        staticClass: "row"
      },
      [_vm._m(0)]
    ),
    _vm._v(" "),
    _c(
      "div",
      {
        directives: [
          {
            name: "show",
            rawName: "v-show",
            value: !_vm.preload,
            expression: "!preload"
          }
        ],
        staticClass: "row"
      },
      [
        _c("div", { staticClass: "col-md-6 col-sm-6" }, [
          _c("h5", { staticClass: "m-0 text-dark" }, [
            _c("strong", [_vm._v("Nueva leccion")]),
            _vm._v(" "),
            _c(
              "button",
              {
                staticClass: "btn btn-tool",
                attrs: { type: "button" },
                on: {
                  click: function($event) {
                    $event.preventDefault()
                    _vm.redirectVolver()
                  }
                }
              },
              [
                _c("i", {
                  staticClass: "fa fa-arrow-circle-left",
                  staticStyle: { "font-size": "24px" }
                })
              ]
            )
          ])
        ])
      ]
    ),
    _vm._v(" "),
    _c(
      "div",
      {
        directives: [
          {
            name: "show",
            rawName: "v-show",
            value: !_vm.preload,
            expression: "!preload"
          }
        ],
        staticClass: "card"
      },
      [
        _c("div", { staticClass: "card-body" }, [
          _vm._m(1),
          _vm._v(" "),
          _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "form-group col-md-2 col-sm-4" }, [
              _vm._m(2),
              _vm._v(" "),
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.o_leccion.numero,
                    expression: "o_leccion.numero"
                  }
                ],
                staticClass: "form-control",
                class: [_vm.e_leccion.numero ? "is-invalid" : ""],
                attrs: {
                  type: "number",
                  min: "0",
                  step: "0.01",
                  name: "numero"
                },
                domProps: { value: _vm.o_leccion.numero },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.$set(_vm.o_leccion, "numero", $event.target.value)
                  }
                }
              }),
              _vm._v(" "),
              _vm.e_leccion.numero
                ? _c("span", {
                    staticClass: "text-danger",
                    domProps: { textContent: _vm._s(_vm.e_leccion.numero[0]) }
                  })
                : _vm._e()
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "form-group col-md-10 col-sm-12" }, [
              _vm._m(3),
              _vm._v(" "),
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.o_leccion.nombre,
                    expression: "o_leccion.nombre"
                  }
                ],
                staticClass: "form-control",
                class: [_vm.e_leccion.nombre ? "is-invalid" : ""],
                attrs: { type: "text", name: "nombre" },
                domProps: { value: _vm.o_leccion.nombre },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.$set(_vm.o_leccion, "nombre", $event.target.value)
                  }
                }
              }),
              _vm._v(" "),
              _vm.e_leccion.nombre
                ? _c("span", {
                    staticClass: "text-danger",
                    domProps: { textContent: _vm._s(_vm.e_leccion.nombre[0]) }
                  })
                : _vm._e()
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "form-group" }, [
            _vm._m(4),
            _vm._v(" "),
            _c(
              "select",
              {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.o_leccion.modulo,
                    expression: "o_leccion.modulo"
                  }
                ],
                staticClass: "form-control",
                class: [_vm.e_leccion.modulo ? "is-invalid" : ""],
                attrs: { name: "select_mod" },
                on: {
                  change: function($event) {
                    var $$selectedVal = Array.prototype.filter
                      .call($event.target.options, function(o) {
                        return o.selected
                      })
                      .map(function(o) {
                        var val = "_value" in o ? o._value : o.value
                        return val
                      })
                    _vm.$set(
                      _vm.o_leccion,
                      "modulo",
                      $event.target.multiple ? $$selectedVal : $$selectedVal[0]
                    )
                  }
                }
              },
              [
                _c("option", { domProps: { value: "" } }, [_vm._v(" - ")]),
                _vm._v(" "),
                _vm._l(_vm.select_mod, function(s_mod) {
                  return _c("option", {
                    domProps: {
                      value: s_mod.id,
                      textContent: _vm._s(s_mod.nombre)
                    }
                  })
                })
              ],
              2
            ),
            _vm._v(" "),
            _vm.e_leccion.modulo
              ? _c("span", {
                  staticClass: "text-danger",
                  domProps: { textContent: _vm._s(_vm.e_leccion.modulo[0]) }
                })
              : _vm._e()
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "form-group" }, [
            _c("label", [_vm._v("Tiempo de lectura(Minutos)")]),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.o_leccion.tiempolectura,
                  expression: "o_leccion.tiempolectura"
                }
              ],
              staticClass: "form-control",
              attrs: { type: "number", name: "tiempo", min: "0", max: "1000" },
              domProps: { value: _vm.o_leccion.tiempolectura },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.o_leccion, "tiempolectura", $event.target.value)
                }
              }
            })
          ]),
          _vm._v(" "),
          _vm._m(5),
          _vm._v(" "),
          _c(
            "button",
            {
              staticClass: "btn btn-outline-primary btn-sm float-left",
              attrs: { type: "button", disabled: _vm.loader_guardar },
              on: {
                click: function($event) {
                  $event.preventDefault()
                  _vm.guardar()
                }
              }
            },
            [
              _vm._v("\n        Crear leccion\n        "),
              _vm.loader_guardar
                ? _c("i", {
                    staticClass: "fa fa-spinner fa-spin fa-loader",
                    staticStyle: { "font-size": "20px" }
                  })
                : _vm._e()
            ]
          )
        ])
      ]
    )
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "callout callout-info" }, [
      _c("p", [
        _c("i", { staticClass: "fa fa-fw fa-info" }),
        _vm._v("Los campos marcados en "),
        _c("code", [_vm._v("*")]),
        _vm._v(" son obligatorios\n      \t")
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", [_vm._v("Numero "), _c("code", [_vm._v("*")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", [_vm._v("Titulo "), _c("code", [_vm._v("*")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", [_vm._v("Modulo "), _c("code", [_vm._v("*")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "form-group" }, [
      _c("div", { attrs: { id: "summernote" } })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-32693da6", module.exports)
  }
}

/***/ }),
/* 63 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(64)
/* template */
var __vue_template__ = __webpack_require__(65)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/lecciones/LeccionesEditComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-e030a35a", Component.options)
  } else {
    hotAPI.reload("data-v-e030a35a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 64 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    mounted: function mounted() {
        $('#summernote').summernote({
            callbacks: {
                onImageUpload: function onImageUpload(image) {
                    var sizeKB = image[0]['size'] / 1000;
                    var tmp_pr = 0;
                    if (sizeKB > 1100) {
                        tmp_pr = 1;
                        swal({
                            title: "Seleccione una imagen menor o igual a 1mb",
                            text: '',
                            type: "info"
                        });
                    }
                    if (image[0]['type'] != 'image/jpeg' && image[0]['type'] != 'image/png') {
                        tmp_pr = 1;
                        swal({
                            title: "La imagen debe ser formato png o jpg",
                            text: '',
                            type: "info"
                        });
                    }
                    if (tmp_pr == 0) {
                        var file = image[0];
                        var reader = new FileReader();
                        reader.onloadend = function () {
                            var image = $('<img>').attr('src', reader.result);
                            $('#summernote').summernote("insertNode", image[0]);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            },
            toolbar: [['font', ['fontname']], ['para', ['ul', 'ol', 'paragraph', 'strikethrough']], ['style', ['bold', 'italic', 'underline', 'clear']], ['fontsize', ['fontsize']], ['color', ['color']], ['height', ['height']], ['groupName', ['picture', 'link', 'video', 'table', 'hr', 'fullscreen']]],
            height: 350
        });
    },
    created: function created() {
        this.base_url = base_url;
        this.idcurso = document.getElementById('idcurso').value;
        this.id = document.getElementById('id').value;
        this.getLeccion();
    },
    data: function data() {
        return {
            loader_actualizar: false,
            id: 0,
            idcurso: 0,
            o_leccion: {},
            e_leccion: [],
            select_mod: [],
            preload: false
        };
    },
    methods: {
        getLeccion: function getLeccion() {
            var _this = this;

            this.preload = true;
            var url = this.base_url + '/lecciones/editar';
            axios.post(url, { id: this.id, idcurso: this.idcurso }).then(function (response) {
                _this.select_mod = response.data.select_mod;
                _this.o_leccion = response.data.leccion;
                $('#summernote').summernote('code', _this.o_leccion.descripcion);
                _this.preload = false;
            }).catch(function (error) {
                _this.preload = false;
            });
        },
        actualizar: function actualizar() {
            var _this2 = this;

            this.loader_actualizar = true;
            var url = this.base_url + '/lecciones/actualizar';
            this.o_leccion.id = this.id;
            this.o_leccion.descripcion = $('#summernote').summernote('code');
            var inst = this;
            axios.post(url, this.o_leccion).then(function (response) {
                _this2.loader_actualizar = false;
                _this2.e_leccion = [];
                swal({
                    title: response.data.message,
                    text: response.data.message2,
                    type: "success"
                }, function () {
                    document.getElementById('id').value = '';
                    inst.$root.$emit('setMenu', 'lecciones-lista');
                });
            }).catch(function (error) {
                _this2.loader_actualizar = false;
                if (error.response.data.errors) {
                    _this2.e_leccion = error.response.data.errors;
                }
                if (error.response.data.error) {
                    toastr.error(error.response.data.error, '', {
                        "timeOut": "3500"
                    });
                }
            });
        },
        redirectVolver: function redirectVolver() {
            this.$root.$emit('setMenu', 'lecciones-lista');
        }
    }
});

/***/ }),
/* 65 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _vm.preload ? _c("div", { staticClass: "row" }, [_vm._m(0)]) : _vm._e(),
    _vm._v(" "),
    !_vm.preload
      ? _c("div", { staticClass: "row" }, [
          _c("div", { staticClass: "col-md-6 col-sm-6" }, [
            _c("h5", { staticClass: "m-0 text-dark" }, [
              _c("strong", [_vm._v("Actualizar leccion")]),
              _vm._v(" "),
              _c(
                "button",
                {
                  staticClass: "btn btn-tool",
                  attrs: { type: "button" },
                  on: {
                    click: function($event) {
                      $event.preventDefault()
                      _vm.redirectVolver()
                    }
                  }
                },
                [
                  _c("i", {
                    staticClass: "fa fa-arrow-circle-left",
                    staticStyle: { "font-size": "24px" }
                  })
                ]
              )
            ])
          ])
        ])
      : _vm._e(),
    _vm._v(" "),
    _c(
      "div",
      {
        directives: [
          {
            name: "show",
            rawName: "v-show",
            value: !_vm.preload,
            expression: "!preload"
          }
        ],
        staticClass: "card"
      },
      [
        _c("div", { staticClass: "card-body" }, [
          _vm._m(1),
          _vm._v(" "),
          _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "form-group col-md-2 col-sm-4" }, [
              _vm._m(2),
              _vm._v(" "),
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.o_leccion.numero,
                    expression: "o_leccion.numero"
                  }
                ],
                staticClass: "form-control",
                class: [_vm.e_leccion.numero ? "is-invalid" : ""],
                attrs: {
                  type: "number",
                  min: "0",
                  step: "0.01",
                  name: "numero"
                },
                domProps: { value: _vm.o_leccion.numero },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.$set(_vm.o_leccion, "numero", $event.target.value)
                  }
                }
              }),
              _vm._v(" "),
              _vm.e_leccion.numero
                ? _c("span", {
                    staticClass: "text-danger",
                    domProps: { textContent: _vm._s(_vm.e_leccion.numero[0]) }
                  })
                : _vm._e()
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "form-group col-md-10 col-sm-12" }, [
              _vm._m(3),
              _vm._v(" "),
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.o_leccion.nombre,
                    expression: "o_leccion.nombre"
                  }
                ],
                staticClass: "form-control",
                class: [_vm.e_leccion.nombre ? "is-invalid" : ""],
                attrs: { type: "text", name: "nombre" },
                domProps: { value: _vm.o_leccion.nombre },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.$set(_vm.o_leccion, "nombre", $event.target.value)
                  }
                }
              }),
              _vm._v(" "),
              _vm.e_leccion.nombre
                ? _c("span", {
                    staticClass: "text-danger",
                    domProps: { textContent: _vm._s(_vm.e_leccion.nombre[0]) }
                  })
                : _vm._e()
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "form-group" }, [
            _vm._m(4),
            _vm._v(" "),
            _c(
              "select",
              {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model",
                    value: _vm.o_leccion.modulo,
                    expression: "o_leccion.modulo"
                  }
                ],
                staticClass: "form-control",
                class: [_vm.e_leccion.modulo ? "is-invalid" : ""],
                attrs: { name: "select_mod" },
                on: {
                  change: function($event) {
                    var $$selectedVal = Array.prototype.filter
                      .call($event.target.options, function(o) {
                        return o.selected
                      })
                      .map(function(o) {
                        var val = "_value" in o ? o._value : o.value
                        return val
                      })
                    _vm.$set(
                      _vm.o_leccion,
                      "modulo",
                      $event.target.multiple ? $$selectedVal : $$selectedVal[0]
                    )
                  }
                }
              },
              [
                _c("option", { domProps: { value: "" } }, [_vm._v(" - ")]),
                _vm._v(" "),
                _vm._l(_vm.select_mod, function(s_mod) {
                  return _c("option", {
                    domProps: {
                      value: s_mod.id,
                      textContent: _vm._s(s_mod.nombre)
                    }
                  })
                })
              ],
              2
            ),
            _vm._v(" "),
            _vm.e_leccion.modulo
              ? _c("span", {
                  staticClass: "text-danger",
                  domProps: { textContent: _vm._s(_vm.e_leccion.modulo[0]) }
                })
              : _vm._e()
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "form-group" }, [
            _c("label", [_vm._v("Tiempo de lectura(Minutos)")]),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.o_leccion.tiempolectura,
                  expression: "o_leccion.tiempolectura"
                }
              ],
              staticClass: "form-control",
              attrs: { type: "number", name: "tiempo", min: "0", max: "1000" },
              domProps: { value: _vm.o_leccion.tiempolectura },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.o_leccion, "tiempolectura", $event.target.value)
                }
              }
            })
          ]),
          _vm._v(" "),
          _vm._m(5),
          _vm._v(" "),
          _c(
            "button",
            {
              staticClass: "btn btn-outline-primary btn-sm float-left",
              attrs: { type: "button", disabled: _vm.loader_actualizar },
              on: {
                click: function($event) {
                  $event.preventDefault()
                  _vm.actualizar()
                }
              }
            },
            [
              _vm._v("\n        Actualizar\n        "),
              _vm.loader_actualizar
                ? _c("i", {
                    staticClass: "fa fa-spinner fa-spin fa-loader",
                    staticStyle: { "font-size": "20px" }
                  })
                : _vm._e()
            ]
          )
        ])
      ]
    )
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "callout callout-info" }, [
      _c("p", [
        _c("i", { staticClass: "fa fa-fw fa-info" }),
        _vm._v("Los campos marcados en "),
        _c("code", [_vm._v("*")]),
        _vm._v(" son obligatorios\n      \t")
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", [_vm._v("Numero "), _c("code", [_vm._v("*")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", [_vm._v("Titulo "), _c("code", [_vm._v("*")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", [_vm._v("Modulo "), _c("code", [_vm._v("*")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "form-group" }, [
      _c("div", { attrs: { id: "summernote" } })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-e030a35a", module.exports)
  }
}

/***/ }),
/* 66 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(67)
/* template */
var __vue_template__ = __webpack_require__(68)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/tareas/TareasCrearComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-15113d6a", Component.options)
  } else {
    hotAPI.reload("data-v-15113d6a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 67 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {
    $('#summernote').summernote({
      callbacks: {
        onImageUpload: function onImageUpload(image) {
          var sizeKB = image[0]['size'] / 1000;
          var tmp_pr = 0;
          if (sizeKB > 1100) {
            tmp_pr = 1;
            swal({
              title: "Seleccione una imagen menor o igual a 1mb",
              text: '',
              type: "info"
            });
          }
          if (image[0]['type'] != 'image/jpeg' && image[0]['type'] != 'image/png') {
            tmp_pr = 1;
            swal({
              title: "La imagen debe ser formato png o jpg",
              text: '',
              type: "info"
            });
          }
          if (tmp_pr == 0) {
            var file = image[0];
            var reader = new FileReader();
            reader.onloadend = function () {
              var image = $('<img>').attr('src', reader.result);
              $('#summernote').summernote("insertNode", image[0]);
            };
            reader.readAsDataURL(file);
          }
        }
      },
      toolbar: [['font', ['fontname']], ['para', ['ul', 'ol', 'paragraph', 'strikethrough']], ['style', ['bold', 'italic', 'underline', 'clear']], ['fontsize', ['fontsize']], ['color', ['color']], ['height', ['height']], ['groupName', ['picture', 'link', 'video', 'table', 'hr', 'fullscreen']]],
      height: 250
    });
  },
  created: function created() {
    this.base_url = base_url;
    this.idcurso = document.getElementById('idcurso').value;
  },
  data: function data() {
    return {
      idcurso: 0,
      o_basetarea: { 'nombre': '', 'calificacion': 0, 'fecha_vencimiento': '', 'descripcion': '' },
      o_tarea: { 'nombre': '', 'calificacion': 0, 'fecha_vencimiento': '', 'descripcion': '' },
      e_tarea: [],
      loader_guardar: false
    };
  },
  methods: {
    guardar: function guardar() {
      var _this = this;

      this.loader_guardar = true;
      this.o_tarea.idcurso = this.idcurso;
      this.o_tarea.descripcion = $('#summernote').summernote('code');
      var url = this.base_url + '/tareas/guardar';
      axios.post(url, this.o_tarea).then(function (response) {
        _this.loader_guardar = false;
        _this.e_tarea = [];
        _this.o_tarea = _this.o_basetarea;
        var inst = _this;

        _this.$root.$emit('notifi_cli', response.data.notifi_tk);

        swal({
          title: response.data.message,
          text: response.data.message2,
          type: "success"
        }, function () {
          inst.redirectVolver();
        });
      }).catch(function (error) {
        _this.loader_guardar = false;
        if (error.response.data.errors) {
          _this.e_tarea = error.response.data.errors;
        }
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "2500"
          });
        }
      });
    },
    redirectVolver: function redirectVolver() {
      document.getElementById('id').value = '';
      this.$root.$emit('setMenu', 'tareas-lista');
    }
  }
});

/***/ }),
/* 68 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c("div", { staticClass: "row" }, [
      _c("div", { staticClass: "col-md-6 col-sm-6" }, [
        _c("h5", { staticClass: "m-0 text-dark" }, [
          _c("strong", [_vm._v("Nueva tarea")]),
          _vm._v(" "),
          _c(
            "button",
            {
              staticClass: "btn btn-tool",
              attrs: { type: "button" },
              on: {
                click: function($event) {
                  $event.preventDefault()
                  _vm.redirectVolver()
                }
              }
            },
            [
              _c("i", {
                staticClass: "fa fa-arrow-circle-left",
                staticStyle: { "font-size": "24px" }
              })
            ]
          )
        ])
      ])
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "card" }, [
      _c("div", { staticClass: "card-body" }, [
        _vm._m(0),
        _vm._v(" "),
        _c("div", { staticClass: "form-group" }, [
          _vm._m(1),
          _vm._v(" "),
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.o_tarea.nombre,
                expression: "o_tarea.nombre"
              }
            ],
            staticClass: "form-control",
            class: [_vm.e_tarea.nombre ? "is-invalid" : ""],
            attrs: { type: "text", name: "nombre" },
            domProps: { value: _vm.o_tarea.nombre },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(_vm.o_tarea, "nombre", $event.target.value)
              }
            }
          }),
          _vm._v(" "),
          _vm.e_tarea.nombre
            ? _c("span", {
                staticClass: "text-danger",
                domProps: { textContent: _vm._s(_vm.e_tarea.nombre[0]) }
              })
            : _vm._e()
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "form-group" }, [
          _vm._m(2),
          _vm._v(" "),
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.o_tarea.calificacion,
                expression: "o_tarea.calificacion"
              }
            ],
            staticClass: "form-control",
            class: [_vm.e_tarea.calificacion ? "is-invalid" : ""],
            attrs: {
              type: "number",
              name: "calificacion",
              min: "0",
              max: "1000"
            },
            domProps: { value: _vm.o_tarea.calificacion },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(_vm.o_tarea, "calificacion", $event.target.value)
              }
            }
          }),
          _vm._v(" "),
          _vm.e_tarea.calificacion
            ? _c("span", {
                staticClass: "text-danger",
                domProps: { textContent: _vm._s(_vm.e_tarea.calificacion[0]) }
              })
            : _vm._e()
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "form-group" }, [
          _c("label", [_vm._v("Fecha vencimiento")]),
          _vm._v(" "),
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.o_tarea.fecha_vencimiento,
                expression: "o_tarea.fecha_vencimiento"
              }
            ],
            staticClass: "form-control",
            class: [_vm.e_tarea.fecha_vencimiento ? "is-invalid" : ""],
            attrs: { type: "date", name: "fecha_vencimiento" },
            domProps: { value: _vm.o_tarea.fecha_vencimiento },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(_vm.o_tarea, "fecha_vencimiento", $event.target.value)
              }
            }
          }),
          _vm._v(" "),
          _vm.e_tarea.fecha_vencimiento
            ? _c("span", {
                staticClass: "text-danger",
                domProps: {
                  textContent: _vm._s(_vm.e_tarea.fecha_vencimiento[0])
                }
              })
            : _vm._e()
        ]),
        _vm._v(" "),
        _vm._m(3),
        _vm._v(" "),
        _c(
          "button",
          {
            staticClass: "btn btn-outline-primary btn-sm float-left",
            attrs: { type: "button", disabled: _vm.loader_guardar },
            on: {
              click: function($event) {
                $event.preventDefault()
                _vm.guardar()
              }
            }
          },
          [
            _vm._v("\n        Crear tarea\n        "),
            _vm.loader_guardar
              ? _c("i", {
                  staticClass: "fa fa-spinner fa-spin fa-loader",
                  staticStyle: { "font-size": "20px" }
                })
              : _vm._e()
          ]
        )
      ])
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "callout callout-info" }, [
      _c("p", [
        _c("i", { staticClass: "fa fa-fw fa-info" }),
        _vm._v("Los campos marcados en "),
        _c("code", [_vm._v("*")]),
        _vm._v(" son obligatorios\n      \t")
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", [_vm._v("Titulo "), _c("code", [_vm._v("*")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", [
      _vm._v("Calificacion sobre "),
      _c("code", [_vm._v("*")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "form-group" }, [
      _c("div", { attrs: { id: "summernote" } })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-15113d6a", module.exports)
  }
}

/***/ }),
/* 69 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(70)
/* template */
var __vue_template__ = __webpack_require__(71)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/tareas/TareasEditComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-341ea60f", Component.options)
  } else {
    hotAPI.reload("data-v-341ea60f", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 70 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    mounted: function mounted() {
        $('#summernote').summernote({
            callbacks: {
                onImageUpload: function onImageUpload(image) {
                    var sizeKB = image[0]['size'] / 1000;
                    var tmp_pr = 0;
                    if (sizeKB > 1100) {
                        tmp_pr = 1;
                        swal({
                            title: "Seleccione una imagen menor o igual a 1mb",
                            text: '',
                            type: "info"
                        });
                    }
                    if (image[0]['type'] != 'image/jpeg' && image[0]['type'] != 'image/png') {
                        tmp_pr = 1;
                        swal({
                            title: "La imagen debe ser formato png o jpg",
                            text: '',
                            type: "info"
                        });
                    }
                    if (tmp_pr == 0) {
                        var file = image[0];
                        var reader = new FileReader();
                        reader.onloadend = function () {
                            var image = $('<img>').attr('src', reader.result);
                            $('#summernote').summernote("insertNode", image[0]);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            },
            toolbar: [['font', ['fontname']], ['para', ['ul', 'ol', 'paragraph', 'strikethrough']], ['style', ['bold', 'italic', 'underline', 'clear']], ['fontsize', ['fontsize']], ['color', ['color']], ['height', ['height']], ['groupName', ['picture', 'link', 'video', 'table', 'hr', 'fullscreen']]],
            height: 250
        });
    },
    created: function created() {
        this.base_url = base_url;
        this.idcurso = document.getElementById('idcurso').value;
        this.id = document.getElementById('id').value;
        this.getTarea();
    },
    data: function data() {
        return {
            loader_actualizar: false,
            id: 0,
            idcurso: 0,
            o_tarea: {},
            e_tarea: [],
            preload: true
        };
    },
    methods: {
        getTarea: function getTarea() {
            var _this = this;

            this.preload = true;
            var url = this.base_url + '/tareas/editar';
            axios.post(url, { id: this.id }).then(function (response) {
                _this.o_tarea = response.data.tarea;
                $('#summernote').summernote('code', _this.o_tarea.descripcion);
                _this.preload = false;
            }).catch(function (error) {
                _this.preload = false;
            });
        },
        actualizar: function actualizar() {
            var _this2 = this;

            this.loader_actualizar = true;
            var url = this.base_url + '/tareas/actualizar';
            this.o_tarea.descripcion = $('#summernote').summernote('code');
            this.o_tarea.id = this.id;
            var inst = this;
            axios.post(url, this.o_tarea).then(function (response) {
                _this2.loader_actualizar = false;
                _this2.e_tarea = [];
                swal({
                    title: response.data.message,
                    text: response.data.message2,
                    type: "success"
                }, function () {
                    inst.redirectVolver();
                });
            }).catch(function (error) {
                _this2.loader_actualizar = false;
                if (error.response.data.errors) {
                    _this2.e_tarea = error.response.data.errors;
                }
                if (error.response.data.error) {
                    toastr.error(error.response.data.error, '', {
                        "timeOut": "3500"
                    });
                }
            });
        },
        redirectVolver: function redirectVolver() {
            document.getElementById('id').value = '';
            this.$root.$emit('setMenu', 'tareas-lista');
        }
    }
});

/***/ }),
/* 71 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _vm.preload ? _c("div", { staticClass: "row" }, [_vm._m(0)]) : _vm._e(),
    _vm._v(" "),
    !_vm.preload
      ? _c("div", { staticClass: "row" }, [
          _c("div", { staticClass: "col-md-6 col-sm-6" }, [
            _c("h5", { staticClass: "m-0 text-dark" }, [
              _c("strong", [_vm._v("Actualizar tarea")]),
              _vm._v(" "),
              _c(
                "button",
                {
                  staticClass: "btn btn-tool",
                  attrs: { type: "button" },
                  on: {
                    click: function($event) {
                      $event.preventDefault()
                      _vm.redirectVolver()
                    }
                  }
                },
                [
                  _c("i", {
                    staticClass: "fa fa-arrow-circle-left",
                    staticStyle: { "font-size": "24px" }
                  })
                ]
              )
            ])
          ])
        ])
      : _vm._e(),
    _vm._v(" "),
    _c(
      "div",
      {
        directives: [
          {
            name: "show",
            rawName: "v-show",
            value: !_vm.preload,
            expression: "!preload"
          }
        ],
        staticClass: "card"
      },
      [
        _c("div", { staticClass: "card-body" }, [
          _vm._m(1),
          _vm._v(" "),
          _c("div", { staticClass: "form-group" }, [
            _vm._m(2),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.o_tarea.nombre,
                  expression: "o_tarea.nombre"
                }
              ],
              staticClass: "form-control",
              class: [_vm.e_tarea.nombre ? "is-invalid" : ""],
              attrs: { type: "text", name: "nombre" },
              domProps: { value: _vm.o_tarea.nombre },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.o_tarea, "nombre", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _vm.e_tarea.nombre
              ? _c("span", {
                  staticClass: "text-danger",
                  domProps: { textContent: _vm._s(_vm.e_tarea.nombre[0]) }
                })
              : _vm._e()
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "form-group" }, [
            _vm._m(3),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.o_tarea.calificacion,
                  expression: "o_tarea.calificacion"
                }
              ],
              staticClass: "form-control",
              class: [_vm.e_tarea.calificacion ? "is-invalid" : ""],
              attrs: {
                type: "number",
                name: "calificacion",
                min: "0",
                max: "1000"
              },
              domProps: { value: _vm.o_tarea.calificacion },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.o_tarea, "calificacion", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _vm.e_tarea.calificacion
              ? _c("span", {
                  staticClass: "text-danger",
                  domProps: { textContent: _vm._s(_vm.e_tarea.calificacion[0]) }
                })
              : _vm._e()
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "form-group" }, [
            _c("label", [_vm._v("Fecha vencimiento")]),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.o_tarea.fecha_vencimiento,
                  expression: "o_tarea.fecha_vencimiento"
                }
              ],
              staticClass: "form-control",
              class: [_vm.e_tarea.fecha_vencimiento ? "is-invalid" : ""],
              attrs: { type: "date", name: "fecha_vencimiento" },
              domProps: { value: _vm.o_tarea.fecha_vencimiento },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(
                    _vm.o_tarea,
                    "fecha_vencimiento",
                    $event.target.value
                  )
                }
              }
            }),
            _vm._v(" "),
            _vm.e_tarea.fecha_vencimiento
              ? _c("span", {
                  staticClass: "text-danger",
                  domProps: {
                    textContent: _vm._s(_vm.e_tarea.fecha_vencimiento[0])
                  }
                })
              : _vm._e()
          ]),
          _vm._v(" "),
          _vm._m(4),
          _vm._v(" "),
          _c(
            "button",
            {
              staticClass: "btn btn-outline-primary btn-sm float-left",
              attrs: { type: "button", disabled: _vm.loader_actualizar },
              on: {
                click: function($event) {
                  $event.preventDefault()
                  _vm.actualizar()
                }
              }
            },
            [
              _vm._v("\n        Actualizar\n        "),
              _vm.loader_actualizar
                ? _c("i", {
                    staticClass: "fa fa-spinner fa-spin fa-loader",
                    staticStyle: { "font-size": "20px" }
                  })
                : _vm._e()
            ]
          )
        ])
      ]
    )
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "callout callout-info" }, [
      _c("p", [
        _c("i", { staticClass: "fa fa-fw fa-info" }),
        _vm._v("Los campos marcados en "),
        _c("code", [_vm._v("*")]),
        _vm._v(" son obligatorios\n        ")
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", [_vm._v("Titulo "), _c("code", [_vm._v("*")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", [
      _vm._v("Calificacion sobre "),
      _c("code", [_vm._v("*")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "form-group" }, [
      _c("div", { attrs: { id: "summernote" } })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-341ea60f", module.exports)
  }
}

/***/ }),
/* 72 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(73)
/* template */
var __vue_template__ = __webpack_require__(74)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/tareas/TareasListaEntregaComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-aff4c578", Component.options)
  } else {
    hotAPI.reload("data-v-aff4c578", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 73 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {},
  created: function created() {
    this.base_url = base_url;
    this.idcurso = document.getElementById('idcurso').value;
    this.id = document.getElementById('id').value;
    this.listado();
  },
  data: function data() {
    return {
      idcurso: 0,
      id: 0,
      preload: true,
      a_tareas: [],
      o_tarea: {},

      preloadmodal: true,
      o_revision: {},
      loader_revision: false
    };
  },
  methods: {
    listado: function listado() {
      var _this = this;

      var url = this.base_url + '/tareas/listaent';
      this.preload = true;
      axios.post(url, { idcurso: this.idcurso, id: this.id }).then(function (response) {
        _this.preload = false;
        _this.a_tareas = response.data.tareas;
        _this.o_tarea = response.data.tarea;
      }).catch(function (error) {
        _this.preload = false;
        if (error.response.data.errors) {}
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
      });
    },
    openRevisar: function openRevisar(id) {
      var _this2 = this;

      $('#modal_revision').modal('show');
      var url = base_url + '/tareas/revision';
      this.preloadmodal = true;
      axios.post(url, { id: id }).then(function (response) {
        _this2.preloadmodal = false;
        _this2.o_revision = response.data.tarea;
        _this2.o_revision.id = id;
      }).catch(function (error) {
        _this2.preloadmodal = false;
        _this2.o_revision = {};
        if (error.response.data.errors) {}
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
      });
    },
    updrevision: function updrevision() {
      var _this3 = this;

      if (this.o_revision.notaes > this.o_revision.notasobre) {
        swal({
          title: "La calificacion no puede ser mayor a " + this.o_revision.notasobre,
          text: "Click para continuar",
          type: "info"
        });
        return;
      }

      this.loader_revision = true;
      var url = this.base_url + '/tareas/updrevision';
      axios.post(url, this.o_revision).then(function (response) {
        _this3.loader_revision = false;
        _this3.o_revision = {};
        $('#modal_revision').modal('hide');
        _this3.listado();
        swal({
          title: response.data.message,
          text: response.data.message2,
          type: "success"
        });
      }).catch(function (error) {
        _this3.loader_revision = false;
        if (error.response.data.errors) {
          _this3.e_tarea = error.response.data.errors;
        }
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "2500"
          });
        }
      });
    },
    redirectVolver: function redirectVolver() {
      document.getElementById('id').value = '';
      this.$root.$emit('setMenu', 'tareas-lista');
    }
  }
});

/***/ }),
/* 74 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c(
        "div",
        {
          staticClass: "modal fade",
          attrs: {
            id: "modal_revision",
            tabindex: "-1",
            role: "dialog",
            "aria-hidden": "true"
          }
        },
        [
          _c(
            "div",
            {
              staticClass: "modal-dialog modal-lg",
              attrs: { role: "document" }
            },
            [
              _c("div", { staticClass: "modal-content" }, [
                _vm._m(0),
                _vm._v(" "),
                _c(
                  "div",
                  {
                    staticClass: "modal-body",
                    staticStyle: { height: "450px", "overflow-y": "auto" }
                  },
                  [
                    _vm.preloadmodal
                      ? _c("div", { staticClass: "row" }, [_vm._m(1)])
                      : _vm._e(),
                    _vm._v(" "),
                    _c("label", [_vm._v("Descripcion")]),
                    _vm._v(" "),
                    _c("p", {
                      domProps: {
                        innerHTML: _vm._s(_vm.o_revision.descripcion)
                      }
                    }),
                    _vm._v(" "),
                    _c("hr"),
                    _vm._v(" "),
                    _c("label", [_vm._v("Entrega")]),
                    _vm._v(" "),
                    _c("p", {
                      domProps: { innerHTML: _vm._s(_vm.o_revision.respuesta) }
                    }),
                    _vm._v(" "),
                    _c("hr"),
                    _vm._v(" "),
                    _c("div", { staticClass: "form-group" }, [
                      _c("label", [
                        _vm._v("Calificacion sobre "),
                        _c("span", {
                          domProps: {
                            textContent: _vm._s(_vm.o_revision.notasobre)
                          }
                        })
                      ]),
                      _vm._v(" "),
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.o_revision.notaes,
                            expression: "o_revision.notaes"
                          }
                        ],
                        staticClass: "form-control",
                        attrs: {
                          type: "number",
                          name: "calificacion",
                          min: "0",
                          max: "1000"
                        },
                        domProps: { value: _vm.o_revision.notaes },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(
                              _vm.o_revision,
                              "notaes",
                              $event.target.value
                            )
                          }
                        }
                      })
                    ]),
                    _vm._v(" "),
                    _c("label", [_vm._v("Comentario")]),
                    _vm._v(" "),
                    _c("div", { staticClass: "form-group" }, [
                      _c("textarea", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.o_revision.comentario,
                            expression: "o_revision.comentario"
                          }
                        ],
                        staticClass: "form-control",
                        attrs: {
                          rows: "3",
                          placeholder: "Escribe tu comentario aqui",
                          name: "p_descripcion"
                        },
                        domProps: { value: _vm.o_revision.comentario },
                        on: {
                          input: function($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.$set(
                              _vm.o_revision,
                              "comentario",
                              $event.target.value
                            )
                          }
                        }
                      })
                    ])
                  ]
                ),
                _vm._v(" "),
                _c("div", { staticClass: "modal-footer" }, [
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-outline-primary btn-sm float-left",
                      attrs: { type: "button", disabled: _vm.loader_revision },
                      on: {
                        click: function($event) {
                          $event.preventDefault()
                          _vm.updrevision()
                        }
                      }
                    },
                    [
                      _vm._v("\n            Enviar revision\n            "),
                      _vm.loader_revision
                        ? _c("i", {
                            staticClass: "fa fa-spinner fa-spin fa-loader",
                            staticStyle: { "font-size": "20px" }
                          })
                        : _vm._e()
                    ]
                  )
                ])
              ])
            ]
          )
        ]
      ),
      _vm._v(" "),
      _vm.preload ? _c("div", { staticClass: "row" }, [_vm._m(2)]) : _vm._e(),
      _vm._v(" "),
      !_vm.preload
        ? _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col-sm-6" }, [
              _c("h5", { staticClass: "m-0 text-dark" }, [
                _c("strong", [_vm._v("Entrega: ")]),
                _c("span", {
                  domProps: { textContent: _vm._s(_vm.o_tarea.nombre) }
                }),
                _vm._v(" "),
                _c(
                  "button",
                  {
                    staticClass: "btn btn-tool",
                    attrs: { type: "button" },
                    on: {
                      click: function($event) {
                        $event.preventDefault()
                        _vm.redirectVolver()
                      }
                    }
                  },
                  [
                    _c("i", {
                      staticClass: "fa fa-arrow-circle-left",
                      staticStyle: { "font-size": "24px" }
                    })
                  ]
                )
              ])
            ])
          ])
        : _vm._e(),
      _vm._v(" "),
      _vm._l(_vm.a_tareas, function(tarea) {
        return !_vm.preload
          ? _c("div", { staticClass: "card" }, [
              _c("div", { staticClass: "card-header no-border" }, [
                _c("h5", {
                  staticClass: "card-title",
                  staticStyle: { cursor: "pointer" },
                  domProps: { textContent: _vm._s(tarea.nombre) }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "card-tools" }, [
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-tool",
                      attrs: { type: "button" },
                      on: {
                        click: function($event) {
                          $event.preventDefault()
                          _vm.openRevisar(tarea.ident)
                        }
                      }
                    },
                    [
                      _c("i", {
                        staticClass: "fa  fa-eye",
                        staticStyle: { "font-size": "20px" }
                      })
                    ]
                  )
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "row" }, [
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("b", [_vm._v("Estado :")]),
                    _vm._v(" "),
                    _c("small", { class: "badge badge-" + tarea.status }, [
                      _c("span", {
                        domProps: { textContent: _vm._s(tarea.nombestado) }
                      })
                    ])
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("b", [_vm._v("Calificacion :")]),
                    _vm._v(" "),
                    _c("span", {
                      domProps: { textContent: _vm._s(tarea.notaes) }
                    }),
                    _vm._v("/"),
                    _c("span", {
                      domProps: { textContent: _vm._s(tarea.calificacion) }
                    })
                  ])
                ])
              ])
            ])
          : _vm._e()
      })
    ],
    2
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "modal-header" }, [
      _vm._v("\n            Revision"),
      _c(
        "button",
        {
          staticClass: "close",
          attrs: { type: "button", "data-dismiss": "modal" }
        },
        [_vm._v("×")]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-aff4c578", module.exports)
  }
}

/***/ }),
/* 75 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(76)
/* template */
var __vue_template__ = __webpack_require__(77)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/tareas/TareasListaEstudianteComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-0011cffc", Component.options)
  } else {
    hotAPI.reload("data-v-0011cffc", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 76 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {},
  created: function created() {
    this.base_url = base_url;
    this.idcurso = document.getElementById('idcurso').value;
    this.listado();
  },
  data: function data() {
    return {
      idcurso: 0,
      preload: true,
      a_tareas: []
    };
  },
  methods: {
    listado: function listado() {
      var _this = this;

      var url = this.base_url + '/tareas/lista_es';
      this.preload = true;
      axios.post(url, { idcurso: this.idcurso }).then(function (response) {
        _this.preload = false;
        _this.a_tareas = response.data.tareas;
      }).catch(function (error) {
        _this.preload = false;
        _this.modulos = [];
        if (error.response.data.errors) {}
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
      });
    },
    abrir: function abrir(id) {
      document.getElementById('id').value = id;
      this.$root.$emit('setMenu', 'tareas-entrega-es');
    }
  }
});

/***/ }),
/* 77 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _vm.preload ? _c("div", { staticClass: "row" }, [_vm._m(0)]) : _vm._e(),
      _vm._v(" "),
      _vm._l(_vm.a_tareas, function(tarea) {
        return !_vm.preload
          ? _c("div", { staticClass: "card" }, [
              _c("div", { staticClass: "card-header no-border" }, [
                _c("h5", {
                  staticClass: "card-title",
                  domProps: { textContent: _vm._s(tarea.nombre) }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "row" }, [
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _vm._m(1, true),
                    _vm._v(" "),
                    _c("span", {
                      domProps: { textContent: _vm._s(tarea.fecha_vencimiento) }
                    })
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("b", [_vm._v("Calificacion Sobre :")]),
                    _vm._v(" "),
                    _c("span", {
                      domProps: { textContent: _vm._s(tarea.calificacion) }
                    })
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("b", [_vm._v("Estado :")]),
                    _vm._v(" "),
                    _c("small", { class: "badge badge-" + tarea.status }, [
                      _c("span", {
                        domProps: { textContent: _vm._s(tarea.nombestado) }
                      })
                    ])
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("b", [
                      _vm._v("Nota : "),
                      _c("span", {
                        domProps: { textContent: _vm._s(tarea.notaes) }
                      })
                    ])
                  ])
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "card-body" }, [
                _c(
                  "button",
                  {
                    staticClass: "btn btn-outline-primary btn-sm float-left",
                    attrs: { type: "button" },
                    on: {
                      click: function($event) {
                        _vm.abrir(tarea.id)
                      }
                    }
                  },
                  [_vm._v("\n        Abrir tarea\n      ")]
                )
              ])
            ])
          : _vm._e()
      })
    ],
    2
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("b", [
      _c("i", { staticClass: "fa  fa-clock-o" }),
      _vm._v(" Vence :")
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-0011cffc", module.exports)
  }
}

/***/ }),
/* 78 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(79)
/* template */
var __vue_template__ = __webpack_require__(80)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/tareas/TareasEntregaEstudianteComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-0d5049b2", Component.options)
  } else {
    hotAPI.reload("data-v-0d5049b2", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 79 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    mounted: function mounted() {
        $('#summernote').summernote({
            callbacks: {
                onImageUpload: function onImageUpload(image) {
                    var sizeKB = image[0]['size'] / 1000;
                    var tmp_pr = 0;
                    if (sizeKB > 1100) {
                        tmp_pr = 1;
                        swal({
                            title: "Seleccione una imagen menor o igual a 1mb",
                            text: '',
                            type: "info"
                        });
                    }
                    if (image[0]['type'] != 'image/jpeg' && image[0]['type'] != 'image/png') {
                        tmp_pr = 1;
                        swal({
                            title: "La imagen debe ser formato png o jpg",
                            text: '',
                            type: "info"
                        });
                    }
                    if (tmp_pr == 0) {
                        var file = image[0];
                        var reader = new FileReader();
                        reader.onloadend = function () {
                            var image = $('<img>').attr('src', reader.result);
                            $('#summernote').summernote("insertNode", image[0]);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            },
            toolbar: [['font', ['fontname']], ['para', ['ul', 'ol', 'paragraph', 'strikethrough']], ['style', ['bold', 'italic', 'underline', 'clear']], ['fontsize', ['fontsize']], ['color', ['color']], ['height', ['height']], ['groupName', ['picture', 'link', 'video', 'table', 'hr', 'fullscreen']]],
            height: 250
        });
    },
    created: function created() {
        this.base_url = base_url;
        this.idcurso = document.getElementById('idcurso').value;
        this.id = document.getElementById('id').value;
        this.getTarea();
    },
    data: function data() {
        return {
            loader_actualizar: false,
            id: 0,
            idcurso: 0,
            o_tarea: {},
            e_tarea: [],
            preload: true
        };
    },
    methods: {
        getTarea: function getTarea() {
            var _this = this;

            this.preload = true;
            var url = this.base_url + '/tareas/editent';
            axios.post(url, { id: this.id }).then(function (response) {
                _this.o_tarea = response.data.tarea;
                $('#summernote').summernote('code', _this.o_tarea.respuesta);
                _this.preload = false;
            }).catch(function (error) {
                _this.preload = false;
            });
        },
        entregar: function entregar() {
            var _this2 = this;

            this.loader_actualizar = true;
            var url = this.base_url + '/tareas/entregar';
            this.o_tarea.id = this.id;
            this.o_tarea.respuesta = $('#summernote').summernote('code');
            var inst = this;
            axios.post(url, this.o_tarea).then(function (response) {
                _this2.loader_actualizar = false;
                _this2.e_tarea = [];
                swal({
                    title: response.data.message,
                    text: response.data.message2,
                    type: "success"
                }, function () {
                    inst.redirectVolver();
                });
            }).catch(function (error) {
                _this2.loader_actualizar = false;
                if (error.response.data.errors) {
                    _this2.e_tarea = error.response.data.errors;
                }
                if (error.response.data.error) {
                    toastr.error(error.response.data.error, '', {
                        "timeOut": "3500"
                    });
                }
            });
        },
        redirectVolver: function redirectVolver() {
            document.getElementById('id').value = '';
            this.$root.$emit('setMenu', 'tareas-lista-es');
        }
    }
});

/***/ }),
/* 80 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c(
      "div",
      {
        directives: [
          {
            name: "show",
            rawName: "v-show",
            value: _vm.preload,
            expression: "preload"
          }
        ],
        staticClass: "row"
      },
      [_vm._m(0)]
    ),
    _vm._v(" "),
    _c(
      "div",
      {
        directives: [
          {
            name: "show",
            rawName: "v-show",
            value: !_vm.preload,
            expression: "!preload"
          }
        ],
        staticClass: "row"
      },
      [
        _c("div", { staticClass: "col-md-6 col-sm-6" }, [
          _c("h5", { staticClass: "m-0 text-dark" }, [
            _c(
              "strong",
              { domProps: { innerHTML: _vm._s(_vm.o_tarea.nombre) } },
              [_vm._v("ver tarea")]
            ),
            _vm._v(" "),
            _c(
              "button",
              {
                staticClass: "btn btn-tool",
                attrs: { type: "button" },
                on: {
                  click: function($event) {
                    $event.preventDefault()
                    _vm.redirectVolver()
                  }
                }
              },
              [
                _c("i", {
                  staticClass: "fa fa-arrow-circle-left",
                  staticStyle: { "font-size": "24px" }
                })
              ]
            )
          ])
        ])
      ]
    ),
    _vm._v(" "),
    _c(
      "div",
      {
        directives: [
          {
            name: "show",
            rawName: "v-show",
            value: !_vm.preload,
            expression: "!preload"
          }
        ],
        staticClass: "card"
      },
      [
        _c("div", { staticClass: "card-body" }, [
          _c("label", [_vm._v("Descripcion")]),
          _vm._v(" "),
          _c("p", { domProps: { innerHTML: _vm._s(_vm.o_tarea.descripcion) } }),
          _vm._v(" "),
          _c("hr"),
          _vm._v(" "),
          _c("label", [_vm._v("Respuesta")]),
          _vm._v(" "),
          _c(
            "div",
            {
              directives: [
                {
                  name: "show",
                  rawName: "v-show",
                  value: _vm.o_tarea.entrega,
                  expression: "o_tarea.entrega"
                }
              ],
              staticClass: "form-group"
            },
            [_c("div", { attrs: { id: "summernote" } })]
          ),
          _vm._v(" "),
          !_vm.o_tarea.entrega
            ? _c("div", { staticClass: "form-group" }, [
                _c("div", {
                  domProps: { innerHTML: _vm._s(_vm.o_tarea.respuesta) }
                })
              ])
            : _vm._e(),
          _vm._v(" "),
          _c("hr"),
          _vm._v(" "),
          !_vm.o_tarea.entrega
            ? _c("label", [_vm._v("Comentarios Profesor")])
            : _vm._e(),
          _vm._v(" "),
          _c("div", { staticClass: "form-group" }, [
            !_vm.o_tarea.entrega
              ? _c("div", {
                  domProps: { innerHTML: _vm._s(_vm.o_tarea.comentario) }
                })
              : _vm._e()
          ]),
          _vm._v(" "),
          _vm.o_tarea.entrega
            ? _c(
                "button",
                {
                  staticClass: "btn btn-outline-primary btn-sm float-left",
                  attrs: { type: "button", disabled: _vm.loader_actualizar },
                  on: {
                    click: function($event) {
                      $event.preventDefault()
                      _vm.entregar()
                    }
                  }
                },
                [
                  _vm._v("\n        Entregar tarea\n        "),
                  _vm.loader_actualizar
                    ? _c("i", {
                        staticClass: "fa fa-spinner fa-spin fa-loader",
                        staticStyle: { "font-size": "20px" }
                      })
                    : _vm._e()
                ]
              )
            : _vm._e()
        ])
      ]
    )
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-0d5049b2", module.exports)
  }
}

/***/ }),
/* 81 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(82)
/* template */
var __vue_template__ = __webpack_require__(83)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/examenes/ExamenesListaComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-6ae182ae", Component.options)
  } else {
    hotAPI.reload("data-v-6ae182ae", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 82 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {},
  created: function created() {
    this.base_url = base_url;
    this.idcurso = document.getElementById('idcurso').value;
    this.listado();
  },
  data: function data() {
    return {
      idcurso: 0,
      preload: false,
      a_ejercicios: [],
      cantUser: 0
    };
  },
  methods: {
    listado: function listado() {
      var _this = this;

      var url = this.base_url + '/ejercicios/lista';
      this.preload = true;
      axios.post(url, { idcurso: this.idcurso }).then(function (response) {
        _this.preload = false;
        _this.a_ejercicios = response.data.ejercicios;
        _this.cantUser = response.data.cantUser;
      }).catch(function (error) {
        _this.preload = false;
        if (error.response.data.errors) {}
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
      });
    },
    redirectCrear: function redirectCrear() {
      this.$root.$emit('setMenu', 'examenes-crear');
    },
    redirectEdit: function redirectEdit(id) {
      document.getElementById('id').value = id;
      this.$root.$emit('setMenu', 'examenes-edit');
    },
    redirectPreguntas: function redirectPreguntas(id) {
      document.getElementById('id').value = id;
      this.$root.$emit('setMenu', 'preguntas-lista');
    },
    redirectEnt: function redirectEnt(id) {
      document.getElementById('id').value = id;
      this.$root.$emit('setMenu', 'examenes-lista-entrega');
    }
  }
});

/***/ }),
/* 83 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _vm.preload ? _c("div", { staticClass: "row" }, [_vm._m(0)]) : _vm._e(),
      _vm._v(" "),
      !_vm.preload
        ? _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col-sm-6" }, [
              _c("h5", { staticClass: "m-0 text-dark" }, [
                _c("strong", [_vm._v("Lista de examenes")]),
                _vm._v(" "),
                _c(
                  "button",
                  {
                    staticClass: "btn btn-tool",
                    attrs: { type: "button" },
                    on: {
                      click: function($event) {
                        $event.preventDefault()
                        _vm.redirectCrear()
                      }
                    }
                  },
                  [
                    _c("i", {
                      staticClass: "fa fa-plus-circle",
                      staticStyle: { "font-size": "24px" }
                    })
                  ]
                )
              ])
            ])
          ])
        : _vm._e(),
      _vm._v(" "),
      _vm._l(_vm.a_ejercicios, function(ejercicio) {
        return !_vm.preload
          ? _c("div", { staticClass: "card" }, [
              _c("div", { staticClass: "card-header no-border" }, [
                _c(
                  "h5",
                  {
                    staticClass: "card-title",
                    staticStyle: { cursor: "pointer" },
                    on: {
                      click: function($event) {
                        $event.preventDefault()
                        _vm.redirectEdit(ejercicio.id)
                      }
                    }
                  },
                  [
                    _c("span", {
                      domProps: { textContent: _vm._s(ejercicio.nombre) }
                    }),
                    _vm._v(" "),
                    _c("i", {
                      staticClass: "fa  fa-pencil btn-tool",
                      staticStyle: { "font-size": "20px" },
                      on: {
                        click: function($event) {
                          $event.preventDefault()
                          _vm.redirectEdit(ejercicio.id)
                        }
                      }
                    })
                  ]
                ),
                _vm._v(" "),
                _c("div", { staticClass: "card-tools" }, [
                  _c("div", { staticClass: "btn-group" }, [
                    _c(
                      "button",
                      {
                        staticClass: "btn btn-tool",
                        attrs: { type: "button" },
                        on: {
                          click: function($event) {
                            $event.preventDefault()
                            _vm.redirectPreguntas(ejercicio.id)
                          }
                        }
                      },
                      [
                        _c("i", {
                          staticClass: "fa  fa-list-alt",
                          staticStyle: { "font-size": "20px" }
                        })
                      ]
                    )
                  ])
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "row" }, [
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("b", [_vm._v("Creado :")]),
                    _vm._v(" "),
                    _c("span", {
                      domProps: {
                        textContent: _vm._s(ejercicio.fecha_creacion)
                      }
                    })
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("b", [_vm._v("Inicia :")]),
                    _vm._v(" "),
                    _c("span", {
                      domProps: { textContent: _vm._s(ejercicio.fecha_inicio) }
                    })
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("b", [_vm._v("Finalizacion :")]),
                    _vm._v(" "),
                    _c("span", {
                      domProps: {
                        textContent: _vm._s(ejercicio.fecha_finalizacion)
                      }
                    })
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("b", [_vm._v("Duracion :")]),
                    _vm._v(" "),
                    _c("span", {
                      domProps: { textContent: _vm._s(ejercicio.duracion) }
                    }),
                    _vm._v(" minutos\n        ")
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("b", [_vm._v("Preguntas :")]),
                    _vm._v(" "),
                    _c("span", {
                      domProps: { textContent: _vm._s(ejercicio.cant_preg) }
                    })
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("b", [_vm._v("Nota maxima :")]),
                    _vm._v(" "),
                    _c("span", {
                      domProps: { textContent: _vm._s(ejercicio.notamaxima) }
                    })
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("i", {
                      staticClass: "fa fa-list-alt",
                      staticStyle: { cursor: "pointer" },
                      on: {
                        click: function($event) {
                          $event.preventDefault()
                          _vm.redirectEnt(ejercicio.id)
                        }
                      }
                    }),
                    _vm._v(" "),
                    _c("b", [_vm._v("Realizado :")]),
                    _vm._v(" "),
                    _c("span", {
                      domProps: { textContent: _vm._s(ejercicio.entregas) }
                    }),
                    _vm._v("/"),
                    _c("span", {
                      domProps: { textContent: _vm._s(_vm.cantUser) }
                    })
                  ])
                ])
              ])
            ])
          : _vm._e()
      })
    ],
    2
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-6ae182ae", module.exports)
  }
}

/***/ }),
/* 84 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(85)
/* template */
var __vue_template__ = __webpack_require__(86)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/examenes/ExamenesCrearComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-5630bc2a", Component.options)
  } else {
    hotAPI.reload("data-v-5630bc2a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 85 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {
    $('#summernote').summernote({
      callbacks: {
        onImageUpload: function onImageUpload(image) {
          var sizeKB = image[0]['size'] / 1000;
          var tmp_pr = 0;
          if (sizeKB > 1100) {
            tmp_pr = 1;
            swal({
              title: "Seleccione una imagen menor o igual a 1mb",
              text: '',
              type: "info"
            });
          }
          if (image[0]['type'] != 'image/jpeg' && image[0]['type'] != 'image/png') {
            tmp_pr = 1;
            swal({
              title: "La imagen debe ser formato png o jpg",
              text: '',
              type: "info"
            });
          }
          if (tmp_pr == 0) {
            var file = image[0];
            var reader = new FileReader();
            reader.onloadend = function () {
              var image = $('<img>').attr('src', reader.result);
              $('#summernote').summernote("insertNode", image[0]);
            };
            reader.readAsDataURL(file);
          }
        }
      },
      toolbar: [['font', ['fontname']], ['para', ['ul', 'ol', 'paragraph', 'strikethrough']], ['style', ['bold', 'italic', 'underline', 'clear']], ['fontsize', ['fontsize']], ['color', ['color']], ['height', ['height']], ['groupName', ['picture', 'link', 'video', 'table', 'hr', 'fullscreen']]],
      height: 100
    });
  },
  created: function created() {
    this.base_url = base_url;
    this.idcurso = document.getElementById('idcurso').value;
  },
  data: function data() {
    return {
      idcurso: 0,
      o_baseejercicio: { 'nombre': '', 'fecha_inicio': '', 'duracion': 0, 'descripcion': '' },
      o_ejercicio: { 'nombre': '', 'fecha_inicio': '', 'duracion': 0, 'descripcion': '' },
      e_ejercicio: [],
      loader_guardar: false
    };
  },
  methods: {
    guardar: function guardar() {
      var _this = this;

      this.loader_guardar = true;
      this.o_ejercicio.idcurso = this.idcurso;
      this.o_ejercicio.descripcion = $('#summernote').summernote('code');
      var url = this.base_url + '/ejercicios/guardar';
      var inst = this;
      axios.post(url, this.o_ejercicio).then(function (response) {
        _this.loader_guardar = false;
        _this.e_ejercicio = [];
        _this.o_ejercicio = _this.o_baseejercicio;
        swal({
          title: response.data.message,
          text: response.data.message2,
          type: "success"
        }, function () {
          inst.redirectVolver();
        });
      }).catch(function (error) {
        _this.loader_guardar = false;
        if (error.response.data.errors) {
          _this.e_ejercicio = error.response.data.errors;
        }
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
      });
    },
    redirectVolver: function redirectVolver() {
      document.getElementById('id').value = '';
      this.$root.$emit('setMenu', 'examenes-lista');
    }
  }
});

/***/ }),
/* 86 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c("div", { staticClass: "row" }, [
      _c("div", { staticClass: "col-md-6 col-sm-6" }, [
        _c("h5", { staticClass: "m-0 text-dark" }, [
          _c("strong", [_vm._v("Nuevo examen")]),
          _vm._v(" "),
          _c(
            "button",
            {
              staticClass: "btn btn-tool",
              attrs: { type: "button" },
              on: {
                click: function($event) {
                  $event.preventDefault()
                  _vm.redirectVolver()
                }
              }
            },
            [
              _c("i", {
                staticClass: "fa fa-arrow-circle-left",
                staticStyle: { "font-size": "24px" }
              })
            ]
          )
        ])
      ])
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "card" }, [
      _c("div", { staticClass: "card-body" }, [
        _vm._m(0),
        _vm._v(" "),
        _c("div", { staticClass: "form-group" }, [
          _vm._m(1),
          _vm._v(" "),
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.o_ejercicio.nombre,
                expression: "o_ejercicio.nombre"
              }
            ],
            staticClass: "form-control",
            class: [_vm.e_ejercicio.nombre ? "is-invalid" : ""],
            attrs: { type: "text", name: "nombre" },
            domProps: { value: _vm.o_ejercicio.nombre },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(_vm.o_ejercicio, "nombre", $event.target.value)
              }
            }
          }),
          _vm._v(" "),
          _vm.e_ejercicio.nombre
            ? _c("span", {
                staticClass: "text-danger",
                domProps: { textContent: _vm._s(_vm.e_ejercicio.nombre[0]) }
              })
            : _vm._e()
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "form-group" }, [
          _vm._m(2),
          _vm._v(" "),
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.o_ejercicio.fecha_inicio,
                expression: "o_ejercicio.fecha_inicio"
              }
            ],
            staticClass: "form-control",
            class: [_vm.e_ejercicio.fecha_inicio ? "is-invalid" : ""],
            attrs: { type: "date", name: "fecha_inicio" },
            domProps: { value: _vm.o_ejercicio.fecha_inicio },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(_vm.o_ejercicio, "fecha_inicio", $event.target.value)
              }
            }
          }),
          _vm._v(" "),
          _vm.e_ejercicio.fecha_inicio
            ? _c("span", {
                staticClass: "text-danger",
                domProps: {
                  textContent: _vm._s(_vm.e_ejercicio.fecha_inicio[0])
                }
              })
            : _vm._e()
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "form-group" }, [
          _c("label", [_vm._v("Fecha de Finalizacion")]),
          _vm._v(" "),
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.o_ejercicio.fecha_finalizacion,
                expression: "o_ejercicio.fecha_finalizacion"
              }
            ],
            staticClass: "form-control",
            class: [_vm.e_ejercicio.fecha_finalizacion ? "is-invalid" : ""],
            attrs: { type: "date", name: "fecha_inicio" },
            domProps: { value: _vm.o_ejercicio.fecha_finalizacion },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(
                  _vm.o_ejercicio,
                  "fecha_finalizacion",
                  $event.target.value
                )
              }
            }
          }),
          _vm._v(" "),
          _vm.e_ejercicio.fecha_finalizacion
            ? _c("span", {
                staticClass: "text-danger",
                domProps: {
                  textContent: _vm._s(_vm.e_ejercicio.fecha_finalizacion[0])
                }
              })
            : _vm._e()
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "form-group" }, [
          _vm._m(3),
          _vm._v(" "),
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.o_ejercicio.duracion,
                expression: "o_ejercicio.duracion"
              }
            ],
            staticClass: "form-control",
            class: [_vm.e_ejercicio.duracion ? "is-invalid" : ""],
            attrs: { type: "number", name: "duracion", min: "0", max: "1000" },
            domProps: { value: _vm.o_ejercicio.duracion },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.$set(_vm.o_ejercicio, "duracion", $event.target.value)
              }
            }
          }),
          _vm._v(" "),
          _vm.e_ejercicio.duracion
            ? _c("span", {
                staticClass: "text-danger",
                domProps: { textContent: _vm._s(_vm.e_ejercicio.duracion[0]) }
              })
            : _vm._e()
        ]),
        _vm._v(" "),
        _vm._m(4),
        _vm._v(" "),
        _c(
          "button",
          {
            staticClass: "btn btn-outline-primary btn-sm float-left",
            attrs: { type: "button", disabled: _vm.loader_guardar },
            on: {
              click: function($event) {
                $event.preventDefault()
                _vm.guardar()
              }
            }
          },
          [
            _vm._v("\n        Crear examen\n        "),
            _vm.loader_guardar
              ? _c("i", {
                  staticClass: "fa fa-spinner fa-spin fa-loader",
                  staticStyle: { "font-size": "20px" }
                })
              : _vm._e()
          ]
        )
      ])
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "callout callout-info" }, [
      _c("p", [
        _c("i", { staticClass: "fa fa-fw fa-info" }),
        _vm._v("Los campos marcados en "),
        _c("code", [_vm._v("*")]),
        _vm._v(" son obligatorios\n        ")
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", [
      _vm._v("Titulo de evaluación "),
      _c("code", [_vm._v("*")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", [_vm._v("Fecha de Inicio "), _c("code", [_vm._v("*")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", [
      _vm._v("Duracion(Minutos) "),
      _c("code", [_vm._v("*")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "form-group" }, [
      _c("label", [_vm._v("Contenido de preguntas")]),
      _vm._v(" "),
      _c("div", { attrs: { id: "summernote" } })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-5630bc2a", module.exports)
  }
}

/***/ }),
/* 87 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(88)
/* template */
var __vue_template__ = __webpack_require__(89)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/examenes/ExamenesEditComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-25b44f4f", Component.options)
  } else {
    hotAPI.reload("data-v-25b44f4f", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 88 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    mounted: function mounted() {
        $('#summernote').summernote({
            callbacks: {
                onImageUpload: function onImageUpload(image) {
                    var sizeKB = image[0]['size'] / 1000;
                    var tmp_pr = 0;
                    if (sizeKB > 1100) {
                        tmp_pr = 1;
                        swal({
                            title: "Seleccione una imagen menor o igual a 1mb",
                            text: '',
                            type: "info"
                        });
                    }
                    if (image[0]['type'] != 'image/jpeg' && image[0]['type'] != 'image/png') {
                        tmp_pr = 1;
                        swal({
                            title: "La imagen debe ser formato png o jpg",
                            text: '',
                            type: "info"
                        });
                    }
                    if (tmp_pr == 0) {
                        var file = image[0];
                        var reader = new FileReader();
                        reader.onloadend = function () {
                            var image = $('<img>').attr('src', reader.result);
                            $('#summernote').summernote("insertNode", image[0]);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            },
            toolbar: [['font', ['fontname']], ['para', ['ul', 'ol', 'paragraph', 'strikethrough']], ['style', ['bold', 'italic', 'underline', 'clear']], ['fontsize', ['fontsize']], ['color', ['color']], ['height', ['height']], ['groupName', ['picture', 'link', 'video', 'table', 'hr', 'fullscreen']]],
            height: 100
        });
    },
    created: function created() {
        this.base_url = base_url;
        this.idcurso = document.getElementById('idcurso').value;
        this.id = document.getElementById('id').value;
        this.getEjercicio();
    },
    data: function data() {
        return {
            loader_actualizar: false,
            id: 0,
            idcurso: 0,
            o_ejercicio: {},
            e_ejercicio: [],
            preload: false
        };
    },
    methods: {
        getEjercicio: function getEjercicio() {
            var _this = this;

            this.preload = true;
            var url = this.base_url + '/ejercicios/editar';
            axios.post(url, { id: this.id }).then(function (response) {
                _this.o_ejercicio = response.data.ejercicio;
                $('#summernote').summernote('code', _this.o_ejercicio.descripcion);
                _this.preload = false;
            }).catch(function (error) {
                _this.preload = false;
            });
        },
        actualizar: function actualizar() {
            var _this2 = this;

            this.loader_actualizar = true;
            var url = this.base_url + '/ejercicios/actualizar';
            this.o_ejercicio.id = this.id;
            this.o_ejercicio.idcurso = this.idcurso;
            this.o_ejercicio.descripcion = $('#summernote').summernote('code');
            var inst = this;
            axios.post(url, this.o_ejercicio).then(function (response) {
                _this2.loader_actualizar = false;
                _this2.e_ejercicio = [];
                swal({
                    title: response.data.message,
                    text: response.data.message2,
                    type: "success"
                }, function () {
                    inst.redirectVolver();
                });
            }).catch(function (error) {
                _this2.loader_actualizar = false;
                if (error.response.data.errors) {
                    _this2.e_modulo = error.response.data.errors;
                }
                if (error.response.data.error) {
                    toastr.error(error.response.data.error, '', {
                        "timeOut": "3500"
                    });
                }
            });
        },
        redirectVolver: function redirectVolver() {
            document.getElementById('id').value = '';
            this.$root.$emit('setMenu', 'examenes-lista');
        }
    }
});

/***/ }),
/* 89 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _vm.preload ? _c("div", { staticClass: "row" }, [_vm._m(0)]) : _vm._e(),
    _vm._v(" "),
    !_vm.preload
      ? _c("div", { staticClass: "row" }, [
          _c("div", { staticClass: "col-md-6 col-sm-6" }, [
            _c("h5", { staticClass: "m-0 text-dark" }, [
              _c("strong", [_vm._v("Actualizar examen")]),
              _vm._v(" "),
              _c(
                "button",
                {
                  staticClass: "btn btn-tool",
                  attrs: { type: "button" },
                  on: {
                    click: function($event) {
                      $event.preventDefault()
                      _vm.redirectVolver()
                    }
                  }
                },
                [
                  _c("i", {
                    staticClass: "fa fa-arrow-circle-left",
                    staticStyle: { "font-size": "24px" }
                  })
                ]
              )
            ])
          ])
        ])
      : _vm._e(),
    _vm._v(" "),
    _c(
      "div",
      {
        directives: [
          {
            name: "show",
            rawName: "v-show",
            value: !_vm.preload,
            expression: "!preload"
          }
        ],
        staticClass: "card"
      },
      [
        _c("div", { staticClass: "card-body" }, [
          _vm._m(1),
          _vm._v(" "),
          _c("div", { staticClass: "form-group" }, [
            _vm._m(2),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.o_ejercicio.nombre,
                  expression: "o_ejercicio.nombre"
                }
              ],
              staticClass: "form-control",
              class: [_vm.e_ejercicio.nombre ? "is-invalid" : ""],
              attrs: { type: "text", name: "nombre" },
              domProps: { value: _vm.o_ejercicio.nombre },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.o_ejercicio, "nombre", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _vm.e_ejercicio.nombre
              ? _c("span", {
                  staticClass: "text-danger",
                  domProps: { textContent: _vm._s(_vm.e_ejercicio.nombre[0]) }
                })
              : _vm._e()
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "form-group" }, [
            _vm._m(3),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.o_ejercicio.fecha_inicio,
                  expression: "o_ejercicio.fecha_inicio"
                }
              ],
              staticClass: "form-control",
              class: [_vm.e_ejercicio.fecha_inicio ? "is-invalid" : ""],
              attrs: { type: "date", name: "fecha_inicio" },
              domProps: { value: _vm.o_ejercicio.fecha_inicio },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.o_ejercicio, "fecha_inicio", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _vm.e_ejercicio.fecha_inicio
              ? _c("span", {
                  staticClass: "text-danger",
                  domProps: {
                    textContent: _vm._s(_vm.e_ejercicio.fecha_inicio[0])
                  }
                })
              : _vm._e()
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "form-group" }, [
            _c("label", [_vm._v("Fecha de Finalizacion")]),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.o_ejercicio.fecha_finalizacion,
                  expression: "o_ejercicio.fecha_finalizacion"
                }
              ],
              staticClass: "form-control",
              class: [_vm.e_ejercicio.fecha_finalizacion ? "is-invalid" : ""],
              attrs: { type: "date", name: "fecha_inicio" },
              domProps: { value: _vm.o_ejercicio.fecha_finalizacion },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(
                    _vm.o_ejercicio,
                    "fecha_finalizacion",
                    $event.target.value
                  )
                }
              }
            }),
            _vm._v(" "),
            _vm.e_ejercicio.fecha_finalizacion
              ? _c("span", {
                  staticClass: "text-danger",
                  domProps: {
                    textContent: _vm._s(_vm.e_ejercicio.fecha_finalizacion[0])
                  }
                })
              : _vm._e()
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "form-group" }, [
            _vm._m(4),
            _vm._v(" "),
            _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.o_ejercicio.duracion,
                  expression: "o_ejercicio.duracion"
                }
              ],
              staticClass: "form-control",
              class: [_vm.e_ejercicio.duracion ? "is-invalid" : ""],
              attrs: {
                type: "number",
                name: "duracion",
                min: "0",
                max: "1000"
              },
              domProps: { value: _vm.o_ejercicio.duracion },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.$set(_vm.o_ejercicio, "duracion", $event.target.value)
                }
              }
            }),
            _vm._v(" "),
            _vm.e_ejercicio.duracion
              ? _c("span", {
                  staticClass: "text-danger",
                  domProps: { textContent: _vm._s(_vm.e_ejercicio.duracion[0]) }
                })
              : _vm._e()
          ]),
          _vm._v(" "),
          _vm._m(5),
          _vm._v(" "),
          _c(
            "button",
            {
              staticClass: "btn btn-outline-primary btn-sm float-lef",
              attrs: { type: "button", disabled: _vm.loader_actualizar },
              on: {
                click: function($event) {
                  $event.preventDefault()
                  _vm.actualizar()
                }
              }
            },
            [
              _vm._v("\n        Actualizar\n        "),
              _vm.loader_actualizar
                ? _c("i", {
                    staticClass: "fa fa-spinner fa-spin fa-loader",
                    staticStyle: { "font-size": "20px" }
                  })
                : _vm._e()
            ]
          )
        ])
      ]
    )
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "callout callout-info" }, [
      _c("p", [
        _c("i", { staticClass: "fa fa-fw fa-info" }),
        _vm._v("Los campos marcados en "),
        _c("code", [_vm._v("*")]),
        _vm._v(" son obligatorios\n        ")
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", [_vm._v("Titulo "), _c("code", [_vm._v("*")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", [_vm._v("Fecha de Inicio "), _c("code", [_vm._v("*")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", [
      _vm._v("Duracion(Minutos) "),
      _c("code", [_vm._v("*")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "form-group" }, [
      _c("label", [_vm._v("Descripcion")]),
      _vm._v(" "),
      _c("div", { attrs: { id: "summernote" } })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-25b44f4f", module.exports)
  }
}

/***/ }),
/* 90 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(91)
/* template */
var __vue_template__ = __webpack_require__(92)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/examenes/ExamenesListaEntregaComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-72fe0684", Component.options)
  } else {
    hotAPI.reload("data-v-72fe0684", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 91 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {},
  created: function created() {
    this.base_url = base_url;
    this.idcurso = document.getElementById('idcurso').value;
    this.id = document.getElementById('id').value;
    this.listado();
  },
  data: function data() {
    return {
      idcurso: 0,
      id: 0,
      preload: true,
      a_ejercicios: [],
      o_ejercicio: {},

      preloadmodal: true,
      a_revision: [],
      o_revision: {},
      loader_revision: false
    };
  },
  methods: {
    listado: function listado() {
      var _this = this;

      var url = this.base_url + '/ejercicios/listaent';
      this.preload = true;
      axios.post(url, { idcurso: this.idcurso, id: this.id }).then(function (response) {
        _this.preload = false;
        _this.a_ejercicios = response.data.ejercicios;
        _this.o_ejercicio = response.data.ejercicio;
      }).catch(function (error) {
        _this.preload = false;
        if (error.response.data.errors) {}
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
      });
    },
    redirectVolver: function redirectVolver() {
      document.getElementById('id').value = '';
      this.$root.$emit('setMenu', 'examenes-lista');
    },
    openRevisar: function openRevisar(id) {
      var _this2 = this;

      $('#modal_revision').modal('show');
      var url = this.base_url + '/ejercicios/revision';
      this.preloadmodal = true;
      axios.post(url, { id: id }).then(function (response) {
        _this2.preloadmodal = false;
        _this2.a_revision = response.data.ejercicio;
        _this2.o_revision.id = id;
        console.log(response.data);
      }).catch(function (error) {
        _this2.preloadmodal = false;
        _this2.a_revision = [];
        _this2.o_revision = {};
        if (error.response.data.errors) {}
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
      });
    },
    updrevision: function updrevision() {
      var _this3 = this;

      this.loader_revision = true;
      var url = this.base_url + '/ejercicios/updrevision';
      axios.post(url, { revision: this.a_revision, idejeruser: this.o_revision.id }).then(function (response) {
        _this3.loader_revision = false;
        _this3.a_revision = [];
        _this3.o_revision = {};
        $('#modal_revision').modal('hide');
        _this3.listado();
        swal({
          title: response.data.message,
          text: response.data.message2,
          type: "success"
        });
      }).catch(function (error) {
        _this3.loader_revision = false;
        if (error.response.data.errors) {
          _this3.e_tarea = error.response.data.errors;
        }
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "2500"
          });
        }
      });
    }
  }
});

/***/ }),
/* 92 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c(
        "div",
        {
          staticClass: "modal fade",
          attrs: {
            id: "modal_revision",
            tabindex: "-1",
            role: "dialog",
            "aria-hidden": "true"
          }
        },
        [
          _c(
            "div",
            {
              staticClass: "modal-dialog modal-lg",
              attrs: { role: "document" }
            },
            [
              _c("div", { staticClass: "modal-content" }, [
                _vm._m(0),
                _vm._v(" "),
                _c(
                  "div",
                  {
                    staticClass: "modal-body",
                    staticStyle: { height: "450px", "overflow-y": "auto" }
                  },
                  [
                    _vm.preloadmodal
                      ? _c("div", { staticClass: "row" }, [_vm._m(1)])
                      : _vm._e(),
                    _vm._v(" "),
                    _vm._l(_vm.a_revision, function(revision) {
                      return _c("div", [
                        _c("div", { staticClass: "form-group" }, [
                          _c("label", [_vm._v("Pregunta")]),
                          _vm._v(" "),
                          _c("p", {
                            domProps: { textContent: _vm._s(revision.nombre) }
                          }),
                          _vm._v(" "),
                          _c("p", {
                            domProps: {
                              innerHTML: _vm._s(revision.descripcion)
                            }
                          })
                        ]),
                        _vm._v(" "),
                        _c("div", { staticClass: "form-group" }, [
                          _c("label", [_vm._v("Respuesta")]),
                          _vm._v(" "),
                          _c("p", {
                            domProps: { innerHTML: _vm._s(revision.respuesta) }
                          })
                        ]),
                        _vm._v(" "),
                        _c("div", { staticClass: "form-group" }, [
                          _c("label", [
                            _vm._v("Calificaion sobre "),
                            _c("span", {
                              domProps: {
                                textContent: _vm._s(revision.notapreg)
                              }
                            })
                          ]),
                          _vm._v(" "),
                          _c("input", {
                            directives: [
                              {
                                name: "model",
                                rawName: "v-model",
                                value: revision.calificacion,
                                expression: "revision.calificacion"
                              }
                            ],
                            staticClass: "form-control",
                            attrs: {
                              type: "number",
                              name: "calificacion",
                              min: "0",
                              max: "1000"
                            },
                            domProps: { value: revision.calificacion },
                            on: {
                              input: function($event) {
                                if ($event.target.composing) {
                                  return
                                }
                                _vm.$set(
                                  revision,
                                  "calificacion",
                                  $event.target.value
                                )
                              }
                            }
                          })
                        ]),
                        _vm._v(" "),
                        _c("hr")
                      ])
                    })
                  ],
                  2
                ),
                _vm._v(" "),
                _c("div", { staticClass: "modal-footer" }, [
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-outline-primary btn-sm float-left",
                      attrs: { type: "button", disabled: _vm.loader_revision },
                      on: {
                        click: function($event) {
                          $event.preventDefault()
                          _vm.updrevision()
                        }
                      }
                    },
                    [
                      _vm._v("\n            Enviar revision\n            "),
                      _vm.loader_revision
                        ? _c("i", {
                            staticClass: "fa fa-spinner fa-spin fa-loader",
                            staticStyle: { "font-size": "20px" }
                          })
                        : _vm._e()
                    ]
                  )
                ])
              ])
            ]
          )
        ]
      ),
      _vm._v(" "),
      _vm.preload ? _c("div", { staticClass: "row" }, [_vm._m(2)]) : _vm._e(),
      _vm._v(" "),
      !_vm.preload
        ? _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col-sm-6" }, [
              _c("h5", { staticClass: "m-0 text-dark" }, [
                _c("strong", [_vm._v("Entrega: ")]),
                _c("span", {
                  domProps: { textContent: _vm._s(_vm.o_ejercicio.nombre) }
                }),
                _vm._v(" "),
                _c(
                  "button",
                  {
                    staticClass: "btn btn-tool",
                    attrs: { type: "button" },
                    on: {
                      click: function($event) {
                        $event.preventDefault()
                        _vm.redirectVolver()
                      }
                    }
                  },
                  [
                    _c("i", {
                      staticClass: "fa fa-arrow-circle-left",
                      staticStyle: { "font-size": "24px" }
                    })
                  ]
                )
              ])
            ])
          ])
        : _vm._e(),
      _vm._v(" "),
      _vm._l(_vm.a_ejercicios, function(ejercicio) {
        return !_vm.preload
          ? _c("div", { staticClass: "card" }, [
              _c("div", { staticClass: "card-header no-border" }, [
                _c("h5", {
                  staticClass: "card-title",
                  staticStyle: { cursor: "pointer" },
                  domProps: { textContent: _vm._s(ejercicio.nombre) }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "card-tools" }, [
                  ejercicio.slugstatus != "calificado"
                    ? _c(
                        "button",
                        {
                          staticClass: "btn btn-tool",
                          attrs: { type: "button" },
                          on: {
                            click: function($event) {
                              $event.preventDefault()
                              _vm.openRevisar(ejercicio.ident)
                            }
                          }
                        },
                        [
                          _c("i", {
                            staticClass: "fa  fa-eye",
                            staticStyle: { "font-size": "20px" }
                          })
                        ]
                      )
                    : _vm._e()
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "row" }, [
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("b", [_vm._v("Estado :")]),
                    _vm._v(" "),
                    _c("small", { class: "badge badge-" + ejercicio.status }, [
                      _c("span", {
                        domProps: { textContent: _vm._s(ejercicio.nombestado) }
                      })
                    ])
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("b", [_vm._v("Calificacion :")]),
                    _vm._v(" "),
                    _c("span", {
                      domProps: { textContent: _vm._s(ejercicio.notaes) }
                    }),
                    _vm._v("/"),
                    _c("span", {
                      domProps: { textContent: _vm._s(ejercicio.calificacion) }
                    })
                  ])
                ])
              ])
            ])
          : _vm._e()
      })
    ],
    2
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "modal-header" }, [
      _vm._v("\n            Revision"),
      _c(
        "button",
        {
          staticClass: "close",
          attrs: { type: "button", "data-dismiss": "modal" }
        },
        [_vm._v("×")]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-72fe0684", module.exports)
  }
}

/***/ }),
/* 93 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(94)
/* template */
var __vue_template__ = __webpack_require__(95)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/examenes/ExamenesListaEstudianteComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-3c1c4288", Component.options)
  } else {
    hotAPI.reload("data-v-3c1c4288", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 94 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

var artyom = new Artyom();

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {},
  created: function created() {
    this.base_url = base_url;
    this.idcurso = document.getElementById('idcurso').value;
    this.listado();
  },
  data: function data() {
    return {
      idcurso: 0,
      preload: false,
      a_ejercicios: [],
      preloadmodal: false,
      a_examen: [],
      idejeruser: 0,
      toSecond: 0,
      toMinute: 0,
      loader_finalizar: false,
      tab_active: 0,
      a_resultado: []
    };
  },
  methods: {
    playAudio: function playAudio(id) {
      var vm = this;
      artyom.initialize({
        lang: "en-US", // Más lenguajes son soportados, lee la documentación
        continuous: false, // Reconoce 1 solo comando y basta de escuchar
        listen: true, // Iniciar !
        debug: false, // Muestra un informe en la consola
        speed: 0.7 // Habla normalmente
      }).then(function () {
        //artyom.say("Artyom succesfully initialized");
        console.log("Artyom succesfully initialized");
      }).catch(function (err) {
        //artyom.say("Artyom couldn't be initialized, please check the console for errors");
        console.log("Artyom couldn't be initialized, please check the console for errors");
        console.log(err);
      });

      var palabra = document.getElementById('audio_' + id).value;
      artyom.say(palabra, {
        onStart: function onStart() {
          document.getElementById('player_' + id).disabled = true;
          console.log("Comenzando a leer texto");
        },
        onEnd: function onEnd() {
          document.getElementById('player_' + id).disabled = false;
          artyom.fatality();
          console.log("Texto leido satisfactoriamente");
        }
      });
    },
    tabtoogle_mas: function tabtoogle_mas() {
      if (!(this.tab_active == this.a_examen.length - 1)) {
        this.tab_active = this.tab_active + 1;
      }
    },
    tabtoogle_menos: function tabtoogle_menos() {
      if (!(this.tab_active == 0)) {
        this.tab_active = this.tab_active - 1;
      }
    },
    tabtoogle: function tabtoogle(index) {
      this.tab_active = index;
    },
    listado: function listado() {
      var _this = this;

      var url = this.base_url + '/ejercicios/lista_es';
      this.preload = true;
      axios.post(url, { idcurso: this.idcurso }).then(function (response) {
        _this.preload = false;
        _this.a_ejercicios = response.data.ejercicios;
      }).catch(function (error) {
        _this.preload = false;
        if (error.response.data.errors) {}
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
      });
    },
    comenzar: function comenzar(id, status_user) {
      var inst = this;
      if (status_user == true) {
        swal({
          title: "Ya realizaste la prueba",
          text: "click para continuar",
          type: "info"
        });
        return;
      }

      swal({
        title: "Seguro deseas comenzar",
        text: "",
        type: "info",
        showCancelButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "Iniciar",
        closeOnConfirm: true
      }, function () {
        inst.iniciar(id);
      });
    },
    iniciar: function iniciar(id) {
      var _this2 = this;

      var url = this.base_url + '/ejercicios/iniciar';
      this.preloadmodal = true;
      $('#modal_ejercicio').modal({
        backdrop: 'static',
        keyboard: true,
        show: true
      });
      axios.post(url, { id: id }).then(function (response) {
        _this2.tab_active = 0;
        _this2.preloadmodal = false;
        _this2.idejeruser = response.data.idejeruser;
        _this2.a_examen = response.data.preguntas;
        _this2.toMinute = response.data.duracion;
        _this2.countDown();
        console.log(_this2.a_examen);
      }).catch(function (error) {
        _this2.preloadmodal = false;
        if (error.response.data.errors) {}
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
          //debe colocarse funcionalidad cerrar modal
        }
      });
    },
    finalizar: function finalizar() {
      var _this3 = this;

      var url = this.base_url + '/ejercicios/finalizar';
      this.loader_finalizar = true;
      axios.post(url, { idejeruser: this.idejeruser, examen: this.a_examen }).then(function (response) {
        _this3.loader_finalizar = false;
        $('#modal_ejercicio').modal('hide');
        swal({
          title: response.data.message,
          text: response.data.message2,
          type: "success"
        }, function () {
          location.reload();
        });
      }).catch(function (error) {
        _this3.loader_finalizar = false;
        if (error.response.data.errors) {}
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
      });
    },
    countDown: function countDown() {
      var toSecond = this.toSecond;
      var toMinute = this.toMinute;
      var inst = this;
      toSecond = toSecond - 1;
      if (toSecond < 0) {
        toSecond = 59;
        toMinute = toMinute - 1;
      }
      document.getElementById('second').innerHTML = toSecond;
      this.toSecond = toSecond;

      if (toMinute == 0 && toSecond == 0) {
        swal({
          title: 'Envio automatico',
          text: 'Tu tiempo de prueba finalizo',
          type: "info"
        });
        this.finalizar();
        return;
      }
      document.getElementById('minute').innerHTML = toMinute;
      this.toMinute = toMinute;

      setTimeout(function () {
        inst.countDown();
      }, 1000);
    },
    verresultado: function verresultado(id) {
      var _this4 = this;

      var url = this.base_url + '/ejercicios/verresultado';
      this.preloadmodal = true;
      $('#modal_resultado').modal("show");
      axios.post(url, { id: id }).then(function (response) {
        _this4.tab_active = 0;
        _this4.preloadmodal = false;
        _this4.a_resultado = response.data.preguntas;
        console.log(_this4.a_resultado);
      }).catch(function (error) {
        _this4.preloadmodal = false;
        if (error.response.data.errors) {}
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
          //debe colocarse funcionalidad cerrar modal
        }
      });
    },
    cerrarResultado: function cerrarResultado() {
      this.a_resultado = [];
      $('#modal_resultado').modal("hide");
    }
  }
});

/***/ }),
/* 95 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c(
        "div",
        {
          staticClass: "modal fade",
          attrs: {
            id: "modal_resultado",
            tabindex: "-1",
            role: "dialog",
            "aria-hidden": "true"
          }
        },
        [
          _c(
            "div",
            {
              staticClass: "modal-dialog modal-lg",
              attrs: { role: "document" }
            },
            [
              _c("div", { staticClass: "modal-content" }, [
                _c(
                  "div",
                  {
                    staticClass: "modal-header",
                    staticStyle: { padding: "0px" }
                  },
                  [
                    _c(
                      "h5",
                      {
                        staticClass: "modal-title",
                        staticStyle: {
                          "padding-top": "5px",
                          "padding-left": "10px"
                        }
                      },
                      [_vm._v("\n            Resultado\n          ")]
                    ),
                    _vm._v(" "),
                    _c(
                      "ul",
                      { staticClass: "nav nav-pills ml-auto" },
                      _vm._l(_vm.a_resultado, function(examen, index) {
                        return _c("li", { staticClass: "nav-item" }, [
                          _c("a", {
                            staticClass: "nav-link  show",
                            class: index == _vm.tab_active ? "active" : "",
                            attrs: { href: "#tab_" + index },
                            domProps: { textContent: _vm._s(index + 1) },
                            on: {
                              click: function($event) {
                                $event.preventDefault()
                                _vm.tabtoogle(index)
                              }
                            }
                          })
                        ])
                      })
                    )
                  ]
                ),
                _vm._v(" "),
                _c(
                  "div",
                  {
                    staticClass: "modal-body",
                    staticStyle: { height: "450px", "overflow-y": "auto" }
                  },
                  [
                    _vm.preloadmodal
                      ? _c("div", { staticClass: "row" }, [_vm._m(0)])
                      : _vm._e(),
                    _vm._v(" "),
                    _c(
                      "div",
                      { staticClass: "tab-content" },
                      _vm._l(_vm.a_resultado, function(examen, index) {
                        return _c(
                          "div",
                          {
                            staticClass: "tab-pane show",
                            class: index == _vm.tab_active ? "active" : "",
                            attrs: { id: "tab_" + index }
                          },
                          [
                            _c("p", [
                              _c("b", [
                                _vm._v(" Puntuaciòn "),
                                _c("span", {
                                  domProps: {
                                    textContent: _vm._s(examen.puntaje)
                                  }
                                }),
                                _vm._v(" de "),
                                _c("span", {
                                  domProps: {
                                    textContent: _vm._s(examen.calificacion)
                                  }
                                })
                              ])
                            ]),
                            _vm._v(" "),
                            _c("strong", {
                              domProps: {
                                textContent: _vm._s(
                                  index + 1 + ")" + examen.tipo
                                )
                              }
                            }),
                            _vm._v(" "),
                            _c("p", {
                              domProps: {
                                innerHTML: _vm._s(examen.descripcion)
                              }
                            }),
                            _vm._v(" "),
                            _c("p", {
                              domProps: {
                                innerHTML: _vm._s(examen.textorellenar)
                              }
                            }),
                            _vm._v(" "),
                            _c("hr"),
                            _vm._v(" "),
                            _vm._l(examen.respuestas, function(fila, i) {
                              return examen.tipo == "abierta"
                                ? _c("div", [
                                    _c(
                                      "table",
                                      { staticClass: "table no-border" },
                                      [
                                        _vm._m(1, true),
                                        _vm._v(" "),
                                        _c("tbody", [
                                          _c("tr", [
                                            _c("td", [
                                              _c("p", {
                                                domProps: {
                                                  textContent: _vm._s(
                                                    fila.respuesta_user
                                                  )
                                                }
                                              })
                                            ])
                                          ])
                                        ])
                                      ]
                                    )
                                  ])
                                : _vm._e()
                            }),
                            _vm._v(" "),
                            examen.tipo == "unica"
                              ? _c(
                                  "table",
                                  { staticClass: "table no-border" },
                                  [
                                    _vm._m(2, true),
                                    _vm._v(" "),
                                    _c(
                                      "tbody",
                                      _vm._l(examen.respuestas, function(
                                        fila,
                                        i
                                      ) {
                                        return _c("tr", [
                                          _c("td", [
                                            fila.option
                                              ? _c("i", {
                                                  staticClass:
                                                    "fa fa-fw fa-check",
                                                  staticStyle: {
                                                    color: "green",
                                                    "font-size": "20px"
                                                  }
                                                })
                                              : _vm._e()
                                          ]),
                                          _vm._v(" "),
                                          _c("td", [
                                            fila.seleccion_user
                                              ? _c("i", {
                                                  staticClass:
                                                    "fa fa-fw fa-check",
                                                  staticStyle: {
                                                    color: "green",
                                                    "font-size": "20px"
                                                  }
                                                })
                                              : _vm._e()
                                          ]),
                                          _vm._v(" "),
                                          _c("td", [
                                            _c("p", {
                                              domProps: {
                                                textContent: _vm._s(
                                                  fila.respuesta
                                                )
                                              }
                                            })
                                          ])
                                        ])
                                      })
                                    )
                                  ]
                                )
                              : _vm._e(),
                            _vm._v(" "),
                            examen.tipo == "multiple"
                              ? _c(
                                  "table",
                                  { staticClass: "table no-border" },
                                  [
                                    _vm._m(3, true),
                                    _vm._v(" "),
                                    _c(
                                      "tbody",
                                      _vm._l(examen.respuestas, function(
                                        fila,
                                        i
                                      ) {
                                        return _c("tr", [
                                          _c("td", [
                                            fila.option
                                              ? _c("i", {
                                                  staticClass:
                                                    "fa fa-fw fa-check",
                                                  staticStyle: {
                                                    color: "green",
                                                    "font-size": "20px"
                                                  }
                                                })
                                              : _vm._e()
                                          ]),
                                          _vm._v(" "),
                                          _c("td", [
                                            fila.seleccion_user
                                              ? _c("i", {
                                                  staticClass:
                                                    "fa fa-fw fa-check",
                                                  staticStyle: {
                                                    color: "green",
                                                    "font-size": "20px"
                                                  }
                                                })
                                              : _vm._e()
                                          ]),
                                          _vm._v(" "),
                                          _c("td", [
                                            _c("p", {
                                              domProps: {
                                                textContent: _vm._s(
                                                  fila.respuesta
                                                )
                                              }
                                            })
                                          ])
                                        ])
                                      })
                                    )
                                  ]
                                )
                              : _vm._e(),
                            _vm._v(" "),
                            examen.tipo == "relacionar"
                              ? _c(
                                  "table",
                                  { staticClass: "table no-border" },
                                  [
                                    _vm._m(4, true),
                                    _vm._v(" "),
                                    _c(
                                      "tbody",
                                      _vm._l(examen.respuestas, function(
                                        fila,
                                        i
                                      ) {
                                        return _c("tr", [
                                          _c("td", [
                                            _c("p", {
                                              domProps: {
                                                textContent: _vm._s(
                                                  fila.relacionar_user
                                                )
                                              }
                                            })
                                          ]),
                                          _vm._v(" "),
                                          _c("td", [
                                            _c("p", {
                                              domProps: {
                                                textContent: _vm._s(
                                                  fila.relacionar
                                                )
                                              }
                                            })
                                          ]),
                                          _vm._v(" "),
                                          _c("td", [
                                            _c("p", {
                                              domProps: {
                                                textContent: _vm._s(
                                                  fila.respuesta
                                                )
                                              }
                                            })
                                          ])
                                        ])
                                      })
                                    )
                                  ]
                                )
                              : _vm._e(),
                            _vm._v(" "),
                            examen.tipo == "rellenar"
                              ? _c(
                                  "table",
                                  { staticClass: "table no-border" },
                                  [
                                    _vm._m(5, true),
                                    _vm._v(" "),
                                    _c(
                                      "tbody",
                                      _vm._l(examen.respuestas, function(
                                        fila,
                                        i
                                      ) {
                                        return _c("tr", [
                                          _c("td", [
                                            _c("p", {
                                              domProps: {
                                                textContent: _vm._s(
                                                  fila.relacionar_user
                                                )
                                              }
                                            })
                                          ]),
                                          _vm._v(" "),
                                          _c("td", [
                                            _c("p", {
                                              domProps: {
                                                textContent: _vm._s(
                                                  fila.relacionar
                                                )
                                              }
                                            })
                                          ]),
                                          _vm._v(" "),
                                          _c("td", [
                                            _c("p", {
                                              domProps: {
                                                textContent: _vm._s(
                                                  fila.respuesta
                                                )
                                              }
                                            })
                                          ])
                                        ])
                                      })
                                    )
                                  ]
                                )
                              : _vm._e()
                          ],
                          2
                        )
                      })
                    )
                  ]
                ),
                _vm._v(" "),
                _c("div", { staticClass: "modal-footer" }, [
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-outline-primary btn-sm float-left",
                      attrs: { type: "button" },
                      on: {
                        click: function($event) {
                          $event.preventDefault()
                          _vm.tabtoogle_menos()
                        }
                      }
                    },
                    [
                      _c("i", {
                        staticClass: "fa fa-angle-double-left",
                        staticStyle: { "font-size": "20px" }
                      })
                    ]
                  ),
                  _vm._v(" "),
                  !(_vm.tab_active == _vm.a_resultado.length - 1)
                    ? _c(
                        "button",
                        {
                          staticClass:
                            "btn btn-outline-primary btn-sm float-left",
                          attrs: { type: "button" },
                          on: {
                            click: function($event) {
                              $event.preventDefault()
                              _vm.tabtoogle_mas()
                            }
                          }
                        },
                        [
                          _c("i", {
                            staticClass: "fa fa-angle-double-right",
                            staticStyle: { "font-size": "20px" }
                          })
                        ]
                      )
                    : _vm._e(),
                  _vm._v(" "),
                  _vm.tab_active == _vm.a_resultado.length - 1
                    ? _c(
                        "button",
                        {
                          staticClass:
                            "btn btn-outline-primary btn-sm float-left",
                          attrs: { type: "button" },
                          on: {
                            click: function($event) {
                              $event.preventDefault()
                              _vm.cerrarResultado()
                            }
                          }
                        },
                        [_vm._v("\n            Cerrar\n          ")]
                      )
                    : _vm._e()
                ])
              ])
            ]
          )
        ]
      ),
      _vm._v(" "),
      _c(
        "div",
        {
          staticClass: "modal fade",
          attrs: {
            id: "modal_ejercicio",
            tabindex: "-1",
            role: "dialog",
            "aria-hidden": "true"
          }
        },
        [
          _c(
            "div",
            {
              staticClass: "modal-dialog modal-lg",
              attrs: { role: "document" }
            },
            [
              _c("div", { staticClass: "modal-content" }, [
                _c(
                  "div",
                  {
                    staticClass: "modal-header",
                    staticStyle: { padding: "0px" }
                  },
                  [
                    _vm._m(6),
                    _vm._v(" "),
                    _c(
                      "ul",
                      { staticClass: "nav nav-pills ml-auto" },
                      _vm._l(_vm.a_examen, function(examen, index) {
                        return _c("li", { staticClass: "nav-item" }, [
                          _c("a", {
                            staticClass: "nav-link  show",
                            class: index == _vm.tab_active ? "active" : "",
                            attrs: { href: "#tab_" + index },
                            domProps: { textContent: _vm._s(index + 1) },
                            on: {
                              click: function($event) {
                                $event.preventDefault()
                                _vm.tabtoogle(index)
                              }
                            }
                          })
                        ])
                      })
                    )
                  ]
                ),
                _vm._v(" "),
                _c(
                  "div",
                  {
                    staticClass: "modal-body",
                    staticStyle: { height: "450px", "overflow-y": "auto" }
                  },
                  [
                    _vm.preloadmodal
                      ? _c("div", { staticClass: "row" }, [_vm._m(7)])
                      : _vm._e(),
                    _vm._v(" "),
                    _c(
                      "div",
                      { staticClass: "tab-content" },
                      _vm._l(_vm.a_examen, function(examen, index) {
                        return _c(
                          "div",
                          {
                            staticClass: "tab-pane show",
                            class: index == _vm.tab_active ? "active" : "",
                            attrs: { id: "tab_" + index }
                          },
                          [
                            _c("strong", {
                              domProps: {
                                textContent: _vm._s(
                                  index + 1 + ")" + examen.tipo
                                )
                              }
                            }),
                            _vm._v(" "),
                            _c("p", {
                              domProps: {
                                innerHTML: _vm._s(examen.descripcion)
                              }
                            }),
                            _vm._v(" "),
                            _c("p", {
                              domProps: {
                                innerHTML: _vm._s(examen.textorellenar)
                              }
                            }),
                            _vm._v(" "),
                            examen.audio == "A"
                              ? _c("div", { staticClass: "form-group" }, [
                                  _c("label", [
                                    _vm._v(
                                      "\n                  Reproducir\n                  "
                                    ),
                                    _c(
                                      "button",
                                      {
                                        staticClass:
                                          "btn btn-outline-primary btn-sm",
                                        attrs: {
                                          type: "button",
                                          id: "player_" + index
                                        },
                                        on: {
                                          click: function($event) {
                                            $event.preventDefault()
                                            _vm.playAudio(index)
                                          }
                                        }
                                      },
                                      [_c("i", { staticClass: "fa fa-play" })]
                                    ),
                                    _vm._v("   \n                ")
                                  ])
                                ])
                              : _vm._e(),
                            _vm._v(" "),
                            _c("hr"),
                            _vm._v(" "),
                            _vm._l(examen.respuestas, function(fila, i) {
                              return examen.tipo == "abierta"
                                ? _c("div", [
                                    _c("div", { staticClass: "form-group" }, [
                                      _c("textarea", {
                                        directives: [
                                          {
                                            name: "model",
                                            rawName: "v-model",
                                            value: fila.respuesta,
                                            expression: "fila.respuesta"
                                          }
                                        ],
                                        staticClass: "form-control",
                                        attrs: {
                                          rows: "3",
                                          placeholder: "Escribe tu respuesta"
                                        },
                                        domProps: { value: fila.respuesta },
                                        on: {
                                          input: function($event) {
                                            if ($event.target.composing) {
                                              return
                                            }
                                            _vm.$set(
                                              fila,
                                              "respuesta",
                                              $event.target.value
                                            )
                                          }
                                        }
                                      })
                                    ])
                                  ])
                                : _vm._e()
                            }),
                            _vm._v(" "),
                            examen.tipo == "unica"
                              ? _c(
                                  "table",
                                  { staticClass: "table no-border" },
                                  [
                                    _c(
                                      "tbody",
                                      _vm._l(examen.respuestas, function(
                                        fila,
                                        i
                                      ) {
                                        return _c("tr", [
                                          _c("td", [
                                            _c("input", {
                                              directives: [
                                                {
                                                  name: "model",
                                                  rawName: "v-model",
                                                  value: examen.idunica,
                                                  expression: "examen.idunica"
                                                }
                                              ],
                                              attrs: {
                                                type: "radio",
                                                id: fila.id
                                              },
                                              domProps: {
                                                value: fila.id,
                                                checked: _vm._q(
                                                  examen.idunica,
                                                  fila.id
                                                )
                                              },
                                              on: {
                                                change: function($event) {
                                                  _vm.$set(
                                                    examen,
                                                    "idunica",
                                                    fila.id
                                                  )
                                                }
                                              }
                                            }),
                                            _vm._v(" "),
                                            _c("p", {
                                              domProps: {
                                                textContent: _vm._s(
                                                  fila.respuesta
                                                )
                                              }
                                            })
                                          ])
                                        ])
                                      })
                                    )
                                  ]
                                )
                              : _vm._e(),
                            _vm._v(" "),
                            examen.tipo == "multiple"
                              ? _c(
                                  "table",
                                  { staticClass: "table no-border" },
                                  [
                                    _c(
                                      "tbody",
                                      _vm._l(examen.respuestas, function(
                                        fila,
                                        i
                                      ) {
                                        return _c("tr", [
                                          _c("td", [
                                            _c("input", {
                                              directives: [
                                                {
                                                  name: "model",
                                                  rawName: "v-model",
                                                  value: fila.seleccion,
                                                  expression: "fila.seleccion"
                                                }
                                              ],
                                              attrs: { type: "checkbox" },
                                              domProps: {
                                                checked: Array.isArray(
                                                  fila.seleccion
                                                )
                                                  ? _vm._i(
                                                      fila.seleccion,
                                                      null
                                                    ) > -1
                                                  : fila.seleccion
                                              },
                                              on: {
                                                change: function($event) {
                                                  var $$a = fila.seleccion,
                                                    $$el = $event.target,
                                                    $$c = $$el.checked
                                                      ? true
                                                      : false
                                                  if (Array.isArray($$a)) {
                                                    var $$v = null,
                                                      $$i = _vm._i($$a, $$v)
                                                    if ($$el.checked) {
                                                      $$i < 0 &&
                                                        _vm.$set(
                                                          fila,
                                                          "seleccion",
                                                          $$a.concat([$$v])
                                                        )
                                                    } else {
                                                      $$i > -1 &&
                                                        _vm.$set(
                                                          fila,
                                                          "seleccion",
                                                          $$a
                                                            .slice(0, $$i)
                                                            .concat(
                                                              $$a.slice($$i + 1)
                                                            )
                                                        )
                                                    }
                                                  } else {
                                                    _vm.$set(
                                                      fila,
                                                      "seleccion",
                                                      $$c
                                                    )
                                                  }
                                                }
                                              }
                                            }),
                                            _vm._v(" "),
                                            _c("p", {
                                              domProps: {
                                                textContent: _vm._s(
                                                  fila.respuesta
                                                )
                                              }
                                            })
                                          ])
                                        ])
                                      })
                                    )
                                  ]
                                )
                              : _vm._e(),
                            _vm._v(" "),
                            examen.tipo == "relacionar"
                              ? _c(
                                  "table",
                                  { staticClass: "table no-border" },
                                  [
                                    _c(
                                      "tbody",
                                      _vm._l(examen.respuestas, function(
                                        fila,
                                        i
                                      ) {
                                        return _c("tr", [
                                          _c("td", [
                                            _c("p", {
                                              domProps: {
                                                textContent: _vm._s(
                                                  fila.respuesta
                                                )
                                              }
                                            }),
                                            _vm._v(" "),
                                            _c(
                                              "div",
                                              { staticClass: "form-group" },
                                              [
                                                _c(
                                                  "select",
                                                  {
                                                    directives: [
                                                      {
                                                        name: "model",
                                                        rawName: "v-model",
                                                        value: fila.relacionar2,
                                                        expression:
                                                          "fila.relacionar2"
                                                      }
                                                    ],
                                                    staticClass: "form-control",
                                                    on: {
                                                      change: function($event) {
                                                        var $$selectedVal = Array.prototype.filter
                                                          .call(
                                                            $event.target
                                                              .options,
                                                            function(o) {
                                                              return o.selected
                                                            }
                                                          )
                                                          .map(function(o) {
                                                            var val =
                                                              "_value" in o
                                                                ? o._value
                                                                : o.value
                                                            return val
                                                          })
                                                        _vm.$set(
                                                          fila,
                                                          "relacionar2",
                                                          $event.target.multiple
                                                            ? $$selectedVal
                                                            : $$selectedVal[0]
                                                        )
                                                      }
                                                    }
                                                  },
                                                  [
                                                    _c(
                                                      "option",
                                                      {
                                                        attrs: { value: "''" }
                                                      },
                                                      [_vm._v(" - ")]
                                                    ),
                                                    _vm._v(" "),
                                                    _vm._l(
                                                      examen.respuestas,
                                                      function(select) {
                                                        return _c("option", {
                                                          domProps: {
                                                            value:
                                                              select.relacionar,
                                                            textContent: _vm._s(
                                                              select.relacionar
                                                            )
                                                          }
                                                        })
                                                      }
                                                    )
                                                  ],
                                                  2
                                                )
                                              ]
                                            )
                                          ])
                                        ])
                                      })
                                    )
                                  ]
                                )
                              : _vm._e(),
                            _vm._v(" "),
                            examen.tipo == "rellenar"
                              ? _c(
                                  "table",
                                  { staticClass: "table no-border" },
                                  [
                                    _c(
                                      "tbody",
                                      _vm._l(examen.respuestas, function(
                                        fila,
                                        i
                                      ) {
                                        return _c("tr", [
                                          _c("td", [
                                            _c("p", {
                                              domProps: {
                                                textContent: _vm._s(
                                                  fila.respuesta + ")"
                                                )
                                              }
                                            }),
                                            _vm._v(" "),
                                            _c("input", {
                                              directives: [
                                                {
                                                  name: "model",
                                                  rawName: "v-model",
                                                  value: fila.relacionar2,
                                                  expression: "fila.relacionar2"
                                                }
                                              ],
                                              staticClass: "form-control",
                                              attrs: { type: "text" },
                                              domProps: {
                                                value: fila.relacionar2
                                              },
                                              on: {
                                                input: function($event) {
                                                  if ($event.target.composing) {
                                                    return
                                                  }
                                                  _vm.$set(
                                                    fila,
                                                    "relacionar2",
                                                    $event.target.value
                                                  )
                                                }
                                              }
                                            })
                                          ])
                                        ])
                                      })
                                    )
                                  ]
                                )
                              : _vm._e(),
                            _vm._v(" "),
                            _c("textarea", {
                              staticClass: "form-control",
                              staticStyle: { display: "none" },
                              attrs: { rows: "2", id: "audio_" + index },
                              domProps: {
                                textContent: _vm._s(examen.textoaudio)
                              }
                            })
                          ],
                          2
                        )
                      })
                    )
                  ]
                ),
                _vm._v(" "),
                _c("div", { staticClass: "modal-footer" }, [
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-outline-primary btn-sm float-left",
                      attrs: { type: "button" },
                      on: {
                        click: function($event) {
                          $event.preventDefault()
                          _vm.tabtoogle_menos()
                        }
                      }
                    },
                    [
                      _c("i", {
                        staticClass: "fa fa-angle-double-left",
                        staticStyle: { "font-size": "20px" }
                      })
                    ]
                  ),
                  _vm._v(" "),
                  !(_vm.tab_active == _vm.a_examen.length - 1)
                    ? _c(
                        "button",
                        {
                          staticClass:
                            "btn btn-outline-primary btn-sm float-left",
                          attrs: { type: "button" },
                          on: {
                            click: function($event) {
                              $event.preventDefault()
                              _vm.tabtoogle_mas()
                            }
                          }
                        },
                        [
                          _c("i", {
                            staticClass: "fa fa-angle-double-right",
                            staticStyle: { "font-size": "20px" }
                          })
                        ]
                      )
                    : _vm._e(),
                  _vm._v(" "),
                  _vm.tab_active == _vm.a_examen.length - 1
                    ? _c(
                        "button",
                        {
                          staticClass:
                            "btn btn-outline-primary btn-sm float-left",
                          attrs: {
                            type: "button",
                            disabled: _vm.loader_finalizar
                          },
                          on: {
                            click: function($event) {
                              $event.preventDefault()
                              _vm.finalizar()
                            }
                          }
                        },
                        [
                          _vm._v("\n            Finalizar\n            "),
                          _vm.loader_finalizar
                            ? _c("i", {
                                staticClass: "fa fa-spinner fa-spin fa-loader",
                                staticStyle: { "font-size": "20px" }
                              })
                            : _vm._e()
                        ]
                      )
                    : _vm._e()
                ])
              ])
            ]
          )
        ]
      ),
      _vm._v(" "),
      _vm.preload ? _c("div", { staticClass: "row" }, [_vm._m(8)]) : _vm._e(),
      _vm._v(" "),
      _vm._l(_vm.a_ejercicios, function(ejercicio) {
        return !_vm.preload
          ? _c("div", { staticClass: "card" }, [
              _c("div", { staticClass: "card-header no-border" }, [
                _c("h5", {
                  staticClass: "card-title",
                  domProps: { textContent: _vm._s(ejercicio.nombre) }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "row" }, [
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("b", [_vm._v("Inicia :")]),
                    _vm._v(" "),
                    _c("span", {
                      domProps: { textContent: _vm._s(ejercicio.fecha_inicio) }
                    })
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("b", [_vm._v("Finalizacion :")]),
                    _vm._v(" "),
                    _c("span", {
                      domProps: {
                        textContent: _vm._s(ejercicio.fecha_finalizacion)
                      }
                    })
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("b", [_vm._v("Duracion :")]),
                    _vm._v(" "),
                    _c("span", {
                      domProps: { textContent: _vm._s(ejercicio.duracion) }
                    }),
                    _vm._v(" minutos\n        ")
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("b", [_vm._v("Estado :")]),
                    _vm._v(" "),
                    _c("small", {
                      class: "badge badge-" + ejercicio.status,
                      domProps: { textContent: _vm._s(ejercicio.nombestado) }
                    })
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("b", [_vm._v("Calificacion :")]),
                    _vm._v(" "),
                    _c("span", {
                      domProps: { textContent: _vm._s(ejercicio.calificacion) }
                    }),
                    _vm._v("/"),
                    _c("span", {
                      domProps: { textContent: _vm._s(ejercicio.notamaxima) }
                    })
                  ])
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "card-body" }, [
                ejercicio.statusini == true && ejercicio.status_user == false
                  ? _c(
                      "button",
                      {
                        staticClass:
                          "btn btn-outline-primary btn-sm float-left",
                        attrs: { type: "button" },
                        on: {
                          click: function($event) {
                            $event.preventDefault()
                            _vm.comenzar(ejercicio.id, ejercicio.status_user)
                          }
                        }
                      },
                      [_vm._v("\n        Comenzar\n      ")]
                    )
                  : _vm._e(),
                _vm._v(" "),
                ejercicio.status_user == true
                  ? _c(
                      "button",
                      {
                        staticClass:
                          "btn btn-outline-primary btn-sm float-left",
                        attrs: { type: "button" },
                        on: {
                          click: function($event) {
                            $event.preventDefault()
                            _vm.verresultado(ejercicio.id)
                          }
                        }
                      },
                      [_vm._v("\n        Ver resultado\n      ")]
                    )
                  : _vm._e(),
                _vm._v(" "),
                ejercicio.statusini == false && ejercicio.status_user == false
                  ? _c(
                      "button",
                      {
                        staticClass:
                          "btn btn-outline-primary btn-sm float-left",
                        attrs: { type: "button", disabled: "" }
                      },
                      [_vm._v("\n        Cerrado\n      ")]
                    )
                  : _vm._e()
              ])
            ])
          : _vm._e()
      })
    ],
    2
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [_c("th", [_vm._v("Su respuesta")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [
      _c("th", [_vm._v("Su seleccion")]),
      _vm._v(" "),
      _c("th", [_vm._v("Seleccion correcta")]),
      _vm._v(" "),
      _c("th", [_vm._v("Respuesta")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [
      _c("th", [_vm._v("Su seleccion")]),
      _vm._v(" "),
      _c("th", [_vm._v("Seleccion correcta")]),
      _vm._v(" "),
      _c("th", [_vm._v("Respuesta")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [
      _c("th", [_vm._v("Su seleccion")]),
      _vm._v(" "),
      _c("th", [_vm._v("Seleccion correcta")]),
      _vm._v(" "),
      _c("th", [_vm._v("Respuesta")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [
      _c("th", [_vm._v("Su seleccion")]),
      _vm._v(" "),
      _c("th", [_vm._v("Seleccion correcta")]),
      _vm._v(" "),
      _c("th", [_vm._v("Respuesta")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "h5",
      {
        staticClass: "modal-title",
        staticStyle: { "padding-top": "5px", "padding-left": "10px" }
      },
      [
        _c("strong", [
          _c("span", { attrs: { id: "minute" } }),
          _vm._v(" : "),
          _c("span", { attrs: { id: "second" } })
        ])
      ]
    )
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-3c1c4288", module.exports)
  }
}

/***/ }),
/* 96 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(97)
/* template */
var __vue_template__ = __webpack_require__(98)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/preguntas/PreguntasListaComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-a343017c", Component.options)
  } else {
    hotAPI.reload("data-v-a343017c", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 97 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {},
  created: function created() {
    this.base_url = base_url;
    this.idcurso = document.getElementById('idcurso').value;
    this.idejerc = document.getElementById('id').value;
    this.listado();
  },
  data: function data() {
    return {
      idcurso: 0,
      idejerc: 0,
      preload: false,
      a_preguntas: []
    };
  },
  methods: {
    listado: function listado() {
      var _this = this;

      var url = this.base_url + '/preguntas/lista';
      this.preload = true;
      axios.post(url, { idcurso: this.idcurso, idejerc: this.idejerc }).then(function (response) {
        _this.preload = false;
        _this.a_preguntas = response.data.preguntas;
      }).catch(function (error) {
        _this.preload = false;
        if (error.response.data.errors) {}
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "2500"
          });
        }
      });
    },
    redirectCrear: function redirectCrear() {
      this.$root.$emit('setMenu', 'preguntas-crear');
    },
    redirectEdit: function redirectEdit(idpregunta) {
      document.getElementById('id2').value = idpregunta;
      this.$root.$emit('setMenu', 'preguntas-edit');
    },
    redirectVolver: function redirectVolver() {
      this.$root.$emit('setMenu', 'examenes-lista');
    }
  }
});

/***/ }),
/* 98 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _vm.preload ? _c("div", { staticClass: "row" }, [_vm._m(0)]) : _vm._e(),
      _vm._v(" "),
      !_vm.preload
        ? _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col-sm-6" }, [
              _c("h5", { staticClass: "m-0 text-dark" }, [
                _c("strong", [_vm._v("Preguntas ")]),
                _vm._v(" "),
                _c(
                  "button",
                  {
                    staticClass: "btn btn-tool",
                    attrs: { type: "button" },
                    on: {
                      click: function($event) {
                        $event.preventDefault()
                        _vm.redirectVolver()
                      }
                    }
                  },
                  [
                    _c("i", {
                      staticClass: "fa fa-arrow-circle-left",
                      staticStyle: { "font-size": "24px" }
                    })
                  ]
                ),
                _vm._v(" "),
                _c(
                  "button",
                  {
                    staticClass: "btn btn-tool",
                    attrs: { type: "button" },
                    on: {
                      click: function($event) {
                        $event.preventDefault()
                        _vm.redirectCrear()
                      }
                    }
                  },
                  [
                    _c("i", {
                      staticClass: "fa fa-plus-circle",
                      staticStyle: { "font-size": "24px" }
                    })
                  ]
                )
              ])
            ])
          ])
        : _vm._e(),
      _vm._v(" "),
      _vm._l(_vm.a_preguntas, function(pregunta) {
        return !_vm.preload
          ? _c("div", { staticClass: "card" }, [
              _c("div", { staticClass: "card-header no-border" }, [
                _c("h5", {
                  staticClass: "card-title",
                  staticStyle: { cursor: "pointer" },
                  domProps: { textContent: _vm._s(pregunta.tipo) },
                  on: {
                    click: function($event) {
                      $event.preventDefault()
                      _vm.redirectEdit(pregunta.id)
                    }
                  }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "card-tools" }, [
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-tool",
                      attrs: { type: "button" },
                      on: {
                        click: function($event) {
                          $event.preventDefault()
                          _vm.redirectEdit(pregunta.id)
                        }
                      }
                    },
                    [
                      _c("i", {
                        staticClass: "fa  fa-pencil",
                        staticStyle: { "font-size": "20px" }
                      })
                    ]
                  )
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "row" }, [
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("b", [_vm._v("Creado :")]),
                    _vm._v(" "),
                    _c("span", {
                      domProps: { textContent: _vm._s(pregunta.fecha_creacion) }
                    })
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "col-md-4 col-sm-6" }, [
                    _c("b", [_vm._v("Puntaje :")]),
                    _vm._v(" "),
                    _c("span", {
                      domProps: { textContent: _vm._s(pregunta.puntaje) }
                    })
                  ])
                ])
              ])
            ])
          : _vm._e()
      })
    ],
    2
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-a343017c", module.exports)
  }
}

/***/ }),
/* 99 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(100)
/* template */
var __vue_template__ = __webpack_require__(101)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/preguntas/PreguntasCrearComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-cca48e84", Component.options)
  } else {
    hotAPI.reload("data-v-cca48e84", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 100 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

var artyom = new Artyom();

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {
    $('#summernote').summernote({
      callbacks: {
        onImageUpload: function onImageUpload(image) {
          var sizeKB = image[0]['size'] / 1000;
          var tmp_pr = 0;
          if (sizeKB > 1100) {
            tmp_pr = 1;
            swal({
              title: "Seleccione una imagen menor o igual a 1mb",
              text: '',
              type: "info"
            });
          }
          if (image[0]['type'] != 'image/jpeg' && image[0]['type'] != 'image/png') {
            tmp_pr = 1;
            swal({
              title: "La imagen debe ser formato png o jpg",
              text: '',
              type: "info"
            });
          }
          if (tmp_pr == 0) {
            var file = image[0];
            var reader = new FileReader();
            reader.onloadend = function () {
              var image = $('<img>').attr('src', reader.result);
              $('#summernote').summernote("insertNode", image[0]);
            };
            reader.readAsDataURL(file);
          }
        }
      },
      toolbar: [['font', ['fontname']], ['para', ['ul', 'ol', 'paragraph', 'strikethrough']], ['style', ['bold', 'italic', 'underline', 'clear']], ['fontsize', ['fontsize']], ['color', ['color']], ['height', ['height']], ['groupName', ['picture', 'link', 'video', 'table', 'hr', 'fullscreen']]],
      height: 200
    });
  },
  created: function created() {
    this.base_url = base_url;
    this.idcurso = document.getElementById('idcurso').value;
    this.idejerc = document.getElementById('id').value;
  },
  data: function data() {
    return {
      idcurso: 0,
      idejerc: 0,
      o_basepregunta: { 'nombre': '', 'descripicion': '', 'tipo': '', 'texto_audio': '' },
      o_pregunta: { 'nombre': '', 'descripicion': '', 'tipo': '', 'texto_audio': '' },
      e_pregunta: [],
      loader_guardar: false,

      //respuesta Abierta
      view_resp_abierta: false,
      o_resp_abierta: {},

      //respuesta Unica
      view_resp_unica: false,
      a_resp_unica: [],
      radio_unica: 0,
      id_unica: 0,

      //respuesta Multiple
      view_resp_multiple: false,
      a_resp_multiple: [],
      id_multiple: 0,

      //respuesta relacionar
      view_resp_relacionar: false,
      a_resp_relacionar: [],
      id_relacionar: 0,

      //respuesta Rellenar
      view_resp_rellenar: false,
      a_resp_rellenar: [],
      resp_rellenar: '',
      id_rellenar: 0,

      disabled_play: false
    };
  },
  methods: {
    guardar: function guardar() {
      var _this = this;

      this.loader_guardar = true;
      this.o_pregunta.idcurso = this.idcurso;
      this.o_pregunta.idejerc = this.idejerc;
      this.o_pregunta.descripcion = $('#summernote').summernote('code');
      this.o_pregunta.resp_abierta = this.o_resp_abierta;
      this.o_pregunta.resp_unica = this.a_resp_unica;
      this.o_pregunta.radio_unica = this.radio_unica;
      this.o_pregunta.resp_multiple = this.a_resp_multiple;
      this.o_pregunta.resp_relacionar = this.a_resp_relacionar;
      this.o_pregunta.resp_rellenar = this.a_resp_rellenar;
      this.o_pregunta.texto_rellenar = this.resp_rellenar;
      var url = this.base_url + '/preguntas/guardar';
      var inst = this;
      axios.post(url, this.o_pregunta).then(function (response) {
        _this.loader_guardar = false;
        _this.e_pregunta = [];
        _this.o_pregunta = _this.o_basepregunta;
        swal({
          title: response.data.message,
          text: response.data.message2,
          type: "success"
        }, function () {
          inst.redirectVolver();
        });
      }).catch(function (error) {
        _this.loader_guardar = false;
        if (error.response.data.errors) {
          _this.e_pregunta = error.response.data.errors;
        }
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
        console.log(error.response.data);
      });
    },
    playAudio: function playAudio() {
      var vm = this;
      artyom.initialize({
        lang: "en-US", // Más lenguajes son soportados, lee la documentación
        continuous: false, // Reconoce 1 solo comando y basta de escuchar
        listen: true, // Iniciar !
        debug: false, // Muestra un informe en la consola
        speed: 0.7 // Habla normalmente
      }).then(function () {
        //artyom.say("Artyom succesfully initialized");
        console.log("Artyom succesfully initialized");
      }).catch(function (err) {
        //artyom.say("Artyom couldn't be initialized, please check the console for errors");
        console.log("Artyom couldn't be initialized, please check the console for errors");
        console.log(err);
      });

      var palabra = this.o_pregunta.texto_audio;
      artyom.say(palabra, {
        onStart: function onStart() {
          vm.disabled_play = true;
          console.log("Comenzando a leer texto");
        },
        onEnd: function onEnd() {
          vm.disabled_play = false;
          artyom.fatality();
          console.log("Texto leido satisfactoriamente");
        }
      });
    },
    viewtipo: function viewtipo() {
      this.view_resp_abierta = false;
      this.view_resp_unica = false;
      this.view_resp_multiple = false;
      this.view_resp_relacionar = false;
      this.view_resp_rellenar = false;

      //respuesta Abierta
      if (this.o_pregunta.tipo == 'abierta') {
        this.view_resp_abierta = true;
        this.o_resp_abierta = { 'puntaje': 0 };
      }

      if (this.o_pregunta.tipo == 'unica') {
        this.view_resp_unica = true;
        this.radio_unica = 1;
        this.id_unica = 2;
        this.a_resp_unica = [{ 'id': 1, 'respuesta': '', 'puntaje': 0, 'delete': true }, { 'id': 2, 'respuesta': '', 'puntaje': 0, 'delete': true }];
      }

      if (this.o_pregunta.tipo == 'relacionar') {
        this.view_resp_relacionar = true;
        this.id_relacionar = 2;
        this.a_resp_relacionar = [{ 'id': 1, 'respuesta': '', 'relacionar': '', 'puntaje': 0, 'delete': true }, { 'id': 2, 'respuesta': '', 'relacionar': '', 'puntaje': 0, 'delete': true }];
      }

      if (this.o_pregunta.tipo == 'multiple') {
        this.view_resp_multiple = true;
        this.id_multiple = 2;
        this.a_resp_multiple = [{ 'id': 1, 'option': false, 'respuesta': '', 'puntaje': 0, 'delete': true }, { 'id': 2, 'option': false, 'respuesta': '', 'puntaje': 0, 'delete': true }];
      }

      if (this.o_pregunta.tipo == 'rellenar') {
        this.view_resp_rellenar = true;
        this.resp_rellenar = '';
        this.id_rellenar = 0;
        this.a_resp_rellenar = [];
      }
    },
    addRespUnica: function addRespUnica() {
      this.id_unica++;
      this.a_resp_unica.push({ 'id': this.id_unica, 'respuesta': '', 'puntaje': 0, 'delete': true });
    },
    removeRespUnica: function removeRespUnica(index) {
      this.a_resp_unica.splice(index, 1);
    },
    addRespMultiple: function addRespMultiple() {
      this.id_multiple++;
      this.a_resp_multiple.push({ 'id': this.id_multiple, 'option': false, 'respuesta': '', 'puntaje': 0, 'delete': true });
    },
    removeRespMultiple: function removeRespMultiple(index) {
      this.a_resp_multiple.splice(index, 1);
    },
    addRespRelacionar: function addRespRelacionar() {
      this.id_relacionar++;
      this.a_resp_relacionar.push({ 'id': this.id_relacionar, 'option': false, 'respuesta': '', 'puntaje': 0, 'delete': true });
    },
    removeRespRelacionar: function removeRespRelacionar(index) {
      this.a_resp_relacionar.splice(index, 1);
    },
    obtenerRellenar: function obtenerRellenar() {
      var cadena = this.resp_rellenar;
      this.id_rellenar = 0;
      this.a_resp_rellenar = [];

      var abrir = '0';
      var palabra = '';
      for (var i = 0; i < cadena.length; i++) {
        //var letra=cadena[i].toLowerCase();
        var letra = cadena[i];
        if (letra == '[') {
          abrir = '1';
        } else if (abrir == '1' && letra != ']') {
          palabra += letra;
        } else if (letra == ']') {
          this.a_resp_rellenar.push({ 'id': this.id_rellenar, 'respuesta': palabra, 'relacionar': '', 'puntaje': 0 });
          abrir = 0;
          palabra = '';
        }

        //if (cadena[i].toLowerCase() === caracter) indices.push(i);
      }
    },
    redirectVolver: function redirectVolver() {
      this.$root.$emit('setMenu', 'preguntas-lista');
    }
  }
});

/***/ }),
/* 101 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c("div", { staticClass: "row" }, [
      _c("div", { staticClass: "col-md-6 col-sm-6" }, [
        _c("h5", { staticClass: "m-0 text-dark" }, [
          _c("strong", [_vm._v("Nueva pregunta")]),
          _vm._v(" "),
          _c(
            "button",
            {
              staticClass: "btn btn-tool",
              attrs: { type: "button" },
              on: {
                click: function($event) {
                  $event.preventDefault()
                  _vm.redirectVolver()
                }
              }
            },
            [
              _c("i", {
                staticClass: "fa fa-arrow-circle-left",
                staticStyle: { "font-size": "24px" }
              })
            ]
          )
        ])
      ])
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "card" }, [
      _c("div", { staticClass: "card-body" }, [
        _vm._m(0),
        _vm._v(" "),
        _c("div", { staticClass: "form-group" }, [
          _c("label", [_vm._v("Contenido de pregunta")]),
          _vm._v(" "),
          _c("div", { attrs: { id: "summernote" } }),
          _vm._v(" "),
          _vm.e_pregunta.descripcion
            ? _c("span", {
                staticClass: "text-danger",
                domProps: { textContent: _vm._s(_vm.e_pregunta.descripcion[0]) }
              })
            : _vm._e()
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "form-group" }, [
          _vm._m(1),
          _vm._v(" "),
          _c(
            "select",
            {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.o_pregunta.tipo,
                  expression: "o_pregunta.tipo"
                }
              ],
              staticClass: "form-control",
              class: [_vm.e_pregunta.tipo ? "is-invalid" : ""],
              attrs: { name: "tipo" },
              on: {
                change: [
                  function($event) {
                    var $$selectedVal = Array.prototype.filter
                      .call($event.target.options, function(o) {
                        return o.selected
                      })
                      .map(function(o) {
                        var val = "_value" in o ? o._value : o.value
                        return val
                      })
                    _vm.$set(
                      _vm.o_pregunta,
                      "tipo",
                      $event.target.multiple ? $$selectedVal : $$selectedVal[0]
                    )
                  },
                  function($event) {
                    _vm.viewtipo()
                  }
                ]
              }
            },
            [
              _c("option", { attrs: { value: "" } }, [
                _vm._v("Seleccione el tipo")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "abierta" } }, [
                _vm._v("Abierta")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "unica" } }, [_vm._v("Unica")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "multiple" } }, [
                _vm._v("Multiple")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "relacionar" } }, [
                _vm._v("Relacionar")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "rellenar" } }, [
                _vm._v("Rellenar")
              ])
            ]
          ),
          _vm._v(" "),
          _vm.e_pregunta.tipo
            ? _c("span", {
                staticClass: "text-danger",
                domProps: { textContent: _vm._s(_vm.e_pregunta.tipo[0]) }
              })
            : _vm._e()
        ]),
        _vm._v(" "),
        _vm.view_resp_abierta
          ? _c("div", [
              _c("div", { staticClass: "card" }, [
                _c("div", { staticClass: "card-body" }, [
                  _c("div", { staticClass: "form-group" }, [
                    _c("label", [_vm._v("Puntaje")]),
                    _vm._v(" "),
                    _c("input", {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.o_resp_abierta.puntaje,
                          expression: "o_resp_abierta.puntaje"
                        }
                      ],
                      staticClass: "form-control",
                      attrs: { type: "number", min: "0", name: "puntaje" },
                      domProps: { value: _vm.o_resp_abierta.puntaje },
                      on: {
                        input: function($event) {
                          if ($event.target.composing) {
                            return
                          }
                          _vm.$set(
                            _vm.o_resp_abierta,
                            "puntaje",
                            $event.target.value
                          )
                        }
                      }
                    })
                  ])
                ])
              ])
            ])
          : _vm._e(),
        _vm._v(" "),
        _vm.view_resp_unica
          ? _c("div", [
              _c("div", { staticClass: "card" }, [
                _c("div", { staticClass: "card-body table-responsive p-0" }, [
                  _c(
                    "table",
                    { staticClass: "table table-striped table-valign-middle" },
                    [
                      _c("thead", [
                        _c("tr", [
                          _c("th", [_vm._v("Verdadera")]),
                          _vm._v(" "),
                          _c("th", [_vm._v("Posibles respuestas")]),
                          _vm._v(" "),
                          _c("th", [_vm._v("Puntaje")]),
                          _vm._v(" "),
                          _c("th", [
                            _c(
                              "button",
                              {
                                staticClass:
                                  "btn btn-outline-primary btn-sm float-left",
                                attrs: { type: "button" },
                                on: {
                                  click: function($event) {
                                    $event.preventDefault()
                                    _vm.addRespUnica()
                                  }
                                }
                              },
                              [_c("i", { staticClass: "fa fa-plus" })]
                            )
                          ])
                        ])
                      ]),
                      _vm._v(" "),
                      _c(
                        "tbody",
                        _vm._l(_vm.a_resp_unica, function(fila, index) {
                          return _c("tr", [
                            _c("td", [
                              _vm._v("  \n                      "),
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: _vm.radio_unica,
                                    expression: "radio_unica"
                                  }
                                ],
                                attrs: { type: "radio", id: fila.id },
                                domProps: {
                                  value: fila.id,
                                  checked: _vm._q(_vm.radio_unica, fila.id)
                                },
                                on: {
                                  change: function($event) {
                                    _vm.radio_unica = fila.id
                                  }
                                }
                              })
                            ]),
                            _vm._v(" "),
                            _c("td", [
                              _c("textarea", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: fila.respuesta,
                                    expression: "fila.respuesta"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: { rows: "2", cols: "100" },
                                domProps: { value: fila.respuesta },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      fila,
                                      "respuesta",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ]),
                            _vm._v(" "),
                            _c("td", [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: fila.puntaje,
                                    expression: "fila.puntaje"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: {
                                  type: "number",
                                  min: "0",
                                  name: "puntaje"
                                },
                                domProps: { value: fila.puntaje },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      fila,
                                      "puntaje",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ]),
                            _vm._v(" "),
                            _c("td", [
                              fila.delete
                                ? _c(
                                    "button",
                                    {
                                      staticClass:
                                        "btn btn-outline-danger btn-sm float-left",
                                      attrs: { type: "button" },
                                      on: {
                                        click: function($event) {
                                          $event.preventDefault()
                                          _vm.removeRespUnica(index)
                                        }
                                      }
                                    },
                                    [_c("i", { staticClass: "fa fa-remove" })]
                                  )
                                : _vm._e()
                            ])
                          ])
                        })
                      )
                    ]
                  )
                ])
              ])
            ])
          : _vm._e(),
        _vm._v(" "),
        _vm.view_resp_multiple
          ? _c("div", [
              _c("div", { staticClass: "card" }, [
                _c("div", { staticClass: "card-body table-responsive p-0" }, [
                  _c(
                    "table",
                    { staticClass: "table table-striped table-valign-middle" },
                    [
                      _c("thead", [
                        _c("tr", [
                          _c("th", [_vm._v("Verdadera")]),
                          _vm._v(" "),
                          _c("th", [_vm._v("Posibles respuestas")]),
                          _vm._v(" "),
                          _c("th", [_vm._v("Puntaje")]),
                          _vm._v(" "),
                          _c("th", [
                            _c(
                              "button",
                              {
                                staticClass:
                                  "btn btn-outline-primary btn-sm float-left",
                                attrs: { type: "button" },
                                on: {
                                  click: function($event) {
                                    $event.preventDefault()
                                    _vm.addRespMultiple()
                                  }
                                }
                              },
                              [_c("i", { staticClass: "fa fa-plus" })]
                            )
                          ])
                        ])
                      ]),
                      _vm._v(" "),
                      _c(
                        "tbody",
                        _vm._l(_vm.a_resp_multiple, function(fila, index) {
                          return _c("tr", [
                            _c("td", [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: fila.option,
                                    expression: "fila.option"
                                  }
                                ],
                                attrs: { type: "checkbox" },
                                domProps: {
                                  checked: Array.isArray(fila.option)
                                    ? _vm._i(fila.option, null) > -1
                                    : fila.option
                                },
                                on: {
                                  change: function($event) {
                                    var $$a = fila.option,
                                      $$el = $event.target,
                                      $$c = $$el.checked ? true : false
                                    if (Array.isArray($$a)) {
                                      var $$v = null,
                                        $$i = _vm._i($$a, $$v)
                                      if ($$el.checked) {
                                        $$i < 0 &&
                                          _vm.$set(
                                            fila,
                                            "option",
                                            $$a.concat([$$v])
                                          )
                                      } else {
                                        $$i > -1 &&
                                          _vm.$set(
                                            fila,
                                            "option",
                                            $$a
                                              .slice(0, $$i)
                                              .concat($$a.slice($$i + 1))
                                          )
                                      }
                                    } else {
                                      _vm.$set(fila, "option", $$c)
                                    }
                                  }
                                }
                              })
                            ]),
                            _vm._v(" "),
                            _c("td", [
                              _c("textarea", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: fila.respuesta,
                                    expression: "fila.respuesta"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: { rows: "2", cols: "100" },
                                domProps: { value: fila.respuesta },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      fila,
                                      "respuesta",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ]),
                            _vm._v(" "),
                            _c("td", [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: fila.puntaje,
                                    expression: "fila.puntaje"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: {
                                  type: "number",
                                  min: "0",
                                  name: "puntaje"
                                },
                                domProps: { value: fila.puntaje },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      fila,
                                      "puntaje",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ]),
                            _vm._v(" "),
                            _c("td", [
                              fila.delete
                                ? _c(
                                    "button",
                                    {
                                      staticClass:
                                        "btn btn-outline-danger btn-sm float-left",
                                      attrs: { type: "button" },
                                      on: {
                                        click: function($event) {
                                          $event.preventDefault()
                                          _vm.removeRespMultiple(index)
                                        }
                                      }
                                    },
                                    [_c("i", { staticClass: "fa fa-remove" })]
                                  )
                                : _vm._e()
                            ])
                          ])
                        })
                      )
                    ]
                  )
                ])
              ])
            ])
          : _vm._e(),
        _vm._v(" "),
        _vm.view_resp_relacionar
          ? _c("div", [
              _c("div", { staticClass: "card" }, [
                _c("div", { staticClass: "card-body table-responsive p-0" }, [
                  _c(
                    "table",
                    { staticClass: "table table-striped table-valign-middle" },
                    [
                      _c("thead", [
                        _c("tr", [
                          _c("th", [_vm._v("Posibles respuestas")]),
                          _vm._v(" "),
                          _c("th", [_vm._v("Corresponde a")]),
                          _vm._v(" "),
                          _c("th", [_vm._v("Puntaje")]),
                          _vm._v(" "),
                          _c("th", [
                            _c(
                              "button",
                              {
                                staticClass:
                                  "btn btn-outline-primary btn-sm float-left",
                                attrs: { type: "button" },
                                on: {
                                  click: function($event) {
                                    $event.preventDefault()
                                    _vm.addRespRelacionar()
                                  }
                                }
                              },
                              [_c("i", { staticClass: "fa fa-plus" })]
                            )
                          ])
                        ])
                      ]),
                      _vm._v(" "),
                      _c(
                        "tbody",
                        _vm._l(_vm.a_resp_relacionar, function(fila, index) {
                          return _c("tr", [
                            _c("td", [
                              _c("textarea", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: fila.respuesta,
                                    expression: "fila.respuesta"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: { rows: "2", cols: "50" },
                                domProps: { value: fila.respuesta },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      fila,
                                      "respuesta",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ]),
                            _vm._v(" "),
                            _c("td", [
                              _c("textarea", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: fila.relacionar,
                                    expression: "fila.relacionar"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: { rows: "2", cols: "50" },
                                domProps: { value: fila.relacionar },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      fila,
                                      "relacionar",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ]),
                            _vm._v(" "),
                            _c("td", [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: fila.puntaje,
                                    expression: "fila.puntaje"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: {
                                  type: "number",
                                  min: "0",
                                  name: "puntaje"
                                },
                                domProps: { value: fila.puntaje },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      fila,
                                      "puntaje",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ]),
                            _vm._v(" "),
                            _c("td", [
                              fila.delete
                                ? _c(
                                    "button",
                                    {
                                      staticClass:
                                        "btn btn-outline-danger btn-sm float-left",
                                      attrs: { type: "button" },
                                      on: {
                                        click: function($event) {
                                          $event.preventDefault()
                                          _vm.removeRespRelacionar(index)
                                        }
                                      }
                                    },
                                    [_c("i", { staticClass: "fa fa-remove" })]
                                  )
                                : _vm._e()
                            ])
                          ])
                        })
                      )
                    ]
                  )
                ])
              ])
            ])
          : _vm._e(),
        _vm._v(" "),
        _vm.view_resp_rellenar
          ? _c("div", [
              _c("div", { staticClass: "card" }, [
                _c("div", { staticClass: "card-body table-responsive p-0" }, [
                  _c("div", { staticClass: "form-group" }, [
                    _c("strong", { staticStyle: { padding: "5px" } }, [
                      _vm._v(
                        "Parar marcar los puntos de separacion utilize [palabra]"
                      )
                    ]),
                    _vm._v(" "),
                    _c("textarea", {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.resp_rellenar,
                          expression: "resp_rellenar"
                        }
                      ],
                      staticClass: "form-control",
                      attrs: { rows: "4", placeholder: "Escribe el texto" },
                      domProps: { value: _vm.resp_rellenar },
                      on: {
                        keyup: function($event) {
                          _vm.obtenerRellenar()
                        },
                        input: function($event) {
                          if ($event.target.composing) {
                            return
                          }
                          _vm.resp_rellenar = $event.target.value
                        }
                      }
                    })
                  ]),
                  _vm._v(" "),
                  _c(
                    "table",
                    { staticClass: "table table-striped table-valign-middle" },
                    [
                      _vm._m(2),
                      _vm._v(" "),
                      _c(
                        "tbody",
                        _vm._l(_vm.a_resp_rellenar, function(fila, index) {
                          return _c("tr", [
                            _c("td", [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: fila.respuesta,
                                    expression: "fila.respuesta"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: {
                                  type: "text",
                                  name: "respuesta",
                                  readonly: ""
                                },
                                domProps: { value: fila.respuesta },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      fila,
                                      "respuesta",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ]),
                            _vm._v(" "),
                            _c("td", [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: fila.relacionar,
                                    expression: "fila.relacionar"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: { type: "text", name: "relacionar" },
                                domProps: { value: fila.relacionar },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      fila,
                                      "relacionar",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ]),
                            _vm._v(" "),
                            _c("td", [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: fila.puntaje,
                                    expression: "fila.puntaje"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: {
                                  type: "number",
                                  min: "0",
                                  name: "puntaje"
                                },
                                domProps: { value: fila.puntaje },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      fila,
                                      "puntaje",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ])
                          ])
                        })
                      )
                    ]
                  )
                ])
              ])
            ])
          : _vm._e(),
        _vm._v(" "),
        _c("div", { attrs: { id: "accordion" } }, [
          _c("div", { staticClass: "card " }, [
            _vm._m(3),
            _vm._v(" "),
            _c(
              "div",
              {
                staticClass: "panel-collapse in collapse",
                attrs: { id: "colapse1" }
              },
              [
                _c("div", { staticClass: "card-body" }, [
                  _c("div", { staticClass: "form-group" }, [
                    _c("label", [
                      _vm._v(
                        "\n                  Agregar audio(Ingles)\n                  "
                      ),
                      _c(
                        "button",
                        {
                          staticClass: "btn btn-outline-primary btn-sm",
                          attrs: {
                            type: "button",
                            disabled: _vm.disabled_play
                          },
                          on: {
                            click: function($event) {
                              $event.preventDefault()
                              _vm.playAudio()
                            }
                          }
                        },
                        [_c("i", { staticClass: "fa fa-play" })]
                      ),
                      _vm._v("   \n                ")
                    ]),
                    _vm._v(" "),
                    _c("textarea", {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.o_pregunta.texto_audio,
                          expression: "o_pregunta.texto_audio"
                        }
                      ],
                      staticClass: "form-control",
                      attrs: {
                        rows: "2",
                        placeholder:
                          "Escriba el texto que desea ser reproducido"
                      },
                      domProps: { value: _vm.o_pregunta.texto_audio },
                      on: {
                        input: function($event) {
                          if ($event.target.composing) {
                            return
                          }
                          _vm.$set(
                            _vm.o_pregunta,
                            "texto_audio",
                            $event.target.value
                          )
                        }
                      }
                    })
                  ])
                ])
              ]
            )
          ])
        ]),
        _vm._v(" "),
        _c(
          "button",
          {
            staticClass: "btn btn-outline-primary btn-sm float-left",
            attrs: { type: "button", disabled: _vm.loader_guardar },
            on: {
              click: function($event) {
                $event.preventDefault()
                _vm.guardar()
              }
            }
          },
          [
            _vm._v("\n        Crear Pregunta\n        "),
            _vm.loader_guardar
              ? _c("i", {
                  staticClass: "fa fa-spinner fa-spin fa-loader",
                  staticStyle: { "font-size": "20px" }
                })
              : _vm._e()
          ]
        )
      ])
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "callout callout-info" }, [
      _c("p", [
        _c("i", { staticClass: "fa fa-fw fa-info" }),
        _vm._v("Los campos marcados en "),
        _c("code", [_vm._v("*")]),
        _vm._v(" son obligatorios\n      \t")
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", [_vm._v("Tipo respuesta  "), _c("code", [_vm._v("*")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [
      _c("tr", [
        _c("th", [_vm._v("Opcion")]),
        _vm._v(" "),
        _c("th", [_vm._v("Respuesta")]),
        _vm._v(" "),
        _c("th", [_vm._v("Puntaje")])
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "div",
      { staticClass: "card-header", staticStyle: { padding: ".2rem 1.25rem" } },
      [
        _c(
          "h5",
          { staticClass: "card-title", staticStyle: { "font-size": "1rem" } },
          [
            _c(
              "a",
              {
                staticClass: "collapsed",
                attrs: {
                  "data-toggle": "collapse",
                  "data-parent": "#accordion",
                  href: "#colapse1",
                  "aria-expanded": "false"
                }
              },
              [
                _vm._v(
                  "\n                Parametros adicionales\n              "
                )
              ]
            )
          ]
        )
      ]
    )
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-cca48e84", module.exports)
  }
}

/***/ }),
/* 102 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(103)
/* template */
var __vue_template__ = __webpack_require__(104)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/preguntas/PreguntasEditComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-0f1b703b", Component.options)
  } else {
    hotAPI.reload("data-v-0f1b703b", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 103 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

var artyom = new Artyom();

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {
    $('#summernote').summernote({
      callbacks: {
        onImageUpload: function onImageUpload(image) {
          var sizeKB = image[0]['size'] / 1000;
          var tmp_pr = 0;
          if (sizeKB > 1100) {
            tmp_pr = 1;
            swal({
              title: "Seleccione una imagen menor o igual a 1mb",
              text: '',
              type: "info"
            });
          }
          if (image[0]['type'] != 'image/jpeg' && image[0]['type'] != 'image/png') {
            tmp_pr = 1;
            swal({
              title: "La imagen debe ser formato png o jpg",
              text: '',
              type: "info"
            });
          }
          if (tmp_pr == 0) {
            var file = image[0];
            var reader = new FileReader();
            reader.onloadend = function () {
              var image = $('<img>').attr('src', reader.result);
              $('#summernote').summernote("insertNode", image[0]);
            };
            reader.readAsDataURL(file);
          }
        }
      },
      toolbar: [['font', ['fontname']], ['para', ['ul', 'ol', 'paragraph', 'strikethrough']], ['style', ['bold', 'italic', 'underline', 'clear']], ['fontsize', ['fontsize']], ['color', ['color']], ['height', ['height']], ['groupName', ['picture', 'link', 'video', 'table', 'hr', 'fullscreen']]],
      height: 200
    });
  },
  created: function created() {
    this.base_url = base_url;
    this.idcurso = document.getElementById('idcurso').value;
    this.idejerc = document.getElementById('id').value;
    this.id = document.getElementById('id2').value;
    this.getPregunta();
  },
  data: function data() {
    return {
      idcurso: 0,
      idejerc: 0,
      id: 0,
      o_basepregunta: { 'nombre': '', 'descripicion': '', 'tipo': '', 'texto_audio': '' },
      o_pregunta: { 'nombre': '', 'descripicion': '', 'tipo': '', 'texto_audio': '' },
      e_pregunta: [],
      loader_actualizar: false,

      //respuesta Abierta
      view_resp_abierta: false,
      o_resp_abierta: {},

      //respuesta Unica
      view_resp_unica: false,
      a_resp_unica: [],
      radio_unica: 0,
      id_unica: 0,

      //respuesta Multiple
      view_resp_multiple: false,
      a_resp_multiple: [],
      id_multiple: 0,

      //respuesta relacionar
      view_resp_relacionar: false,
      a_resp_relacionar: [],
      id_relacionar: 0,

      //respuesta Rellenar
      view_resp_rellenar: false,
      a_resp_rellenar: [],
      resp_rellenar: '',
      id_rellenar: 0,

      disabled_play: false
    };
  },
  methods: {
    getPregunta: function getPregunta() {
      var _this = this;

      this.preload = true;
      var url = this.base_url + '/preguntas/editar';
      axios.post(url, { id: this.id }).then(function (response) {
        console.log(response.data);
        _this.o_pregunta = response.data.pregunta;
        $('#summernote').summernote('code', _this.o_pregunta.descripcion);
        _this.o_resp_abierta.puntaje = response.data.resp_abierta;
        _this.a_resp_unica = response.data.resp_unica;
        _this.radio_unica = response.data.radio_unica;
        _this.a_resp_multiple = response.data.resp_multiple;
        _this.a_resp_relacionar = response.data.resp_relacionar;
        _this.a_resp_rellenar = response.data.resp_rellenar;
        _this.resp_rellenar = _this.o_pregunta.textorellenar;

        if (_this.o_pregunta.texto_audio != '') document.getElementById("colapse1").classList.add("show");;

        if (_this.o_pregunta.tipo == 'abierta') _this.view_resp_abierta = true;
        if (_this.o_pregunta.tipo == 'unica') _this.view_resp_unica = true;
        if (_this.o_pregunta.tipo == 'multiple') _this.view_resp_multiple = true;
        if (_this.o_pregunta.tipo == 'relacionar') _this.view_resp_relacionar = true;
        if (_this.o_pregunta.tipo == 'rellenar') _this.view_resp_rellenar = true;
        _this.preload = false;
      }).catch(function (error) {
        _this.preload = false;
      });
    },
    actualizar: function actualizar() {
      var _this2 = this;

      this.loader_actualizar = true;
      this.o_pregunta.idcurso = this.idcurso;
      this.o_pregunta.id = this.id;
      this.o_pregunta.descripcion = $('#summernote').summernote('code');
      this.o_pregunta.resp_abierta = this.o_resp_abierta;
      this.o_pregunta.resp_unica = this.a_resp_unica;
      this.o_pregunta.radio_unica = this.radio_unica;
      this.o_pregunta.resp_multiple = this.a_resp_multiple;
      this.o_pregunta.resp_relacionar = this.a_resp_relacionar;
      this.o_pregunta.resp_rellenar = this.a_resp_rellenar;
      this.o_pregunta.texto_rellenar = this.resp_rellenar;
      var inst = this;
      var url = this.base_url + '/preguntas/actualizar';
      axios.post(url, this.o_pregunta).then(function (response) {
        _this2.loader_actualizar = false;
        _this2.e_pregunta = [];
        _this2.o_pregunta = _this2.o_basepregunta;
        swal({
          title: response.data.message,
          text: response.data.message2,
          type: "success"
        }, function () {
          inst.redirectVolver();
        });
      }).catch(function (error) {
        _this2.loader_actualizar = false;
        if (error.response.data.errors) {
          _this2.e_pregunta = error.response.data.errors;
        }
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
        console.log(error.response.data);
      });
    },
    playAudio: function playAudio() {
      var vm = this;
      artyom.initialize({
        lang: "en-US", // Más lenguajes son soportados, lee la documentación
        continuous: false, // Reconoce 1 solo comando y basta de escuchar
        listen: true, // Iniciar !
        debug: false, // Muestra un informe en la consola
        speed: 0.8 // Habla normalmente
      }).then(function () {
        //artyom.say("Artyom succesfully initialized");
        console.log("Artyom succesfully initialized");
      }).catch(function (err) {
        //artyom.say("Artyom couldn't be initialized, please check the console for errors");
        console.log("Artyom couldn't be initialized, please check the console for errors");
        console.log(err);
      });

      var palabra = this.o_pregunta.texto_audio;
      artyom.say(palabra, {
        onStart: function onStart() {
          vm.disabled_play = true;
          console.log("Comenzando a leer texto");
        },
        onEnd: function onEnd() {
          vm.disabled_play = false;
          artyom.fatality();
          console.log("Texto leido satisfactoriamente");
        }
      });
    },
    viewtipo: function viewtipo() {
      this.view_resp_abierta = false;
      this.view_resp_unica = false;
      this.view_resp_multiple = false;
      this.view_resp_relacionar = false;
      this.view_resp_rellenar = false;

      //respuesta Abierta
      if (this.o_pregunta.tipo == 'abierta') {
        this.view_resp_abierta = true;
        this.o_resp_abierta = { 'puntaje': 0 };
      }

      if (this.o_pregunta.tipo == 'unica') {
        this.view_resp_unica = true;
        this.radio_unica = 1;
        this.id_unica = 2;
        this.a_resp_unica = [{ 'id': 1, 'respuesta': '', 'puntaje': 0, 'delete': true }, { 'id': 2, 'respuesta': '', 'puntaje': 0, 'delete': true }];
      }

      if (this.o_pregunta.tipo == 'relacionar') {
        this.view_resp_relacionar = true;
        this.id_relacionar = 2;
        this.a_resp_relacionar = [{ 'id': 1, 'respuesta': '', 'relacionar': '', 'puntaje': 0, 'delete': true }, { 'id': 2, 'respuesta': '', 'relacionar': '', 'puntaje': 0, 'delete': true }];
      }

      if (this.o_pregunta.tipo == 'multiple') {
        this.view_resp_multiple = true;
        this.id_multiple = 2;
        this.a_resp_multiple = [{ 'id': 1, 'option': false, 'respuesta': '', 'puntaje': 0, 'delete': true }, { 'id': 2, 'option': false, 'respuesta': '', 'puntaje': 0, 'delete': true }];
      }

      if (this.o_pregunta.tipo == 'rellenar') {
        this.view_resp_rellenar = true;
        this.resp_rellenar = '';
        this.id_rellenar = 0;
        this.a_resp_rellenar = [];
      }
    },
    addRespUnica: function addRespUnica() {
      this.id_unica++;
      this.a_resp_unica.push({ 'id': this.id_unica, 'respuesta': '', 'puntaje': 0, 'delete': true });
    },
    removeRespUnica: function removeRespUnica(index) {
      this.a_resp_unica.splice(index, 1);
    },
    addRespMultiple: function addRespMultiple() {
      this.id_multiple++;
      this.a_resp_multiple.push({ 'id': this.id_multiple, 'option': false, 'respuesta': '', 'puntaje': 0, 'delete': true });
    },
    removeRespMultiple: function removeRespMultiple(index) {
      this.a_resp_multiple.splice(index, 1);
    },
    addRespRelacionar: function addRespRelacionar() {
      this.id_relacionar++;
      this.a_resp_relacionar.push({ 'id': this.id_relacionar, 'option': false, 'respuesta': '', 'puntaje': 0, 'delete': true });
    },
    removeRespRelacionar: function removeRespRelacionar(index) {
      this.a_resp_relacionar.splice(index, 1);
    },
    obtenerRellenar: function obtenerRellenar() {
      var cadena = this.resp_rellenar;
      this.id_rellenar = 0;
      this.a_resp_rellenar = [];

      var abrir = '0';
      var palabra = '';
      for (var i = 0; i < cadena.length; i++) {
        //var letra=cadena[i].toLowerCase();
        var letra = cadena[i];
        if (letra == '[') {
          abrir = '1';
        } else if (abrir == '1' && letra != ']') {
          palabra += letra;
        } else if (letra == ']') {
          this.a_resp_rellenar.push({ 'id': this.id_rellenar, 'respuesta': palabra, 'relacionar': '', 'puntaje': 0 });
          abrir = 0;
          palabra = '';
        }

        //if (cadena[i].toLowerCase() === caracter) indices.push(i);
      }
    },
    redirectVolver: function redirectVolver() {
      this.$root.$emit('setMenu', 'preguntas-lista');
    }
  }
});

/***/ }),
/* 104 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c("div", { staticClass: "row" }, [
      _c("div", { staticClass: "col-md-6 col-sm-6" }, [
        _c("h5", { staticClass: "m-0 text-dark" }, [
          _c("strong", [_vm._v("Actualizar pregunta")]),
          _vm._v(" "),
          _c(
            "button",
            {
              staticClass: "btn btn-tool",
              attrs: { type: "button" },
              on: {
                click: function($event) {
                  $event.preventDefault()
                  _vm.redirectVolver()
                }
              }
            },
            [
              _c("i", {
                staticClass: "fa fa-arrow-circle-left",
                staticStyle: { "font-size": "24px" }
              })
            ]
          )
        ])
      ])
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "card" }, [
      _c("div", { staticClass: "card-body" }, [
        _vm._m(0),
        _vm._v(" "),
        _c("div", { staticClass: "form-group" }, [
          _c("label", [_vm._v("Contenido de pregunta")]),
          _vm._v(" "),
          _c("div", { attrs: { id: "summernote" } }),
          _vm._v(" "),
          _vm.e_pregunta.descripcion
            ? _c("span", {
                staticClass: "text-danger",
                domProps: { textContent: _vm._s(_vm.e_pregunta.descripcion[0]) }
              })
            : _vm._e()
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "form-group" }, [
          _vm._m(1),
          _vm._v(" "),
          _c(
            "select",
            {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.o_pregunta.tipo,
                  expression: "o_pregunta.tipo"
                }
              ],
              staticClass: "form-control",
              class: [_vm.e_pregunta.tipo ? "is-invalid" : ""],
              attrs: { name: "tipo" },
              on: {
                change: [
                  function($event) {
                    var $$selectedVal = Array.prototype.filter
                      .call($event.target.options, function(o) {
                        return o.selected
                      })
                      .map(function(o) {
                        var val = "_value" in o ? o._value : o.value
                        return val
                      })
                    _vm.$set(
                      _vm.o_pregunta,
                      "tipo",
                      $event.target.multiple ? $$selectedVal : $$selectedVal[0]
                    )
                  },
                  function($event) {
                    _vm.viewtipo()
                  }
                ]
              }
            },
            [
              _c("option", { attrs: { value: "" } }, [
                _vm._v("Seleccione el tipo")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "abierta" } }, [
                _vm._v("Abierta")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "unica" } }, [_vm._v("Unica")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "multiple" } }, [
                _vm._v("Multiple")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "relacionar" } }, [
                _vm._v("Relacionar")
              ]),
              _vm._v(" "),
              _c("option", { attrs: { value: "rellenar" } }, [
                _vm._v("Rellenar")
              ])
            ]
          ),
          _vm._v(" "),
          _vm.e_pregunta.tipo
            ? _c("span", {
                staticClass: "text-danger",
                domProps: { textContent: _vm._s(_vm.e_pregunta.tipo[0]) }
              })
            : _vm._e()
        ]),
        _vm._v(" "),
        _vm.view_resp_abierta
          ? _c("div", [
              _c("div", { staticClass: "card" }, [
                _c("div", { staticClass: "card-body" }, [
                  _c("div", { staticClass: "form-group" }, [
                    _c("label", [_vm._v("Puntaje")]),
                    _vm._v(" "),
                    _c("input", {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.o_resp_abierta.puntaje,
                          expression: "o_resp_abierta.puntaje"
                        }
                      ],
                      staticClass: "form-control",
                      attrs: { type: "number", min: "0", name: "puntaje" },
                      domProps: { value: _vm.o_resp_abierta.puntaje },
                      on: {
                        input: function($event) {
                          if ($event.target.composing) {
                            return
                          }
                          _vm.$set(
                            _vm.o_resp_abierta,
                            "puntaje",
                            $event.target.value
                          )
                        }
                      }
                    })
                  ])
                ])
              ])
            ])
          : _vm._e(),
        _vm._v(" "),
        _vm.view_resp_unica
          ? _c("div", [
              _c("div", { staticClass: "card" }, [
                _c("div", { staticClass: "card-body table-responsive p-0" }, [
                  _c(
                    "table",
                    { staticClass: "table table-striped table-valign-middle" },
                    [
                      _c("thead", [
                        _c("tr", [
                          _c("th", [_vm._v("Verdadera")]),
                          _vm._v(" "),
                          _c("th", [_vm._v("Posibles respuestas")]),
                          _vm._v(" "),
                          _c("th", [_vm._v("Puntaje")]),
                          _vm._v(" "),
                          _c("th", [
                            _c(
                              "button",
                              {
                                staticClass:
                                  "btn btn-outline-primary btn-sm float-left",
                                attrs: { type: "button" },
                                on: {
                                  click: function($event) {
                                    $event.preventDefault()
                                    _vm.addRespUnica()
                                  }
                                }
                              },
                              [_c("i", { staticClass: "fa fa-plus" })]
                            )
                          ])
                        ])
                      ]),
                      _vm._v(" "),
                      _c(
                        "tbody",
                        _vm._l(_vm.a_resp_unica, function(fila, index) {
                          return _c("tr", [
                            _c("td", [
                              _vm._v("  \n                      "),
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: _vm.radio_unica,
                                    expression: "radio_unica"
                                  }
                                ],
                                attrs: { type: "radio", id: fila.id },
                                domProps: {
                                  value: fila.id,
                                  checked: _vm._q(_vm.radio_unica, fila.id)
                                },
                                on: {
                                  change: function($event) {
                                    _vm.radio_unica = fila.id
                                  }
                                }
                              })
                            ]),
                            _vm._v(" "),
                            _c("td", [
                              _c("textarea", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: fila.respuesta,
                                    expression: "fila.respuesta"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: { rows: "2", cols: "100" },
                                domProps: { value: fila.respuesta },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      fila,
                                      "respuesta",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ]),
                            _vm._v(" "),
                            _c("td", [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: fila.puntaje,
                                    expression: "fila.puntaje"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: {
                                  type: "number",
                                  min: "0",
                                  name: "puntaje"
                                },
                                domProps: { value: fila.puntaje },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      fila,
                                      "puntaje",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ]),
                            _vm._v(" "),
                            _c("td", [
                              fila.delete
                                ? _c(
                                    "button",
                                    {
                                      staticClass:
                                        "btn btn-outline-danger btn-sm float-left",
                                      attrs: { type: "button" },
                                      on: {
                                        click: function($event) {
                                          $event.preventDefault()
                                          _vm.removeRespUnica(index)
                                        }
                                      }
                                    },
                                    [_c("i", { staticClass: "fa fa-remove" })]
                                  )
                                : _vm._e()
                            ])
                          ])
                        })
                      )
                    ]
                  )
                ])
              ])
            ])
          : _vm._e(),
        _vm._v(" "),
        _vm.view_resp_multiple
          ? _c("div", [
              _c("div", { staticClass: "card" }, [
                _c("div", { staticClass: "card-body table-responsive p-0" }, [
                  _c(
                    "table",
                    { staticClass: "table table-striped table-valign-middle" },
                    [
                      _c("thead", [
                        _c("tr", [
                          _c("th", [_vm._v("Verdadera")]),
                          _vm._v(" "),
                          _c("th", [_vm._v("Posibles respuestas")]),
                          _vm._v(" "),
                          _c("th", [_vm._v("Puntaje")]),
                          _vm._v(" "),
                          _c("th", [
                            _c(
                              "button",
                              {
                                staticClass:
                                  "btn btn-outline-primary btn-sm float-left",
                                attrs: { type: "button" },
                                on: {
                                  click: function($event) {
                                    $event.preventDefault()
                                    _vm.addRespMultiple()
                                  }
                                }
                              },
                              [_c("i", { staticClass: "fa fa-plus" })]
                            )
                          ])
                        ])
                      ]),
                      _vm._v(" "),
                      _c(
                        "tbody",
                        _vm._l(_vm.a_resp_multiple, function(fila, index) {
                          return _c("tr", [
                            _c("td", [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: fila.option,
                                    expression: "fila.option"
                                  }
                                ],
                                attrs: { type: "checkbox" },
                                domProps: {
                                  checked: Array.isArray(fila.option)
                                    ? _vm._i(fila.option, null) > -1
                                    : fila.option
                                },
                                on: {
                                  change: function($event) {
                                    var $$a = fila.option,
                                      $$el = $event.target,
                                      $$c = $$el.checked ? true : false
                                    if (Array.isArray($$a)) {
                                      var $$v = null,
                                        $$i = _vm._i($$a, $$v)
                                      if ($$el.checked) {
                                        $$i < 0 &&
                                          _vm.$set(
                                            fila,
                                            "option",
                                            $$a.concat([$$v])
                                          )
                                      } else {
                                        $$i > -1 &&
                                          _vm.$set(
                                            fila,
                                            "option",
                                            $$a
                                              .slice(0, $$i)
                                              .concat($$a.slice($$i + 1))
                                          )
                                      }
                                    } else {
                                      _vm.$set(fila, "option", $$c)
                                    }
                                  }
                                }
                              })
                            ]),
                            _vm._v(" "),
                            _c("td", [
                              _c("textarea", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: fila.respuesta,
                                    expression: "fila.respuesta"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: { rows: "2", cols: "100" },
                                domProps: { value: fila.respuesta },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      fila,
                                      "respuesta",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ]),
                            _vm._v(" "),
                            _c("td", [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: fila.puntaje,
                                    expression: "fila.puntaje"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: {
                                  type: "number",
                                  min: "0",
                                  name: "puntaje"
                                },
                                domProps: { value: fila.puntaje },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      fila,
                                      "puntaje",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ]),
                            _vm._v(" "),
                            _c("td", [
                              fila.delete
                                ? _c(
                                    "button",
                                    {
                                      staticClass:
                                        "btn btn-outline-danger btn-sm float-left",
                                      attrs: { type: "button" },
                                      on: {
                                        click: function($event) {
                                          $event.preventDefault()
                                          _vm.removeRespMultiple(index)
                                        }
                                      }
                                    },
                                    [_c("i", { staticClass: "fa fa-remove" })]
                                  )
                                : _vm._e()
                            ])
                          ])
                        })
                      )
                    ]
                  )
                ])
              ])
            ])
          : _vm._e(),
        _vm._v(" "),
        _vm.view_resp_relacionar
          ? _c("div", [
              _c("div", { staticClass: "card" }, [
                _c("div", { staticClass: "card-body table-responsive p-0" }, [
                  _c(
                    "table",
                    { staticClass: "table table-striped table-valign-middle" },
                    [
                      _c("thead", [
                        _c("tr", [
                          _c("th", [_vm._v("Posibles respuestas")]),
                          _vm._v(" "),
                          _c("th", [_vm._v("Corresponde a")]),
                          _vm._v(" "),
                          _c("th", [_vm._v("Puntaje")]),
                          _vm._v(" "),
                          _c("th", [
                            _c(
                              "button",
                              {
                                staticClass:
                                  "btn btn-outline-primary btn-sm float-left",
                                attrs: { type: "button" },
                                on: {
                                  click: function($event) {
                                    $event.preventDefault()
                                    _vm.addRespRelacionar()
                                  }
                                }
                              },
                              [_c("i", { staticClass: "fa fa-plus" })]
                            )
                          ])
                        ])
                      ]),
                      _vm._v(" "),
                      _c(
                        "tbody",
                        _vm._l(_vm.a_resp_relacionar, function(fila, index) {
                          return _c("tr", [
                            _c("td", [
                              _c("textarea", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: fila.respuesta,
                                    expression: "fila.respuesta"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: { rows: "2", cols: "50" },
                                domProps: { value: fila.respuesta },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      fila,
                                      "respuesta",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ]),
                            _vm._v(" "),
                            _c("td", [
                              _c("textarea", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: fila.relacionar,
                                    expression: "fila.relacionar"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: { rows: "2", cols: "50" },
                                domProps: { value: fila.relacionar },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      fila,
                                      "relacionar",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ]),
                            _vm._v(" "),
                            _c("td", [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: fila.puntaje,
                                    expression: "fila.puntaje"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: {
                                  type: "number",
                                  min: "0",
                                  name: "puntaje"
                                },
                                domProps: { value: fila.puntaje },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      fila,
                                      "puntaje",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ]),
                            _vm._v(" "),
                            _c("td", [
                              fila.delete
                                ? _c(
                                    "button",
                                    {
                                      staticClass:
                                        "btn btn-outline-danger btn-sm float-left",
                                      attrs: { type: "button" },
                                      on: {
                                        click: function($event) {
                                          $event.preventDefault()
                                          _vm.removeRespRelacionar(index)
                                        }
                                      }
                                    },
                                    [_c("i", { staticClass: "fa fa-remove" })]
                                  )
                                : _vm._e()
                            ])
                          ])
                        })
                      )
                    ]
                  )
                ])
              ])
            ])
          : _vm._e(),
        _vm._v(" "),
        _vm.view_resp_rellenar
          ? _c("div", [
              _c("div", { staticClass: "card" }, [
                _c("div", { staticClass: "card-body table-responsive p-0" }, [
                  _c("div", { staticClass: "form-group" }, [
                    _c("strong", { staticStyle: { padding: "5px" } }, [
                      _vm._v(
                        "Parar marcar los puntos de separacion utilize [palabra]"
                      )
                    ]),
                    _vm._v(" "),
                    _c("textarea", {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.resp_rellenar,
                          expression: "resp_rellenar"
                        }
                      ],
                      staticClass: "form-control",
                      attrs: { rows: "4", placeholder: "Escribe el texto" },
                      domProps: { value: _vm.resp_rellenar },
                      on: {
                        keyup: function($event) {
                          _vm.obtenerRellenar()
                        },
                        input: function($event) {
                          if ($event.target.composing) {
                            return
                          }
                          _vm.resp_rellenar = $event.target.value
                        }
                      }
                    })
                  ]),
                  _vm._v(" "),
                  _c(
                    "table",
                    { staticClass: "table table-striped table-valign-middle" },
                    [
                      _vm._m(2),
                      _vm._v(" "),
                      _c(
                        "tbody",
                        _vm._l(_vm.a_resp_rellenar, function(fila, index) {
                          return _c("tr", [
                            _c("td", [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: fila.respuesta,
                                    expression: "fila.respuesta"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: {
                                  type: "text",
                                  name: "respuesta",
                                  readonly: ""
                                },
                                domProps: { value: fila.respuesta },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      fila,
                                      "respuesta",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ]),
                            _vm._v(" "),
                            _c("td", [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: fila.relacionar,
                                    expression: "fila.relacionar"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: { type: "text", name: "relacionar" },
                                domProps: { value: fila.relacionar },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      fila,
                                      "relacionar",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ]),
                            _vm._v(" "),
                            _c("td", [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: fila.puntaje,
                                    expression: "fila.puntaje"
                                  }
                                ],
                                staticClass: "form-control",
                                attrs: {
                                  type: "number",
                                  min: "0",
                                  name: "puntaje"
                                },
                                domProps: { value: fila.puntaje },
                                on: {
                                  input: function($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      fila,
                                      "puntaje",
                                      $event.target.value
                                    )
                                  }
                                }
                              })
                            ])
                          ])
                        })
                      )
                    ]
                  )
                ])
              ])
            ])
          : _vm._e(),
        _vm._v(" "),
        _c("div", { attrs: { id: "accordion" } }, [
          _c("div", { staticClass: "card " }, [
            _vm._m(3),
            _vm._v(" "),
            _c(
              "div",
              {
                staticClass: "panel-collapse in collapse",
                attrs: { id: "colapse1" }
              },
              [
                _c("div", { staticClass: "card-body" }, [
                  _c("div", { staticClass: "form-group" }, [
                    _c("label", [
                      _vm._v(
                        "\n                  Agregar audio(Ingles)\n                  "
                      ),
                      _c(
                        "button",
                        {
                          staticClass: "btn btn-outline-primary btn-sm",
                          attrs: {
                            type: "button",
                            disabled: _vm.disabled_play
                          },
                          on: {
                            click: function($event) {
                              $event.preventDefault()
                              _vm.playAudio()
                            }
                          }
                        },
                        [_c("i", { staticClass: "fa fa-play" })]
                      ),
                      _vm._v("   \n                ")
                    ]),
                    _vm._v(" "),
                    _c("textarea", {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.o_pregunta.texto_audio,
                          expression: "o_pregunta.texto_audio"
                        }
                      ],
                      staticClass: "form-control",
                      attrs: {
                        rows: "2",
                        placeholder:
                          "Escriba el texto que desea ser reproducido"
                      },
                      domProps: { value: _vm.o_pregunta.texto_audio },
                      on: {
                        input: function($event) {
                          if ($event.target.composing) {
                            return
                          }
                          _vm.$set(
                            _vm.o_pregunta,
                            "texto_audio",
                            $event.target.value
                          )
                        }
                      }
                    })
                  ])
                ])
              ]
            )
          ])
        ]),
        _vm._v(" "),
        _c(
          "button",
          {
            staticClass: "btn btn-outline-primary btn-sm float-left",
            attrs: { type: "button", disabled: _vm.loader_actualizar },
            on: {
              click: function($event) {
                $event.preventDefault()
                _vm.actualizar()
              }
            }
          },
          [
            _vm._v("\n        Actualizar Pregunta\n        "),
            _vm.loader_actualizar
              ? _c("i", {
                  staticClass: "fa fa-spinner fa-spin fa-loader",
                  staticStyle: { "font-size": "20px" }
                })
              : _vm._e()
          ]
        )
      ])
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "callout callout-info" }, [
      _c("p", [
        _c("i", { staticClass: "fa fa-fw fa-info" }),
        _vm._v("Los campos marcados en "),
        _c("code", [_vm._v("*")]),
        _vm._v(" son obligatorios\n      \t")
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", [_vm._v("Tipo respuesta  "), _c("code", [_vm._v("*")])])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [
      _c("tr", [
        _c("th", [_vm._v("Opcion")]),
        _vm._v(" "),
        _c("th", [_vm._v("Respuesta")]),
        _vm._v(" "),
        _c("th", [_vm._v("Puntaje")])
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "div",
      { staticClass: "card-header", staticStyle: { padding: ".2rem 1.25rem" } },
      [
        _c(
          "h5",
          { staticClass: "card-title", staticStyle: { "font-size": "1rem" } },
          [
            _c(
              "a",
              {
                staticClass: "collapsed",
                attrs: {
                  "data-toggle": "collapse",
                  "data-parent": "#accordion",
                  href: "#colapse1",
                  "aria-expanded": "false"
                }
              },
              [
                _vm._v(
                  "\n                Parametros adicionales\n              "
                )
              ]
            )
          ]
        )
      ]
    )
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-0f1b703b", module.exports)
  }
}

/***/ }),
/* 105 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(106)
/* template */
var __vue_template__ = __webpack_require__(107)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/resultados/ResultadosComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-44e7e8b9", Component.options)
  } else {
    hotAPI.reload("data-v-44e7e8b9", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 106 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {
    console.log('Component integrantes mounted.');
  },
  created: function created() {
    this.base_url = base_url;
    this.idcurso = document.getElementById('idcurso').value;
    this.listado();
  },
  data: function data() {
    return {
      idcurso: 0,
      preload: true,
      a_integrantes: [],
      preloadmodal: false,
      a_tareas: [],
      a_examenes: []
    };
  },
  methods: {
    listado: function listado() {
      var _this = this;

      var url = base_url + '/resultados/lista';
      this.preload = true;
      axios.post(url, { idcurso: this.idcurso }).then(function (response) {
        _this.preload = false;
        _this.a_integrantes = response.data.integrantes;
      }).catch(function (error) {
        _this.preload = false;
        if (error.response.data.errors) {}
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
      });
    },
    openuser: function openuser(id) {
      var _this2 = this;

      console.log(id);
      $('#modal_resultados').modal('show');
      var url = this.base_url + '/resultados/estudiante';
      this.preloadmodal = true;
      axios.post(url, { idcurso: this.idcurso, id: id }).then(function (response) {
        _this2.preloadmodal = false;
        _this2.a_tareas = response.data.tareas;
        _this2.a_examenes = response.data.examenes;
      }).catch(function (error) {
        _this2.preloadmodal = false;
        _this2.a_tareas = [];
        _this2.a_examenes = [];
        if (error.response.data.errors) {}
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
      });
    },
    porcent: function porcent(numerador, denominador) {

      if (denominador == 0) {
        return 0;
      } else {
        return numerador / denominador * 100;
      }
    }
  }
});

/***/ }),
/* 107 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c(
      "div",
      {
        staticClass: "modal fade",
        attrs: {
          id: "modal_resultados",
          tabindex: "-1",
          role: "dialog",
          "aria-hidden": "true"
        }
      },
      [
        _c(
          "div",
          { staticClass: "modal-dialog modal-lg", attrs: { role: "document" } },
          [
            _c("div", { staticClass: "modal-content" }, [
              _vm._m(0),
              _vm._v(" "),
              _c(
                "div",
                {
                  staticClass: "modal-body",
                  staticStyle: { height: "400px", "overflow-y": "auto" }
                },
                [
                  _vm.preloadmodal
                    ? _c("div", { staticClass: "row" }, [_vm._m(1)])
                    : _vm._e(),
                  _vm._v(" "),
                  !_vm.preload
                    ? _c("div", { staticClass: "card" }, [
                        _c(
                          "div",
                          { staticClass: "card-body" },
                          [
                            _vm._m(2),
                            _vm._v(" "),
                            _vm._l(_vm.a_tareas, function(tarea) {
                              return _c(
                                "div",
                                { staticClass: "progress-group" },
                                [
                                  _c("span", {
                                    domProps: {
                                      textContent: _vm._s(tarea.nombre)
                                    }
                                  }),
                                  _vm._v(" "),
                                  _c("span", { staticClass: "float-right" }, [
                                    _c("b", [
                                      _c("span", {
                                        domProps: {
                                          textContent: _vm._s(tarea.notaes)
                                        }
                                      })
                                    ]),
                                    _vm._v("/"),
                                    _c("span", {
                                      domProps: {
                                        textContent: _vm._s(tarea.calificacion)
                                      }
                                    })
                                  ]),
                                  _vm._v(" "),
                                  _c(
                                    "div",
                                    { staticClass: "progress progress-sm" },
                                    [
                                      _c("div", {
                                        staticClass: "progress-bar bg-primary",
                                        style:
                                          "width:" +
                                          _vm.porcent(
                                            tarea.notaes,
                                            tarea.calificacion
                                          ) +
                                          "%"
                                      })
                                    ]
                                  )
                                ]
                              )
                            })
                          ],
                          2
                        )
                      ])
                    : _vm._e(),
                  _vm._v(" "),
                  !_vm.preload
                    ? _c("div", { staticClass: "card" }, [
                        _c(
                          "div",
                          { staticClass: "card-body" },
                          [
                            _vm._m(3),
                            _vm._v(" "),
                            _vm._l(_vm.a_examenes, function(examen) {
                              return _c(
                                "div",
                                { staticClass: "progress-group" },
                                [
                                  _c("span", {
                                    domProps: {
                                      textContent: _vm._s(examen.nombre)
                                    }
                                  }),
                                  _vm._v(" "),
                                  _c("span", { staticClass: "float-right" }, [
                                    _c("b", [
                                      _c("span", {
                                        domProps: {
                                          textContent: _vm._s(examen.notaes)
                                        }
                                      })
                                    ]),
                                    _vm._v("/"),
                                    _c("span", {
                                      domProps: {
                                        textContent: _vm._s(examen.notamaxima)
                                      }
                                    })
                                  ]),
                                  _vm._v(" "),
                                  _c(
                                    "div",
                                    { staticClass: "progress progress-sm" },
                                    [
                                      _c("div", {
                                        staticClass: "progress-bar bg-primary",
                                        style:
                                          "width:" +
                                          _vm.porcent(
                                            examen.notaes,
                                            examen.notamaxima
                                          ) +
                                          "%"
                                      })
                                    ]
                                  )
                                ]
                              )
                            })
                          ],
                          2
                        )
                      ])
                    : _vm._e()
                ]
              )
            ])
          ]
        )
      ]
    ),
    _vm._v(" "),
    _vm.preload ? _c("div", { staticClass: "row" }, [_vm._m(4)]) : _vm._e(),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "row" },
      _vm._l(_vm.a_integrantes, function(integrante) {
        return _c("div", { staticClass: "col-md-6 col-sm-12" }, [
          !_vm.preload
            ? _c("div", { staticClass: "card" }, [
                _c("div", { staticClass: "card-header" }, [
                  _c("div", { staticClass: "card-tools" }, [
                    _c("div", { staticClass: "btn-group" }, [
                      _c(
                        "button",
                        {
                          staticClass: "btn btn-tool",
                          attrs: { type: "button" },
                          on: {
                            click: function($event) {
                              $event.preventDefault()
                              _vm.openuser(integrante.id)
                            }
                          }
                        },
                        [
                          _c("i", {
                            staticClass: "fa  fa-list-alt",
                            staticStyle: { "font-size": "20px" }
                          })
                        ]
                      )
                    ])
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "post" }, [
                    _c("div", { staticClass: "user-block" }, [
                      _c("img", {
                        staticClass: "img-circle img-bordered",
                        attrs: { src: _vm.base_url + "/" + integrante.imagen }
                      }),
                      _vm._v(" "),
                      _c("span", { staticClass: "username" }, [
                        _c("a", [
                          _c("span", {
                            domProps: { textContent: _vm._s(integrante.nombre) }
                          })
                        ])
                      ])
                    ])
                  ])
                ])
              ])
            : _vm._e()
        ])
      })
    )
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "modal-header" }, [
      _vm._v("\n            Resultados"),
      _c(
        "button",
        {
          staticClass: "close",
          attrs: { type: "button", "data-dismiss": "modal" }
        },
        [_vm._v("×")]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", { staticClass: "text-center" }, [
      _c("strong", [_vm._v("TAREAS")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", { staticClass: "text-center" }, [
      _c("strong", [_vm._v("EXAMENES")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-44e7e8b9", module.exports)
  }
}

/***/ }),
/* 108 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(109)
/* template */
var __vue_template__ = __webpack_require__(110)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/resultados/ResultadosEstudianteComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-1cf719f2", Component.options)
  } else {
    hotAPI.reload("data-v-1cf719f2", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 109 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {},
  created: function created() {
    this.base_url = base_url;
    this.idcurso = document.getElementById('idcurso').value;
    this.listado();
  },
  data: function data() {
    return {
      idcurso: 0,
      preload: true,
      a_tareas: [],
      a_examenes: []
    };
  },
  methods: {
    listado: function listado() {
      var _this = this;

      var url = this.base_url + '/resultados/lista_es';
      this.preload = true;
      axios.post(url, { idcurso: this.idcurso }).then(function (response) {
        _this.preload = false;
        _this.a_tareas = response.data.tareas;
        _this.a_examenes = response.data.examenes;
      }).catch(function (error) {
        _this.preload = false;
        _this.a_tareas = [];
        _this.a_examenes = [];
        if (error.response.data.errors) {}
        if (error.response.data.error) {
          toastr.error(error.response.data.error, '', {
            "timeOut": "3500"
          });
        }
      });
    },
    porcent: function porcent(numerador, denominador) {

      if (denominador == 0) {
        return 0;
      } else {
        return numerador / denominador * 100;
      }
    }
  }
});

/***/ }),
/* 110 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _vm.preload ? _c("div", { staticClass: "row" }, [_vm._m(0)]) : _vm._e(),
    _vm._v(" "),
    !_vm.preload
      ? _c("div", { staticClass: "card" }, [
          _c(
            "div",
            { staticClass: "card-body" },
            [
              _vm._m(1),
              _vm._v(" "),
              _vm._l(_vm.a_tareas, function(tarea) {
                return _c("div", { staticClass: "progress-group" }, [
                  _c("span", {
                    domProps: { textContent: _vm._s(tarea.nombre) }
                  }),
                  _vm._v(" "),
                  _c("span", { staticClass: "float-right" }, [
                    _c("b", [
                      _c("span", {
                        domProps: { textContent: _vm._s(tarea.notaes) }
                      })
                    ]),
                    _vm._v(" de "),
                    _c("span", {
                      domProps: { textContent: _vm._s(tarea.calificacion) }
                    })
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "progress progress-sm" }, [
                    _c("div", {
                      staticClass: "progress-bar bg-primary",
                      style:
                        "width:" +
                        _vm.porcent(tarea.notaes, tarea.calificacion) +
                        "%"
                    })
                  ])
                ])
              })
            ],
            2
          )
        ])
      : _vm._e(),
    _vm._v(" "),
    !_vm.preload
      ? _c("div", { staticClass: "card" }, [
          _c(
            "div",
            { staticClass: "card-body" },
            [
              _vm._m(2),
              _vm._v(" "),
              _vm._l(_vm.a_examenes, function(examen) {
                return _c("div", { staticClass: "progress-group" }, [
                  _c("span", {
                    domProps: { textContent: _vm._s(examen.nombre) }
                  }),
                  _vm._v(" "),
                  _c("span", { staticClass: "float-right" }, [
                    _c("b", [
                      _c("span", {
                        domProps: { textContent: _vm._s(examen.notaes) }
                      })
                    ]),
                    _vm._v(" de "),
                    _c("span", {
                      domProps: { textContent: _vm._s(examen.notamaxima) }
                    })
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "progress progress-sm" }, [
                    _c("div", {
                      staticClass: "progress-bar bg-primary",
                      style:
                        "width:" +
                        _vm.porcent(examen.notaes, examen.notamaxima) +
                        "%"
                    })
                  ])
                ])
              })
            ],
            2
          )
        ])
      : _vm._e()
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", { staticClass: "text-center" }, [
      _c("strong", [_vm._v("TAREAS")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("p", { staticClass: "text-center" }, [
      _c("strong", [_vm._v("EXAMENES")])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-1cf719f2", module.exports)
  }
}

/***/ }),
/* 111 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(112)
/* template */
var __vue_template__ = __webpack_require__(113)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/usuarios/UsuariosListaComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-2387d38e", Component.options)
  } else {
    hotAPI.reload("data-v-2387d38e", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 112 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    mounted: function mounted() {},
    created: function created() {
        this.base_url = base_url;
        this.listado();
    },
    data: function data() {
        return {
            preload: false,
            pagination: {
                page: 0,
                per_page: 8,
                next_page: 0,
                total: 0,
                total_pages: 0,
                offset: 2,
                data: [],
                datafilter: [],
                search: '',
                keys: ["email", "nombre", "telefono", "ciudad", "direccion", "facebook", "linkedin"]
            }
        };
    },
    computed: {
        isActived: function isActived() {
            return this.pagination.page;
        },
        pagesNumbers: function pagesNumbers() {
            if (this.pagination.total_pages <= 1) {
                return [];
            }

            var from = this.pagination.page - this.pagination.offset;
            if (from < 1) {
                from = 1;
            }

            var to = from + this.pagination.offset * 2;
            if (to >= this.pagination.total_pages) {
                to = this.pagination.total_pages;
            }

            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }

            return pagesArray;
        },
        msjTables: function msjTables() {
            var cantIni = 1;
            var cantFin = 1;
            if (this.pagination.page > 1) {
                cantIni = this.pagination.pre_page * this.pagination.per_page;
            }

            if (this.pagination.page == this.pagination.total_pages) {
                cantFin = this.pagination.total;
            } else {
                if (this.pagination.page > 1) {
                    cantFin = cantIni + this.pagination.per_page;
                } else {
                    cantFin = this.pagination.per_page;
                }
            }
            var mensaje = "Mostrando " + cantIni + " a " + cantFin + " de " + this.pagination.total;
            return mensaje;
        }
    },
    methods: {
        listado: function listado() {
            var _this = this;

            var url = this.base_url + '/usuarios/lista';
            this.preload = true;
            console.log('entros');
            axios.post(url, {}).then(function (response) {
                _this.preload = false;
                console.log("**" + response.data.users);
                _this.pagination.data = response.data.users;
                _this.changePage(1);

                console.log(_this.pagination);
            }).catch(function (error) {
                _this.preload = false;
            });
        },

        /*metodos de paginacion de tablas*/
        changePage: function changePage(page) {
            var data = this.filterData(this.pagination.search, this.pagination.keys, this.pagination.data);
            this.paginator(data, page, this.pagination.per_page);
        },
        changeSearch: function changeSearch() {
            this.changePage(1);
        },
        paginator: function paginator(items, page, per_page) {

            var page = page || 1;
            var per_page = per_page || 10;
            var offset = (page - 1) * per_page;

            var paginatedItems = items.slice(offset).slice(0, per_page);
            var total_pages = Math.ceil(items.length / per_page);

            this.pagination.page = page;
            this.pagination.per_page = per_page;
            this.pagination.pre_page = page - 1 ? page - 1 : null;
            this.pagination.next_page = total_pages > page ? page + 1 : null;
            this.pagination.total = items.length;
            this.pagination.total_pages = total_pages;
            this.pagination.datafilter = paginatedItems;
        },
        filterData: function filterData(search, keys, wines) {
            var lowSearch = search.toLowerCase();
            return wines.filter(function (wine) {
                return keys.some(function (key) {
                    return String(wine[key]).toLowerCase().includes(lowSearch);
                });
            });
        }
    }
});

/***/ }),
/* 113 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _vm.preload ? _c("div", { staticClass: "row" }, [_vm._m(0)]) : _vm._e(),
    _vm._v(" "),
    !_vm.preload
      ? _c("div", { staticClass: "card" }, [
          _c("div", { staticClass: "card-header" }, [
            _c("h3", { staticClass: "card-title" }, [
              _vm._v("Lista de Usuarios")
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "card-tools" }, [
              _c(
                "div",
                {
                  staticClass: "input-group input-group-sm",
                  staticStyle: { width: "150px" }
                },
                [
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.pagination.search,
                        expression: "pagination.search"
                      }
                    ],
                    staticClass: "form-control float-right",
                    attrs: {
                      type: "text",
                      name: "table_search",
                      placeholder: "Buscar.."
                    },
                    domProps: { value: _vm.pagination.search },
                    on: {
                      keyup: function($event) {
                        _vm.changeSearch()
                      },
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(_vm.pagination, "search", $event.target.value)
                      }
                    }
                  })
                ]
              )
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "card-body table-responsive p-0" }, [
            _c("table", { staticClass: "table table-hover" }, [
              _c(
                "tbody",
                [
                  _vm._m(1),
                  _vm._v(" "),
                  _vm._l(_vm.pagination.datafilter, function(usuario) {
                    return _c("tr", [
                      _c("td", {
                        domProps: { textContent: _vm._s(usuario.id) }
                      }),
                      _vm._v(" "),
                      _c("td", {
                        domProps: { textContent: _vm._s(usuario.email) }
                      }),
                      _vm._v(" "),
                      _c("td", {
                        domProps: { textContent: _vm._s(usuario.nombre) }
                      }),
                      _vm._v(" "),
                      _c("td", {
                        domProps: { textContent: _vm._s(usuario.telefono) }
                      }),
                      _vm._v(" "),
                      _c("td", {
                        domProps: { textContent: _vm._s(usuario.ciudad) }
                      }),
                      _vm._v(" "),
                      _c("td", {
                        domProps: { textContent: _vm._s(usuario.direccion) }
                      }),
                      _vm._v(" "),
                      _c("td", {
                        domProps: { textContent: _vm._s(usuario.facebook) }
                      }),
                      _vm._v(" "),
                      _c("td", {
                        domProps: { textContent: _vm._s(usuario.linkedin) }
                      }),
                      _vm._v(" "),
                      _c("td", {
                        domProps: { textContent: _vm._s(usuario.created_at) }
                      }),
                      _vm._v(" "),
                      _c("td", {
                        domProps: {
                          textContent: _vm._s(usuario.fecha_ultimo_ingreso)
                        }
                      })
                    ])
                  })
                ],
                2
              )
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "card-footer" }, [
            _c(
              "ul",
              { staticClass: "pagination pagination-sm m-0 float-right" },
              [
                _c(
                  "li",
                  {
                    staticClass: "page-item",
                    class: [_vm.pagination.page > 1 ? "" : "disabled"]
                  },
                  [
                    _c(
                      "a",
                      {
                        staticClass: "page-link",
                        attrs: { href: "#" },
                        on: {
                          click: function($event) {
                            $event.preventDefault()
                            _vm.changePage(_vm.pagination.page - 1)
                          }
                        }
                      },
                      [_vm._v("«")]
                    )
                  ]
                ),
                _vm._v(" "),
                _vm._l(_vm.pagesNumbers, function(page) {
                  return _c(
                    "li",
                    {
                      staticClass: "page-item",
                      class: [page == _vm.isActived ? "active" : ""]
                    },
                    [
                      _c(
                        "a",
                        {
                          staticClass: "page-link",
                          attrs: { href: "#" },
                          on: {
                            click: function($event) {
                              $event.preventDefault()
                              _vm.changePage(page)
                            }
                          }
                        },
                        [
                          _c("span", {
                            domProps: { textContent: _vm._s(page) }
                          })
                        ]
                      )
                    ]
                  )
                }),
                _vm._v(" "),
                _c(
                  "li",
                  {
                    staticClass: "page-item",
                    class: [
                      _vm.pagination.page < _vm.pagination.total_pages
                        ? ""
                        : "disabled"
                    ]
                  },
                  [
                    _c(
                      "a",
                      {
                        staticClass: "page-link",
                        attrs: { href: "#" },
                        on: {
                          click: function($event) {
                            $event.preventDefault()
                            _vm.changePage(_vm.pagination.page + 1)
                          }
                        }
                      },
                      [_vm._v("»")]
                    )
                  ]
                )
              ],
              2
            )
          ])
        ])
      : _vm._e()
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-block mx-auto" }, [
      _c("i", {
        staticClass: "fa fa-circle-o-notch fa-spin",
        staticStyle: { "font-size": "80px" }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("tr", [
      _c("th", [_vm._v("#")]),
      _vm._v(" "),
      _c("th", [_vm._v("Email")]),
      _vm._v(" "),
      _c("th", [_vm._v("Nombre")]),
      _vm._v(" "),
      _c("th", [_vm._v("Telefono")]),
      _vm._v(" "),
      _c("th", [_vm._v("Ciudad")]),
      _vm._v(" "),
      _c("th", [_vm._v("Direccion")]),
      _vm._v(" "),
      _c("th", [_vm._v("Facebook")]),
      _vm._v(" "),
      _c("th", [_vm._v("Linkedin")]),
      _vm._v(" "),
      _c("th", [_vm._v("Fecha creacion")]),
      _vm._v(" "),
      _c("th", [_vm._v("Ultimo Ingreso")])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-2387d38e", module.exports)
  }
}

/***/ }),
/* 114 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(115)
/* template */
var __vue_template__ = __webpack_require__(116)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/herramientas/ReproductoComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-0dddf283", Component.options)
  } else {
    hotAPI.reload("data-v-0dddf283", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 115 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

var artyom = new Artyom();

/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {},
  created: function created() {
    this.base_url = base_url;
  },
  data: function data() {
    return {
      texto_audio: '',
      disabled_play: false,
      artyom_speed: 0.7
    };
  },
  methods: {
    playAudio: function playAudio() {
      var vm = this;
      artyom.initialize({
        lang: "en-US", // Más lenguajes son soportados, lee la documentación
        continuous: false, // Reconoce 1 solo comando y basta de escuchar
        listen: true, // Iniciar !
        debug: false, // Muestra un informe en la consola
        speed: vm.artyom_speed, // Habla normalmente,
        volume: 1
      }).then(function () {
        //artyom.say("Artyom succesfully initialized");
        console.log("Artyom succesfully initialized");
      }).catch(function (err) {
        //artyom.say("Artyom couldn't be initialized, please check the console for errors");
        console.log("Artyom couldn't be initialized, please check the console for errors");
        console.log(err);
      });

      artyom.say(vm.texto_audio, {
        onStart: function onStart() {
          vm.disabled_play = true;
          console.log("Comenzando a leer texto");
        },
        onEnd: function onEnd() {
          vm.disabled_play = false;
          console.log("Texto leido satisfactoriamente");
        }
      });
    }

  }
});

/***/ }),
/* 116 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c("div", { staticClass: "card" }, [
      _c("div", { staticClass: "card-body" }, [
        _vm._m(0),
        _vm._v(" "),
        _c("div", { staticClass: "form-group" }, [
          _c("label", { attrs: { for: "formControlRange" } }, [
            _vm._v("Velocidad ("),
            _c("span", { domProps: { textContent: _vm._s(_vm.artyom_speed) } }),
            _vm._v(")")
          ]),
          _vm._v(" "),
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.artyom_speed,
                expression: "artyom_speed"
              }
            ],
            staticClass: "form-control-range",
            attrs: { type: "range", min: "0", max: "1", step: "0.1" },
            domProps: { value: _vm.artyom_speed },
            on: {
              __r: function($event) {
                _vm.artyom_speed = $event.target.value
              }
            }
          })
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "form-group" }, [
          _c("label", [
            _c(
              "button",
              {
                staticClass: "btn btn-outline-primary btn-sm",
                attrs: { type: "button", disabled: _vm.disabled_play },
                on: {
                  click: function($event) {
                    $event.preventDefault()
                    _vm.playAudio()
                  }
                }
              },
              [
                _vm._v("\n            Reproducir "),
                _c("i", {
                  staticClass: "fa fa fa-volume-up",
                  staticStyle: { "font-size": "20px" }
                })
              ]
            ),
            _vm._v("   \n        ")
          ]),
          _vm._v(" "),
          _c("textarea", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.texto_audio,
                expression: "texto_audio"
              }
            ],
            staticClass: "form-control",
            attrs: {
              rows: "10",
              placeholder: "Escriba el texto que desea ser reproducido"
            },
            domProps: { value: _vm.texto_audio },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.texto_audio = $event.target.value
              }
            }
          })
        ])
      ])
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "callout callout-info" }, [
      _c("p", [
        _c("i", { staticClass: "fa fa-fw fa-info" }),
        _vm._v(
          "\n          Agrega una palabra o texto en ingles y da click en el boton reproducir para escucharlo,\n          recuerda que tienes la opcion de regular la velocidad de reproduccion\n      \t"
        )
      ])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-0dddf283", module.exports)
  }
}

/***/ }),
/* 117 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(118)
/* template */
var __vue_template__ = __webpack_require__(119)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/herramientas/PronunciacionComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-38df2264", Component.options)
  } else {
    hotAPI.reload("data-v-38df2264", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 118 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

var artyom = new Artyom();
/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {},
  created: function created() {
    this.base_url = base_url;
  },
  data: function data() {
    return {
      disabled_play: false,
      disabled_escuchar: false,
      disabled_evaluar: false,
      texto_escucha: ''
    };
  },
  methods: {
    playAudio: function playAudio() {
      var vm = this;
      artyom.addCommands([{
        description: "",
        indexes: [""],
        action: function action(i) {}
      }]);
      artyom.redirectRecognizedTextOutput(function (recognized, isFinal) {
        if (!isFinal) {
          var texto_voz_audio = document.getElementById("texto_voz_audio");
          texto_voz_audio.value = '';
          console.log("Dictation started by the user");
        } else {
          vm.disabled_play = false;
          var texto_voz_audio = document.getElementById("texto_voz_audio");
          texto_voz_audio.value += recognized + '\n';
          texto_voz_audio.scrollTop = texto_voz_audio.scrollHeight;
        }
      });
      artyom.initialize({
        lang: "en-GB", // Más lenguajes son soportados, lee la documentación
        continuous: false, // Reconoce 1 solo comando y basta de escuchar
        listen: true, // Iniciar !
        debug: true, // Muestra un informe en la consola
        speed: 1 // Habla normalmente
      }).then(function () {
        console.log("Artyom succesfully initialized");
        var texto_voz_audio = document.getElementById("texto_voz_audio");
        texto_voz_audio.value = '';
        vm.disabled_play = true;
      }).catch(function (err) {
        //artyom.say("Artyom couldn't be initialized, please check the console for errors");
        vm.disabled_play = false;
        console.log("Artyom couldn't be initialized, please check the console for errors");
        console.log(err);
      });
    },
    stopAudio: function stopAudio() {
      var vm = this;
      artyom.fatality();
      vm.disabled_play = false;
    },
    escucharAudio: function escucharAudio() {
      var vm = this;
      artyom.initialize({
        lang: "en-US", // Más lenguajes son soportados, lee la documentación
        continuous: false, // Reconoce 1 solo comando y basta de escuchar
        listen: true, // Iniciar !
        debug: false, // Muestra un informe en la consola
        speed: 0.6, // Habla normalmente,
        volume: 1
      }).then(function () {
        //artyom.say("Artyom succesfully initialized");
        console.log("Artyom succesfully initialized");
      }).catch(function (err) {
        //artyom.say("Artyom couldn't be initialized, please check the console for errors");
        console.log("Artyom couldn't be initialized, please check the console for errors");
        console.log(err);
      });

      artyom.say(vm.texto_escucha, {
        onStart: function onStart() {
          vm.disabled_escuchar = true;
          console.log("Comenzando a leer texto");
        },
        onEnd: function onEnd() {
          vm.disabled_escuchar = false;
          console.log("Texto leido satisfactoriamente");
        }
      });
    },
    evaluarAudio: function evaluarAudio() {
      var vm = this;

      artyom.addCommands([{
        description: "",
        indexes: [""],
        action: function action(i) {}
      }]);
      artyom.redirectRecognizedTextOutput(function (recognized, isFinal) {
        if (!isFinal) {
          //var texto_voz_audio=document.getElementById("texto_voz_audio");
          //texto_voz_audio.value ='';
          console.log("Dictation started by the user");
        } else {
          vm.disabled_evaluar = false;
          if (vm.texto_escucha.toLowerCase() == recognized) {
            document.getElementById('resultado_pronun').innerHTML = recognized + " <i class='fa fa-check'></i>";
            document.getElementById("resultado_pronun").style.color = '#4CAF50';
          } else {
            document.getElementById('resultado_pronun').innerHTML = recognized + " <i class='fa  fa-close'></i>";
            document.getElementById("resultado_pronun").style.color = '#ff0000';
          }
        }
      });
      artyom.initialize({
        lang: "en-GB", // Más lenguajes son soportados, lee la documentación
        continuous: false, // Reconoce 1 solo comando y basta de escuchar
        listen: true, // Iniciar !
        debug: true, // Muestra un informe en la consola
        speed: 1 // Habla normalmente
      }).then(function () {
        console.log("Artyom succesfully initialized");
        vm.disabled_evaluar = true;
        document.getElementById("resultado_pronun").value = '';
      }).catch(function (err) {
        vm.disabled_evaluar = false;
        console.log("Artyom couldn't be initialized, please check the console for errors");
        console.log(err);
      });
    }
  }
});

/***/ }),
/* 119 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c("div", { staticClass: "card" }, [
      _c("div", { staticClass: "card-body" }, [
        _vm._m(0),
        _vm._v(" "),
        _c("div", { staticClass: "input-group mb-3" }, [
          _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.texto_escucha,
                expression: "texto_escucha"
              }
            ],
            staticClass: "form-control",
            attrs: {
              type: "text",
              placeholder: "Palabra",
              "aria-label": "Recipient's username",
              "aria-describedby": "basic-addon2"
            },
            domProps: { value: _vm.texto_escucha },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.texto_escucha = $event.target.value
              }
            }
          }),
          _vm._v(" "),
          _c("div", { staticClass: "input-group-append" }, [
            _c(
              "button",
              {
                staticClass: "btn btn-outline-primary",
                attrs: { type: "button", disabled: _vm.disabled_escuchar },
                on: {
                  click: function($event) {
                    $event.preventDefault()
                    _vm.escucharAudio()
                  }
                }
              },
              [
                _vm._v("\n            Escuchar "),
                _c("i", { staticClass: "fa fa-volume-up" })
              ]
            )
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "form-group" }, [
          _c("label", [
            _c(
              "button",
              {
                staticClass: "btn btn-outline-primary btn-sm",
                attrs: { type: "button", disabled: _vm.disabled_evaluar },
                on: {
                  click: function($event) {
                    $event.preventDefault()
                    _vm.evaluarAudio()
                  }
                }
              },
              [
                _vm._v("\n            Hablar "),
                _c("i", {
                  staticClass: "fa fa-microphone",
                  staticStyle: { "font-size": "20px" }
                })
              ]
            ),
            _vm._v("   \n          "),
            _c("span", { attrs: { id: "resultado_pronun" } })
          ])
        ])
      ])
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "card" }, [
      _c("div", { staticClass: "card-body" }, [
        _vm._m(1),
        _vm._v(" "),
        _c("div", { staticClass: "form-group" }, [
          _c("label", [
            _c(
              "button",
              {
                staticClass: "btn btn-outline-primary btn-sm",
                attrs: { type: "button", disabled: _vm.disabled_play },
                on: {
                  click: function($event) {
                    $event.preventDefault()
                    _vm.playAudio()
                  }
                }
              },
              [
                _vm._v("\n            Hablar "),
                _c("i", { staticClass: "fa fa-microphone" })
              ]
            ),
            _vm._v("   \n          "),
            _c(
              "button",
              {
                staticClass: "btn btn-outline-danger btn-sm",
                attrs: { type: "button", disabled: !_vm.disabled_play },
                on: {
                  click: function($event) {
                    $event.preventDefault()
                    _vm.stopAudio()
                  }
                }
              },
              [
                _vm._v("\n            Detener "),
                _c("i", { staticClass: "fa fa-stop" })
              ]
            )
          ]),
          _vm._v(" "),
          _c("textarea", {
            staticClass: "form-control",
            attrs: { rows: "10", id: "texto_voz_audio" }
          })
        ])
      ])
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "callout callout-info" }, [
      _c("p", [
        _c("i", { staticClass: "fa fa-fw fa-info" }),
        _vm._v(
          "\n          Escribe la palabra a pronunciar y da en evaluar para verificar tu pronunciacion,\n        "
        )
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "callout callout-info" }, [
      _c("p", [
        _c("i", { staticClass: "fa fa-fw fa-info" }),
        _vm._v(
          "\n          Da click en el boton hablar y verifica tu pronunciacion, una vez termines de hablar da click en el boton detener para\n          ver tus resultados\n      \t"
        )
      ])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-38df2264", module.exports)
  }
}

/***/ }),
/* 120 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(121)
/* template */
var __vue_template__ = __webpack_require__(122)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/herramientas/DiccionarioComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-76e9de3a", Component.options)
  } else {
    hotAPI.reload("data-v-76e9de3a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 121 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//


/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {},
  created: function created() {
    this.base_url = base_url;
    this.url_dicc = 'https://www.wordreference.com/es/translation.asp';
  },
  data: function data() {
    return {
      url_dicc: '',
      palabra_clave: '',
      open_dicc: false
    };
  },
  methods: {
    busqueda: function busqueda() {
      var palabra_clave = this.palabra_clave;
      this.url_dicc += "?tranword=" + palabra_clave.replace(/' '/g, '%20');
      this.open_dicc = true;
    }
  }
});

/***/ }),
/* 122 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      !_vm.open_dicc
        ? _c(
            "div",
            {
              staticClass: "row justify-content-center",
              staticStyle: { "padding-top": "10%" }
            },
            [
              _c("div", { staticClass: "col-12 col-md-10 col-lg-8" }, [
                _c("form", { staticClass: "card card-sm" }, [
                  _c(
                    "div",
                    {
                      staticClass: "card-body row no-gutters align-items-center"
                    },
                    [
                      _vm._m(0),
                      _vm._v(" "),
                      _c("div", { staticClass: "col" }, [
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.palabra_clave,
                              expression: "palabra_clave"
                            }
                          ],
                          staticClass:
                            "form-control form-control-lg form-control-borderless",
                          attrs: {
                            type: "search",
                            placeholder: "Buscar palabra clave"
                          },
                          domProps: { value: _vm.palabra_clave },
                          on: {
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.palabra_clave = $event.target.value
                            }
                          }
                        })
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "col-auto" }, [
                        _c(
                          "button",
                          {
                            staticClass: "btn btn-lg btn-success ",
                            on: {
                              click: function($event) {
                                $event.preventDefault()
                                _vm.busqueda()
                              }
                            }
                          },
                          [_vm._v("Buscar")]
                        )
                      ])
                    ]
                  )
                ])
              ])
            ]
          )
        : _vm._e(),
      _vm._v(" "),
      _vm.open_dicc
        ? _c("center", [
            _c("iframe", {
              attrs: {
                src: _vm.url_dicc,
                frameborder: "0",
                allowfullscreen: ""
              }
            })
          ])
        : _vm._e()
    ],
    1
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-auto" }, [
      _c("i", { staticClass: "fa  fa-search" })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-76e9de3a", module.exports)
  }
}

/***/ })
/******/ ]);