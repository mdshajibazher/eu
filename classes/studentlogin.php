<?php

	
	include('lib/studentsession.php');
	Session::checkLogin();
	include('lib/database.php');
	include('helpers/format.php');


?>


<?php


	class Studentlogin{
		private $db;
		private $fm;
		public function __construct(){
			$this->db = new Database;
			$this->fm = new Format;
		}



		public function StudentLogin($student_id,$pass, $date, $serve_hour){
			$err = array();
			function isInteger($input){
			    return(ctype_digit(strval($input)));
			}

			$id = $student_id;
			$pass = $pass;

			if(empty($id) || empty($pass)){
				$err['login_msg'] = "Username & Password Must Not be empty";
			}
			if($date == NULL){
			$err['date'] = "<p  style='color: red'>Please Select a Specific Date using Datepicker</p>";
			}
			if($serve_hour == 0){
			$err['s_hour'] = "<p  style='color: red'>Please Select a Serve Hour</p>";
			}



			if(count($err) == 0){

			
			if(isInteger($id) == 1){
				$query = "SELECT * FROM students_table WHERE student_id='$id' AND password='$pass'";
				$result = $this->db->select($query);
				if($result == false){
					$err['login_msg'] = "<span style='color: red;font-weight: bold;margin: 20px 0;display: block'>Incorrect studentId/password combination</span>";

				}else{
					$value = $result->fetch_assoc();
					if($value['active_status'] == 0){
						$err['login_msg'] =  "<span style='color: red;font-weight: bold;margin: 20px 0;display: block'>User Inactive <a href='activate.php?sid=".$value['student_id']."'>Click Here To Activate</a></span>";
					}else{
						Session::set("studentlogin", true);
						Session::set("studentemail", $value['email']);
						Session::set("id",$value['id']);
						Session::set("name", $value['name']);
						Session::set("custom_order_date",$date);
						Session::set("serve_hour", $serve_hour);
						echo "<script>window.location = '';</script>";
						die();
					}
				}
			}elseif(isInteger($id) == NULL){
				$query = "SELECT * FROM students_table WHERE email='$id' AND password='$pass'";
				$result = $this->db->select($query);
				if($result == false){
					$err['login_msg'] =  "<span style='color: red;font-weight: bold;margin: 20px 0;display: block'>Incorrect email/password combination</span>";

					
				}else{

					$value = $result->fetch_assoc();
					if($value['active_status'] == 0){
						$err['login_msg'] = "<span style='color: red;font-weight: bold;margin: 20px 0;display: block'>User Inactive <a href='activate.php?sid=".$value['student_id']."'>Click Here To Activate</a></span>";
					}else{
						Session::set("studentlogin", true);
						Session::set("studentemail", $value['email']);
						Session::set("id",$value['id']);
						Session::set("name", $value['name']);
						Session::set("custom_order_date",$date);
						Session::set("serve_hour", $serve_hour);
						echo "<script>window.location = '';</script>";
						die();
					}
				}
			}
			    else{
					$loginmsg = "Invalid Username & Password";
					return $loginmsg;
		    }
		    }
		    return $err;
		}



		public function checkCode($code, $id){

			if(empty($code)){
				$msg = "Active Code Must Not be Empty";
				return $msg;
			}else{
			$query = "SELECT * FROM students_table WHERE active_code='$code'";
			$result = $this->db->select($query);

			if($result != false){
				$updateQuery = "UPDATE students_table SET active_status = 1 WHERE student_id='$id'";
				$statusUpdate = $this->db->update($updateQuery);
				if($statusUpdate){
						$query = "SELECT * FROM students_table WHERE student_id='$id'";
				        $result = $this->db->select($query);
				        $value = $result->fetch_assoc();
					    Session::set("studentlogin", true);
						Session::set("studentemail", $value['email']);
						Session::set("id",$value['id']);
						Session::set("name", $value['name']);
						echo "<script>window.location = '';</script>";
				}else{
					$msg = "<span style='color: red'>Not Updated</span>";
					return $msg;
				}
			}else{
				$msg = "<span style='color: red'>Invalid Security Code Try Again</span>";
					return $msg;
			}

		}
		}
	}



?>