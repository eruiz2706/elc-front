<template>
<div>
  <div class="row" v-if="preload">
    <div class="d-block mx-auto" >
      <i class="fa fa-circle-o-notch fa-spin" style="font-size:80px"></i>
    </div>
  </div>

  <div class="callout callout-info">
    <i class="icon fa fa-info"></i>
    <span v-text='traslate.msg_type_activity'></span>
    <span class="badge badge-info" v-text='traslate.homework'></span>
    <span class="badge badge-success" v-text='traslate.test'></span>
  </div>

  <div class="card card-primary">
    <div class="card-body p-0">
      <div id="calendar"></div>
    </div>
  </div>
</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component calendario mounted.');
            var date = new Date()
            var d    = date.getDate();
            var m    = date.getMonth();
            var y    = date.getFullYear();
            $('#calendar').fullCalendar({
              monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
              monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
              dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
              dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
              header    : {
                left  : 'prev,next today',
                center: 'title',
                //right : 'month,agendaWeek,agendaDay'
              },
              buttonText: {
                today: 'Hoy',
                month: 'Mes',
                week : 'Semana',
                day  : 'Dia'
              },
              editable  : false,
              droppable : false,
              //events    : a_eventos
            });
        },created : function(){
          this.base_url=base_url;
          this.idcurso=document.getElementById('idcurso').value;
          this.listado();
        },
        data: function () {
          return {
            id : 0,
            preload:false,
            a_eventos:[],
            traslate:{
              'homework':trans('backend.homework'),
              'test':trans('backend.test'),
              'msg_type_activity':trans('backend.msg_type_activity'),
            }
          }
        },
        methods : {
          listado:function(){
            var url =this.base_url+'/calendario/lista';
            this.preload=true;
            axios.post(url,{idcurso:this.idcurso}).then(response =>{
                this.preload=false;
                this.a_eventos=response.data.eventos;
                this.addEventos();
            }).catch(error =>{
                this.preload=false;
            });
          },
          addEventos:function(){
            var i;
            for (i = 0; i < this.a_eventos.length; i++) {
              var evento=this.a_eventos[i];
              var color ='';
              if(evento.tipo=='tarea'){
                color="#17a2b8";
              }
              if(evento.tipo=='ejercicio'){
                color="#28a745";
              }

              $('#calendar').fullCalendar('renderEvent', {
                title: evento.titulo,
                start: new Date(evento.anio,evento.mes-1,evento.dia),
                end: new Date(evento.anio,evento.mes-1,evento.dia),
                backgroundColor: color,
                borderColor    : color,
                allDay: true
              });
            }

          }
        }
    }
</script>
