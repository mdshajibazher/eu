<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php  include '../classes/category.php'; ?>
<?php $cat = new Category(); ?>

<?php
	if (isset($_GET['delid'])) {
		$delid = $_GET['delid'];
		$delcat = $cat->delCatById($delid);
	}

?>


        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">      
                  <?php if(isset($delcat)){ echo $delcat; } ?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php 

						$getCat = $cat->getAllCat();
						if($getCat){
							$i=0;
							while ($result = $getCat->fetch_assoc()) {
								$i++;
							?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['catname']; ?></td>
							<td><a href="catedit.php?catid=<?php echo $result['catid'];  ?>">Edit</a> || <a onclick="return confirm('Are You Sure?')" href="?delid=<?php echo $result['catid'];  ?>">Delete</a></td>
						</tr>
						<?php  	}	} ?>
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

