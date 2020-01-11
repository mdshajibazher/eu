<?php
	$fielpath = realpath(dirname(__FILE__));

	include_once $fielpath.'/../lib/database.php';
	include_once $fielpath.'/../helpers/format.php';

	class GeneralInf{
		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database;
			$this->fm = new Format;
		}





	public function getGeneralInforamtion(){
			$query = "SELECT * FROM general_information WHERE id='1'";
			$result = $this->db->select($query);
			return $result;
	}

	public function updateGeneralInforamtion($postmethod){
			$site_title = $postmethod['site_title'];
			$discount = $postmethod['discount'];
			$vat = $postmethod['vat'];
			$processing_fee = $postmethod['processing_fee'];
			$query = "UPDATE general_information SET site_title='$site_title', discount='$discount',vat='$vat',processing_fee='$processing_fee' WHERE id='1'";
			$result = $this->db->update($query);
			if($result){
					$msg = "<span style='color: green'>Infromation Updated Successful</span>";
					return $msg;
				}else{
					$msg = "<span style='color: red'>Not Updated</span>";
					return $msg;
				}
			
			return $result;
	}






	}

?> 