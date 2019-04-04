
new Vue({
    el : '#vue',
    ready: function(){

    },
    created : function(){
      var id=document.getElementById('id').value;
      this.id=id;
      this.getCurso();
    },
    data : {
      loader_actualizar:false,
      id :0,
      o_curso:{},
      e_curso:[],
      preload :false,
      traduction:{},
      o_user:{'nombre':'','email':'','password':'','repassword':'','rol':''},
      o_recover:{'email':''},
      errores :[],
      errores_recover :[],
      loader_recover :false,
    },
    computed : {

    },
    methods : {
      getCurso:function(){
          this.preload=true;
          var url =base_url+'/getcursodet/'+this.id;
          axios.get(url,{}).then(response =>{
              this.o_curso=response.data.curso;
              this.traduction=response.data.traduction;
              this.preload=false;
              console.log(this.o_curso);
          }).catch(error =>{
              this.preload=false;
              console.log(error.response.data);
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
    openrecover:function(){
      $('#modal_recover').modal('show');
      this.errores_recover=[];
    },
  }
});
