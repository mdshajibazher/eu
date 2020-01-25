<?php

	
	include('lib/studentsession.php');
	Session::checkLogin();
	include('lib/database.php');
	include('helpers/format.php');


?>


<?php


	class StudentSignup{
		private $db;
		private $fm;
		public function __construct(){
			$this->db = new Database;
			$this->fm = new Format;
		}


	public function email_exists($arg_mail){

	        $query = "SELECT email FROM students_table WHERE email='$arg_mail'";
	        $result = $this->db->select($query);
	        if($result){
		        if(mysqli_num_rows($result) == 1){
		            return true;
		        } else{
		            return false;
		        }
	        }
	        
	  }
	  public function studentId_exists($sid){

	        $query = "SELECT student_id FROM students_table WHERE student_id='$sid'";
	        $result = $this->db->select($query);
	        if($result){
		        if(mysqli_num_rows($result) == 1){
		            return true;
		        } else{
		            return false;
		        }
	        }
	        
	  }

		public function StudentSignup($postmethod){

            $name = $this->fm->validation($postmethod['name']);
            $studentid = $this->fm->validation($postmethod['st_id']);
            $email = $this->fm->validation($postmethod['email']);
            $password = $this->fm->validation($postmethod['password']);
     		$md5pass = md5($password);
            $confirm_password = $this->fm->validation($postmethod['conf_password']);
            $address = $this->fm->validation($postmethod['addr']);
            $activecode = rand(1,10000);

	         


            $err = array();
                if($name == null){
                    $err['name'] = '<p style="color: red;">*Name field Must Not be empty </p>';
                }
                if($studentid == null){
                    $err['sid'] = '<p style="color: red">*Student Id field Must Not be empty </p>';
                }elseif($this->studentId_exists($studentid)){
                    $err['student_exists'] = '<p style="color: red;font-weight: bold;">***StudentId Already Exists</p>';
                }
                if($email == null){
                    $err['email'] = '<p style="color: red">*Email field Cant be empty </p>';
                }elseif($this->email_exists($email)){
                    $err['email_exists'] = '<p style="color: red;font-weight: bold;">***Email Already Exists</p>';
                }


                

                

                if(strlen($password) == NULL){
                    $err['pass1'] = '<p style="color: red">*Password cant be blank </p>';
                }else if(strlen($password) < 5){
                    $err['pass'] = '<p style="color: red">*Password must be greater  6 charecter</p>';
                }
                if($password !== $confirm_password){
                    $err['conf_pass'] = '<p style="color: red">*password dont match</p>';
                }
                if($address == null){
                    $err['addr'] = '<p style="color: red;">*Address field Must Not be empty </p>';
                }



                

                if(count($err)== NULL){
                $query = "INSERT INTO students_table(name,student_id,email,password, address,active_code, active_status) VALUES('$name','$studentid','$email','$md5pass','$address', '$activecode', 0)";
			    $inserted_rows = $this->db->insert($query);

				    if ($inserted_rows) {
				       

$to = $email;
$subject = "Welcome ".$name." to e-Canteen Familly.Please Check The Code given Below";

$message = '<table dir="ltr" style="font-family: Segoe UI Semibold,Arial,sans-serif;font-size:17px;color:#707070">
      <tbody>

        <tr>
              <td><img style="width: 500px" src="//bd.sapappu.com/img/banner.png" alt=""></td>
            </tr>
        <tr><td>Eu e-Canteen</td></tr>
      <tr><td style="padding:0;font-family: Segoe UI Light;font-size:41px;color:#2672ec">Signup Security code</td></tr>
      <tr><td  style="padding:0;padding-top:25px;font-family: Segoe UI;font-size:14px;color:#2a2a2a">
                
                Please use the following security code for the e-Canteen account
            </td></tr>

            
      <tr><td style="padding:0;padding-top:25px;font-family:Segoe UI;font-size:14px;color:#2a2a2a">
                
                Security code: <span style="font-family:Segoe UI Bold;font-size:14px;font-weight:bold;color:#2a2a2a;font-size: 40px">'.$activecode.'</span>
            </td></tr>
      
      <tr><td style="padding:0;padding-top:25px;font-family:Segoe UI;font-size:14px;color:#2a2a2a">Thanks,</td></tr>
      <tr><td style="padding:0;font-family: Segoe UI;font-size:14px;color:#2a2a2a">The EU e-Canteen team</td></tr>
</tbody></table>
';

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <info@sapappu.com>' . "\r\n";

mail($to,$subject,$message,$headers);
echo "<script>window.location = 'activate.php?sid=".$studentid.'&&email='.$email."'</script>";



				    }
				    else {
				        echo "<span class='error'>Not Inserted !</span>";
				    }
                }

                return $err;



		}

	








	}



?>