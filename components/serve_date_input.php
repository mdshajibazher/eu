<?php
if(isset($_POST['submit'])){
$date       = $_POST['datepicker'];
$serve_hour = $_POST['serve_hour'];

if($date == NULL){
$err1 = "Please Select a Specific Date using Datepicker";
}elseif($serve_hour == 0){
$err2 = "Please Select a Serve Hour";
}else{
$date_with_day_name = $date;
$nameOfDay = date('l', strtotime($date_with_day_name));
$_SESSION['custom_order_date'] = $date." ".$nameOfDay;
$_SESSION['serve_hour'] = $serve_hour;
echo "<script>window.location = ''; </script>";
}
}
?>
<div class="order-date-wrapper">
  <div class="row">
    <form class="dateinput_form" action="" method="POST">
      <div class="form-group" id="orderDate">
        <label for="exampleInputEmail1">Order Date</label>
        <input type="text" class="form-control" value="<?php if(isset($date)){ echo $date; } ?>" name="datepicker" placeholder="Enter Date Of Order" data-date-start-date="0d" readonly>
        <small class="form-text" style="color: red">
        <?php if(isset($err1)){
        echo $err1;
        }?></small>
      </div>
      <div class="form-group">
        <label for="exampleFormControlSelect2">Select Serve Hour</label>
        <select class="form-control" id="exampleFormControlSelect2" name="serve_hour">
          <option value="0">-----select Serve Hour-----</option>
          <?php
          $getServeHour = $pd->getServeHour();
          if($getServeHour) :
          while($serve_result = $getServeHour->fetch_assoc()) :
          ?>
          <option value="<?php echo $serve_result['id']; ?>"><?php echo $serve_result['period']; ?></option>
          <?php endwhile; endif; ?>
        </select>
        <small class="form-text" style="color: red">
        <?php if(isset($err2)){
        echo $err2;
        } ?></small>
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
  </div>
</div>