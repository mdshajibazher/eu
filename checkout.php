<?php
include 'inc/header.php';
include_once 'classes/sold_product.php';
include_once('lib/database.php');
include_once 'classes/Ip.php';
$ip = new Ip;
$si = new soldItem;


$oid = $_GET['order_id'];
$sid = session_id();
if($_GET['order_id'] == NULL || $_GET['session_id'] == NULL){
    die();
}else{
  $checkOrder = $si->orderCheck($oid, $sid);
  if($checkOrder == NULL){
      echo "<p style='font-size: 100px;text-align: center; text-transfrom: uppercase;color: red;margin: 100px 0;'>404 ERROR</p>";
      die();
  } 
}


if(isset($_POST['order_submit'])){
    
    $payment_mod = $_POST['payment_mod']; 
    


    


  $db = new Database;
 //For Ip Address

    $ip->get_ip_address() == NULL ? $ip_addr = 'localhost' : $ip_addr =  $ip->get_ip_address();


    $userid = $_SESSION['id'];
   $custom_order_date = $_SESSION['custom_order_date'];
   $serve_hour        = $_SESSION['serve_hour'];
    $path = 'countlog.txt';
    $query2 = "INSERT INTO item_sold(user_id, session_id, discount,vat, order_id, payment_mode, payment_status, delivery_status,custom_order_date,ip_address ,serve_hour) VALUES('$userid','$sid','10','0','$oid','$payment_mod','0','Not Delivered','$custom_order_date','$ip_addr', '$serve_hour')";
    $insert = $db->insert($query2);

    if($insert){
        echo "<script>window.location = 'confirmation.php?order_id=".$oid."';</script>";
        
    }else{
        echo "There Was a Problem In server";
    }
}


?>

  


<?php if(isset($_SESSION['custom_order_date']) && isset($_SESSION['custom_order_date'])){ ?>



        <div class="row">
          <div class="col-md-9">
            
        


  
    <div class="checkout-content">
      <div class="cartoption">    
      <div class="cartpage table-responsive-sm">
            <h2>Dear <b><?php  echo $_SESSION['name']; ?></b> Please Review Your Cart</h2>
            <table class="table table-striped table-responsive-sm">
              <tr class="bg-light">
                <th style="width: 5%">Sl.</th>
                <th style="width: 20%">Product Name</th>
                <th style="width: 15%">Image</th>
                <th style="width: 15%">Price</th>
                <th style="width: 15%">Quantity</th>
                <th style="width: 15%">Total Price</th>
                <th style="width: 10%">Action</th>
              </tr>

              <?php 
                    $sess_id = session_id();
                    $orderId = $_GET['order_id'];
                    $getcartInf= $si->getCartInformation($orderId);
                    $getDisocunt = $si->getDiscount();
                    if($getcartInf){
                      $j=0;
                      $sum = 0;
                      while($sresult=$getcartInf->fetch_assoc()){
                      $j++;


                    $productName = $sresult['productname'];
                    $productImg = $sresult['image'];
                    $product_qty = $sresult['quantity'];
                    $price = $sresult['price'];
                    $sub_total = $price*$product_qty;

                    $sum = $sum+$sub_total;
                    $discount = $sum*($getDisocunt/100);
                    $total_value = $sum-$discount;
               
               ?>

              <tr>

                <td><?php echo $j ?></td>
                <td><?php echo $productName ?></td>
                <td><img style="height:50px"  src="admin/<?php echo $productImg ?>" alt=""/></td>
                <td>Tk. <?php echo $price ?></td>
                <td>
                    <?php echo $product_qty ?> Pcs
                </td>
                <td>Tk.
                <?php echo $sub_total; ?></td>
                <td><a href="">X</a></td>
              </tr>
          

          <?php } }  ?>

                
                            
            </table>
            <table class="amount-table">
              <tr>
                <th>Sub Total : </th>
                <td>TK. <?php echo  $sum ?></td>
              </tr>
              <tr>
                <th>Discount : <?php echo $getDisocunt ?>%  </th>
                <td>Tk - <?php echo  $discount ?></td>
              </tr>
              <tr>
                <th>Grand Total :</th>
                <td>TK. <?php echo  $total_value ?></td>
              </tr>
              <tr>
                  
              </tr>

             </table>
             <form action="" method="POST">
             <select id="payment_mod" name="payment_mod">
                      <option value="0">---Select Payment Method---</option>
                      <?php 
                        $getPaymentMode = $pd->getPaymentMode();
                        if($getPaymentMode) :
                           while($payment_result = $getPaymentMode->fetch_assoc()) :
                        

                       ?>
                      <option value="<?php echo $payment_result['id'] ?>"><?php echo $payment_result['mode'] ?></option>

                      <?php endwhile; endif;  ?>
              </select>
              <p id="msg"></p>
              <input type="hidden" name="order_id" value="<?php echo $_GET['order_id']; ?>">
              <input type="hidden" name="session_id" value="<?php echo $_GET['session_id']; ?>">
            <div class="shopping">
              <a class="btn btn-danger" href="index.php">Cancel Order</a>
              <input class="btn btn-success" type="submit" name="order_submit" value="Confirm">

            </div>
          </div>

            </form>
          

       <div class="clear"></div>

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
            




