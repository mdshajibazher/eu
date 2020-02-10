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
			$sku = preg_replace('/\s+/', '', $productName);
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
                    $err['product_name'] = 'ProductName field Must Not be empty';

             }
             if($categoryId == NULL){
             		$err['categoryId'] = 'Please Select A Category';
             }
            if($description == NULL){
                    $err['description'] = 'Product Description field Must Not be empty';

             }
            if (empty($file_name)) {
		         $err['image'] = "Please Select any Image !";
		    }elseif ($file_size >1048567) {
		         $err['image'] = "<span class='error'>Image Size should be less then 1MB! </span>";
		    } elseif (in_array($file_ext, $permited) === false) {
			     $err['image'] = "You can upload only:-".implode(', ', $permited);
		    }
             
              if($price == NULL){
                    $err['price'] = 'Product Price field Must Not be empty';
             }
             if($type == NULL){
                    $err['type'] = 'Please Select A product Type';
             }

   if(count($err)==NULL){


			    move_uploaded_file($file_temp, $uploaded_image);
			    $query = "INSERT INTO product_table(productname,sku,categoryid,description,price,image,type) VALUES('$productName','$sku','$categoryId','$description','$price','$uploaded_image','$type')";
			    $inserted_rows = $this->db->insert($query);

				    if ($inserted_rows) {
				        $err['success'] = "success";
				        header('Refresh: 5; url=product-list.php');

				    }
				    else {
				       $err['error'] = "Error Product not inserted";
				    }
		     


		    }


		    return $err;
  
		}



	public function ProductEdit($post, $file, $id){

			$err = array();
			$productName  = $this->fm->validation($post['productname']);
			$sku = preg_replace('/\s+/', '', $productName);
			$categoryId  = $post['categoryid'];
			$des = $this->fm->validation($post['description']);
			$description = str_replace("'", "", $des);
			$price = $this->fm->validation($post['price']);
			$type        = $this->fm->validation($post['type']);

			if($file['image']['name'] != null && $file['image']['size'] > 0 ) :

		    $permited    = array('jpg', 'jpeg', 'png', 'gif');
		    $file_name   = $file['image']['name'];
		    $file_size   = $file['image']['size'];
		    $file_temp   = $file['image']['tmp_name'];

		    $div = explode('.', $file_name);
		    $file_ext = strtolower(end($div));
		    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		    $uploaded_image = "uploads/".$unique_image;



            if (empty($file_name)) {
		         $err['image'] = "Please Select any Image !";
		    }elseif ($file_size >1048567) {
		         $err['image'] = "Image Size should be less then 1MB!";
		    } elseif (in_array($file_ext, $permited) === false) {
			     $err['image'] = "You can upload only:-".implode(', ', $permited);
		    }


		    endif;

		    


		    if($productName == NULL){
                    $err['product_name'] = 'ProductName field Must Not be empty';

             }
             if($categoryId == NULL){
             		$err['categoryId'] = 'Please Select A Category';
             }
            if($description == NULL){
                    $err['description'] = 'Product Description field Must Not be empty';

             }
             
              if($price == NULL){
                    $err['price'] = 'Product Price field Must Not be empty';
             }
             if($type == NULL){
                    $err['type'] = 'Please Select A product Type';
             }

   if(count($err)==NULL){

   				if($file['image']['name'] == null && $file['image']['size'] == 0 ) :
   						 $query = "UPDATE product_table SET productname='$productName',sku='$sku',categoryid='$categoryId',description='$description',price='$price',type='$type' WHERE productid='$id'";
			    
			    else:


			    move_uploaded_file($file_temp, $uploaded_image);
			    $query = "UPDATE product_table SET productname='$productName',sku='$sku',categoryid='$categoryId',description='$description',price='$price',image='$uploaded_image',type='$type' WHERE productid='$id'";


			    endif;


			    $updated_rows = $this->db->update($query);

				    if($updated_rows) {
				        $err['success'] = "success";
				        header('Refresh: 5; url=product-list.php');

				    }
				    else {
				       $err['error'] = "Error Product not inserted";
				    }
		     


		    }


		    return $err;
	}

	public function getSpecificProduct($id){
			$query = "SELECT product_table.*, category_table.* FROM product_table INNER JOIN category_table ON product_table.categoryid=category_table.id WHERE productid='$id'";
			$result = $this->db->select($query);
			return $result;
	}

	public function delProductById($id){
			$err = array();
			$query = "DELETE FROM product_table WHERE productid='$id'";
			$deleted = $this->db->delete($query);
			var_dump($deleted);

			if($deleted) {
				      $err['success'] = "success";
		    }
			else {
		         $err['error'] = "Error Product not inserted";
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