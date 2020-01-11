<?php include 'classes/studentlogin.php'; ?>
<?php
  $sl = new Studentlogin;
  $student_id = $_GET['sid'];
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $code = $_POST['active_code'];
    $checkCode = $sl->checkCode($code,$student_id);
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

        <title>Active Process</title>
        <link href="css/login.css" rel="stylesheet">
    </head>
    <body>

      <div class="login-page">
        <div class="form">
          <form class="login-form" method="POST" action="">
            <p style="color: #1289A7"><?php if(isset($_GET['email'])){ echo "We sent you a code in your mail addrss <span style='color: red;font-style: italic'>".$_GET['email']." </span>Check The mail & verify your Account";} ?></p>
            <h3>Active User Process</h3>
            <span style="color:red"><?php if(isset($checkCode)){ echo $checkCode; } ?></span>
            <img src="img/banner.png" width="100%">
            <input type="text" placeholder="Enter Active Code 12****" name="active_code" />
            
            <button type="submit">Activate</button>
            <p class="message">Not registered? <a href="signup.php">Create an account</a></p>
          </form>
        </div>
      </div>

    </body>
    
</html>