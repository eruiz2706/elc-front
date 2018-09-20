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
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ URL::asset('rsc/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
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
<!-- vue -->
<script src="{{ URL::asset('js/vue.js') }}"></script>
<script src="{{ URL::asset('js/axios.js') }}"></script>
