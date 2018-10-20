new Vue({
    el : '#vue',
    ready: function(){
    },
    created : function(){
      this.idcurso=document.getElementById('idcurso').value;
      this.listado();
      console.log('fafd');
    },
    data : {
      idcurso : 0,
      preload:false,
      a_ejercicios:[],
    },
    computed : {

    },
    methods : {
      listado:function(){
        var url =base_url+'/ejercicios/lista';
        this.preload=true;
        axios.post(url,{idcurso:this.idcurso}).then(response =>{
            this.preload=false;
            this.a_ejercicios=response.data.ejercicios;
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
      crear:function(){
        window.location.href=base_url+'/ejercicios/v_crear/'+this.idcurso;
      },
      editar:function(idejercicio){
        window.location.href=base_url+'/ejercicios/v_editar/'+this.idcurso+'/'+idejercicio;
      },
      preguntas:function(idejercicio){
        window.location.href=base_url+'/preguntas/'+this.idcurso+'/'+idejercicio;
      }

    }
});
