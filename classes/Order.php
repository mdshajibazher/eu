<?php
	$fielpath = realpath(dirname(__FILE__));

	include_once $fielpath.'/../lib/database.php';
	include_once $fielpath.'/../helpers/format.php';

	class Order{
		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database;
			$this->fm = new Format;
		}



    public function CartCehck($cartid, $token){
        	$query = "SELECT * FROM cart_table WHERE cartid='$cartid' AND session_id='$token'";
			$result = $this->db->select($query);
			return $result;
    }

    public function DeleteCart($cartid){
        	$query = "DELETE FROM cart_table WHERE cartid='$cartid'";
			$result = $this->db->select($query);
			return $result;
    }

    public function getTotalOrderCount(){
        	$query = "SELECT id FROM item_sold";
			$result = $this->db->select($query);
			return $result;
    }
    public function getPendingOrderCount(){
        	$query = "SELECT id FROM item_sold WHERE order_status=0";
			$result = $this->db->select($query);
			return $result;
    }
    public function getCancelledOrderCount(){
        	$query = "SELECT id  FROM item_sold WHERE order_status=2";
			$result = $this->db->select($query);
			return $result;
    }

    public function getOrderInformation(){
	    $query = "SELECT item_sold.*,students_table.name,students_table.phone, students_table.address, payment_mode.*, serve_hour.* FROM item_sold JOIN students_table JOIN payment_mode JOIN serve_hour WHERE item_sold.user_id=students_table.id AND item_sold.payment_mode=payment_mode.id AND item_sold.serve_hour=serve_hour.id ORDER BY item_sold.id DESC";
		$result = $this->db->select($query);
		return $result;
    }


    public function getPendingOrderInformation(){
	    $query = "SELECT item_sold.*,students_table.name,students_table.phone, students_table.address, payment_mode.*, serve_hour.* FROM item_sold JOIN students_table JOIN payment_mode JOIN serve_hour WHERE item_sold.user_id=students_table.id AND item_sold.payment_mode=payment_mode.id AND item_sold.serve_hour=serve_hour.id AND item_sold.order_status=0 ORDER BY item_sold.id DESC";
		$result = $this->db->select($query);
		return $result;
    }
    public function getCancelOrderInformation(){
	    $query = "SELECT item_sold.*,students_table.name,students_table.phone, students_table.address, payment_mode.*, serve_hour.* FROM item_sold JOIN students_table JOIN payment_mode JOIN serve_hour WHERE item_sold.user_id=students_table.id AND item_sold.payment_mode=payment_mode.id AND item_sold.serve_hour=serve_hour.id AND item_sold.order_status=2 ORDER BY item_sold.id DESC";
		$result = $this->db->select($query);
		return $result;
    }

    public function getSpecificOrderInformation($id){
	    $query = "SELECT item_sold.*,students_table.*, payment_mode.*, serve_hour.* FROM item_sold JOIN students_table JOIN payment_mode JOIN serve_hour WHERE item_sold.user_id=students_table.id AND item_sold.payment_mode=payment_mode.id AND item_sold.serve_hour=serve_hour.id AND item_sold.order_id='$id'";
		$result = $this->db->select($query);
		return $result;
    }
     public function getSpecificOrderCartInformation($id){
	    $query = "SELECT cart_table.*,product_table.productname,product_table.image  FROM cart_table JOIN product_table WHERE cart_table.product_id = product_table.productid AND cart_table.order_id='$id'";
		$result = $this->db->select($query);
		return $result;
    }
    
    

    public function orderApproval($id){
    	$query = "UPDATE item_sold SET order_status =1 WHERE order_id='$id'";
		$OrderStatus = $this->db->update($query);
		if($OrderStatus){
		   $msg = "Your Order Has Been Approved Successfully";
		   return $msg;
		}
		
    }

    public function MasrkAsServed($id){
        $current_timestamp = time();
        $query = "UPDATE item_sold SET servedAt ='$current_timestamp', delivery_status='served' WHERE order_id='$id'";
        $OrderStatus = $this->db->update($query);
        if($OrderStatus){
           $msg = "Your Order Has Been Mark As Served";
           return $msg;
        }
        
    }

    public function StorePayment($id, $amount){
    	$current_timestamp = time();
    	if($amount == NULL){
    		$msg = 'error';
    	}else{
	    	$query = "UPDATE item_sold SET amount ='$amount',paymentAt='$current_timestamp', payment_status=1 WHERE order_id='$id'";
			$result = $this->db->update($query);
			if($result){
			   $msg = "Payment Submitted Successfully";
			   
			}
    	}
    	return $msg;
    	
		
    }



    public function orderCancel($id){
    	$query = "UPDATE item_sold SET order_status =2 WHERE order_id='$id'";
		$OrderStatus = $this->db->update($query);
		if($OrderStatus){
		   $msg = "Your Order Has Been Cancelled Successfully";
		   return $msg;
		}
    }

    public function OrderStatus($status){

    	if($status == 0){
                  $order_status_msg = '<span class="badge badge-warning">pending</span>';
                  
                  }elseif($status == 1){
                        $order_status_msg =  '<span class="badge badge-success">approved</span>';
                  }else{
                  
                    $order_status_msg = '<span class="badge badge-danger">Cancelled</span>';
          }


          return $order_status_msg;
    }

    public function PaymentStatus($status){

    	if($status == 0){
                  $order_payment_msg = '<span class="badge badge-warning">pending</span>';
                  
                  }elseif($status == 1){
                        $order_payment_msg =  '<span class="badge badge-success">paid</span>';
                  }

          return $order_payment_msg;
    }
    



	}

?> 