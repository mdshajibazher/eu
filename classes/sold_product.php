<?php
	$fielpath = realpath(dirname(__FILE__));

	include_once $fielpath.'/../lib/database.php';
	include_once $fielpath.'/../helpers/format.php';
	class soldItem{
		private $db;
		private $fm;
		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}





		public function getSpecificSoldItem($id){
			$query = "SELECT * FROM item_sold WHERE order_id='$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function getAllSoldItem($id){
			$query = "SELECT * FROM item_sold WHERE user_id='$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function getUserInformation($id){
			$query = "SELECT * FROM students_table WHERE id='$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function getCartInformation($id){
			$query = "SELECT cart_table.*, product_table.productname, product_table.image FROM cart_table INNER JOIN product_table ON cart_table.product_id = product_table.productid AND cart_table.order_id='$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function getDiscount(){
			$query = "SELECT discount FROM general_information";
			$result = $this->db->select($query);
			while ($getCurrentDisocunt = $result->fetch_assoc()) {
                return  $getCurrentDisocunt['discount'];
            }
		}
		public function orderCheck($oid,$sid){
			$query = "SELECT * FROM cart_table WHERE order_id='$oid' AND session_id='$sid'";
			$result = $this->db->select($query);
			return $result;
		}






	}




?>  