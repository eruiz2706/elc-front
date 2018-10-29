new Vue({
    el : '#vue',
    ready: function(){
    },
    created : function(){
      this.idcurso=document.getElementById('idcurso').value;
      this.listado();
    },
    data : {
      id : 0,
      preload:false,
      a_eventos:[],
    },
    computed : {

    },
    methods : {
      listado:function(){
        var url =base_url+'/calendario/lista';
        this.preload=true;
        axios.post(url,{idcurso:this.idcurso}).then(response =>{
            this.preload=false;
            this.a_eventos=response.data.eventos;
            console.log(this.a_eventos);
            this.addEventos();
        }).catch(error =>{
            this.preload=false;
            this.a_modulos=[];
            if(error.response.data.errors){
            }
            if(error.response.data.error){
              toastr.error(error.response.data.error,'',{
                  "timeOut": "3500"
              });
            }
        });
      },
      addEventos:function(){

        var a_eventos=[];
        for (i = 0; i < this.a_eventos.length; i++) {
          var evento=this.a_eventos[i];
          var color ='';
          if(evento.tipo=='tarea'){
            color="#17a2b8";
          }
          if(evento.tipo=='ejercicio'){
            color="#28a745";
          }

          a_eventos.push({
            title          : evento.titulo,
            start          : new Date(evento.anio,evento.mes-1,evento.dia),
            end            : new Date(evento.anio,evento.mes-1,evento.dia),
            //url            : 'http://google.com/',
            backgroundColor: color,
            borderColor    : color
          });
        }

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
          events    : a_eventos
        });
      }
    }
});
