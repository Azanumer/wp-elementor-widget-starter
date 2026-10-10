/**
 * Editor-only script: re-run after each render so hooks stay attached.
 * Keep frontend logic in CSS/HTML where possible — this file is optional.
 */
(function ($) {
	'use strict';

	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/ews-testimonial-card.default', function ($scope) {
			// Example: add a subtle entrance animation when the widget scrolls into view.
			if ('IntersectionObserver' in window) {
				$scope.find('.ews-testimonial').css({ opacity: 0, transform: 'translateY(12px)', transition: 'opacity .5s, transform .5s' });
				var observer = new IntersectionObserver(function (entries) {
					entries.forEach(function (entry) {
						if (entry.isIntersecting) {
							entry.target.style.opacity = 1;
							entry.target.style.transform = 'none';
							observer.disconnect();
						}
					});
				}, { threshold: 0.2 });
				$scope.find('.ews-testimonial').each(function () {
					observer.observe(this);
				});
			}
		});
	});
})(jQuery);
