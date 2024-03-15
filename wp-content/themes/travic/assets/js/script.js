(function($) {
	
	"use strict";
	
	//Hide Loading Box (Preloader)
	function handlePreloader() {
		if($('.loader-wrap').length){
			$('.loader-wrap').delay(1000).fadeOut(500);
		}
	}

	if ($(".preloader-close").length) {
        $(".preloader-close").on("click", function(){
            $('.loader-wrap').delay(200).fadeOut(500);
        })
    }
	
	//Update Header Style and Scroll to Top
	function headerStyle() {
		if($('.main-header').length){
			var windowpos = $(window).scrollTop();
			var siteHeader = $('.main-header');
			var scrollLink = $('.scroll-top');
			if (windowpos >= 110) {
				siteHeader.addClass('fixed-header');
				scrollLink.addClass('open');
			} else {
				siteHeader.removeClass('fixed-header');
				scrollLink.removeClass('open');
			}
		}
	}
	
	headerStyle();


	//Submenu Dropdown Toggle
	if($('.main-header li.dropdown ul').length){
		$('.main-header .navigation li.dropdown').append('<div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>');
		
	}

	//Mobile Nav Hide Show
	if($('.mobile-menu').length){
		
		
		var mobileMenuContent = $('.main-header .menu-area .main-menu').html();
		$('.mobile-menu .menu-box .menu-outer').append(mobileMenuContent);
		$('.sticky-header .main-menu').append(mobileMenuContent);
		
		//Dropdown Button
		$('.mobile-menu li.dropdown .dropdown-btn').on('click', function() {
			$(this).toggleClass('open');
			$(this).prev('ul').slideToggle(500);
		});
		//Dropdown Button
		$('.mobile-menu li.dropdown .dropdown-btn').on('click', function() {
			$(this).prev('.megamenu').slideToggle(900);
		});
		//Menu Toggle Btn
		$('.mobile-nav-toggler').on('click', function() {
			$('body').addClass('mobile-menu-visible');
		});

		//Menu Toggle Btn
		$('.mobile-menu .menu-backdrop,.mobile-menu .close-btn').on('click', function() {
			$('body').removeClass('mobile-menu-visible');
		});
	}

	// Elements Animation
	if($('.wow').length){
		var wow = new WOW({
		mobile:       false
		});
		wow.init();
	}

	
	//Fact Counter + Text Count
	if($('.count-box').length){
		$('.count-box').appear(function(){
	
			var $t = $(this),
				n = $t.find(".count-text").attr("data-stop"),
				r = parseInt($t.find(".count-text").attr("data-speed"), 10);
				
			if (!$t.hasClass("counted")) {
				$t.addClass("counted");
				$({
					countNum: $t.find(".count-text").text()
				}).animate({
					countNum: n
				}, {
					duration: r,
					easing: "linear",
					step: function() {
						$t.find(".count-text").text(Math.floor(this.countNum));
					},
					complete: function() {
						$t.find(".count-text").text(this.countNum);
					}
				});
			}
			
		},{accY: 0});
	}


	//LightBox / Fancybox
	if($('.lightbox-image').length) {
		$('.lightbox-image').fancybox({
			openEffect  : 'fade',
			closeEffect : 'fade',
			helpers : {
				media : {}
			}
		});
	}

    
	//Accordion Box
	if ($('.te-detail__accordian').length) {
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
	
	// Tour Gallery Slider
	if ($('.te-hero__gallery .te-gallery__carousel').length && $('.te-hero__gallery .thumbs-carousel').length) {

		var $sync1 = $(".te-hero__gallery .te-gallery__carousel"),
			$sync2 = $(".te-hero__gallery .thumbs-carousel"),
			flag = false,
			duration = 500;

			$sync1
				.owlCarousel({
					loop:false,
					items: 1,
					margin: 0,
					nav: true,
					navText: [ '<span class="far fa-angle-left"></span>', '<span class="far fa-angle-right"></span>' ],
					dots: true,
					autoplay: true,
					autoplayTimeout: 5000,
				})
				
				.on('changed.owl.carousel', function (e) {
					if (!flag) {
						flag = false;
						$sync2.trigger('to.owl.carousel', [e.item.index, duration, true]);
						flag = false;
					}
				});

			$sync2
				.owlCarousel({
					loop:false,
					margin: 30,
					items: 1,
					nav: false,
					dots: false,
					center: false,
					autoplay: true,
					autoplayTimeout: 5000,
					responsive: {
						0:{
				            items:2,
				            autoWidth: false
				        },
				        400:{
				            items:3,
				            autoWidth: false
				        },
				        600:{
				            items:3,
				            autoWidth: false
				        },
				        900:{
				            items:3,
				            autoWidth: false
				        },
				        1000:{
				            items:5,
				            autoWidth: false
				        }
				    },
				})
				
		.on('click', '.owl-item', function () {
			$sync1.trigger('to.owl.carousel', [$(this).index(), duration, true]);
		})
		.on('changed.owl.carousel', function (e) {
			if (!flag) {
				flag = true;		
				$sync1.trigger('to.owl.carousel', [e.item.index, duration, true]);
				flag = false;
			}
		});
	}
	
	// five-item-carousel
	if ($('.te-gallery__carousel-two').length) {
		$('.te-gallery__carousel-two').owlCarousel({
			loop:true,
			margin:30,
			nav:true,
			smartSpeed: 500,
			autoplay: 1000,
			navText: [ '<span class="far fa-angle-left"></span>', '<span class="far fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				480:{
					items:2
				},
				600:{
					items:3
				},
				800:{
					items:4
				},			
				1200:{
					items:5
				}

			}
		});    		
	}
	
	//Tabs Box
	if($('.tabs-box-tour__detail').length){
		$('.tabs-box .tab-buttons .tab-btn').on('click', function(e) {
			e.preventDefault();
			var target = $($(this).attr('data-tab'));
			
			if ($(target).is(':visible')){
				return false;
			}else{
				target.parents('.tabs-box').find('.tab-buttons').find('.tab-btn').removeClass('active-btn');
				$(this).addClass('active-btn');
				target.parents('.tabs-box').find('.tabs-content').find('.tab').fadeOut(0);
				target.parents('.tabs-box').find('.tabs-content').find('.tab').removeClass('active-tab');
				$(target).fadeIn(100);
				$(target).addClass('active-tab');
			}
		});
	}

	//Add One Page nav
	if($('.scroll-nav').length) {
		$('.scroll-nav').onePageNav();
	}

	//nice select
	$(document).ready(function() {
		$('select:not(.ignore)').niceSelect();
	  });


	//Sortable Masonary with Filters
	function enableMasonry() {
		if($('.sortable-masonry').length){
	
			var winDow = $(window);
			// Needed variables
			var $container=$('.sortable-masonry .items-container');
			var $filter=$('.filter-btns');
	
			$container.isotope({
				filter:'*',
				 masonry: {
					columnWidth : '.masonry-item.small-column'
				 },
				animationOptions:{
					duration:500,
					easing:'linear'
				}
			});
			
	
			// Isotope Filter 
			$filter.find('li').on('click', function(){
				var selector = $(this).attr('data-filter');
	
				try {
					$container.isotope({ 
						filter	: selector,
						animationOptions: {
							duration: 500,
							easing	: 'linear',
							queue	: false
						}
					});
				} catch(err) {
	
				}
				return false;
			});
	
	
			winDow.on('resize', function(){
				var selector = $filter.find('li.active').attr('data-filter');

				$container.isotope({ 
					filter	: selector,
					animationOptions: {
						duration: 500,
						easing	: 'linear',
						queue	: false
					}
				});
			});
	
	
			var filterItemA	= $('.filter-btns li');
	
			filterItemA.on('click', function(){
				var $this = $(this);
				if ( !$this.hasClass('active')) {
					filterItemA.removeClass('active');
					$this.addClass('active');
				}
			});
		}
	}
	
	enableMasonry();


    // Progress Bar
	if ($('.count-bar').length) {
		$('.count-bar').appear(function(){
			var el = $(this);
			var percent = el.data('percent');
			$(el).css('width',percent).addClass('counted');
		},{accY: -50});

	}


	// Scroll top button
    $('.scroll-top-inner').on("click", function () {
        $('html, body').animate({scrollTop: 0}, 500);
        return false;
    });


    function handleScrollbar() {
        const bHeight = $('body').height();
        const scrolled = $(window).innerHeight() + $(window).scrollTop();

        let percentage = ((scrolled / bHeight) * 100);

        if (percentage > 100) percentage = 100;

        $('.scroll-top-inner .bar-inner').css( 'width', percentage + '%');
    }


	// page direction
	function directionswitch() {
	  	if ($('.page_direction').length) {

	    	$('.direction_switch button').on('click', function() {
			   $('.boxed_wrapper').toggleClass(function(){
			      return $(this).is('.rtl, .ltr') ? 'rtl ltr' : 'rtl';
			  })
			});
	  	};
	}


	// Scroll to a Specific Div
	if($('.scroll-to-target').length){
		$(".scroll-to-target").on('click', function() {
			var target = $(this).attr('data-target');
		   // animate
		   $('html, body').animate({
			   scrollTop: $(target).offset().top
			 }, 1000);
	
		});
	}


	// Date picker
	function datepicker () {
	    if ($('#datepicker').length) {
	        $('#datepicker').datepicker();
	    };
	}

	if($('.curved-circle').length) {
        $('.curved-circle').circleType({position: 'absolute', dir: 1, radius: 90, forceHeight: true, forceWidth: true});
    }


    //Search Popup
	if($('#search-popup').length){
		
		//Show Popup
		$('.search-toggler').on('click', function() {
			$('#search-popup').addClass('popup-visible');
		});
		$(document).keydown(function(e){
	        if(e.keyCode === 27) {
	            $('#search-popup').removeClass('popup-visible');
	        }
	    });
		//Hide Popup
		$('.close-search,.search-popup .overlay-layer').on('click', function() {
			$('#search-popup').removeClass('popup-visible');
		});
	}


	//Price Range Slider
	if($('.price-range-slider').length){
		$( ".price-range-slider" ).slider({
			range: true,
			min: 10,
			max: 99,
			values: [ 10, 60 ],
			slide: function( event, ui ) {
			$( "input.property-amount" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
			}
		});
		
		$( "input.property-amount" ).val( $( ".price-range-slider" ).slider( "values", 0 ) + " - $" + $( ".price-range-slider" ).slider( "values", 1 ) );	
	}


	
        $('.cal-month-bar').on('click', '.cal-month-prev', function() {
            var cur_block = $(this).parents().eq(1);
            if ($(cur_block).prev('.cal-month-block').length) {
                $(cur_block).removeClass('cal-month-active');
                $(cur_block).prev('.cal-month-block').addClass('cal-month-active');
            }
        });
        $('.cal-month-bar').on('click', '.cal-month-next', function() {
            var cur_block = $(this).parents().eq(1);
            if ($(cur_block).next('.cal-month-block').length) {
                $(cur_block).removeClass('cal-month-active');
                $(cur_block).next('.cal-month-block').addClass('cal-month-active');
            }
        });
        function av_cal_set_month(Y, m) {
            var mm = m + 1;
            mm = (mm < 10) ? "0" + mm : mm;
            $('.cal-month-block.cal-month-active').removeClass('cal-month-active');
            $('.cal-month-block[data-yearmonth="' + Y + '-' + mm + '"]').addClass('cal-month-active');
        }


	


	/*	=========================================================================
	When document is on ready, do
	========================================================================== */

	jQuery(document).on('ready', function () {
		(function ($) {
			// add your functions
			directionswitch();
			datepicker ();
		})(jQuery);
	});



	/* ==========================================================================
   When document is Scrollig, do
   ========================================================================== */
	
	$(window).on('scroll', function() {
		headerStyle();
		handleScrollbar();
		if ($(window).scrollTop() > 200) {
                $('.scroll-top-inner').addClass('visible');
            } else {
                $('.scroll-top-inner').removeClass('visible');
            }
	});

	
	
	/* ==========================================================================
   When document is loaded, do
   ========================================================================== */
	
	$(window).on('load', function() {
		handlePreloader();
		enableMasonry();
	});

	

})(window.jQuery);