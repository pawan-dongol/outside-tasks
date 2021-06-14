
(function($) {
	 "use strict";
	$(document).on('ready', function() {	
		$('.slider-container').slick({
		  infinite: true,
		  slidesToShow: 3,
		  slidesToScroll: 3
		});
	});
});