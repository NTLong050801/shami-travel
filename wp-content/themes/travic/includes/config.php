<?php
/**
 * Theme config file.
 *
 * @package TRAVIC
 * @author  TonaTheme
 * @version 1.0
 * changed
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Restricted' );
}

$config = array();

$config['default']['travic_main_header'][] 	= array( 'travic_main_header_area', 99 );

$config['default']['travic_main_footer'][] 	= array( 'travic_main_footer_area', 99 );

$config['default']['travic_sidebar'][] 	    = array( 'travic_sidebar', 99 );

$config['default']['travic_banner'][] 	    = array( 'travic_banner', 99 );


return $config;
