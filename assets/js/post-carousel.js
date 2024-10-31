( function( $ ) {
	var WidgetCounter = function( $scope, $ ) {

		var $counterItems = $scope.find('.owl-slider-demo');

		if ( $counterItems.length > 0 ) {

			/*Feature Slider Carousel*/
			$counterItems.owlCarousel({
				loop: true,
				margin: 0,
				transitionStyle : "fade",
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
		elementorFrontend.hooks.addAction( 'frontend/element_ready/rt-widget-post-carousel.default', WidgetCounter );
	} );
} )( jQuery );