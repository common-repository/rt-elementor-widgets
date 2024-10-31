( function( $ ) {
	var WidgetCounter = function( $scope, $ ) {

		var $counterItems = $scope.find('.counters-item');

		var $counter_setting = $scope.find( '.about-bottom-inner > span' ).eq(0);

		if ( $counterItems.length > 0 ) {

			$counterItems.each(function (i) {
				var el = $counterItems[i],
					$el = $(el),
					from = $el.data('from'),
					to =  $el.data('to'),
					duration = $el.data('duration');


				$(this).prop('Counter', from).animate({
					Counter: to
					}, {
						'duration': duration,
						easing: 'swing',
						step: function (now) {
						$(this).text(Math.ceil(now));
					}
				});
			});	
		}
	};
	
	// Make sure we run this code under Elementor
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/rt-widget-counter.default', WidgetCounter );
	} );
} )( jQuery );