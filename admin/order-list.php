<?php include 'inc/header.php';?>

<div class="wrapper">

<?php include('inc/top_nav.php'); ?>
<?php include('inc/sidebar.php'); ?>
<?php include  '../classes/Order.php'; ?>

<?php 
  $order = new Order;

?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Show Order Information</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <!-- <li class="breadcrumb-item active"><a href="add-product.php">Add Product</a></li> -->
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
        <h3 class="card-title">EU e-Canteen Order DataTable </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
 
            <div class="row">
                <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 5%;">Order Id</th>
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 5%;">Order Date</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 10%">Student Name</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 7%">Phone</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 10%">Serve Date</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 5%">Serve Hour</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 5%">Order Status</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 10%;">Payment Mode</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 5%">Payment Status</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 5%">Serve Status</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 15%">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                       <?php 
                            $getOrder = $order->getOrderInformation();
                            if($getOrder){
                            while($result=$getOrder->fetch_assoc()) {
                         ?>
                            

                        <tr role="row" class="odd">
  
                            <td>#<?php echo $result['order_id'];  ?></td>
                            <td><?php $order_timestamp = strtotime($result['purchaseAt']); echo date('d/m/y g:i a',$order_timestamp);?></td>
                            <td><?php echo $result['name'];  ?></td>
                            <td><?php echo $result['phone'];  ?></td>
                            <td><?php echo $result['custom_order_date'];  ?></td>

                            <td><?php echo $result['period'];  ?></td>

                            <td><?php if($result['order_status'] == 0){ echo '<span class="badge bg-warning">pending</span>'; }else{ echo '<span class="badge bg-success">Approved</span>'; }  ?></td>

                            <td ><?php echo $result['mode']; ?></td>

                            <td><?php if($result['payment_status'] == 0){ echo '<span class="badge bg-danger">unpaid</span>'; }else{ echo '<span class="badge bg-success">paid</span>'; }  ?></td>

                            <td><?php if($result['delivery_status'] == 0){ echo '<span class="badge bg-warning">pending</span>'; }else{ echo '<span class="badge bg-success">served</span>'; }  ?></td>

                            <td><a class="btn btn-primary btn-sm" href="order-details.php?id=<?php echo $result['order_id']; ?>">Details</a></td>
                          </tr>
       

                        <?php } } ?>
                           
                        </tbody>
                        <tfoot>
                          <tr>
    
                                <th rowspan="1" colspan="1" >Order Id</th>
                                <th rowspan="1" colspan="1" >Order Date</th>
                                <th rowspan="1" colspan="1">Student Name</th>
                                <th rowspan="1" colspan="1">Phone</th>
                                <th rowspan="1" colspan="1">Serve Date</th>
                                <th rowspan="1" colspan="1">Serve Hour</th>
                                <th rowspan="1" colspan="1">Order Status</th>
                                <th rowspan="1" colspan="1">Payment Mode</th>
                                <th rowspan="1" colspan="1">Payment Status</th>
                                <th  rowspan="1" colspan="1" >Serve Status</th>
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