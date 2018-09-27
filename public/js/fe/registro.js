
new Vue({
    el : '#vue',
    ready: function(){

    },
    created : function(){
      this.o_user =this.o_userbase;
    },
    data : {
      o_userbase :{'nombre':'','email':'','password':'','repassword':'','rol':''},
      o_user:{},
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
              console.log(error.response.data.error);
              toastr.error(error.response.data.message,'',{
                  "timeOut": "2500"
              });
          });
      }
    }
});
