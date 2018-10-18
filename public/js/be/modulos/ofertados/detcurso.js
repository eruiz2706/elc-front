
new Vue({
    el : '#vue',
    ready: function(){

    },
    created : function(){
      var id=document.getElementById('id').value;
      this.id_curso=id;
      this.getCurso();
    },
    data : {
      loader_suscrip:false,
      id_curso :0,
      o_curso:{},
      preload :false,
    },
    computed : {

    },
    methods : {
      getCurso:function(){
          this.preload=true;
          var url =base_url+'/ofertados/e_curso/'+this.id_curso;
          axios.get(url,{}).then(response =>{
              this.o_curso=response.data.curso;
              this.preload=false;
              console.log(this.o_curso);
          }).catch(error =>{
              this.preload=false;
              console.log(error.response.data);
          });
      },
      suscribirse:function(){
        this.loader_suscrip=true;

        var url =base_url+'/ofertados/suscrip';
        axios.post(url,{idcurso:this.id_curso}).then(response =>{
            this.loader_suscrip=false;
            swal({
                title:response.data.message,
                text:response.data.message2,
                type: "success"
            },function(){
              window.location.href=base_url+'/ofertados';
            });
        }).catch(error =>{
            this.loader_suscrip=false;
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "2500"
              });
            }
            console.log(error.response.data);
        });
      }
    }
});
