<?php include 'inc/header.php';
$id = $_GET['id'];
?>

<?php if(isset($_SESSION['custom_order_date']) && isset($_SESSION['custom_order_date'])){ ?>

<div class="wrapper-bg">
  <div class="row">
    <div class="col-md-9">
      
      
      <div class="Product-Area">
        <div class="section-title"><span>Single Product</span></div>
        <div class="row">
          <?php
          $getSingleProduct = $pd->getSingleProduct($id);
          if($getSingleProduct){
          $i=0;
          while($result=$getSingleProduct->fetch_assoc()){
          
          ?>
          
          <!-- Single Product Card -->
          
          <div class="col-md-6 offset-md-3">
            <img class="card-img-top img-thumbnail" src="admin/<?php echo $result['image']; ?>" alt="Card image cap">
            
            <h4><?php echo $result['productname']; ?></h4>
            <p><?php echo $result['description']; ?></p>
            <div class="link">
              <h4>Tk <?php echo $result['price']; ?></h4>
              <a href="#" data-name="<?php echo $result['sku']; ?>" data-id="<?php echo $result['productid']; ?>" data-price="<?php echo $result['price']; ?>" class="add-to-cart btn btn-success">Add to cart</a>
            </div>
            
          </div>
          <?php } }  ?>
        </div>
        
        
        <!-- Cart  Modal -->
        <?php include('components/cart-modal.php'); ?>
      </div>
    </div>
    <!-- End col-md-9  -->
    <div class="col-md-3">
      
      <div class="categories">
        <div class="cat-right">
          <div class="canteen-categories">
            <div class="cat-right-title">
              
              <h1>Categories</h1>
            </div>
            <ul>
              <?php $getAllCat = $ct->getAllCatWithLimit(6);
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

//Serve Date Input  Form & Functionality
include('components/serve_date_input.php');
}
?>


<?php include 'inc/footer.php'; ?>