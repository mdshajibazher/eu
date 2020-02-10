<?php include 'inc/header.php';?>


  
<?php include('inc/top_nav.php'); ?>
<?php include('inc/sidebar.php'); ?>
<?php include  '../classes/Order.php'; ?>
<?php include  '../classes/Students.php'; ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            
            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                  
                <?php
                    $order = new Order;
                    $getTotalOrder = $order->getTotalOrder();
                
                ?>
                <h3><?php echo $getTotalOrder->num_rows; ?></h3>
                
                <p>Total Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                 <?php
                     $getPendingOrder = $order->getPendingOrder();
                ?>
                <h3><?php echo $getPendingOrder->num_rows; ?></h3>

                <p>Pending Order</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                  
                <?php 
                    $st = new Students;
                    $getTotalStudents = $st->getTotalStudents;
                    var_dump($getTotalStudents);
                ?>
                <h3><?php echo $getTotalStudents->num_rows; ?></h3>

                <p>Total Students</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                  
                <?php
                    $getCancelledOrder  = $order->getCancelledOrder();
                ?>
                <h3><?php echo $getCancelledOrder->num_rows; ?></h3>

                <p>Cancelled Order</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
                </div>
        </section>
    </div>
</div>


<?php include('inc/footer.php'); ?>