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

<?php
if(isset($_GET['read']) && $_GET['read'] == 1){
    $updateNotificationReadStatus = $nt->updateNotificationReadStatus($order_id);
}
?>


<?php if(isset($_POST['payment_submit'])) : 


	 $amount = $_POST['amount'];


      $orderPayment = $order->StorePayment($order_id, $amount);
      if(isset($orderPayment)){
        $msg = $orderPayment;
      }


endif;  

?>





<?php if(isset($_POST['approval_submit'])) : 

  if($_POST['approval'] == 'approved' ) :

      $orderApproval = $order->orderApproval($order_id);
      if(isset($orderApproval)){
        $msg = $orderApproval;
      }
    endif;

endif;  ?>


<?php if(isset($_POST['cancel_submit'])) : 

  if($_POST['cancel'] == 'cancel' ) :

      $orderCancel = $order->orderCancel($order_id);
      
       if(isset($orderCancel)){
        $msg = $orderCancel;
      }
      
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
                    <i class="fas fa-concierge-bell"></i> EU e-Canteen
                    <small class="float-right">Date: <?php $order_timestamp = strtotime($result['purchaseAt']); echo date('d/m/Y g:i a',$order_timestamp);?></small>
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
                  <b>Order Status: &nbsp;
                  <?php echo $order->OrderStatus($result['order_status']); ?>
                  
                  <br>
				 <b>Payment Status: <?php  echo $order->PaymentStatus($result['payment_status']); ?></b><br>

                  
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

                  <p class="well well-sm shadow-none payment" style="margin-top: 10px;">
                   <?php echo $result['mode']; ?> <i class="fa fa-money-bill-alt"></i>
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

                        $discount = $sum*($result['discount']/100); ?>
                        <th>Discount  (<?php echo $result['discount']; ?>%)</th>
                        <td>Tk. <?php echo $discount; ?></td>
                      </tr>
                      <tr>
                        <th>Vat: (<?php echo $result['vat']; ?>%)</th>
                        <td>Tk.<?php echo  $vat = $sum*($result['vat']/100); ?></td>
                      </tr>
                      <tr>
                        <th>Shipping:</th>
                        <td>Tk. <?php echo $result['shipping']; ?> </td>
                      </tr>
                      <tr>
                        <th>Payment:</th>
                        <td>Tk. <?php if($result['amount'] == NULL){ 
                        	echo 0; 
                        }
                        else{ echo $result['amount']."&nbsp; (".date("d/m/Y g:i a",$result['paymentAt']).")";  
                         } ?>
                        	
                        </td>
                      </tr>
                      <tr>
                        <th>Total Due:</th>
                        <td><?php echo ($sum+$vat+$result['shipping']-($discount+$result['amount'])); ?></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->



            <!--Modal For Payment -->
                
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                            <form action="" method="POST">
                              <div class="form-group">
                                <label for="amount">Enter Specific Amout of this order</label>
                                <input type="text" class="form-control" name="amount" id="amount"  placeholder="Enter amount">
                                <small style="color: red" class="form-text">Total Due Of this invoice is <strong><?php echo ($sum+$vat+$result['shipping']-($discount+$result['amount'])); ?></strong></small>
                              </div>
                            
                            
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="payment_submit">Submit Payment</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                
                
                <!--Close Modal-->


              <div class="row">
                <div class="col-12">
                  <!-- Pending  -->
                  <?php if($result['order_status'] == 0) : ?>
                  
                  <form action="" method="POST">
                  <input type="hidden" name="approval" value="approved">
                  <button type="submit" class="btn btn-primary float-right" name="approval_submit" style="margin-right: 5px;">
                     Approve<i class="fas fa-question"></i>
                  </button>
                  </form>
                  
                  

                  <?php elseif($result['order_status'] == 1) : ?>

                  	<?php if($result['payment_status'] == 0) : ?>
				  
                  <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-info float-right"><i class="fas fa-dollar-sign"></i> Submit Payment</button>


                  <form action="" method="POST">
                  <input type="hidden" name="cancel" value="cancel">
                  <button type="submit" class="btn btn-danger float-right" name="cancel_submit" style="margin-right: 5px;">
                     Cancel &nbsp;<i class="fas fa-times"></i>
                  </button>
                  </form>
                  
                  <?php endif; ?>
                  
                  
                    <button type="button" class="btn btn-success float-right" style="margin-right: 5px;" disabled>
                     Approved <i class="fas fa-check-circle"></i>
                  </button>
                  

                  
                  
                  <?php elseif($result['order_status'] == 2) : ?>
                    <button type="button" class="btn btn-danger float-right" style="margin-right: 5px;" disabled>
                     Cancelled <i class="fas fa-check-circle"></i>
                  </button> <br>
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