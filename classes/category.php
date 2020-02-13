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
		    $err = array();
			$catName = $this->fm->validation($catName);
			if(empty($catName)){
				 $err['empty'] = "Category Name Should Not be Empty";
			}else{
				$query = "INSERT INTO category_table(catname) VALUES('$catName')";
				$catInsert = $this->db->insert($query);
				if($catInsert){
					$err['success'] = "success";
					header('Refresh: 3; url=category-list.php');
				}else{
					$err['error'] = "Error";
				}
			}
			
			return $err;

		}



		public function getAllCat(){
			$query = "SELECT * FROM category_table";
			$result = $this->db->select($query);

			return $result;
		}
		public function getAllCatWithLimit($limit){
			$query = "SELECT * FROM category_table ORDER BY id DESC LIMIT $limit";
			$result = $this->db->select($query);

			return $result;
		}

		public function getCatById($id){
			$query = "SELECT * FROM category_table WHERE id='$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function delCatById($id){
		    $err = array();
			$query = "DELETE  FROM category_table WHERE id='$id'";
			$result = $this->db->delete($query);
				if($result){
					$err['success'] = "success";
					header('Refresh: 3; url=category-list.php');
				}else{
					$err['error'] = "error";
				}
				
				return $err;
		}

		public function catUpdate($catName, $id){
		    $err = array();
			$catName = $this->fm->validation($catName);
			
			if(empty($catName)){
				 $err['empty'] = "Category Name Should Not be Empty";
			}else{
				$query = "UPDATE category_table SET catname ='$catName' WHERE id='$id'";
				$catUpdate = $this->db->update($query);
				if($catUpdate){
					$err['success'] = "success";
					header('Refresh: 3; url=category-list.php');
				}else{
				    $err['error'] = "error";
				}
			}
			
			return $err;

		}






	}




?>  