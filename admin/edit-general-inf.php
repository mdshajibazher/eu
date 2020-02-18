<?php include 'inc/header.php';?>

<div class="wrapper">
  
<?php include('inc/top_nav.php'); ?>
<?php include('inc/sidebar.php'); ?>
<?php include  '../classes/general_inf.php'; ?>

<?php 

  $gi = new GeneralInf;
  if(isset($_POST['update_inf'])){
        $updateGenaralInf = $gi->updateGeneralInforamtion($_POST);
    }
?>

<script type="text/javascript">toastr.options = {"closeButton":true,"debug":false,"newestOnTop":true,"progressBar":true,"positionClass":"toast-top-right","preventDuplicates":false,"onclick":null,"showDuration":"300","hideDuration":"1000","timeOut":"2500","extendedTimeOut":"1000","showEasing":"swing","hideEasing":"linear","showMethod":"fadeIn","hideMethod":"fadeOut"};
<?php
  if(isset($updateGenaralInf)) : 
  foreach ($updateGenaralInf as  $msg) :  

    if($msg == 'success') :
  ?>
      
  toastr.success('<?php echo "General Information Updated Successfully" ?>', 'Confirmation Message');

  <?php 
      else: ?>
    toastr.error('<?php echo $msg; ?>','Error Notification');

    <?php
      endif;
       endforeach; 
      endif;
  ?>
</script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit General Information</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active"><a href="category-list.php">Category List</a></li>
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
          <div class="col-md-8 offset-md-2">


            <!-- Horizontal Form -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Edit Genereal Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="" method="POST">
                <div class="card-body">
                  
                    <?php 
                       $getGenralinf = $gi->getGeneralInforamtion();
                       if($getGenralinf) : 
                           while($getGenralinfresult = $getGenralinf->fetch_assoc()) :
                    ?>

                  <div class="form-group row">
                    <label for="site_title" class="col-sm-3 col-form-label">Site Title</label>
                    <div class="col-sm-9">                        
                      <input type="text" class="form-control" id="site_title" placeholder="Enter Category Name" name="site_title" value="<?php if(isset($_POST['site_title'])){ echo $_POST['site_title']; } else{
                            echo $getGenralinfresult['site_title'];
                      }?>">
                      <p style="color: red"><?php if(isset($updateGenaralInf['site_title'])){ echo $updateGenaralInf['site_title'];} ?></p>

                      
                      
                      
                    </div>
                    
                  </div>



                  <div class="form-group row">
                    <label for="discount" class="col-sm-3 col-form-label">Discount</label>
                    <div class="col-sm-9">                        
                      <input type="number" class="form-control" id="discount" placeholder="Enter Discount Percentage" name="discount" value="<?php if(isset($_POST['discount'])){ echo $_POST['discount']; } else{
                            echo $getGenralinfresult['discount'];
                      }?>">                      
                      
                      <p style="color: red"><?php if(isset($updateGenaralInf['discount'])){ echo $updateGenaralInf['discount'];} ?></p>
                    </div>
                    
                  </div>


                <div class="form-group row">
                    <label for="vat" class="col-sm-3 col-form-label">Vat</label>
                    <div class="col-sm-9">                        
                      <input type="number" class="form-control" id="vat" placeholder="Enter Vat Percentage" name="vat" value="<?php if(isset($_POST['vat'])){ echo $_POST['vat']; } else{
                            echo $getGenralinfresult['vat'];
                      }?>">                      
                      

                      <p style="color: red"><?php if(isset($updateGenaralInf['vat'])){ echo $updateGenaralInf['vat'];} ?></p>
                    </div>
                    
                  </div>





                <div class="form-group row">
                    <label for="shipping" class="col-sm-3 col-form-label">Shipping</label>
                    <div class="col-sm-9">                        
                      <input type="number" class="form-control" id="shipping" placeholder="Enter Shipping Amount" name="shipping" value="<?php if(isset($_POST['shipping'])){ echo $_POST['shipping']; } else{
                            echo $getGenralinfresult['shipping'];
                      }?>">                      
                      
                      <p style="color: red"><?php if(isset($updateGenaralInf['shipping'])){ echo $updateGenaralInf['shipping'];} ?></p>
                    </div>
                    
                  </div>


              <?php endwhile; endif; ?>

                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-warning" name="update_inf">Update</button>
                  
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->

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