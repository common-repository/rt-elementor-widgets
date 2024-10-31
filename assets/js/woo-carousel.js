( function( $ ) {
	var WidgetCounter = function( $scope, $ ) {

		var $counterItems = $scope.find('.product-carousel');

		if ( $counterItems.length > 0 ) {

			/*Testimonial section carousel*/
			$counterItems.owlCarousel({
				loop:false,
				margin: 0,
				autoplay:false, 
				smartSpeed: 1000,
				responsive: {
					0: {
						items: 1
					},
					480: {
						items: 2
					},
					768: {
						items: 3
					},
					992: {
						items: 4
					}
				}
			});	

		}
	};
	
	// Make sure we run this code under Elementor
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/rt-widget-woo-carousel.default', WidgetCounter );
	} );
} )( jQuery );