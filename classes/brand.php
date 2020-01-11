<?php
	include_once '../lib/database.php';
	include_once '../helpers/format.php';
	class Brand{
		private $db;
		private $fm;
		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function brandInsert($brandName){
			$brandName = $this->fm->validation($brandName);
			if(empty($brandName)){
				$loginmsg = "<span style='color: red'>Brand Name Should Not be Empty<span>";
				return $loginmsg;
			}else{
				$query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
				$brandInsert = $this->db->insert($query);
				if($brandInsert){
					$msg = "<span style='color: green'>Brand Inserted Successful</span>";
					return $msg;
				}else{
					$msg = "<span style='color: red'>Brand Not Inserted</span>";
					return $msg;
				}
			}

		}



		public function getAllBrand(){
			$query = "SELECT * FROM tbl_brand";
			$result = $this->db->select($query);

			return $result;
		}

		public function getBrandById($id){
			$query = "SELECT * FROM tbl_brand WHERE brandId='$id'";
			$result = $this->db->select($query);

			return $result;
		}

		public function delBrandById($id){
			$query = "DELETE  FROM tbl_brand WHERE brandId='$id'";
			$result = $this->db->delete($query);

			
				if($result){
					$msg = "<span style='color: green'>Brand Deleted Successful</span>";
					return $msg;
				}else{
					$msg = "<span style='color: red'>Brand Not Deleted</span>";
					return $msg;
				}
		}

		public function brandUpdate($brandName, $id){
			$brandName = $this->fm->validation($brandName);
			if(empty($brandName)){
				$loginmsg = "<span style='color: red'>Brand Name Should Not be Empty<span>";
				return $loginmsg;
			}else{
				$query = "UPDATE tbl_brand SET brandName ='$brandName' WHERE brandId='$id'";
				$brandUpdate = $this->db->update($query);
				if($brandUpdate){
					$msg = "<span style='color: green'>Brand Updated Successful</span>";
					return $msg;
				}else{
					$msg = "<span style='color: red'>Brand Not Updated</span>";
					return $msg;
				}
			}

		}






	}




?>  