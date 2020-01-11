<?php include 'inc/header.php'; 
      include('classes/sold_product.php');
?>

      <div class="container">


      
            <div class="section-title"><span>User Dashboard</span></div>
                <div class="row">
                    
                    <div class="col-md-2">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="">My Orders</a>
                            </li>
                            <li class="list-group-item">
                                <a href="">Pending Order</a>
                            </li>
                            <li class="list-group-item">
                                <a href="">Cancel Order</a>
                            </li>
                            <li class="list-group-item">
                                <a href="">Food Item Request</a>
                            </li>
                            <li class="list-group-item">
                                <a href="">Complain</a>
                            </li>
                            

                        </ul>
                    </div>
                    <div class="col-md-10">
                        <div class="card card-default">
    <div class="card-header">
        Orders
    </div>



    
    <div class="card-body">
		<table class="table table-bordered" style="font-size: 14px">
  <thead class="table-dark">
    <tr>
      <th>#</th>
      <th>Order Id</th>
      <th>Order Place Date</th>
      <th>Serving Date</th>
      <th>Serve Hour</th>     
      <th>Order Status</th>
      <th>Payment Mode</th>
      <th>Payment Status</th>
      <th>IP Address</th>
      <th>link</th>
    </tr>
  </thead>
  <tbody>
            <?php
    $si = new soldItem;
    $studentid = $_SESSION['id'];
    $getsoldItem= $si->getAllSoldItem($studentid);
    if($getsoldItem){
      $i=0;
      while($result=$getsoldItem->fetch_assoc()){

      $i++;
    $OrderPlaceDate = date( "d-m-Y g:i a", strtotime($result['purchaseAt']));

  ?>
    <tr>
      <td><?php echo $i; ?></th>
        <td>#<?php echo $result['order_id']; ?></td>
      <td><?php echo $OrderPlaceDate; ?></td>
      <td><?php echo $result['custom_order_date']; ?></td>
      <td><?php if($result['serve_hour'] == 1){ 
        echo "Lunch";
    }elseif($result['serve_hour'] == 2){
      echo "Breakfast";
    }else{
      echo "Others";
    } ?></td>
      <td><?php if($result['order_status'] == 0){ echo "Pending"; }else{ echo "Approved"; } ?></td>
      <td><?php echo $result['payment_mode'] == 1  ? "Cash On Delivery" : "Credit/Debit Card" ; ?></td>
      <td><?php echo $result['payment_status'] == 0  ? "UNPAID" : "PAID" ; ?></td>
      <td><?php echo $result['ip_address']; ?></td>
      <td><a href="/pdf/ex.php?order_id=<?php echo $result['order_id']; ?>&session_id=<?php echo $result['session_id']; ?>">Invoice</a></td>

   </tr>
    <?php } } ?>

 

  </tbody>
</table>
    </div>
</div>
</div>
        </div>
      </div>


         




<?php include 'inc/footer.php'; ?>
            



