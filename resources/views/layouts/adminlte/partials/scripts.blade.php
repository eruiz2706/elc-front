<script src="{{ URL::asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ URL::asset('plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ URL::asset('plugins/fastclick/fastclick.js') }}"></script>
<script src="{{ URL::asset('plugins/toastr/toastr.js') }}"></script>
<script src="{{ URL::asset('plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ URL::asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ URL::asset('plugins/fullcalendar/fullcalendar.min.js') }}"></script>
<script src="{{ URL::asset('plugins/vue/vue.js') }}"></script>
<script src="{{ URL::asset('plugins/axios/axios.js') }}"></script>
<script src="{{ URL::asset('rsc/js/adminlte.js') }}"></script>
<script src="{{ URL::asset('plugins/artyom/artyom.window.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.0/socket.io.js"></script>
<script>
$.widget.bridge('uibutton', $.ui.button)
window.onload = function() {
  loaders = document.getElementById('loader-body');
  loaders.style.display = "none";
};
var base_url = '<?php echo url('/'); ?>';
var ident_tk='<?php echo Auth::user()->id; ?>';
var url_servinotifi='<?php echo env('URL_SERVINOTIFI'); ?>';
</script>
<script src="{{ URL::asset('js/app.js') }}"></script>
