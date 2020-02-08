<?php include 'inc/header.php';?>

<div class="wrapper">

<?php include('inc/top_nav.php'); ?>
<?php include('inc/sidebar.php'); ?>
<?php include  '../classes/brand.php'; ?>
<?php include  '../classes/product.php'; ?>
<?php include  '../classes/category.php'; ?>

<?php 
  $pd = new Product;
  if(isset($_POST['submit'])){
        $insertProduct = $pd->productInsert($_POST, $_FILES);

    }

  $fm = new Format;

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
            <h1>Show Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active"><a href="add-product.php">Add Product</a></li>
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
        <h3 class="card-title">EU e-Canteen Product DataTable </h3>
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
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 5%;">Pd_Id</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%">Product Name</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 5%">Sku</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 15%">Description</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 10%">Price</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 10%;">Image</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 5%">Type</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 15%">Added At</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 20%">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                       <?php 
                            $pd = new Product;
                            $getProduct = $pd->getAllProduct();
                            if($getProduct){
                            $i=0;
                            while($result=$getProduct->fetch_assoc()){
                            $i++;
                         ?>
                            

                        <tr role="row" class="odd">
                            <td><?php echo $i;  ?></td>
                            <td>#<?php echo $result['productid'];  ?></td>
                            <td><?php echo $result['productname'];  ?></td>
                            <td><?php echo $result['sku'];  ?></td>
                            <td><?php echo $fm->textShorten(strip_tags($result['description']), 30)  ?><a href="#">More</a></td>
                            <td><?php echo $result['price'];  ?></td>
                            <td><img height="50px" src="<?php echo $result['image'];  ?>" alt=""></td>
                            <td><?php echo $result['type'];  ?></td>
                            <td><?php echo $result['time'];  ?></td>
                            <td><a href="edit-product.php?id=<?php echo $result['productid']; ?>">Edit</a> || <a onclick="return confirm('Are you sure you want to delete this product?')" href="?delid=<?php echo $result['productid']; ?>">Delete</a></td>
                          </tr>
       

                        <?php } } ?>
                           
                        </tbody>
                        <tfoot>
                          <tr>
                                <th rowspan="1" colspan="1">sl.</th>
                                <th rowspan="1" colspan="1" >Pd_Id</th>
                                <th rowspan="1" colspan="1">Product Name</th>
                                <th rowspan="1" colspan="1">Sku</th>
                                <th rowspan="1" colspan="1">Description</th>
                                <th rowspan="1" colspan="1">Price</th>
                                <th rowspan="1" colspan="1">Image</th>
                                <th rowspan="1" colspan="1">Type</th>
                                <th  rowspan="1" colspan="1" >Added At</th>
                                <th  rowspan="1" colspan="1" >Action</th>

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