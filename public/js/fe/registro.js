
new Vue({
    el : '#vue',
    ready: function(){

    },
    created : function(){

    },
    data : {
      o_userbase :{'nombre':'','email':'','password':'','repassword':'','rol':''},
      o_user:{'nombre':'','email':'','password':'','repassword':'','rol':''},
      o_recover:{'email':''},
      errores :[],
      errores_recover :[],
      loader_crear :false,
      loader_recover :false,
    },
    computed : {

    },
    methods : {
      limpiar : function(){
        this.o_user =this.o_userbase;
        this.errores=[];
        this.loader_crear=false;
      },crear: function(){
          this.loader_crear=true;
          var url =base_url+'/registro/guardar';
          axios.post(url,{
            nombre : this.o_user.nombre,
            email : this.o_user.email,
            password :this.o_user.password,
            repassword :this.o_user.repassword,
            rol :this.o_user.rol
          }).then(response =>{
              this.limpiar();
              swal({
                  title:response.data.message,
                  text:response.data.message2,
                  type: "success"
              }, function() {
                  //window.location = "login";
                  window.location = "";
              });
          }).catch(error =>{
              this.loader_crear=false;
              this.errores=error.response.data.errors;
              toastr.error(error.response.data.message,'',{
                  "timeOut": "2500"
              });
          });
      },
      recover: function(){
          this.loader_recover=true;
          var url =base_url+'/registro/recover';
          axios.post(url,{
            email : this.o_recover.email,
          }).then(response =>{
              this.errores_recover=[];
              $('#modal_recover').modal('hide');
              swal({
                  title:response.data.message,
                  text:response.data.message2,
                  type: "success"
              }, function() {
                  /*window.location = "login";*/
                  window.location = "";
              });
          }).catch(error =>{
              this.loader_recover=false;
              this.errores_recover=error.response.data.errors;
              toastr.error(error.response.data.message,'',{
                  "timeOut": "2500"
              });
          });
      },
      openregister:function(){
        this.o_user.nombre='';
        this.o_user.email='';
        this.o_user.password='';
        this.o_user.repassword='';
        this.o_user.rol='';
        this.errores=[];
        $('#modal_register').modal('show');
      },
      openrecover:function(){
        $('#modal_recover').modal('show');
        this.errores_recover=[];
      },
      crearRedes:function(provider){
        var modo =document.getElementById('counter_select');

        if(modo.value==''){
          swal({
              title:'',
              text:modo.options[modo.selectedIndex].text,
              type: "info"
          });
          return;
        }
        var url=base_url+"/redirect/"+provider+"/registro/"+modo;
        window.location.href =url;
      }
    }
});
