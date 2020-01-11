<?php
	$fielpath = realpath(dirname(__FILE__));
	include_once $fielpath.'/../lib/database.php';
	include_once $fielpath.'/../helpers/format.php';
	class Category{
		private $db;
		private $fm;
		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function catInsert($catName){
			$catName = $this->fm->validation($catName);
			if(empty($catName)){
				$loginmsg = "<span style='color: red'>Category Name Should Not be Empty<span>";
				return $loginmsg;
			}else{
				$query = "INSERT INTO category_table(catname) VALUES('$catName')";
				$catInsert = $this->db->insert($query);
				if($catInsert){
					$msg = "<span style='color: green'>Category Inserted Successful</span>";
					return $msg;
				}else{
					$msg = "<span style='color: red'>Category Not Inserted</span>";
					return $msg;
				}
			}

		}



		public function getAllCat(){
			$query = "SELECT * FROM category_table";
			$result = $this->db->select($query);

			return $result;
		}
		public function getAllCatWithLimit($limit){
			$query = "SELECT * FROM category_table LIMIT $limit";
			$result = $this->db->select($query);

			return $result;
		}

		public function getCatById($id){
			$query = "SELECT * FROM category_table WHERE catid='$id'";
			$result = $this->db->select($query);

			return $result;
		}

		public function delCatById($id){
			$query = "DELETE  FROM category_table WHERE catid='$id'";
			$result = $this->db->delete($query);

			
				if($result){
					$msg = "<span style='color: green'>Category Deleted Successful</span>";
					return $msg;
				}else{
					$msg = "<span style='color: red'>Category Not Deleted</span>";
					return $msg;
				}
		}

		public function catUpdate($catName, $id){
			$catName = $this->fm->validation($catName);
			if(empty($catName)){
				$loginmsg = "<span style='color: red'>Category Name Should Not be Empty<span>";
				return $loginmsg;
			}else{
				$query = "UPDATE tbl_cat SET catname ='$catName' WHERE catid='$id'";
				$catUpdate = $this->db->update($query);
				if($catUpdate){
					$msg = "<span style='color: green'>Category Updated Successful</span>";
					return $msg;
				}else{
					$msg = "<span style='color: red'>Category Not Updated</span>";
					return $msg;
				}
			}

		}






	}




?>  