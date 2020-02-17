<?php include 'inc/header.php';?>


  
<?php include('inc/top_nav.php'); ?>
<?php include('inc/sidebar.php'); ?>
<?php include  '../classes/Order.php'; ?>
<?php include  '../classes/Students.php'; ?>
<?php include  '../classes/general_inf.php'; ?>

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
                    $getTotalOrder = $order->getTotalOrderCount();
                
                ?>
                <h3><?php  if($getTotalOrder){ echo $getTotalOrder->num_rows; }else{ echo 0; } ?></h3>
                
                <p>Total Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="order-list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                 <?php
                     $getPendingOrder = $order->getPendingOrderCount();
                ?>
                <h3><?php if($getPendingOrder){ echo $getPendingOrder->num_rows; }else{ echo 0;} ?></h3>

                <p>Pending Order</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="pending-order-list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                  
                <?php 
                    $st = new Students;
                    $getTotalStudents = $st->getTotalStudents();
                ?>
                <h3><?php if($getTotalStudents){ echo $getTotalStudents->num_rows; }else{ echo 0; } ?></h3>

                <p>Total Students</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="student-list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                  
                <?php
                    $getCancelledOrder  = $order->getCancelledOrderCount();
                ?>
                <h3><?php if($getCancelledOrder){ echo $getCancelledOrder->num_rows; }else{ echo 0; } ?></h3>

                <p>Cancelled Order</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="canceled-order-list.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->


                </div>
                <div class="row">
                   <div class="col-md-6">
                     
              <?php 
              $gi = new GeneralInf;
              $generalinf = $gi->getGeneralInforamtion(); 

              if($generalinf) :
                while ($general_inf_result= $generalinf->fetch_assoc()) :

              ?>

                      <div class="card">
              <div class="card-header bg-info">
                <h3 class="card-title">General Information</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th>Site Title</th>
                      <th>Discount</th>
                      <th>VAT</th>
                      <th>Shipping</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php echo $general_inf_result['site_title'] ?></td>
                      <td><span class="badge bg-success">
                        <?php echo $general_inf_result['discount'] ?>%</span>
                      </td>
                      <td><span class="badge bg-warning"><?php echo $general_inf_result['vat'] ?>%</span></td>
                      <td><span class="badge bg-info"><?php echo $general_inf_result['shipping'] ?> BDT</span></td>
                    </tr>
                   

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <a href="edit-general-inf.php"  class="btn btn-primary">Edit</a>
                </div>

            </div>

          <?php endwhile; endif; ?>


                   </div>
                </div>



              </div>
        </section>

    </div>
</div>


<?php include('inc/footer.php'); ?>