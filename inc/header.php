<?php 
  include 'lib/studentsession.php';
  Session::checkSession();

  include_once "classes/category.php";
  include_once "classes/product.php";

  include_once 'helpers/format.php';


  
  $ct = new Category;
  $pd = new Product;
  $fm = new Format;
  

?>

<!doctype html>
<html lang="en-us">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <title>Eu e-Canteen</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="manifest" href="site.webmanifest">
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="favicon.png">
  <!--Fontawesome Css-->
  <link rel="stylesheet" href="css/font-awesome.css">
  <!--Bootstrap  Css-->
  <link rel="stylesheet" href="css/bootstrap.css">
  <!--Bootstrap Datepicker Css-->
  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <!--Animate Css-->
  <link rel="stylesheet" href="css/animate.css">
  <!--Style Css-->
  <link rel="stylesheet" href="style.css">
   <!-- Responsive css -->
  <link rel="stylesheet" href="responsive.css">
  <meta name="theme-color" content="#fafafa">
</head>

<body>

    <div class="float-information">
      <?php 
      if(isset($_SESSION['custom_order_date'])){
         echo "Order For: ".$_SESSION['custom_order_date'];
      }else{
        echo "No Date Selected";
      }

      ?>
    </div>

    <div class="container-fluid" >
      <div class="header-area" id="sticker">
      <div class="row">
           <div class="col-md-5">
              <div class="main-wrapper">
                  <div class="banner">
                   <img src="img/banner.png" alt="">
                 </div>
              </div>
           </div>
           <div class="col-md-1">
             <div class="cart-item-count animated">
              <a href="#" class="" id="basket" data-toggle="modal" data-target="#cart" ><i class="fa fa fa-cart-plus" ></i> <span class="total-count"></span></a>
            </div>
           </div>

           <div class="col-md-6">
                <div class="search-box">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search Food">
                    <div class="input-group-append">
                      <button class="btn btn-secondary" type="button">
                        <i class="fa fa-search"></i>
                      </button>

                    </div>
                  </div>
                </div>
           </div>
      </div>
    <div class="row">
      <div class="col-md-12">
          <!-- Navbar Start -->
    <nav class="nav-bar">
        <div class="row">
            <div class="col-md-12">
           
                <div class="menu-area">
                <div class="button-wrapper">
            <div class="menu-button">
    						<span></span>
    						<span></span>
    						<span></span>
    					</div>
          </div>
                  <ul class="menu" id="menu">
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="user_dashboard.php">My Account</a></li>
                    <li><a href="?action=logout">Logout</a></li>
                    <?php if(isset($_GET['action']) && $_GET['action'] == 'logout'){
                          session_destroy();
                       echo "<script>
                            sessionStorage.clear();
                              window.location ='login.php';
                            </script>";
                    } ?>
                  </ul>
                </div>

            </div>
        </div>


    </nav>
    <!-- end .nav-bar -->
      </div>
      </div>
      </div>