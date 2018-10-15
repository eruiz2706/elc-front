
new Vue({
    el : '#vue',
    ready: function(){

    },
    created : function(){

    },
    data : {
      o_userbase :{'nombre':'','email':'','password':'','repassword':'','rol':''},
      o_user:{'nombre':'','email':'','password':'','repassword':'','rol':''},
      errores :[],
      loader_crear :false,
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
                  window.location = "login";
              });
          }).catch(error =>{
              this.loader_crear=false;
              this.errores=error.response.data.errors;
              toastr.error(error.response.data.message,'',{
                  "timeOut": "2500"
              });
          });
      },
      crearRedes:function(provider){
        var modo =document.getElementById('counter_select').value;

        if(modo==''){
          swal({
              title:'',
              text:'Debe seleccionar el tipo',
              type: "error"
          });
          return;
        }
        var url=base_url+"/redirect/"+provider+"/registro/"+modo;
        window.location.href =url;
      }
    }
});
