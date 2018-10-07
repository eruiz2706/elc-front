new Vue({
    el : '#vue',
    ready: function(){
    },
    created : function(){

    },
    data : {
      o_basemodulo:{'nombre':''},
      o_modulo:{'nombre':''},
      e_modulo:[],
      loader_guardar :false,
    },
    computed : {

    },
    methods : {
      guardar:function(){
        this.loader_guardar=true;

        var url =base_url+'/modulos/guardar';
        axios.post(url,this.o_modulo).then(response =>{
            this.loader_guardar=false;
            this.e_modulo=[];
            this.o_modulo=this.o_basemodulo;
            swal({
                title:response.data.message,
                text:response.data.message2,
                type: "success"
            },function(){
                window.location.href=base_url+'/modulos';
            });
        }).catch(error =>{
            this.loader_guardar=false;
            if(error.response.data.errors){
              this.e_modulo=error.response.data.errors;
            }
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "2500"
              });
            }
            console.log(error.response.data);
        });
      },
    }
});
