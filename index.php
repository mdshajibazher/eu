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
				<!-- Cart  Modal -->
				<?php include('components/cart-modal.php'); ?>
			</div>
		</div>
		
		<!-- Start col 3 -->
		<div class="col-md-3">
			
			<?php include('components/sidebar-category.php'); ?>
		</div>
	</div>
	<!-- End row -->
</div>
<!-- End wrapper bg -->
<?php  } else{
//Serve Date Input
include('components/serve_date_input.php');
}
?>

<?php include 'inc/footer.php'; ?>