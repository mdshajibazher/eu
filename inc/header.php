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
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="description" content="Eu E-Canteen">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
  <meta name="theme-color" content="#fafafa">
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="favicon.png">
  <!--Fontawesome Css-->
  <link rel="stylesheet" href="css/font-awesome.css">
  <!-- Easy Auto Complete Theme Css -->
  <link rel="stylesheet" href="css/easy-autocomplete.themes.css">
  <!-- Easy Auto Complete Css -->
  <link rel="stylesheet" href="css/easy-autocomplete.min.css">
  <!--Bootstrap Datepicker Css-->
  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <!--Animate Css-->
  <link rel="stylesheet" href="css/animate.css">
    <!--Bootstrap  Css-->
  <link rel="stylesheet" href="css/bootstrap.css">
  <!--Style Css-->
  <link rel="stylesheet" href="style.css">
   <!-- Responsive css -->
  <link rel="stylesheet" href="responsive.css">
  <title>Eu e-Canteen</title>
</head>

<body>
  <!-- Page Loader -->
     <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->

    <div class="container-fluid" >
      <div class="header-area" id="sticker">
      <div class="row">
           <div class="col-md-4">
              <div class="main-wrapper">
                  <div class="banner">
                   <img src="img/banner.png" alt="">
                 </div>
              </div>
           </div>
           <div class="col-md-1">
                <span class="badge information">Welcome,<br>
              <?php echo $_SESSION['name'] ?></span>      
                
          

           </div>
           <div class="col-md-1">
             <div class="cart-item-count animated">
              <a href="#" class="" id="basket" data-toggle="modal" data-target="#cart" ><i class="fa fa fa-cart-plus" ></i> <span class="total-count"></span></a>
            </div>
           </div>
          <div class="col-md-2">
            <div class="order-date-badge">
                <span class="badge badge-warning">
              <?php 
              if(isset($_SESSION['custom_order_date'])){
                 echo "Order For: ".$_SESSION['custom_order_date'];
              }else{
                echo "No Date Selected";
              } ?>
            </span>
            </div>

          </div>
           <div class="col-md-4 col-xs-2">
              <form action="search.php" method="GET">
                <div class="search-box">
                  <div class="input-group">
                    <input  id="search" type="text" value="" class="form-control" name="s" placeholder="Search Food...." autofocus>
                    <div class="text-rotate-box">

                    </div>
                    <div class="input-group-append">
                      <button class="btn btn-secondary" type="submit">
                        <i class="fa fa-search"></i>
                      </button>

                    </div>
                  </div>
                </div>
                </form>
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
                    <li><a href="index.php">Home</a></li>
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