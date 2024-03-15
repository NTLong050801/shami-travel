(function($) {

	

	"use strict";

	var accordian_carousel_js = function($scope, $) {

		

		//Accordion Box
		if ($('.accordion-box').length) {
			// Attach a click event handler to elements with class 'acc-btn' inside '.accordion-box'
			$(".accordion-box").on('click', '.acc-btn', function() {
				// Get the outer accordion box and the specific accordion associated with the clicked button
				var outerBox = $(this).closest('.accordion-box');
				var target = $(this).closest('.accordion');
	
				// Check if the clicked button does not have the class 'active'
				if (!$(this).hasClass('active')) {
					// Remove the 'active' class from all accordion buttons within the same accordion box
					outerBox.find('.accordion .acc-btn').removeClass('active');
				}
	
				// Check if the next '.acc-content' element is visible
				if ($(this).next('.acc-content').is(':visible')) {
					return false; // Prevent further action if it's visible
				} else {
					// Add the 'active' class to the clicked button
					$(this).addClass('active');
	
					// Remove the 'active-block' class from all '.accordion' elements within the same accordion box
					outerBox.find('.accordion').removeClass('active-block');
	
					// Slide up all '.acc-content' elements within the accordion box
					outerBox.find('.accordion .acc-content').slideUp(300);
	
					// Add the 'active-block' class to the specific '.accordion'
					target.addClass('active-block');
	
					// Slide down the next '.acc-content' element
					$(this).next('.acc-content').slideDown(300);
				}
			});
		}

		

	};

	$(window).on('elementor/frontend/init', function () {

            elementorFrontend.hooks.addAction('frontend/element_ready/travic_our_faqs.default', accordian_carousel_js);

    });	



})(window.jQuery);