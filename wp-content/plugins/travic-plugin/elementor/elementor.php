<?php

namespace TRAVICPLUGIN\Element;


class Elementor {
	static $widgets = array(
		//Home Page One
		'banner_slider',
		'hero_title',
		'icon_box',
		'float_image',
		'featured_tours',
		'categories_section',
		'video_section',
		'our_features',
		'testimonials_carousel',
		'blog_grid',
		'newsletter_form',
		
		//Home Page Two
		'banner',
		'our_destination',
		'tours_packages',
		'button',
		'count_box',
		
		//Home Page Three
		'packages_carousel',
		'clients_section',
		'instagram_section',
		
		//FAQs
		'our_faqs',
		
		//Contct
		'google_map',
		'form',
		
		
		
		
		
		
	);

	static function init() {
		add_action( 'elementor/init', array( __CLASS__, 'loader' ) );
		add_action( 'elementor/elements/categories_registered', array( __CLASS__, 'register_cats' ) );
	}

	static function loader() {

		foreach ( self::$widgets as $widget ) {

			$file = TRAVICPLUGIN_PLUGIN_PATH . '/elementor/' . $widget . '.php';
			if ( file_exists( $file ) ) {
				require_once $file;
			}

			add_action( 'elementor/widgets/widgets_registered', array( __CLASS__, 'register' ) );
		}
	}

	static function register( $elemntor ) {
		foreach ( self::$widgets as $widget ) {
			$class = '\\TRAVICPLUGIN\\Element\\' . ucwords( $widget );

			if ( class_exists( $class ) ) {
				$elemntor->register_widget_type( new $class );
			}
		}
	}

	static function register_cats( $elements_manager ) {

		$elements_manager->add_category(
			'travic',
			[
				'title' => esc_html__( 'Travic', 'travic' ),
				'icon'  => 'fa fa-plug',
			]
		);
		$elements_manager->add_category(
			'templatepath',
			[
				'title' => esc_html__( 'Template Path', 'travic' ),
				'icon'  => 'fa fa-plug',
			]
		);

	}
}

Elementor::init();