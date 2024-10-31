(function($) {
    'use strict';
	/*about us counter*/
	$('.about-bottom-inner > span').each(function () {
		$(this).prop('Counter', 0).animate({
			Counter: $(this).text()
			}, {
				duration: 4000,
				easing: 'swing',
				step: function (now) {
				$(this).text(Math.ceil(now));
			}
		});
	});
})(jQuery);