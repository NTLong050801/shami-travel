<?php

require_once get_template_directory() . '/includes/loader.php';

add_action( 'after_setup_theme', 'travic_setup_theme' );
add_action( 'after_setup_theme', 'travic_load_default_hooks' );


function travic_setup_theme() {

	load_theme_textdomain( 'travic', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-header' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'woocommerce' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'align-wide' );
	add_theme_support( "title-tag" );
	add_theme_support( "responsive-embeds" );
	add_theme_support( "wp-block-styles" );
	
    
	// Set the default content width.
	$GLOBALS['content_width'] = 525;
	
	/*---------- Register image sizes ----------*/
	
	//Register image sizes
	add_image_size( 'travic_60x60', 60, 60, true ); //travic_60x60 Testimonial Carousal
	add_image_size( 'travic_100x100', 100, 100, true ); //travic_100x100 Testimonial Carousal
	add_image_size( 'travic_410x250', 410, 250, true ); //travic_410x250 Blog Grid
	add_image_size( 'travic_90x90', 90, 90, true ); //travic_90x90 Blog Widgets
	add_image_size( 'travic_120x120', 120, 120, true ); //travic_120x120 Author Image
	add_image_size( 'travic_1170x520', 1170, 520, true ); //travic_1170x520 Blog Classic
	add_image_size( 'travic_315x400', 315, 400, true ); //travic_315x400 Tours Packages
	add_image_size( 'travic_410x275', 410, 275, true ); //travic_410x275 Packages Carousel
	add_image_size( 'travic_80x80', 80, 80, true ); //travic_80x80 Featured Tours
	
	
	/*---------- Register image sizes ends ----------*/
	
	
	
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'main_menu' => esc_html__( 'Main Menu', 'travic' ),
		'one_page_menu' => esc_html__( 'One Page Menu', 'travic' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'      => 250,
		'height'     => 250,
		'flex-width' => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style();
	add_action( 'admin_init', 'travic_admin_init', 2000000 );
}

/**
 * [travic_admin_init]
 *
 * @param  array $data [description]
 *
 * @return [type]       [description]
 */


function travic_admin_init() {
	remove_action( 'admin_notices', array( 'ReduxFramework', '_admin_notices' ), 99 );
}

/*---------- Sidebar settings ----------*/

/**
 * [travic_widgets_init]
 *
 * @param  array $data [description]
 *
 * @return [type]       [description]
 */
function travic_widgets_init() {

	global $wp_registered_sidebars;
	$theme_options = get_theme_mod( 'travic' . '_options-mods' );
	register_sidebar( array(
		'name'          => esc_html__( 'Default Sidebar', 'travic' ),
		'id'            => 'default-sidebar',
		'description'   => esc_html__( 'Widgets in this area will be shown on the right-hand side.', 'travic' ),
		'before_widget' => '<div id="%1$s" class="widget sidebar-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
	) );
	register_sidebar(array(
		'name' => esc_html__('Footer Widget', 'travic'),
		'id' => 'footer-sidebar',
		'description' => esc_html__('Widgets in this area will be shown in Footer Area.', 'travic'),
		'before_widget'=>'<div class="footer-column"><div id="%1$s" class="footer-widget %2$s">',
		'after_widget'=>'</div></div>',
		'before_title' => '<div class="widget-title"><h3>',
		'after_title' => '</h3></div>'
	));
	register_sidebar(array(
		'name' => esc_html__('Footer 02 Widget', 'travic'),
		'id' => 'footer-sidebar2',
		'description' => esc_html__('Widgets in this area will be shown in Footer Area.', 'travic'),
		'before_widget'=>'<div class="col-lg-3 col-md-6 col-sm-12 footer-column footer-widget"><div id="%1$s" class="footer-widget single-footer-widget %2$s">',
		'after_widget'=>'</div></div>',
		'before_title' => '<div class="widget-title"><h3>',
		'after_title' => '</h3></div>'
	));
	if ( class_exists( '\Elementor\Plugin' )){
		register_sidebar(array(
		  'name' => esc_html__( 'Blog Listing', 'travic' ),
		  'id' => 'blog-sidebar',
		  'description' => esc_html__( 'Widgets in this area will be shown on the right-hand side.', 'travic' ),
		  'before_widget'=>'<div id="%1$s" class="widget sidebar-side sidebar-widget mb_60 %2$s">',
		  'after_widget'=>'</div>',
		  'before_title' => '<div class="widget-title mb_25"><h3>',
		  'after_title' => '</h3></div>'
		));
	}
	if ( ! is_object( travic_WSH() ) ) {
		return;
	}

	$sidebars = travic_set( $theme_options, 'custom_sidebar_name' );

	foreach ( array_filter( (array) $sidebars ) as $sidebar ) {

		if ( travic_set( $sidebar, 'topcopy' ) ) {
			continue;
		}

		$name = $sidebar;
		if ( ! $name ) {
			continue;
		}
		$slug = str_replace( ' ', '_', $name );

		register_sidebar( array(
			'name'          => $name,
			'id'            => sanitize_title( $slug ),
			'before_widget' => '<div id="%1$s" class="%2$s widget sidebar-widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widget-title"><h3>',
			'after_title'   => '</h3></div>',
		) );
	}

	update_option( 'wp_registered_sidebars', $wp_registered_sidebars );
}

add_action( 'widgets_init', 'travic_widgets_init' );

/*---------- Sidebar settings ends ----------*/

/*---------- Gutenberg settings ----------*/

function travic_gutenberg_editor_palette_styles() {
    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => esc_html__( 'strong yellow', 'travic' ),
            'slug' => 'strong-yellow',
            'color' => '#f7bd00',
        ),
        array(
            'name' => esc_html__( 'strong white', 'travic' ),
            'slug' => 'strong-white',
            'color' => '#fff',
        ),
		array(
            'name' => esc_html__( 'light black', 'travic' ),
            'slug' => 'light-black',
            'color' => '#242424',
        ),
        array(
            'name' => esc_html__( 'very light gray', 'travic' ),
            'slug' => 'very-light-gray',
            'color' => '#797979',
        ),
        array(
            'name' => esc_html__( 'very dark black', 'travic' ),
            'slug' => 'very-dark-black',
            'color' => '#000000',
        ),
    ) );
	
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name' => esc_html__( 'Small', 'travic' ),
			'size' => 10,
			'slug' => 'small'
		),
		array(
			'name' => esc_html__( 'Normal', 'travic' ),
			'size' => 15,
			'slug' => 'normal'
		),
		array(
			'name' => esc_html__( 'Large', 'travic' ),
			'size' => 24,
			'slug' => 'large'
		),
		array(
			'name' => esc_html__( 'Huge', 'travic' ),
			'size' => 36,
			'slug' => 'huge'
		)
	) );
	
}
add_action( 'after_setup_theme', 'travic_gutenberg_editor_palette_styles' );

/*---------- Gutenberg settings ends ----------*/

/*---------- Enqueue Styles and Scripts ----------*/

function travic_enqueue_scripts() {
	$options = travic_WSH()->option();
	
    //styles
    wp_enqueue_style( 'fontawesome-all', get_template_directory_uri() . '/assets/css/font-awesome-all.css' );
	wp_enqueue_style( 'flaticon', get_template_directory_uri() . '/assets/css/flaticon.css' );
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/css/owl.css' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css' );
	wp_enqueue_style( 'jquery-fancybox', get_template_directory_uri() . '/assets/css/jquery.fancybox.min.css' );
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.css' );
	wp_enqueue_style( 'nice-select', get_template_directory_uri() . '/assets/css/nice-select.css' );
	wp_enqueue_style( 'jquery-ui', get_template_directory_uri() . '/assets/css/jquery-ui.css' );
	wp_enqueue_style( 'elpath', get_template_directory_uri() . '/assets/css/elpath.css' );
	wp_enqueue_style( 'travic-color', get_template_directory_uri() . '/assets/css/color.css' );
	wp_enqueue_style( 'travic-banner-section', get_template_directory_uri() . '/assets/css/module-css/banner.css' );
	wp_enqueue_style( 'travic-booking-form', get_template_directory_uri() . '/assets/css/module-css/booking-form.css' );
	wp_enqueue_style( 'travic-about-section', get_template_directory_uri() . '/assets/css/module-css/about.css' );
	wp_enqueue_style( 'travic-chooseus', get_template_directory_uri() . '/assets/css/module-css/chooseus.css' );
	wp_enqueue_style( 'travic-offers', get_template_directory_uri() . '/assets/css/module-css/offers.css' );
	wp_enqueue_style( 'travic-cart', get_template_directory_uri() . '/assets/css/module-css/cart.css' );
	wp_enqueue_style( 'travic-clients', get_template_directory_uri() . '/assets/css/module-css/clients.css' );
	wp_enqueue_style( 'travic-destination-details', get_template_directory_uri() . '/assets/css/module-css/destination-details.css' );
	wp_enqueue_style( 'travic-destinations', get_template_directory_uri() . '/assets/css/module-css/destinations.css' );
	wp_enqueue_style( 'travic-tours', get_template_directory_uri() . '/assets/css/module-css/tours.css' );
	wp_enqueue_style( 'travic-category', get_template_directory_uri() . '/assets/css/module-css/category.css' );
	wp_enqueue_style( 'travic-video', get_template_directory_uri() . '/assets/css/module-css/video.css' );
	wp_enqueue_style( 'travic-instagram', get_template_directory_uri() . '/assets/css/module-css/instagram.css' );
	wp_enqueue_style( 'travic-place', get_template_directory_uri() . '/assets/css/module-css/place.css' );
	wp_enqueue_style( 'travic-pricing', get_template_directory_uri() . '/assets/css/module-css/pricing.css' );
	wp_enqueue_style( 'travic-testimonial', get_template_directory_uri() . '/assets/css/module-css/testimonial.css' );
	wp_enqueue_style( 'travic-news', get_template_directory_uri() . '/assets/css/module-css/news.css' );
	wp_enqueue_style( 'travic-faq', get_template_directory_uri() . '/assets/css/module-css/faq.css' );
	wp_enqueue_style( 'travic-news-sidebar', get_template_directory_uri() . '/assets/css/module-css/news-sidebar.css' );
	wp_enqueue_style( 'travic-blog-details', get_template_directory_uri() . '/assets/css/module-css/blog-details.css' );
	wp_enqueue_style( 'travic-contact', get_template_directory_uri() . '/assets/css/module-css/contact.css' );
	wp_enqueue_style( 'travic-contact-info', get_template_directory_uri() . '/assets/css/module-css/contact-info.css' );
	wp_enqueue_style( 'travic-error', get_template_directory_uri() . '/assets/css/module-css/error.css' );
	wp_enqueue_style( 'travic-tour-sidebar', get_template_directory_uri() . '/assets/css/module-css/tour-sidebar.css' );
	wp_enqueue_style( 'travic-tours', get_template_directory_uri() . '/assets/css/module-css/tours.css' );
	wp_enqueue_style( 'travic-tour-details', get_template_directory_uri() . '/assets/css/module-css/tour-details.css' );
	wp_enqueue_style( 'page-title', get_template_directory_uri() . '/assets/css/module-css/page-title.css' );
	wp_enqueue_style( 'travic-subscribe', get_template_directory_uri() . '/assets/css/module-css/subscribe.css' );
	wp_enqueue_style( 'travic-main', get_stylesheet_uri() );
	wp_enqueue_style( 'travic-main-style', get_template_directory_uri() . '/assets/css/style.css' );
	wp_enqueue_style( 'travic-custom', get_template_directory_uri() . '/assets/css/custom.css' );
	wp_enqueue_style( 'travic-tut', get_template_directory_uri() . '/assets/css/tut.css' );
	wp_enqueue_style( 'travic-gutenberg', get_template_directory_uri() . '/assets/css/gutenberg.css' );
	wp_enqueue_style( 'travic-responsive', get_template_directory_uri() . '/assets/css/responsive.css' );
	
    //scripts
	wp_enqueue_script( 'jquery-ui-core');
	wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/assets/js/bootstrap.min.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'owl', get_template_directory_uri().'/assets/js/owl.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'wow', get_template_directory_uri().'/assets/js/wow.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'jquery-fancybox', get_template_directory_uri().'/assets/js/jquery.fancybox.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'appear', get_template_directory_uri().'/assets/js/appear.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'isotope', get_template_directory_uri().'/assets/js/isotope.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'jquery-nice-select', get_template_directory_uri().'/assets/js/jquery.nice-select.min.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'jquery-lettering', get_template_directory_uri().'/assets/js/jquery.lettering.min.js', array( 'jquery' ), '2.1.2', true );	
	wp_enqueue_script( 'jquery-circletype', get_template_directory_uri().'/assets/js/jquery.circleType.js', array( 'jquery' ), '2.1.2', true );	
	wp_enqueue_script( 'text-animation', get_template_directory_uri().'/assets/js/text_animation.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'text-plugins', get_template_directory_uri().'/assets/js/text_plugins.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'parallax-scroll', get_template_directory_uri().'/assets/js/parallax-scroll.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'pagenav', get_template_directory_uri().'/assets/js/pagenav.js', array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'travic-main-script', get_template_directory_uri().'/assets/js/script.js', array(), false, true );
	
	if( is_singular() ) wp_enqueue_script('comment-reply');
}
add_action( 'wp_enqueue_scripts', 'travic_enqueue_scripts' );

/*---------- Enqueue styles and scripts ends ----------*/

/*---------- Google fonts ----------*/

function travic_fonts_url() {
	
	$fonts_url = '';
	
		
		$font_families['Seaweed+Script']     = 'Seaweed Script:300,400,500,600,700,800,900';
		$font_families['Urbanist']        = 'Urbanist:300,400,500,600,700,800,900';
		$font_families['Inter']        = 'Inter:300,400,500,600,700,800,900';
		

		$font_families = apply_filters( 'TRAVIC/includes/classes/header_enqueue/font_families', $font_families );

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$protocol  = is_ssl() ? 'https' : 'http';
		$fonts_url = add_query_arg( $query_args, $protocol . '://fonts.googleapis.com/css' );

		return esc_url_raw($fonts_url);

}

function travic_theme_styles() {
    wp_enqueue_style( 'travic-theme-fonts', travic_fonts_url(), array(), null );
}

add_action( 'wp_enqueue_scripts', 'travic_theme_styles' );
add_action( 'admin_enqueue_scripts', 'travic_theme_styles' );

/*---------- Google fonts ends ----------*/

/*---------- More functions ----------*/

// 1) travic_set function

/**
 * [travic_set description]
 *
 * @param  array $data [description]
 *
 * @return [type]       [description]
 */
if ( ! function_exists( 'travic_set' ) ) {
	function travic_set( $var, $key, $def = '' ) {

		if ( is_object( $var ) && isset( $var->$key ) ) {
			return $var->$key;
		} elseif ( is_array( $var ) && isset( $var[ $key ] ) ) {
			return $var[ $key ];
		} elseif ( $def ) {
			return $def;
		} else {
			return false;
		}
	}
}


//Contact Form 7 List
function get_contact_form_7_list()
{
	$contact_forms = array();
	$cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
	if (!empty($cf7)) {
		foreach ($cf7 as $cform) {
			if (isset($cform)) {
				if (isset($cform->ID) && isset($cform->post_title)) {
					$contact_forms[$cform->ID] = $cform->post_title;
				}
			}
		}
	}
    return $contact_forms;
}

// 2) travic_add_editor_styles function

function travic_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'admin_init', 'travic_add_editor_styles' );

// 3) Add specific CSS class by filter body class.

$options = travic_WSH()->option(); 
if( travic_set($options, 'boxed_wrapper') ){

add_filter( 'body_class', function( $classes ) {
    $classes[] = 'boxed_wrapper';
    return $classes;
} );
}

add_filter('doing_it_wrong_trigger_error', function () {return false;}, 10, 0);


//Related Products

function travic_related_products_limit() {
  global $product;
	
	$args['posts_per_page'] = 6;
	return $args;
}
function travic_register_block_patterns() {
    register_block_pattern(
        'travic/custom-pattern-1',
        array(
            'title'       => __('Custom Pattern 1', 'travic'),
            'description' => __('Description of Custom Pattern 1.', 'travic'),
            'content'     => '<!-- Your block pattern content here -->',
            'categories'  => array('text'),
            'keywords'    => array('pattern', 'layout', 'custom'),
        )
    );

    // Add more block patterns as needed
}
add_action('init', 'travic_register_block_patterns');
function travic_register_block_styles() {
    // Register custom block styles for specific blocks
    register_block_style(
        'core/paragraph',
        array(
            'name'         => 'travic-custom-style-1',
            'label'        => __('Custom Style 1', 'travic'),
            'style_handle' => 'travic-custom-style-1-css', // Enqueue your custom style CSS
        )
    );

    // Add more custom block styles as needed
}
add_action('init', 'travic_register_block_styles');