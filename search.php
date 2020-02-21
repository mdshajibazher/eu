<?php include 'inc/header.php';
$pd_name = $_GET['s'];
?>
<?php if(isset($_SESSION['custom_order_date']) && isset($_SESSION['custom_order_date'])){ ?>
<div class="wrapper-bg">
  <div class="row">
    <div class="col-md-9">
      <div class="Product-Area">
        <div class="section-title"><span>Serach Result For "<?php echo $pd_name ?>"</span></div>
        <div class="row">

        <?php if($pd_name == NULL) : ?>
            <div class="item-404">
              <h1 class="display-5 text-center">404 Oops! You Dont Type Anything</h1>
              <p class="text-muted">
                We could not find the product you were looking for.
                Meanwhile, you may  return to <a href="index.php">Homepage</a> or try amother on the search form.</p>
              </div>
              </div>


        <?php else:  ?>


        
          <?php
          $getSearchedProduct = $pd->getSearchedProduct($pd_name);
          if($getSearchedProduct){
          while($result=$getSearchedProduct->fetch_assoc()){
          ?>
          <!-- Single Product Card -->
          <?php  if($getSearchedProduct->num_rows < 2) : ?>
          <div class="col-md-4 offset-md-4">
            <?php else : ?>
            <div class="col-md-4">
              <?php endif; ?>
              <img class="card-img-top img-thumbnail" src="admin/<?php echo $result['image']; ?>" alt="Card image cap">
              <h4><?php echo $result['productname']; ?></h4>
              <p><?php echo $result['description']; ?></p>
              <div class="link">
                <h4>Tk <?php echo $result['price']; ?></h4>
                <a href="#" data-name="<?php echo $result['sku']; ?>" data-id="<?php echo $result['productid']; ?>" data-price="<?php echo $result['price']; ?>" class="add-to-cart btn btn-success">Add to cart</a>
              </div>
            </div>
            <?php } }else{ ?>
            <div class="item-404">
              <h1 class="display-5 text-center">404 Oops! No Item Found</h1>
              <p class="text-muted">
                We could not find the product you were looking for.
                Meanwhile, you may  return to <a href="index.php">Homepage</a> or try amother on the search form.</p>
              </div>
              <?php  } ?>
            </div>


        <?php endif; ?>


            <!-- Cart  Modal -->
            <?php include('components/cart-modal.php'); ?>
          </div>
        </div>
        <!-- End col-md-9  -->
        <div class="col-md-3">
          <?php include('components/sidebar-category.php');  ?>
        </div>
      </div>
    </div>
    <?php  } else{
    //Serve Date Input  Form & Functionality
    include('components/serve_date_input.php');
    }
    ?>
    <?php include 'inc/footer.php'; ?>

