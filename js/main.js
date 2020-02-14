(function ($) {
"use strict"

// mobile menu
$(document).ready(function(){
	$('.menu-button').click(function(){
		$('#menu').slideToggle('slow');
		$(this).toggleClass('active');
	})
})
})(jQuery);