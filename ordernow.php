
<?php
	session_start();
    include_once 'classes/sold_product.php';
    $si = new soldItem;
    $oid = $_POST['order_id'];
    $sid = session_id();
    $payment_mod = $_POST['payment_mod']; 
    if($_POST['order_id'] == NULL || $_POST['session_id'] == NULL){
        die();
    }else{
      $checkOrder = $si->orderCheck($oid, $sid);
      if($checkOrder == NULL){
          echo "<p style='font-size: 100px;text-align: center; text-transfrom: uppercase;color: red;margin: 100px 0;'>404 ERROR</p>";
          die();
      } 
    }


    


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
        echo "<script>window.location = 'confirmation.php?'".$oid."</script>";
        
    }else{
        echo "There Was a Problem In server";
    }



?>