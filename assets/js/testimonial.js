( function( $ ) {
	var WidgetCounter = function( $scope, $ ) {

		var $counterItems = $scope.find('.testimonial-wrap');

		if ( $counterItems.length > 0 ) {

			/*Testimonial section carousel*/
			$counterItems.owlCarousel({
				loop: true,
				margin: 0,
				autoplay:1000, 
				smartSpeed: 1000,
				responsive: {
					0: {
						items: 1
					}
				}
			});	

		}
	};
	
	// Make sure we run this code under Elementor
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/rt-widget-testimonial.default', WidgetCounter );
	} );
} )( jQuery );