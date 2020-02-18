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
			$err = array();
			$site_title = $postmethod['site_title'];
			$discount = $postmethod['discount'];
			$vat = $postmethod['vat'];
			$shipping = $postmethod['shipping'];

			if($site_title == NULL){
				$err['site_title'] = 'Site Title Field Must Not Be Empty';
			}
			if($discount == NULL){
				$err['discount'] = 'DiscountField Must Not Be Empty';
			}
			if($vat == NULL){
				$err['vat'] = 'Vat Title Field Must Not Be Empty';
			}
			if($shipping == NULL){
				$err['shipping'] = 'Shipping Field Must Not Be Empty';
			}
			if(count($err)==NULL){
			 $query = "UPDATE general_information SET site_title='$site_title', discount='$discount',vat='$vat',shipping='$shipping' WHERE id='1'";
			$result = $this->db->update($query);
			if($result){
					$err['suceess'] = 'success';
					header('Refresh: 3; url=index.php');
				}else{
					$err['error'] = 'error';
				}
			

			}

			return $err;
	}






	}

?> 