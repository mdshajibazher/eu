<?php include 'inc/header.php';?>

<div class="wrapper">
  
<?php include('inc/top_nav.php'); ?>
<?php include('inc/sidebar.php'); ?>

<?php include  '../classes/product.php'; ?>
<?php include  '../classes/category.php'; ?>

<?php 

  $pd = new Product;
  if(isset($_POST['submit'])){
        $insertProduct = $pd->productInsert($_POST, $_FILES);

    }
?>

<script type="text/javascript">toastr.options = {"closeButton":true,"debug":false,"newestOnTop":true,"progressBar":true,"positionClass":"toast-top-right","preventDuplicates":false,"onclick":null,"showDuration":"300","hideDuration":"1000","timeOut":"5000","extendedTimeOut":"1000","showEasing":"swing","hideEasing":"linear","showMethod":"fadeIn","hideMethod":"fadeOut"};
<?php
  if(isset($insertProduct)) : 
  foreach ($insertProduct as  $msg) :  

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
            <h1>Add Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active"><a href="product-list.php">Product List</a></li>
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
                <h3 class="card-title">Add New Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="productname" class="col-sm-3 col-form-label">Product Name</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="productname" placeholder="Enter Product Name" name="productname" value="<?php if(isset($_POST['productname'])){ echo $_POST['productname']; }?>">

                      <p style="color: red"><?php if(isset($insertProduct['product_name'])){ echo $insertProduct['product_name'];} ?></p>
                    </div>
                    
                  </div>
                  <div class="form-group row">
                    <label for="categoryid" class="col-sm-3 col-form-label">Select Category</label>
                    <div class="col-sm-9">
                  <select class="form-control select2bs4" style="width: 100%;" name="categoryid">
                    <option selected="selected" value="">--Select Category--</option>
                    <?php $cat = new Category;
                    $getCat = $cat->getAllCat();
                    while($result = $getCat->fetch_assoc()) :  ?>

                        <option value="<?php echo $result['id']; ?>"><?php echo $result['catname']; ?></option>

                    <?php  endwhile; ?>
                  </select>

                  <p style="color: red"><?php if(isset($insertProduct['categoryId'])){ echo $insertProduct['categoryId'];} ?></p>

                    </div>
                  </div>




                  <div class="form-group row">
                    <label for="productimage" class="col-sm-3 col-form-label">Product Image</label>
                  <div class="col-sm-9">
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>

                      <p style="color: red"><?php if(isset($insertProduct['image'])){ echo $insertProduct['image'];} ?></p>


                    </div>
                    
                  </div>

                  <div class="form-group row">
                    <label for="productimage" class="col-sm-3 col-form-label">Product Description</label>
                  <div class="col-sm-9">
                      <textarea name="description" class="form-control" id="" cols="30" rows="10"><?php if(isset($_POST['description'])){ echo $_POST['description']; } ?></textarea>
                      <p style="color: red"><?php if(isset($insertProduct['description'])){ echo $insertProduct['description'];} ?></p>
                    
                    </div>
                    
                  </div>
                  
                  

                  
                  <div class="form-group row">
                    <label for="productname" class="col-sm-3 col-form-label">Product Price</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">BDT</span>
                  </div>
                  <input type="text" class="form-control" name="price" value="<?php if(isset($_POST['price'])){ echo $_POST['price'];} ?>">
                  
                </div>
                <p style="color: red"><?php if(isset($insertProduct['price'])){ echo $insertProduct['price'];} ?></p>
                    </div>
                    
                  </div>


                  <div class="form-group row">
                    <label for="categoryid" class="col-sm-3 col-form-label">Product Type</label>
                    <div class="col-sm-9">
                  <select class="form-control select2bs4" style="width: 100%;" name="type">
                    <option selected="selected" value="">--Select Type--</option>
                    <option value="1">General</option>
                    <option value="0">Featured</option>
                     
                  </select>
                  <p style="color: red"><?php if(isset($insertProduct['type'])){ echo $insertProduct['type'];} ?></p>
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