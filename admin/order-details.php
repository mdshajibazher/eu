<?php include 'inc/header.php';?>

<div class="wrapper">

<?php include('inc/top_nav.php'); 
include('inc/sidebar.php'); 
include  '../classes/Order.php'; 
include_once '../classes/sold_product.php';
$si = new soldItem;
?>

<?php 
  $order = new Order;
  $order_id = $_GET['id'];
?>

<?php if(isset($_POST['approval_submit'])) : 

  if($_POST['approval'] == 'approved' ) :

      $orderApproval = $order->orderApproval($order_id);

      $msg = "Your Order Has Been Approved Successfully";

      echo $msg2;
    endif;

endif;  ?>

<?php 
    
    $getSpecificOrder = $order->getSpecificOrderInformation($order_id);
    if($getSpecificOrder) :
    while($result=$getSpecificOrder->fetch_assoc()) : 
 ?>

<?php
  if(isset($msg)) :  
  ?>

<script type="text/javascript">toastr.options = {"closeButton":true,"debug":false,"newestOnTop":true,"progressBar":true,"positionClass":"toast-top-right","preventDuplicates":false,"onclick":null,"showDuration":"300","hideDuration":"1000","timeOut":"5000","extendedTimeOut":"1000","showEasing":"swing","hideEasing":"linear","showMethod":"fadeIn","hideMethod":"fadeOut"};


      
  toastr.success('<?php echo $msg; ?>', 'Confirmation Message');

</script>
  <?php
      endif;
  ?>



 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> EU e-Canteen
                    <small class="float-right">Date: <?php $order_timestamp = strtotime($result['purchaseAt']); echo date('d/m/y',$order_timestamp);?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  Order From
                  <address>
                    <strong><?php echo $result['name']; ?></strong><br>
                    <?php  echo $result['Address']; ?><br>
                    Phone: <?php  echo $result['phone']; ?> <br>
                    Email: <?php  echo $result['email']; ?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">

                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice #<?php  echo $result['order_id']; ?></b><br>
                  <br>
                  <b>Order ID: </b> #<?php  echo $result['order_id']; ?><br>
                  <b>Order Status: &nbsp;<?php echo ($result['order_status'] == 0)  ? '<span class="badge badge-danger">pending</span>' : '<span class="badge badge-success">approved</span>' ?><br>


                  
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>sl</th>
                      <th>Product Name</th>
                      <th>Qty</th>
                      <th>Image</th>
                      <th>Price</th>
                      <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php $getCartInformation = $order->getSpecificOrderCartInformation($order_id);
                          $i=0;
                          $sum = 0;
                          if($getCartInformation) : 
                              while($cart_result=$getCartInformation->fetch_assoc()) : 
                                $i++;
                          $total = ($cart_result['price']*$cart_result['quantity']);
                          $sum = $sum+$total;
                       ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $cart_result['productname']; ?></td>
                      <td><?php echo $cart_result['quantity']; ?></td>
                      <td><img width="50" class="img-thumbnail" src="<?php echo $cart_result['image']; ?>" alt=""></td>
                      <td>Tk.<?php echo $cart_result['price']; ?></td>
                      <td><?php echo $total; ?></td>
                    </tr>
                     
                  <?php endwhile; endif; ?>
                    
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods:</p>
                  <img src="../../dist/img/credit/visa.png" alt="Visa">
                  <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="../../dist/img/credit/american-express.png" alt="American Express">
                  <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                   Some Notes About Payment
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>Tk. <?php echo $sum; ?></td>
                      </tr>
                      <tr>
                        <?php
                        $getDisocunt = $si->getDiscount();
                        $discount = $sum*($getDisocunt/100); ?>
                        <th>Discount  (9.3%)</th>
                        <td>Tk. <?php echo $discount; ?></td>
                      </tr>
                      <tr>
                        <th>Shipping:</th>
                        <td>Tk. 00</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td><?php echo ($sum-$discount) ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="invoice-print.html" target="_blank" class="btn btn-info"><i class="fas fa-print"></i> Submit Payment</a>


                  <!-- Pending  -->
                  <?php if($result['order_status'] == 0) : ?>

                  
                  
                  <form action="" method="POST">
                  <input type="hidden" name="approval" value="approved">
                  <button type="submit" class="btn btn-primary float-right" name="approval_submit" style="margin-right: 5px;">
                     Approve This Order <i class="fas fa-question"></i>
                  </button>
                  </form>

                  <?php else : ?>
                    <button type="button" class="btn btn-success float-right" style="margin-right: 5px;" disabled>
                     Approved <i class="fas fa-check-circle"></i>
                  </button>
                  <?php endif;  ?>

                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php endwhile; endif; ?>

<?php include('inc/footer.php'); ?>