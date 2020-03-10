<?php include 'classes/studentsignup.php'; ?>
<?php
  
  $signUp = new StudentSignup;

  if(isset($_POST['signup'])){


    $studentDataInsert = $signUp->StudentSignup($_POST);


  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="pappu">
        <meta name="description" content="Shajib Azher">

        <title>Login</title>
        <link href="css/login.css" rel="stylesheet">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
        	label{
        		margin-bottom: 15px;
        		display: block;
        	}
        </style>
    </head>
    <body>

      <div class="login-page">
        <div class="form">
          <h3>Student Signup Form</h3>
          <form class="register-form" style="display: block;text-align: left;" action="" method="POST">
             <p class="message">Already registered? <a href="login.php">Sign In</a></p>
             <img src="img/banner.png" width="100%">
            <label for="name">Name</label>
            <input class="form-control" type="text" placeholder="name" name="name" id="name" value="<?php if(isset($_POST['name'])){ echo $_POST['name']; } ?>"/>

            <?php if(isset($studentDataInsert['name'])){ echo $studentDataInsert['name'];} ?>

            <label for="sid">Student Id</label>
            <input type="text" class="form-control" placeholder="Student Id" name="st_id" id="sid" value="<?php if(isset($_POST['st_id'])){ echo $_POST['st_id']; } ?>" />

            <?php if(isset($studentDataInsert['sid'])){ echo $studentDataInsert['sid'];} ?>
            <?php if(isset($studentDataInsert['student_exists'])){ echo $studentDataInsert['student_exists'];} ?>

            <label for="email">Email Address</label>
            <input class="form-control" type="text" placeholder="email address" name="email" id="email" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>"/>

            <?php if(isset($studentDataInsert['email'])){ echo $studentDataInsert['email'];} ?>
            <?php if(isset($studentDataInsert['email_exists'])){ echo $studentDataInsert['email_exists'];} ?>

            <label for="password">Enter Password</label>
            <input class="form-control" type="password" placeholder="Enter Password" name="password" id="password" value="<?php if(isset($_POST['password'])){ echo $_POST['password']; } ?>"/>
            <?php if(isset($studentDataInsert['pass1'])){ echo $studentDataInsert['pass1'];} ?>
            <?php if(isset($studentDataInsert['pass'])){ echo $studentDataInsert['pass'];} ?>
            <label for="password">Confirm Password</label>
            <input class="form-control" type="password" placeholder="Confirm Password" name="conf_password" id="conf_password" value="<?php if(isset($_POST['conf_password'])){ echo $_POST['conf_password']; } ?>" />
            <?php if(isset($studentDataInsert['conf_pass'])){ echo $studentDataInsert['conf_pass'];} ?>
            <label for="addr">Address</label>
            <textarea class="form-control" name="addr"  cols="35" rows="10" placeholder="Enter Your Address" id="addr"><?php if(isset($_POST['addr'])){ echo $_POST['addr']; } ?></textarea>
            <?php if(isset($studentDataInsert['addr'])){ echo $studentDataInsert['addr'];} ?>
            <button class="btn btn-success" type="submit" name="signup">create</button>
            
          </form>
          
        </div>
      </div>

    </body>
    
    
</html>