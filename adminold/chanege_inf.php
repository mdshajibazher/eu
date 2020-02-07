<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update General Information</h2>
        <div class="block sloginblock">
        <?php 
            include '../classes/general_inf.php';
            $gi = new GeneralInf;
                


            if(isset($_POST['update'])){
                $updateQuery = $gi->updateGeneralInforamtion($_POST);
            }


            echo isset($updateQuery) ?  $updateQuery : ''; 



            $query = $gi->getGeneralInforamtion();

            if($query){
                while($result = $query->fetch_assoc()){


        ?>

         <form action="" method="POST">
            <table class="form">					
                <tr>
                    <td>
                        <label>Change Discount Percentage (%)</label>
                    </td>
                    <td>
                        <input type="number"   name="discount" class="medium" value="<?php echo $result['discount'];  ?>" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Change VAT  Percentage (%)</label>
                    </td>
                    <td>
                        <input type="number" name="vat" class="medium" value="<?php echo $result['vat'];  ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Change Processing Fee</label>
                    </td>
                    <td>
                        <input type="number"  name="processing_fee" class="medium" value="<?php echo $result['processing_fee'];  ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Change Site Title</label>
                    </td>
                    <td>
                        <input type="text"  name="site_title" class="medium" value="<?php echo $result['site_title'];  ?>"/>
                    </td>
                </tr>
				 <?php             }  } ?>
				
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="update" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>