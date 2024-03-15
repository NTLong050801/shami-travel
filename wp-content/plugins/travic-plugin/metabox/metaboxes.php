<?php
if ( ! function_exists( "travic_add_metaboxes" ) ) {
	function travic_add_metaboxes( $metaboxes ) {
		$directories_array = array(
			'page.php',
			'projects.php',
			'testimonials.php',
		);
		foreach ( $directories_array as $dir ) {
			$metaboxes[] = require_once( TRAVICPLUGIN_PLUGIN_PATH . '/metabox/' . $dir );
		}

		return $metaboxes;
	}

	add_action( "redux/metaboxes/travic_options/boxes", "travic_add_metaboxes" );
}

