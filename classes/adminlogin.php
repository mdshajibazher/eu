<?php

	include('../lib/session.php');
	Session::checkLogin();
	include('../lib/database.php');
	include('../helpers/format.php');


?>


<?php


	class Adminlogin{
		private $db;
		private $fm;
		public function __construct(){
			$this->db = new Database;
			$this->fm = new Format;
		}



		public function adminLogin($user,$pass){
			$adm_User = $user;
			$adm_Pass = $pass;
			if(empty($adm_User) || empty($adm_Pass)){
				$loginmsg = "Username & Password Must Not be empty";
				return $loginmsg;
			} else{
				$query = "SELECT * FROM tbl_admin WHERE adminUser='$adm_User' AND adminPass='$adm_Pass'";
				$result = $this->db->select($query);
				if($result != false){
					$value = $result->fetch_assoc();
					Session::set("adminlogin", true);
					Session::set("adminId", $value['adminId']);
					Session::set("adminUser", $value['adminUser']);
					Session::set("adminName", $value['adminName']);
					header('Location: index.php');;
				} else{
					$loginmsg = "Invalid Username & Password";
					return $loginmsg;
				}
			}
		}
	}



?>