<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php' ?>


<?php 
	$pd = new Product;
	$fm = new Format;

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Productname</th>
					<th>Sku</th>
					<th>Desription</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Added at</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 

					$getProduct = $pd->getAllProduct();
					if($getProduct){
						$i=0;
						while($result=$getProduct->fetch_assoc()){
					
				 ?>


				<tr class="odd gradeX">
					<td><?php echo $result['productname'];  ?></td>
					<td><?php echo $result['sku'];  ?></td>
					<td width="20%"><?php echo $fm->textShorten(strip_tags($result['description']), 100)  ?></td>
					<td><?php echo $result['price'];  ?></td>
					<td><?php echo $result['image'];  ?></td>
					<td><?php echo $result['type'];  ?></td>
					<td><?php echo $result['time'];  ?></td>
					<td><a href="">Edit</a> || <a href="">Delete</a></td>
				</tr>

			 <?php }	} ?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
