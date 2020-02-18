<?php include 'inc/header.php'; ?>






      <?php if(isset($_SESSION['custom_order_date']) && isset($_SESSION['custom_order_date'])){ ?>


        <div class="wrapper-bg">
        <div class="row">
          <div class="col-md-9">
            
       
      <div class="Product-Area">
          <div class="section-title"><span>All Item</span></div>
          <div class="row">
        <?php 
          $getProduct = $pd->getAllProduct();
          if($getProduct){
            $i=0;
            while($result=$getProduct->fetch_assoc()){
             
         ?>
  
          <!-- Single Product Card -->
          
          <div class="col-md-2 col-lg-2">
              <div class="single-product">
              <img class="card-img-top" src="admin/<?php echo $result['image']; ?>" alt="Card image cap">
                <div class="product-title">
                  <h4 class="card-title"><?php echo $result['productname']; ?></h4>
                </div>
              <div class="link">
                    <h4 class="price">Tk <?php echo $result['price']; ?></h4>
                    <a href="#" data-name="<?php echo $result['sku']; ?>" data-id="<?php echo $result['productid']; ?>" data-price="<?php echo $result['price']; ?>" class="add-to-cart btn btn-custom">Add to cart</a>
                    </div>
                    <a class="btn-details" href="single.php?id=<?php echo $result['productid']; ?>"><i class="fa fa-eye"></i></a>
               </div>
              </div>

         <?php } }  ?>

        </div>


                         <!-- Modal -->
          <div class="modal" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Cart</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body table-responsive-sm">
                  <table class="show-cart table">
                    <tr>
                    <p id="para"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>LOADING................</p>
                    </tr>

                    
                  </table>
                  <div class="tp">Total price in BDT: <span class="total-cart"></span> TK</div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" id="complete-order" class="btn btn-primary">Checkout</button>

                </div>
              </div>
            </div>
          </div> 
      </div>              
  </div>
         <!-- End col-md-9  -->
         <div class="col-md-3">
           

              <div class="sidebar">
                <div class="cat-right">
            <div class="canteen-categories">
              <div class="cat-right-title">
                
                <h1>Categories</h1>
              </div>
              <ul>
                <?php $getAllCat = $ct->getAllCatWithLimit(8);
                     if($getAllCat){
                         while($catResult = $getAllCat->fetch_assoc()){
                 ?>
                <li><a href="category_view.php?id=<?php echo $catResult['id']; ?>"><i class="fa fa-arrow-right"></i><?php echo $catResult['catname']; ?></a></li>

              <?php } }?>
              </ul>
            </div>
            <div class="recent-post">
              <div class="cat-right-title">
                <h1>Recent Item</h1>
              </div>
              <ul>
                <?php 

                  $getRecentProduct = $pd->getRecentProduct(6);
                  if($getRecentProduct){
                    $i=0;
                    while($result=$getRecentProduct->fetch_assoc()){
                     
                 ?>
                <li><a href="single.php?id=<?php echo $result['productid']; ?>"><i class="fa fa-angle-right"></i><?php echo $result['productname']; ?><br><span><?php echo date( "d/m/Y g:i a", strtotime($result['time'])); ?></span></a></li>

                <?php } }  ?>

              </ul>
            </div>

          </div>
              </div>
         </div>
        </div>

        </div>




     <?php  } else{

  if(isset($_POST['submit'])){
      $date       = $_POST['datepicker'];
      $serve_hour = $_POST['serve_hour'];
      
      if($date == NULL){
          $err1 = "Please Select a Specific Date using Datepicker";
      }elseif($serve_hour == 0){
           $err2 = "Please Select a Serve Hour";
      }else{
        $date_with_day_name = $date;
        $nameOfDay = date('l', strtotime($date_with_day_name));
        $_SESSION['custom_order_date'] = $date." ".$nameOfDay;
        $_SESSION['serve_hour'] = $serve_hour;
        echo "<script>window.location = ''; </script>";
      }
  }

?>
      <div class="order-date-wrapper">
      <div class="row">

      <form class="dateinput_form" action="" method="POST">
  <div class="form-group" id="orderDate">
    <label for="exampleInputEmail1">Order Date</label>
    <input type="text" class="form-control" value="<?php if(isset($date)){ echo $date; } ?>" name="datepicker" placeholder="Enter Date Of Order" data-date-start-date="0d" readonly>
    <small class="form-text" style="color: red">
      <?php if(isset($err1)){
        echo $err1;
    }?></small>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect2">Select Serve Hour</label>
    <select class="form-control" id="exampleFormControlSelect2" name="serve_hour">
      <option value="0">-----select Serve Hour-----</option>
      <?php 

          $getServeHour = $pd->getServeHour();

          if($getServeHour) : 
          while($serve_result = $getServeHour->fetch_assoc()) :

       ?>
      <option value="<?php echo $serve_result['id']; ?>"><?php echo $serve_result['period']; ?></option>

      <?php endwhile; endif; ?>
    </select>
    <small class="form-text" style="color: red">
      <?php if(isset($err2)){
        echo $err2;
    } ?></small>
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>
      </div>
      </div>





     <?php  }

      ?>
              
      

<?php include 'inc/footer.php'; ?>
            



