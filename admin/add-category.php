<?php include 'inc/header.php';?>

<div class="wrapper">
  
<?php include('inc/top_nav.php'); ?>
<?php include('inc/sidebar.php'); ?>

<?php include  '../classes/brand.php'; ?>
<?php include  '../classes/category.php'; ?>

<?php 

  $ct = new Category;
  if(isset($_POST['submit'])){
        $category_name = $_POST['category_name'];
        $insertCategory = $ct->catInsert($category_name);

    }
?>

<script type="text/javascript">toastr.options = {"closeButton":true,"debug":false,"newestOnTop":true,"progressBar":true,"positionClass":"toast-top-right","preventDuplicates":false,"onclick":null,"showDuration":"300","hideDuration":"1000","timeOut":"5000","extendedTimeOut":"1000","showEasing":"swing","hideEasing":"linear","showMethod":"fadeIn","hideMethod":"fadeOut"};
<?php
  if(isset($insertCategory)) : 
  foreach ($insertCategory as  $msg) :  

    if($msg == 'success') :
  ?>
      
  toastr.success('<?php echo "Product Inserted To Database Success" ?>', 'Confirmation Message');

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
            <h1>Add Category</h1>
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
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Add New Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="" method="POST">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="productname" class="col-sm-3 col-form-label">Category Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="category_name" placeholder="Enter Category Name" name="category_name" value="<?php if(isset($_POST['category_name'])){ echo $_POST['category_name']; }?>">

                      <p style="color: red"><?php if(isset($insertCategory['empty'])){ echo $insertCategory['empty'];} ?></p>
                    </div>
                    
                  </div>



                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                  <button type="submit" class="btn btn-info" name="submit">Submit</button>
                  
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