<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include  '../classes/brand.php'; ?>
<?php include  '../classes/product.php'; ?>
<?php include  '../classes/category.php'; ?>

<?php 
  $pd = new Product;
  if(isset($_POST['submit'])){
        $insertProduct = $pd->productInsert($_POST, $_FILES);

    }
?>


<?php include('inc/header.php'); ?>

<div class="wrapper">

  <?php include('inc/top_nav.php'); ?>
  <?php include('inc/sidebar.php'); ?>

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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Product</li>
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
                      <input type="text" class="form-control" id="productname" placeholder="Enter Product Name" name="productname" value="<?php if(isset($_POST['productname'])){ echo $_POST['productname']; } ?>">

                      <?php if(isset($insertProduct['product_name'])){ echo $insertProduct['product_name'];} ?>
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

                  <?php if(isset($insertProduct['categoryId'])){ echo $insertProduct['categoryId'];} ?>

                    </div>
                  </div>




                  <div class="form-group row">
                    <label for="productimage" class="col-sm-3 col-form-label">Product Image</label>
                  <div class="col-sm-9">
                      <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>

                      <?php if(isset($insertProduct['image'])){ echo $insertProduct['image'];} ?>


                    </div>
                    
                  </div>

                  <div class="form-group row">
                    <label for="productimage" class="col-sm-3 col-form-label">Product Description</label>
                  <div class="col-sm-9">
                      <textarea name="description" class="form-control" id="" cols="30" rows="10"><?php if(isset($_POST['description'])){ echo $_POST['description']; } ?></textarea>
                      <?php if(isset($insertProduct['description'])){ echo $insertProduct['description'];} ?>
                    
                    </div>
                    
                  </div>
                  
                  

                  
                  <div class="form-group row">
                    <label for="productname" class="col-sm-3 col-form-label">Product Price</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">BDT</span>
                  </div>
                  <input type="text" class="form-control" name="price" value="<?php if(isset($_POST['description'])){ echo $_POST['description'];} ?>">
                  
                </div>
                <?php if(isset($insertProduct['price'])){ echo $insertProduct['price'];} ?>
                    </div>
                    
                  </div>


                  <div class="form-group row">
                    <label for="categoryid" class="col-sm-3 col-form-label">Product Type</label>
                    <div class="col-sm-9">
                  <select class="form-control select2bs4" style="width: 100%;" name="type">
                    <option selected="selected" value="">--Select Type--</option>
                     <option value="0">Featured</option>
                     <option value="1">General</option>
                  </select>
                  <?php if(isset($insertProduct['type'])){ echo $insertProduct['type'];} ?>
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-success" name="submit">Submit</button>
                  <button type="submit" class="btn btn-default float-right">Cancel</button>
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