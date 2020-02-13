<?php 

include('inc/header.php');

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
  


<?php if(isset($_SESSION['custom_order_date']) && isset($_SESSION['custom_order_date'])){ ?>



<div class="row">
  <div class="col-md-9">
    <div class="confirmation-wrapper">
  <h3 style="text-align: center;">ORDER DETAILS</h3>

    <div class="confirm-inf">
      <div class="order-confirm-heading">
      <img src="img/confirm.png">
      <p>Your Order Has been confirmed</p>
      </div>
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

  

    <div class="pdf-link">
      <p class="page_title">Net Payable Amount: (<?php  echo $sum ?>-<?php  echo $discount ?>) = <?php echo $payable ?>Tk</p>
      <a class="btn btn-success" target="_blank" href="pdf/ex.php?order_id=<?php echo $_GET['order_id']; ?>&session_id=<?php echo session_id(); ?>">Download Invoice</a>
    </div>
    
        </div>     
  </div>
         <!-- End col-md-9  -->
         <div class="col-md-3">
           

              <div class="categories">
                <div class="cat-right">
            <div class="canteen-categories">
              <div class="cat-right-title">
                
                <h1>Categories</h1>
              </div>
              <ul>
                <?php $getAllCat = $ct->getAllCatWithLimit(8);
                     if($getAllCat){
                         while($catResult = $getAllCat->fetch_assoc()){
                 ?>
                <li><a href="category_view.php?id=<?php echo $catResult['id']; ?>"><i class="fa fa-arrow-right"></i><?php echo $catResult['catname']; ?></a></li>

              <?php } }?>
              </ul>
            </div>
            <div class="recent-post">
              <div class="cat-right-title">
                <h1>Recent Item</h1>
              </div>
              <ul>
                <?php 

                  $getRecentProduct = $pd->getRecentProduct(6);
                  if($getRecentProduct){
                    $i=0;
                    while($result=$getRecentProduct->fetch_assoc()){
                     
                 ?>
                <li><a href="single.php?id=<?php echo $result['productid']; ?>"><i class="fa fa-angle-right"></i><?php echo $result['productname']; ?><br><span><?php echo date( "d/m/Y g:i a", strtotime($result['time'])); ?></span></a></li>

                <?php } }  ?>

              </ul>
            </div>

          </div>
              </div>
         </div>
        </div>






     <?php  } else{

  if(isset($_POST['submit'])){
      $date       = $_POST['datepicker'];
      $serve_hour = $_POST['serve_hour'];
      
      if($date == NULL){
          $err1 = "Please Select a Specific Date using Datepicker";
      }elseif($serve_hour == 0){
           $err2 = "Please Select a Serve Hour";
      }else{
        $date_with_day_name = $date;
        $nameOfDay = date('l', strtotime($date_with_day_name));
        $_SESSION['custom_order_date'] = $date." ".$nameOfDay;
        $_SESSION['serve_hour'] = $serve_hour;
        echo "<script>window.location = ''; </script>";
      }
  }

?>

      <div class="row">
      <form class="dateinput_form" action="" method="POST">
  <div class="form-group" id="orderDate">
    <label for="exampleInputEmail1">Order Date</label>
    <input type="text" class="form-control" value="<?php if(isset($date)){ echo $date; } ?>" name="datepicker" placeholder="Enter Date Of Order" data-date-start-date="0d" readonly>
    <small class="form-text" style="color: red">
      <?php if(isset($err1)){
        echo $err1;
    }?></small>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect2">Select Serve Hour</label>
    <select class="form-control" id="exampleFormControlSelect2" name="serve_hour">
      <option value="0">-----select Serve Hour-----</option>
      <?php 

          $getServeHour = $pd->getServeHour();

          if($getServeHour) : 
          while($serve_result = $getServeHour->fetch_assoc()) :

       ?>
      <option value="<?php echo $serve_result['id']; ?>"><?php echo $serve_result['period']; ?></option>

      <?php endwhile; endif; ?>
    </select>
    <small class="form-text" style="color: red">
      <?php if(isset($err2)){
        echo $err2;
    } ?></small>
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>

      </div>





     <?php  }

      ?>
              
      

<?php include 'inc/footer.php'; ?>
            




