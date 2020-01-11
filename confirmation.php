<?php include 'inc/header.php'; 
include 'classes/sold_product.php'; 
$si = new soldItem;
$oid = $_GET['order_id'];
$sid = session_id();
if($_GET['order_id'] == NULL){
    die();
}else{
  $checkOrder = $si->orderCheck($oid, $sid);
  if($checkOrder == NULL){
      echo "<p style='font-size: 100px;text-align: center; text-transfrom: uppercase;color: red;margin: 100px 0;'>404 ERROR</p>";
      die();
  } 
}
?>
<div class="container confirm_container">
	<h3>-----------------Order Details--------------</h3>
		<div class="row">
			

	<div class="col-md-5">
		<iframe src="pdf/ex.php?order_id=<?php echo $_GET['order_id']; ?>&session_id=<?php echo session_id(); ?>" height="670px" width="100%"></iframe>
	</div>
	<div class="col-md-7">
		<div class="confirm-inf">
			<img src="img/confirm.png">
		<p class="page_title">Your Order Has been confirmed</p>
		<table class="table table-bordered table-striped table-custom">
    <thead>
      <tr>
        <th>Sl</th>
        <th>Particulers</th>
        <th>Details</th>
      </tr>
    </thead>
    <tbody>
<?php
      $oid = $_GET['order_id'];

$getsoldItem= $si->getSpecificSoldItem($oid);
if($getsoldItem){
  $i=0;
  while($result=$getsoldItem->fetch_assoc()){

$user_id = $result['user_id'];
$order_id = $result['order_id'];
$purchaseDate = 
$payement_mode = $result['payment_mode'];
$payement_status = $result['payment_status'];
$purchaseDate = date( "d/m/Y g:i a", strtotime($result['purchaseAt']));

?>
      <tr>
        <td>1</td>
        <td>Order No</td>
        <td>#<?php echo $order_id; ?></td>
      </tr>

      <tr>
        <td>2</td>
        <td>Order Place Date</td>
        <td><?php echo $purchaseDate; ?></td>
      </tr>


      <tr>
        <td>3</td>
        <td>Payment Status</td>
        <td><?php if($payement_status == 0){ echo "Unpaid"; }else{ echo "Paid"; } ?></td>
      </tr>
      <tr>
        <td>4</td>
        <td>Payment Method</td>
        <td><?php if($payement_mode == 1){ echo "Cash On Delivery"; }elseif($payement_mode == 2){ echo "Credit/Debit Card"; } ?></td>
      </tr>
<?php } } ?>


    </tbody>
  </table>
		</div>
<p class="page_title">Product Details</p>


  <table class="table table-bordered table-striped table-custom">
    <thead>
      <tr>
        <th>Sl</th>
        <th>Product Id</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>






		<?php 
$getcartInf= $si->getCartInformation($_GET['order_id']);


if($getcartInf){
  $j=0;
  $sum = 0;
  while($sresult=$getcartInf->fetch_assoc()){
  $j++;


$productName = $sresult['productname'];
$product_qty = $sresult['quantity'];
$price = $sresult['price'];
$total_price = $price*$product_qty;


$sum = $sum+$total_price;
$discount = $sum*.1;
$payable = $sum-$discount;

?>
      <tr>
          <td><?php echo $j; ?></td>
          <td>#<?php echo $sresult['product_id']; ?></td>
          <td><?php echo $sresult['productname']; ?></td>
          <td><?php echo $sresult['quantity']; ?></td>
          <td><?php echo $sresult['price']; ?></td>
          <td><?php echo $sum; ?></td>
      </tr>






<?php } }  ?>
      </tbody>
  </table>

  <p class="page_title">**Net Payable Amount: <?php  echo $sum ?>-<?php  echo $discount ?> = <?php echo $payable ?>Tk</p>

		<div class="pdf-link">
			<a target="_blank" href="pdf/ex.php?order_id=<?php echo $_GET['order_id']; ?>&session_id=<?php echo session_id(); ?>"><img src="img/pdf.png">Download Invoice</a>
		</div>
		
	</div>


		</div>


	
</div>

<?php include 'inc/footer.php'; ?>