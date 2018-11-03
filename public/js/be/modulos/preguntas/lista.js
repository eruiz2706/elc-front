new Vue({
    el : '#vue',
    ready: function(){
    },
    created : function(){
      this.idcurso=document.getElementById('idcurso').value;
      this.idejerc=document.getElementById('idejerc').value;
      this.listado();
      console.log('fafd');
    },
    data : {
      idcurso : 0,
      idejerc : 0,
      preload:false,
      a_preguntas:[],
    },
    computed : {

    },
    methods : {
      listado:function(){
        var url =base_url+'/preguntas/lista';
        this.preload=true;
        axios.post(url,{idcurso:this.idcurso,idejerc:this.idejerc}).then(response =>{
            this.preload=false;
            this.a_preguntas=response.data.preguntas;
        }).catch(error =>{
            this.preload=false;
            if(error.response.data.errors){
            }
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "2500"
              });
            }
            console.log(error.response.data);
        });
      },
      redirectCrear:function(){
        window.location.href=base_url+'/preguntas/v_crear/'+this.idcurso+'/'+this.idejerc;
      },
      redirectEdit:function(idpregunta){
        window.location.href=base_url+'/preguntas/v_editar/'+this.idcurso+'/'+this.idejerc+'/'+idpregunta;
      },
      redirectVolver:function(){
        window.location.href=base_url+'/ejercicios/'+this.idcurso;
      }
    }
});
