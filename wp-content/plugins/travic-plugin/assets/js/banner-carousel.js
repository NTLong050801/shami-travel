(function($) {
	
	"use strict";
	var banner_carousels_js = function($scope, $) {
		
	function thmOwlInit() {
		// owl slider
	
		if ($(".owl-theme").length) {
		  $(".owl-theme").each(function () {
			let elm = $(this);
			let options = elm.data('owl-options');
			let thmOwlCarousel = elm.owlCarousel(options);
		  });
		}
	
		if ($(".owl-theme--custom-nav").length) {
		  $(".owl-theme--custom-nav").each(function () {
			let elm = $(this);
			let owlNavPrev = elm.data('owl-nav-prev');
			let owlNavNext = elm.data('owl-nav-next');
			$(owlNavPrev).on("click", function (e) {
			  elm.trigger('prev.owl.carousel');
			  e.preventDefault();
			})
	
			$(owlNavNext).on("click", function (e) {
			  elm.trigger('next.owl.carousel');
			  e.preventDefault();
			})
		  });
		}
	
	  }
	  
	  thmOwlInit();	
		
	};
	$(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/travic_banner_slider.default', banner_carousels_js);
			elementorFrontend.hooks.addAction('frontend/element_ready/travic_testimonials_carousel.default', banner_carousels_js);
			elementorFrontend.hooks.addAction('frontend/element_ready/travic_clients_section.default', banner_carousels_js);
			elementorFrontend.hooks.addAction('frontend/element_ready/travic_instagram_section.default', banner_carousels_js);
			elementorFrontend.hooks.addAction('frontend/element_ready/travic_categories_section.default', banner_carousels_js);
			elementorFrontend.hooks.addAction('frontend/element_ready/travic_packages_carousel.default', banner_carousels_js);
    });	

})(window.jQuery);