<?php include 'classes/studentlogin.php'; ?>
<?php include 'classes/product.php'; ?>
<?php
$sl = new Studentlogin;
$pd = new Product;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
$id = $_POST['id'];
$pass = md5($_POST['pass']);
$date       = $_POST['datepicker'];
$serve_hour = $_POST['serve_hour'];

$loginChk = $sl->Studentlogin($id, $pass,$date,$serve_hour);
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
    <!--Bootstrap Datepicker Css-->
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link href="css/login.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">

  </head>
  <body>
    <div class="login-page">
      <div class="form">
        <form class="login-form" method="POST" action="">
          
          <h3>Student Login</h3>
          <p style="color: green"><?php if(isset($_SESSION['activate'])){ echo $_SESSION['activate']; } ?></p>
          
          <img src="img/banner.png" width="100%">
          <span style="color:red"><?php if(isset($loginChk['login_msg'])){ echo $loginChk['login_msg']; } ?> </span>
          <label for="id">Email/Student Id</label>
          <input type="text" class="form-control" placeholder="email/studentid" name="id" id="id" value="<?php if(isset($_POST['id'])){ echo $_POST['id']; }else{ echo "user"; } ?>" />
          <label for="password">Pasword</label>
          <input type="password" class="form-control" placeholder="password" id="password" name="pass" value="user" />
          
          <div id="orderDate" style="overflow: hidden;">
            <label for="date">Order Date</label>
            <input type="text" id="date" class="form-control"  value="<?php if(isset($date)){ echo $date; }else{ echo date('d-m-Y');} ?>" name="datepicker" placeholder="Enter Date Of Order" data-date-start-date="0d" readonly>
          <?php if(isset($loginChk['date'])){
          echo $loginChk['date'];
          } ?>
          </div>
          <label for="s_hour">Serve Hour</label>
          <select class="form-control" id="exampleFormControlSelect2" name="serve_hour" id="s_hour">
            <option value="0">-----select Serve Hour-----</option>
            <?php
            $getServeHour = $pd->getServeHour();
            if($getServeHour) :
            while($serve_result = $getServeHour->fetch_assoc()) :
            ?>
            <option value="<?php echo $serve_result['id']; ?>" <?php if($serve_result['id'] == 2){ echo "selected"; } ?> ><?php echo $serve_result['period']; ?></option>
            <?php endwhile; endif; ?>
          </select>
          <?php if(isset($loginChk['s_hour'])){
          echo $loginChk['s_hour'];
          } ?>
          <button type="submit" class="btn btn-success">login</button>
          <p class="message">Not registered? <a href="signup.php">Create an account</a></p>
        </form>
        <a class="admin_link" href="admin">Admin Login</a>
      </div>
    </div>
  </body>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="js/bootstrapdatepicker.js"></script>
  <script>
  $(document).ready(function(){
  $('#date').datepicker({
  todayHighlight : true,
  orientation    : "right",
  format : "dd-mm-yyyy"
  })
  });
  </script>
</html>