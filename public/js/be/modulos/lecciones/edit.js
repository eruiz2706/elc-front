
new Vue({
    el : '#vue',
    ready: function(){

    },
    created : function(){
      this.idcurso=document.getElementById('idcurso').value;
      this.id=document.getElementById('id').value;
      this.getLeccion();
    },
    data : {
      loader_actualizar:false,
      id :0,
      idcurso :0,
      o_leccion:{},
      e_leccion:[],
      select_mod:[],
      preload :false,
    },
    computed : {

    },
    methods : {
      getLeccion:function(){

          this.preload=true;
          var url =base_url+'/lecciones/editar';
          axios.post(url,{id:this.id,idcurso:this.idcurso}).then(response =>{
              this.select_mod=response.data.select_mod;
              this.o_leccion=response.data.leccion;
              $('#summernote').summernote('code',this.o_leccion.descripcion);
              this.preload=false;
          }).catch(error =>{
              this.preload=false;
          });
      },
      actualizar:function(){
        this.loader_actualizar=true;
        var url =base_url+'/lecciones/actualizar';
        this.o_leccion.id=this.id;
        this.o_leccion.descripcion=$('#summernote').summernote('code');
        axios.post(url,this.o_leccion).then(response =>{
            this.loader_actualizar=false;
            this.e_leccion=[];
            swal({
                title:response.data.message,
                text:response.data.message2,
                type: "success"
            },function(){
              var idcurso=document.getElementById('idcurso').value;
              window.location.href=base_url+'/lecciones/'+idcurso;
            });
        }).catch(error =>{
            this.loader_actualizar=false;
            if(error.response.data.errors){
              this.e_leccion=error.response.data.errors;
            }
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "3500"
              });
            }
        });
      },
      redirectVolver:function(){
        window.location.href=base_url+'/lecciones/'+this.idcurso;
      }
    }
});
