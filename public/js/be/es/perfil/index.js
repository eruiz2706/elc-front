
new Vue({
    el : '#vue',
    ready: function(){

    },
    created : function(){
      this.getData();
    },
    data : {
      preload :false,
      errores :[],
      vrlsuscrip:0,
      user:{'nombre':'','email':'','fecha_vencimiento':''},
      loader_pagar :false,
      pagos:[]
    },
    computed : {

    },
    methods : {
      getData:function(){
          this.preload=true;
          var url ='perfil/info';
          axios.post(url,{}).then(response =>{
              this.preload=false;
              this.user=response.data.user;
              this.vrlsuscrip=response.data.vrlsuscrip;
              this.pagos=response.data.pagos;
              console.log(response.data);
          }).catch(error =>{
              this.preload=false;
              console.log(error.response.data);
          });
      },
      pagar:function(){
        console.log('realizar proceso de pago');
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

        });
      }
    }
});
