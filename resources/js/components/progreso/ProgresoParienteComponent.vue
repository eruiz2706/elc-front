<template>
<div>
  <div class="row" v-if="preload">
    <div class="d-block mx-auto" >
      <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
    </div>
  </div>

  <div class="card" v-for="(progreso,index) in a_progreso">
    <div class="card-header no-border">
      <h3 class="card-title" >
        <div class="progress-group">
            Modulo <span v-text='progreso.numero'></span></span>
            <span class="float-right">
              <span v-text='progreso.cantlec_leidas'></span>/<b><span v-text='progreso.cantlec'></span></b>
            </span>
            <div class="progress">
              <div class="progress-bar bg-primary" v-bind:style="'width:'+porcent(progreso.cantlec_leidas,progreso.cantlec)+'%'">Progreso modulo <span v-text='porcent(progreso.cantlec_leidas,progreso.cantlec)'></span>%</div>
            </div>
          </div>
      </h3>
  </div>
  </div>
</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component pregreso mounted.');

        },created : function(){
          this.base_url=base_url;
          this.idcurso=document.getElementById('idcurso').value;
          this.idest=document.getElementById('idest').value;
          this.listado();
        },
        data: function () {
          return {
            id : 0,
            idest:0,
            preload:false,
            a_progreso:[],
          }
        },
        methods : {
          listado:function(){
            var url =this.base_url+'/progreso/lista_pa';
            this.preload=true;
            axios.post(url,{idcurso:this.idcurso,user_id:this.idest}).then(response =>{
                this.preload=false;
                this.a_progreso=response.data.progreso;
            }).catch(error =>{
                this.preload=false;
                this.a_progreso=[];
                if(error.response.data.errors){
                }
                if(error.response.data.error){
                  toastr.error(error.response.data.error,'',{
                      "timeOut": "3500"
                  });
                }

            });
          },
          porcent:function(numerador,denominador){

            if(denominador==0){
              return 0;
            }else{
              return (numerador/denominador)*100;
            }
          }
        }
    }
</script>
