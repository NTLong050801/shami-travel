<?php

return array(
	'id'     => 'travic_banner_settings',
	'title'  => esc_html__( "Travic Banner Settings", "konia" ),
	'fields' => array(
		array(
			'id'      => 'banner_source_type',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Banner Source Type', 'travic' ),
			'options' => array(
				'd' => esc_html__( 'Default', 'travic' ),
				'e' => esc_html__( 'Elementor', 'travic' ),
			),
			'default' => '',
		),
		array(
			'id'       => 'banner_elementor_template',
			'type'     => 'select',
			'title'    => __( 'Template', 'viral-buzz' ),
			'data'     => 'posts',
			'args'     => [
				'post_type' => [ 'elementor_library' ],
				'posts_per_page'=> -1,
			],
			'required' => [ 'banner_source_type', '=', 'e' ],
		),
		array(
			'id'       => 'banner_page_banner',
			'type'     => 'switch',
			'title'    => esc_html__( 'Show Banner', 'travic' ),
			'default'  => false,
			'required' => [ 'banner_source_type', '=', 'd' ],
		),
		array(
			'id'       => 'banner_banner_title',
			'type'     => 'text',
			'title'    => esc_html__( 'Banner Section Title', 'travic' ),
			'desc'     => esc_html__( 'Enter the title to show in banner section', 'travic' ),
			'required' => array( 'banner_page_banner', '=', true ),
		),
		array(
			'id'       => 'banner_page_background',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Background Image', 'travic' ),
			'desc'     => esc_html__( 'Insert background image for banner', 'travic' ),
			'default'  => array(
				'url' => TRAVIC_URI . '/assets/images/background/page-title-6.jpg',
			),
			'required' => array( 'banner_page_banner', '=', true ),
		),
	),
);