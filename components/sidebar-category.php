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