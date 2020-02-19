<?php
	include 'lib/studentsession.php';
	Session::checkSession();
	include('classes/Order.php');
	$order = new Order;
	$cartid = $_GET['id'];
	$order_id = $_GET['order_id'];
	$token = $_GET['token'];

	if($cartid == NULL || $token  == NULL){
	   die();
	}else{
	$checkOrder = $order->CartCehck($cartid, $token);
	if($checkOrder == NULL){
	echo "<p style='font-size: 100px;text-align: center; text-transfrom: uppercase;color: red;margin: 100px 0;'>404 ERROR</p>";
	die();
	}


	$delCart = $order->DeleteCart($cartid);

	
	Session::set('msg','Product Removed Successfully From The Cart');
	header("Location: checkout.php?order_id=".$order_id."&token=".$token."");
	var_dump($delCart);




	}

?>