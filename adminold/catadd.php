
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php 

	$cat = new Category;

	if(isset($_POST['submit'])){
		$catName = $_POST['catname'];
		$insertCat = $cat->catInsert($catName);

	}

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>

               <div class="block copyblock"> 
                 <form action="" method="POST">
                    <table class="form">
                    <?php if(isset($insertCat)){ echo $insertCat;} ?>					
                        <tr>
                            <td>
                                <input type="text" placeholder="Enter Category Name..." name="catname" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>