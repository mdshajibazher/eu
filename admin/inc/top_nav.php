  <?php
    include('../classes/Notification.php');
  ?>
  
  
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
      
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
      
    <?php
    
        $nt = new Notification;
        $getTotalUnreadOrder = $nt->getTotalUnreadOrder();
        $notification = $nt->OrderNotificationInf();
    
    ?>
      
      
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-danger navbar-badge"><?php echo $getTotalUnreadOrder->num_rows;  ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><?php echo $getTotalUnreadOrder->num_rows;  ?> Notifications</span>
          <div class="dropdown-divider"></div>
          <?php
          if($notification) :
             while($NotificationResult = $notification->fetch_assoc()) :
            $user_id = $NotificationResult['user_id'];
          ?>
          
          <a href="order-details.php?id=<?php echo $NotificationResult['order_id'] ?>&&read=1" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> New Order #<?php echo $NotificationResult['order_id'];  ?> From <?php echo  $nt->getUserName($user_id);  ?> <br>
            <span class="text-muted text-sm"><?php 
            
             $ago =  $nt->time_elapsed_string($NotificationResult['purchaseAt'],'false');
             echo $ago;
             ?></span>
          </a>
          
          
          <div class="dropdown-divider"></div>
         <?php endwhile; endif;  ?>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <?php 
          if(isset($_GET['action']) && $_GET['action'] == 'logout'){
             Session::destroy();
           } 
         ?>
        <a href="?action=logout" class="nav-link"> <i class="fa fa-sign-out-alt"></i>Logout</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->