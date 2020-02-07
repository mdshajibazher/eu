<?php
include 'inc/header.php';
include_once 'classes/sold_product.php';
include_once('lib/database.php');
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
    function get_ip_address(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe

                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
    }
    get_ip_address() == NULL ? $ip_addr = 'localhost' : $ip_addr = get_ip_address();




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


  

    <div class="checkout-content">
      <div class="cartoption">    
      <div class="cartpage">
            <h2>Dear <b><?php  echo $_SESSION['name']; ?></b> Please Review Your Cart</h2>
            <table class="tblone">
              <tr>
                <th width="5%">Sl.</th>
                <th width="20%">Product Name</th>
                <th width="15%">Image</th>
                <th width="15%">Price</th>
                <th width="15%">Quantity</th>
                <th width="15%">Total Price</th>
                <th width="10%">Action</th>
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
                <td><img src="admin/<?php echo $productImg ?>" alt=""/></td>
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
            <table class="amount-table" width="40%">
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
                      <option value="0">-----Select Payment Method-----</option>
                      <option value="1">Cash On Delivery</option>
                      <option value="2">Credit/Debit Card</option>
              </select>
              <p id="msg"></p>
              <input type="hidden" name="order_id" value="<?php echo $_GET['order_id']; ?>">
              <input type="hidden" name="session_id" value="<?php echo $_GET['session_id']; ?>">
          </div>
          <div class="shopping">
            <div class="shopleft">
              <a class="btn btn-danger" href="index.php">Cancel Order</a>
            </div>
            <div class="shopright" style="text-align: right">
              <input class="btn btn-success" type="submit" name="order_submit" value="Confirm">
              
            </div>
            </form>
          </div>
      </div>    
       <div class="clear"></div>
    </div>


<script>

</script>



<?php include 'inc/footer.php'; ?>
            



