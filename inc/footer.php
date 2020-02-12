
        

        
        <!--footer-->
        <footer class="footer">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="author-dis">
                            <p>Copyright &copy; EU Canteen 2019.</p>
                            <p>Designed by Md Shajib Azher.</p>
                        </div>    
                    </div><!--/end col-md-6-->
                    <div class="col-sm-7">
                        <div class="f-menu-area">
                            <ul class="f-menu">
                                <li><a href="index.html">Home</a></li>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Terms and Conditions</a></li>
                                <li><a href="#">Faqs</a></li>
                                <li><a href="contact.html">Contact us</a></li>
                            </ul>
                        </div>
                    </div><!--/end col-md-6-->
                </div>
        </footer>
        <!--///end of footer-->









  <script src="js/vendor/jquery-3.4.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/cart.js"></script>
  <script src="js/moment.js"></script>
  <script src="js/bootstrapdatepicker.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script>

  </script>


  <script>
//payment method
  $(document).ready(function(){
    $("#sticker").sticky({topSpacing:0});
  $(".add-to-cart.btn").click(function(){
    $(this).text('success');
    $(this).addClass('animated tada');
    $(this).css("background-color","#f1c40f");
    $('.cart-item-count').addClass('bounce');
  });


//Datepicker 
$('#orderDate input').datepicker({
    todayHighlight : true,
    orientation    : "right",
    format : "dd-mm-yyyy"
});


  });
</script>

<script>
      jQuery(document).ready(function(){
  jQuery('input[name="order_submit"]').on('click', function(){
    var paymet = jQuery('select[id="payment_mod"]');
    var payment_mod = jQuery('select[id="payment_mod"]').val();
    var err_msg = 'Please Select Any Payment Method';
    if(payment_mod == 0){
        alert('please select any payment Method');
        jQuery('#msg').html(err_msg);
        jQuery('select[id="payment_mod"]').addClass('payment_error_msg');
        
        return false;
        
    }
    
  })
});
</script>
<script>

    </script>
    <script src="js/main.js"></script>

  


 

</body>

</html>
