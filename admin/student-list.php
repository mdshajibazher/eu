<?php include 'inc/header.php';?>

<div class="wrapper">

<?php 
include('inc/top_nav.php');
include('inc/sidebar.php'); 
include  '../classes/Students.php'; 
?>

<?php 
  $st = new Students;
  if (isset($_GET['delid'])) {
    $delid = $_GET['delid'];
    $delPd = $pd->delProductById($delid);
  } ?>

  <script type="text/javascript">toastr.options = {"closeButton":true,"debug":false,"newestOnTop":true,"progressBar":true,"positionClass":"toast-top-right","preventDuplicates":false,"onclick":null,"showDuration":"300","hideDuration":"1000","timeOut":"5000","extendedTimeOut":"1000","showEasing":"swing","hideEasing":"linear","showMethod":"fadeIn","hideMethod":"fadeOut"};
  <?php

  if(isset($delPd)) : 
  foreach ($delPd as  $msg) :  

    if($msg == 'success') :
  ?>
      
  toastr.success('<?php echo "Product Deleted Successfull" ?>', 'Delete Confirmation');

  <?php 
      else: ?>
    toastr.error('<?php echo $msg; ?>','Error Notification');

    <?php
      endif;
       endforeach; 
      endif;
  ?>
</script>


?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Show Students</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active"><a href="add-student.php">Add Student</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
                
              <div class="card">
    <div class="card-header">
        <h3 class="card-title">EU e-Canteen Student DataTable </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
 
            <div class="row">
                <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 5%;">sl.</th>
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 15%;">Name</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 15%">Student Id</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 15%">Email</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 10%">Phone</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 20%">Address</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 10%;">Joined</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 10%;">Action</th>
                                

                            </tr>
                        </thead>
                        <tbody>
                       <?php 
                            $getStudents = $st->getTotalStudents();
                            if($getStudents){
                            $i=0;
                            while($result=$getStudents->fetch_assoc()){
                            $i++;
                         ?>
                            

                        <tr role="row" class="odd">
                            <td><?php echo $i;  ?></td>
                            <td><?php echo $result['name'];  ?></td>
                            <td><?php echo $result['student_id'];  ?></td>
                            <td><?php echo $result['email'];  ?></td>
                            <td><?php echo $result['phone'];  ?></td>
                            <td><?php echo $result['Address'];  ?></td>
                            <td><?php echo $result['created_at'];  ?></td>
                            <td><a class="btn btn-success" href=""><i class="fa fa-eye-slash"></i></a></td>
                            
                          </tr>
       

                        <?php } } ?>
                           
                        </tbody>
                        <tfoot>
                          <tr>
                                <th rowspan="1" colspan="1">sl.</th>
                                <th rowspan="1" colspan="1" >Name</th>
                                <th rowspan="1" colspan="1">Student Id</th>
                                <th rowspan="1" colspan="1">Email</th>
                                <th rowspan="1" colspan="1">Phone</th>
                                <th rowspan="1" colspan="1">Address</th>
                                <th rowspan="1" colspan="1">Joined</th>
                                <th rowspan="1" colspan="1">Action</th>

                            </tr>
                          
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <!-- /.card-body -->
</div>
          </div>
          <!--/.col (left) -->
          <!-- right column -->
   
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


<?php include('inc/footer.php'); ?>