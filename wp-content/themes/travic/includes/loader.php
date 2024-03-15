<?php

define( 'TRAVIC_ROOT', get_template_directory() . '/' );

require_once get_template_directory() . '/includes/functions/functions.php';
include_once get_template_directory() . '/includes/classes/base.php';
include_once get_template_directory() . '/includes/classes/dotnotation.php';
include_once get_template_directory() . '/includes/classes/header-enqueue.php';
include_once get_template_directory() . '/includes/classes/options.php';
include_once get_template_directory() . '/includes/classes/ajax.php';
include_once get_template_directory() . '/includes/classes/common.php';
include_once get_template_directory() . '/includes/classes/bootstrap_walker.php';
include_once get_template_directory() . '/includes/library/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/includes/library/hook.php';

// Merlin demo import.
require_once get_template_directory() . '/demo-import/class-merlin.php';
require_once get_template_directory() . '/demo-import/merlin-config.php';
require_once get_template_directory() . '/demo-import/merlin-filters.php';

add_action( 'after_setup_theme', 'travic_wp_load', 5 );

function travic_wp_load() {

	defined( 'TRAVIC_URL' ) or define( 'TRAVIC_URL', get_template_directory_uri() . '/' );
	define(  'TRAVIC_KEY','!@#travic');
	define(  'TRAVIC_URI', get_template_directory_uri() . '/');

	if ( ! defined( 'TRAVIC_NONCE' ) ) {
		define( 'TRAVIC_NONCE', 'travic_wp_theme' );
	}

	( new \TRAVIC\Includes\Classes\Base )->loadDefaults();
	( new \TRAVIC\Includes\Classes\Ajax )->actions();

}

add_action( 'init', 'travic_bunch_theme_init');
function travic_bunch_theme_init()
{
	$bunch_exlude_hooks = include_once get_template_directory(). '/includes/resource/remove_action.php';
	foreach( $bunch_exlude_hooks as $k => $v )
	{
		foreach( $v as $value )
		remove_action( $k, $value[0], $value[1] );
	}

}