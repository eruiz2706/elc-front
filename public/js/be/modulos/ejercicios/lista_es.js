var v_ejercicio=new Vue({
    el : '#vue',
    ready: function(){
    },
    created : function(){
      this.idcurso=document.getElementById('idcurso').value;
      this.listado();
    },
    data : {
      idcurso : 0,
      preload:false,
      a_ejercicios:[],
      preloadmodal:false,
      a_examen:[],
      idejeruser:0,
      toSecond:0,
      toMinute:0,
      loader_finalizar:false
    },
    computed : {

    },
    methods : {
      listado:function(){
        var url =base_url+'/ejercicios/lista_es';
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
                  "timeOut": "3500"
              });
            }
        });
      },
      comenzar:function(id,status_user){

        if(status_user==true){
          swal({
            title: "Ya realizaste la prueba",
            text: "click para continuar",
            type: "info"
          });
          return;
        }

        swal({
          title: "Seguro deseas comenzar",
          text: "",
          type: "info",
          showCancelButton: true,
          confirmButtonClass: "btn-success",
          confirmButtonText: "Iniciar",
          closeOnConfirm: true
        },
        function(){
          v_ejercicio.iniciar(id);
        });
      },
      iniciar:function(id){
        var url =base_url+'/ejercicios/iniciar';
        this.preloadmodal=true;
        $('#modal_ejercicio').modal({
          backdrop: 'static',
          keyboard: true,
          show: true
        });
        axios.post(url,{id:id}).then(response =>{
            this.preloadmodal=false;
            this.idejeruser=response.data.idejeruser;
            this.a_examen=response.data.preguntas;
            this.toMinute=response.data.duracion;
            this.countDown();
            console.log(this.a_examen);
        }).catch(error =>{
            this.preloadmodal=false;
            if(error.response.data.errors){
            }
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "3500"
              });
              //debe colocarse funcionalidad cerrar modal
            }
        });
      },
      finalizar:function(){
        var url =base_url+'/ejercicios/finalizar';
        this.loader_finalizar=true;
        axios.post(url,{idejeruser:this.idejeruser,examen:this.a_examen}).then(response =>{
            this.loader_finalizar=false;
            $('#modal_ejercicio').modal('hide');
            swal({
                title:response.data.message,
                text:response.data.message2,
                type: "success"
            },function(){
              location.reload();
            });
        }).catch(error =>{
            this.loader_finalizar=false;
            if(error.response.data.errors){
            }
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "3500"
              });
            }
        });
      },
      countDown:function(){
        var toSecond=this.toSecond;
        var toMinute=this.toMinute;
        toSecond=toSecond-1;
      	if(toSecond<0)
      	{
      		toSecond=59;
      		toMinute=toMinute-1;
      	}
      	document.getElementById('second').innerHTML=toSecond;
        this.toSecond=toSecond;

      	if(toMinute==0 && toSecond==0)
      	{
          swal({
              title:'Envio automatico',
              text:'Tu tiempo de prueba finalizo',
              type: "info"
          });
      		this.finalizar();
          return;
      	}
      	document.getElementById('minute').innerHTML=toMinute;
        this.toMinute=toMinute;

      	setTimeout("v_ejercicio.countDown()",1000);
      }
    }
});
