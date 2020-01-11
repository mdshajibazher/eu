<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include  '../classes/brand.php'; ?>
<?php include  '../classes/product.php'; ?>
<?php include  '../classes/category.php'; ?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>

        <div class="block"> 
        <h1><?php 
  $pd = new Product;
  if(isset($_POST['submit'])){
        $insertProduct = $pd->productInsert($_POST, $_FILES);

    }
?></h1>
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               <h1></h1> 
                <tr>
                    <td>
                        
                        <label>Product Name</label>
                    </td>
                    <td>
                        
                        <input type="text" placeholder="Enter Product Name..." class="medium" name="productname" value="<?php if(isset($_POST['productname'])){ echo $_POST['productname']; } ?>" />
                        <?php if(isset($insertProduct['product_name'])){ echo $insertProduct['product_name'];} ?>

                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="categoryid">
                            <option value="">Select Category</option>
                            <?php $cat = new Category;

                            $getCat = $cat->getAllCat();
                            while($result = $getCat->fetch_assoc()) :  ?>

                            <option value="<?php echo $result['id']; ?>"><?php echo $result['catname']; ?></option>

                            <?php  endwhile; ?>

                        </select>
                        <?php if(isset($insertProduct['categoryId'])){ echo $insertProduct['categoryId'];} ?>

                    </td>
                </tr>   
                              

				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="description"><?php if(isset($_POST['description'])){ echo $_POST['description']; } ?></textarea>
                        <?php if(isset($insertProduct['description'])){ echo $insertProduct['description'];} ?>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="number" placeholder="Enter Price..." class="medium" name="price" value="<?php if(isset($_POST['description'])){ echo $_POST['description'];} ?>" />
                        <?php if(isset($insertProduct['price'])){ echo $insertProduct['price'];} ?>
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file" name="image" /><br>
                         <?php if(isset($insertProduct['image'])){ echo $insertProduct['image'];} ?>
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option value="">Select Type</option>
                            <option value="0">Featured</option>
                            <option value="1">General</option>
                        </select>
                        <?php if(isset($insertProduct['type'])){ echo $insertProduct['type'];} ?>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


