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
<html class="no-js" lang="">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <title>Eu e-Canteen</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="css/font-awesome.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="css/animate.css">

  <meta name="theme-color" content="#fafafa">
</head>

<body>
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

  <!-- Add your site or application content here -->

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
      <div class="row" background="#fff">
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

          <!-- Navbar Start -->
    <nav class="nav-bar">
        <div class="row">
          <div class="col-md-12">
            <div class="menu-area">
              <div class="bars" id="bars">
                <i class="fa fa-bars"></i>
              </div>
              <ul class="menu" id="menu">
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="user_dashboard.php">My Account</a></li>
                <li><a href="#">About Developers</a></li>
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
