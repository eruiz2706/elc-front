/*function para previsualizar la imagen */
jQuery(function (){
  jQuery("input[type=file]").change(function() {
    readURL(this);
  });
  const readURL = (input) => {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = (e) => {
        jQuery('#logo-user').attr('src', e.target.result)
      }
      reader.readAsDataURL(input.files[0]);
    }
  };
})

new Vue({
    el : '#vue',
    ready: function(){
    },
    created : function(){
      this.getData();
    },
    data : {
      preload :false,
      o_userbase:{'nombre':'','telefono':'','ciudad':'','direccion':'','email':'','facebook':'','linkedin':'','biografia':''},
      o_user:{'nombre':'','telefono':'','ciudad':'','direccion':'','email':'','facebook':'','linkedin':'','biografia':''},

      loader_img :false,

      loader_cambiocl :false,
      o_cambiocl:{'password':'','repassword':''},
      e_cambiocl :[],

      modo_edit:false,
      loader_act:false
    },
    computed : {

    },
    methods : {
      actualizarImg:function(){
        this.loader_img=true;
        var imagen  =$('#file_avatar')[0].files[0];
        var formData = new FormData();
        formData.append('avatar',imagen);
        var url ='perfil/actimg';
        axios.post(url,formData,{avatar:imagen}).then(response =>{
            this.loader_img=false;
            swal({
                title:response.data.message,
                text:response.data.message2,
                type: "success"
            }, function() {
                location.reload();
            });
        }).catch(error =>{
            this.loader_img=false;
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "2500"
              });
            }
            console.log(error.response.data);
        });
      },
      modalcambiocl:function(){
        this.o_cambiocl={'password':'','repassword':''};
        $('#modalcambiocl').modal('show');
      },
      cambiocl:function(){
        this.loader_cambiocl=true;
        var url ='perfil/cambiocl';
        axios.post(url,this.o_cambiocl).then(response =>{
            this.loader_cambiocl=false;
            this.e_cambiocl=[];
            $('#modalcambiocl').modal('hide');
            swal({
                title:response.data.message,
                text:response.data.message2,
                type: "success"
            });
        }).catch(error =>{
            this.loader_cambiocl=false;
            if(error.response.data.errors){
              this.e_cambiocl=error.response.data.errors;
            }
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "2500"
              });
            }
            console.log(error.response.data);
        });
      },
      getData:function(){
          this.preload=true;
          var url ='perfil/data';
          axios.post(url,{}).then(response =>{
              this.preload=false;
              this.o_user=response.data.user;
              this.o_userbase.nombre=this.o_user.nombre;
              this.o_userbase.telefono=this.o_user.telefono;
              this.o_userbase.ciudad=this.o_user.ciudad;
              this.o_userbase.direccion=this.o_user.direccion;
              this.o_userbase.email=this.o_user.email;
              this.o_userbase.facebook=this.o_user.facebook;
              this.o_userbase.linkedin=this.o_user.linkedin;
              this.o_userbase.biografia=this.o_user.biografia;
          }).catch(error =>{
              this.preload=false;
              console.log(error.response.data);
          });
      },
      editar:function(){
        this.modo_edit=true;
      },
      cancelar:function(){
        this.o_user=this.o_userbase;
        this.modo_edit=false;
      },
      actualizar:function(){
        this.loader_act=true;
        var url ='perfil/act';
        axios.post(url,this.o_user).then(response =>{
            this.loader_act=false;
            this.modo_edit=false;
            swal({
                title:response.data.message,
                text:response.data.message2,
                type: "success"
            });
        }).catch(error =>{
            this.loader_act=false;
            if(error.response.data.errors){
              //
            }
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "2500"
              });
            }
            console.log(error.response.data);
        });
      },

      pagar:function(){
        /*console.log('realizar proceso de pago');
        this.loader_pagar=true;
        var url ='perfil/pagar';
        axios.post(url,{}).then(response =>{
            this.loader_pagar=false;
            this.user.fecha_vencimiento=response.data.fecha_vencimiento;
            this.pagos=response.data.pagos;
            swal({
                title:response.data.message,
                text:response.data.message2,
                type: "success"
            });
        }).catch(error =>{
            this.loader_pagar=false;
            console.log(error.response.data.error);
            swal({
                title:error.response.message,
                text:error.response.message2,
                type: "warning"
            });

        });*/
      }
    }
});
