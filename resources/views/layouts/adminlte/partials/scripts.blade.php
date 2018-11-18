
<script>var base_url = '<?php echo url('/'); ?>';</script>
<!-- jQuery -->
<script src="{{ URL::asset('rsc/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
  window.onload = function() {
    loaders = document.getElementById('loader-body');
    loaders.style.display = "none";
  };
</script>
<!-- Select 2 -->
<script src="{{ URL::asset('rsc/plugins/select2/select2.full.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ URL::asset('rsc/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ URL::asset('rsc/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ URL::asset('rsc/plugins/fastclick/fastclick.js') }}"></script>
<!-- toast -->
<script src="{{ URL::asset('plugins/toastr/toastr.js') }}"></script>
<!-- swheetalert -->
<script src="{{ URL::asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('rsc/dist/js/adminlte.js') }}"></script>
<!-- fullCalendar 2.2.5 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{ URL::asset('rsc/plugins/fullcalendar/fullcalendar.min.js') }}"></script>
<!-- vue -->
<script src="{{ URL::asset('js/vue.js') }}"></script>
<script src="{{ URL::asset('js/axios.js') }}"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.0/socket.io.js"></script>
 <script>
   var socket = io('http://localhost:8081',{ 'forceNew': true });
   socket.on('get_notifi', function(data) {
     console.log(data['mensaje']);

     var nav_notifi = document.getElementById('nav_notificaciones');
     if(nav_notifi.innerHTML==''){
        nav_notifi.innerHTML =1;
     }else{
       nav_notifi.innerHTML =parseInt(nav_notifi.innerHTML)+1;
     }
   });
 </script>
 <script>
 new Vue({
     el : '#vue-notifi',
     ready: function(){
     },
     created : function(){
       this.notificaciones();
     },
     data : {

     },
     computed : {

     },
     methods : {
       notificaciones:function(){
         var url =base_url+'/notificaciones/conteo';
         axios.post(url,{}).then(response =>{
           var conteo=response.data.notificaciones;
           var nav_notifi = document.getElementById('nav_notificaciones');
           if(nav_notifi.innerHTML==''){
              nav_notifi.innerHTML =conteo;
           }else{
             nav_notifi.innerHTML =parseInt(nav_notifi.innerHTML)+parseInt(conteo);
           }
        }).catch(error =>{
             this.loader_guardar=false;
             if(error.response.data.errors){
               this.e_tarea=error.response.data.errors;
             }
             if(error.response.data.error){
               toastr.error(error.response.data.error,'',{
                   "timeOut": "2500"
               });
             }
         });
       }
     }
 });
 </script>
