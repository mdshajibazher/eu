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

    



	}

?> 