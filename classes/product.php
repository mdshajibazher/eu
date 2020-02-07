<?php
	$fielpath = realpath(dirname(__FILE__));

	include_once $fielpath.'/../lib/database.php';
	include_once $fielpath.'/../helpers/format.php';

	class Product{
		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database;
			$this->fm = new Format;
		}


		public function productInsert($post, $file){
			$productName  = $this->fm->validation($post['productname']);
			$categoryId  = $post['categoryid'];
			$des = $this->fm->validation($post['description']);
			$description = str_replace("'", "", $des);
			$price = $this->fm->validation($post['price']);
			$type        = $this->fm->validation($post['type']);
		    $permited    = array('jpg', 'jpeg', 'png', 'gif');
		    $file_name   = $file['image']['name'];
		    $file_size   = $file['image']['size'];
		    $file_temp   = $file['image']['tmp_name'];

		    $div = explode('.', $file_name);
		    $file_ext = strtolower(end($div));
		    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		    $uploaded_image = "uploads/".$unique_image;

		    $err = array();


		    if($productName == NULL){
                    $err['product_name'] = '<p style="color: red;">*ProductName field Must Not be empty </p>';

             }
             if($categoryId == NULL){
             		$err['categoryId'] = '<p style="color: red">*Please Select A Category</p>';
             }
            if($description == NULL){
                    $err['description'] = '<p style="color: red">*Product Description field Must Not be empty</p>';

             }
             if (empty($file_name)) {
		         $err['image'] = "<p style='color: red'>*Please Select any Image !</p>";
		    }elseif ($file_size >1048567) {
		         $err['image'] = "<span class='error'>Image Size should be less then 1MB! </span>";
		    } elseif (in_array($file_ext, $permited) === false) {
			     $err['image'] = "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
		    }
             
              if($price == NULL){
                    $err['price'] = '<p style="color: red">*Product Price field Must Not be empty</p>';
             }
             if($type == NULL){
                    $err['type'] = '<p style="color: red">*Please Select A product Type </p>';
             }

   if(count($err)==NULL){

		    	  
			    move_uploaded_file($file_temp, $uploaded_image);
			    $query = "INSERT INTO product_table(productname,categoryid,description,price,image,type) VALUES('$productName','$categoryId','$description','$price','$uploaded_image','$type')";
			    $inserted_rows = $this->db->insert($query);

				    if ($inserted_rows) {
				        echo "<span class='success'>Product Inserted Successfully.
				     </span>";
				     echo 	"<script>window.location  = 'productlist.php'; </script>";
				    }
				    else {
				        echo "<span class='error'>Not Inserted !</span>";
				    }
		     


		    }


		    return $err;
  
		}


	public function getCategoryWiseProduct($id){
			$query = "SELECT product_table.*, category_table.catname FROM product_table INNER JOIN category_table ON product_table.categoryid=category_table.id WHERE categoryid='$id'  ORDER BY product_table.productid DESC";
			$result = $this->db->select($query);
			return $result;
	}

	public function getAllProduct(){
			$query = "SELECT product_table.*, category_table.catname FROM product_table INNER JOIN category_table ON product_table.categoryid=category_table.id  ORDER BY product_table.productid DESC";
			$result = $this->db->select($query);
			return $result;
	}

	public function getRecentProduct($limit){
			$query = "SELECT * FROM product_table LIMIT $limit";
			$result = $this->db->select($query);
			return $result;
	}


	public function getCatName($id){
		$query = "SELECT * FROM category_table WHERE id='$id'";
			$result = $this->db->select($query);
			return $result;
	}



	}

?> 