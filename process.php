<?php

	  include 'lib/studentsession.php';
	  Session::checkSession();
	  include 'lib/database.php';
	  include 'classes/product.php';
	  
	  $db = new Database;
	  $pd = new Product;
	 $userid = $_SESSION['id'];
     $sid = session_id();

    $tp    = $_POST['Ajaxdata'];

    $path = 'countlog.txt';


    $file  = fopen( $path, 'r' );
    $order_count = fgets( $file, 1000 );
    fclose( $file );

    $order_count = abs( intval( $order_count ) ) + 1;




    $file = fopen( $path, 'w' );
    fwrite( $file, $order_count );
    fclose( $file );

 
    foreach ($tp as $key => $value) {
    	 $sku = $value['name'];
    	 $price = $value['price'];
    	 $qty = $value['count'];
    	 $product_id = 	$value['id'];
    $query = "INSERT INTO cart_table(order_id,session_id,product_id,userid, product_sku, price, quantity) VALUES('$order_count','$sid','$product_id','$userid','$sku','$price', '$qty')";
         $inserted_rows = $db->insert($query);
    	
    }
    echo $order_count."&session_id=".$sid;
    // if ($inserted_rows) {
    //  $query2 = "INSERT INTO item_sold(user_id,order_id, payment_mode, payment_status, delivery_status) VALUES('$userid','$order_count','COD','UNPAID', 'Not Delivered')";
    // $inserted = $db->insert($query2);
    //     if($inserted){ echo "Order Created Successfull"; }
    // }
    // else {
    //     echo "<span class='error'>Not Inserted !</span>";
    // }

    //echo "Name".$tp[1]['name'];

?>