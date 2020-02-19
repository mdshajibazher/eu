<?php include 'classes/studentlogin.php'; ?>
<?php
$sl = new Studentlogin;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
$id = $_POST['id'];
$pass = md5($_POST['pass']);
$loginChk = $sl->Studentlogin($id, $pass);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="pappu">
    <meta name="description" content="Shajib Azher">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="favicon.png">
    <title>Login</title>
    <link href="css/login.css" rel="stylesheet">
  </head>
  <body>
    <div class="login-page">
      <div class="form">
        <form class="login-form" method="POST" action="">
          
          <h3>Student Login</h3>
          <p style="color: green"><?php if(isset($_SESSION['activate'])){ echo $_SESSION['activate']; } ?></p>
          
          <img src="img/banner.png" width="100%">
          <span style="color:red"><?php if(isset($loginChk)){ echo $loginChk; } ?></span>
          <input type="text" placeholder="email/studentid" name="id" value="<?php if(isset($_POST['id'])){ echo $_POST['id']; }else{ echo "user"; } ?>" />
          <input type="password" placeholder="password" name="pass" value="user" />
          <button>login</button>
          <p class="message">Not registered? <a href="signup.php">Create an account</a></p>
        </form>
        <a class="admin_link" href="admin">Admin Login</a>
      </div>
    </div>
  </body>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</html>