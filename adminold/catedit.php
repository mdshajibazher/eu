
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php 

	$cat = new Category;

	if(!isset($_GET['catid']) || $_GET['catid'] == NULL ){
	    echo "<script>window.location = 'catlist.php';</script>";
        die();
	}else{

        $id= $_GET['catid'];
    }

    if(isset($_POST['submit'])){
        $catName = $_POST['catname'];
        $updatecat = $cat->catUpdate($catName, $id);

    }

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
                <?php 

                

                $getCat = $cat->getCatById($id);

                if($getCat){
                    while ($result = $getCat->fetch_assoc()) {
                        # code...
                ?>
               <div class="block copyblock"> 
                 <form action="" method="POST">
                    <table class="form">
                    <?php if(isset($updatecat)){ echo $updatecat;} ?>					
                        <tr>
                            <td>

                                <input type="text" value="<?php echo $result['catname']; ?>" name="catname" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>