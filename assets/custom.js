
(function($) {
	 "use strict";
	 alert('test');
	 $(".example").wrapAll('<div class="carousel-wrapper"></div>');
	$(document).on('ready', function() {	
		$('.slider-container').slick({
		  infinite: true,
		  slidesToShow: 3,
		  slidesToScroll: 3
		});

	});
});