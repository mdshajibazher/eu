<?php include 'inc/header.php';?>

<div class="wrapper">
  
<?php include('inc/top_nav.php'); ?>
<?php include('inc/sidebar.php'); ?>

<?php include  '../classes/brand.php'; ?>
<?php include  '../classes/category.php'; ?>

<?php 

  $ct = new Category;
  $cat_id = $_GET['id'];
  if(isset($_POST['submit'])){
        $category_name = $_POST['category_name'];
        $updateCategory = $ct->catUpdate($category_name,$cat_id);

    }
?>

<script type="text/javascript">toastr.options = {"closeButton":true,"debug":false,"newestOnTop":true,"progressBar":true,"positionClass":"toast-top-right","preventDuplicates":false,"onclick":null,"showDuration":"300","hideDuration":"1000","timeOut":"2500","extendedTimeOut":"1000","showEasing":"swing","hideEasing":"linear","showMethod":"fadeIn","hideMethod":"fadeOut"};
<?php
  if(isset($updateCategory)) : 
  foreach ($updateCategory as  $msg) :  

    if($msg == 'success') :
  ?>
      
  toastr.success('<?php echo "Category Updated Successfully" ?>', 'Confirmation Message');

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
            <h1>Edit Category</h1>
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
                <h3 class="card-title">Edit Existing Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="" method="POST">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="productname" class="col-sm-3 col-form-label">Category Name</label>
                    <div class="col-sm-9">
                        
                       <?php 
                       $getCat = $ct->getCatById($cat_id);
                       if($getCat) : 
                           while($CatResult =$getCat->fetch_assoc()) :
                       ?>
                       
                      <input type="text" class="form-control" id="category_name" placeholder="Enter Category Name" name="category_name" value="<?php if(isset($_POST['category_name'])){ echo $_POST['category_name']; } else{
                            echo $CatResult['catname'];
                      }?>">

                      <?php endwhile; endif; ?>
                      
                      <p style="color: red"><?php if(isset($updateCategory['empty'])){ echo $updateCategory['empty'];} ?></p>
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