// Menu JS
$(function () {
	$(window).scroll(function () {
		if ($(this).scrollTop() < 50) {
			$("nav").removeClass("site-top-nav");
		} else {
			$("nav").addClass("site-top-nav");
		}
	});
});

//Shopping Cart JS
$( function() {
	$( "#shopping-cart" ).on( "click", function() {
	  $( "#cart-content" ).toggle( "blind", "", 500 );
	});
} );
	
