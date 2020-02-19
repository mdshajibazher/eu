(function ($) {
"use strict"



// mobile menu
$(document).ready(function(){
	$('.menu-button').click(function(){
		$('#menu').slideToggle('slow');
		$(this).toggleClass('active');
	})
});


//payment method
  $(document).ready(function(){

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


//Sticky Js //Sticky Js

 $("#sticker").sticky({topSpacing:0});





  });

  //Payment Method Js

      jQuery(document).ready(function(){
  jQuery('input[name="order_submit"]').on('click', function(){
    var paymet = jQuery('select[id="payment_mod"]');
    var payment_mod = jQuery('select[id="payment_mod"]').val();
    var err_msg = 'Please Select Any Payment Method';
    var card = 'Credit/Debit Card Payment Is Currently Unavailable';
    var bkash = 'Bkash Payment Is Currently Unavailable';

    if(payment_mod == 0){
        alert('please select any payment Method');
        jQuery('#msg').html(err_msg);
        jQuery('select[id="payment_mod"]').addClass('payment_error_msg');
        
    }else if(payment_mod == 2){
        alert('Credit/Debit Card Payment Is Currently Unavailable');
        jQuery('#msg').html(card);
        jQuery('select[id="payment_mod"]').addClass('payment_error_msg');
    }
    else if(payment_mod == 3){
        alert('Bkash Payment Is Currently Unavailable');
        jQuery('#msg').html(bkash);
        jQuery('select[id="payment_mod"]').addClass('payment_error_msg');
    }else{
      return true;
    }
    return false;
    
  });
});


var options = {

  url: "product.json",

  getValue: "name",

  list: {
    match: {
      enabled: true
    }
  },

  theme: "square"
};

$("#search").easyAutocomplete(options);


})(jQuery);


