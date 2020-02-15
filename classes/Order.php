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

    public function getTotalOrder(){
        	$query = "SELECT id FROM item_sold";
			$result = $this->db->select($query);
			return $result;
    }
    public function getPendingOrder(){
        	$query = "SELECT id FROM item_sold WHERE order_status=0";
			$result = $this->db->select($query);
			return $result;
    }
    public function getCancelledOrder(){
        	$query = "SELECT id FROM item_sold WHERE order_status=2";
			$result = $this->db->select($query);
			return $result;
    }

    public function getOrderInformation(){
	    $query = "SELECT item_sold.*,students_table.name,students_table.phone, students_table.address, payment_mode.*, serve_hour.* FROM item_sold JOIN students_table JOIN payment_mode JOIN serve_hour WHERE item_sold.user_id=students_table.id AND item_sold.payment_mode=payment_mode.id AND item_sold.serve_hour=serve_hour.id";
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
		$catUpdate = $this->db->update($query);
    }
    



	}

?> 