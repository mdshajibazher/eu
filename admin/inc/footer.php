  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.1
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Input Mask -->
<script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- Select 2 Js -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Jquery Datatable-->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<!-- Datatable Bootstrap -->
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!--  -->
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>

<script>
  $(function () {


    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datatable
    $("#example1").DataTable();


   $('#pd-img').click(function(){
      $('#exising_image').hide();
   });







  });
</script>
</body>
</html>
<?php 

  ob_end_flush();
 ?>